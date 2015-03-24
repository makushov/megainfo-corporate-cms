<?
define('BASEPATH', str_replace("\\", "/", $system_path));
require_once 'db/mysqli.php';
require_once 'helper/functions.php';

abstract class API_Base
{

    protected $method = ''; // POST GET PUT DELETE
	
    protected $endpoint = ''; // cats dogs

    protected $verb = ''; // cats/feed

    protected $args = Array(); // /<endpoint>/<verb>/<arg0>/<arg1>

    protected $file = Null; // file with PUT
	
	protected $request = array();
	
	protected $unsafe_request = array();
	
	protected $allowed = true;
	
	protected $db;
	
	protected $encryption_key;

    public function __construct($request) {
				
		require_once('../../application/config/database.php');
		require_once('../../application/config/config.php');
		
		$this->db = new DBMySQLi($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);
		$this->encryption_key = $config['encryption_key'];
	
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
		header("Cache-Control: no-cache, must-revalidate"); 
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");  
        header("Content-Type: application/json; charset=utf-8"); 
        $this->args = explode('/', rtrim($request, '/'));
        $this->endpoint = array_shift($this->args);
        if (array_key_exists(0, $this->args) && !is_numeric($this->args[0])) {
            $this->verb = array_shift($this->args);
        }

        $this->method = $_SERVER['REQUEST_METHOD'];
        if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->method = 'DELETE';
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $this->method = 'PUT';
            } else {
                throw new Exception("Unexpected Header");
            }
        }

        switch($this->method) {
			case 'POST':
				$this->request = $this->_cleanInputs($_POST);
				$this->unsafe_request = $_POST;
				break;
			case 'GET':
				$this->request = $this->_cleanInputs($_GET);
				break;
			case 'DELETE':
			case 'PUT':
				$this->file = file_get_contents("php://input");
				parse_str($this->file, $this->unsafe_request);
				$this->request = $this->_cleanInputs($this->unsafe_request);
				break;
			default:
				$this->allowed = false;
				break;
        }
    }
	
	protected function checkAuth($login, $password){		
				
		$result = $this->db->query("select email, password from users where email = '".$login."'");			
				
		if($result->num_rows > 0){
					
			$user = $result->row;
			$hash = _encode($password, $this->encryption_key);
			$hash = crypt($hash, $user['password']);
			if($user['password'] == $hash){
				return true;
			} else {
				return false;
			}
			
		} else 
			return false;
	}
 
	public function processAPI() {	
		$username = isset($this->request['username']) ? $this->request['username'] : null;
		$password = isset($this->request['password']) ? $this->request['password'] : null;
		
		if(!$this->checkAuth($username, $password) && $this->endpoint != "auth") {	
			$this->allowed = false;
			return $this->_response("You are not authorized for this action: $this->endpoint", 403);
		}
										
	    if($this->allowed){
			if (method_exists($this, $this->endpoint)) {
				return $this->_response($this->{$this->endpoint}($this->args));
			}
		} else {
			return $this->_response("Invalid Method: $this->method", 405);
		}
        return $this->_response("Wrong entry call: $this->endpoint", 404);
    }

    private function _response($data, $status = 200) {
        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
        return json_encode($data, JSON_UNESCAPED_UNICODE); 
    }

    private function _cleanInputs($data) {
        $clean_input = Array();
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $clean_input[$k] = $this->_cleanInputs($v);
            }
        } else {
            $clean_input = trim(strip_tags($data));
        }
        return $clean_input;
    }

    private function _requestStatus($code) {
        $status = array(  
            200 => 'OK',
			401 => 'Not Authorized',
			403 => 'Forbidden',
            404 => 'Not Found',   
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        ); 
        return ($status[$code])?$status[$code]:$status[500]; 
    }
}