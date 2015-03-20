<?
define('BASEPATH', str_replace("\\", "/", $system_path));
require_once 'API_Base.php';
require_once 'db/mysqli.php';
require_once 'helper/functions.php';

class ExtendedAPI extends API_Base
{
	private $db;
	private $encryption_key;

    public function __construct($request, $origin) {
        parent::__construct($request);
		
		require_once('../../application/config/database.php');
		require_once('../../application/config/config.php');
		
		$this->db = new DBMySQLi($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);
		$this->encryption_key = $config['encryption_key'];
    }
	
    protected function greeting() {
        if ($this->method == 'GET') {
			if($this->verb == 'answerme'){
				return array("Success" => 1, "Response" => "Yo, Bitch");
			} else { 
				return array("Success" => 0, "error_message" => "No access");
			}
        }
    }
	
	protected function auth() {
		if ($this->method == 'POST') {
			if($this->verb == 'login') {
				$data = $_POST;
				$username = htmlspecialchars(strip_tags($data['username']));
				$password = htmlspecialchars(strip_tags($data['password']));
				
				$result = $this->db->query("select email, password from users where email = '".$username."'");			
	
				if($result->num_rows > 0){
					$user = $result->row;
					
					$hash = _encode($password, $this->encryption_key);
					$hash = crypt($hash, $user['password']);

					if($user['password'] == $hash){
						return array("success" => 1);
					} else {
						return array("success" => 0, "error_message" => "WRONG_PASS");
					}
				} else {
					return array("success" => 0,	"error_message" => "WRONG_PASS");
				}
			}			
        }
	}
	
	protected function category() {
		if ($this->method == 'GET') {
		
			if(empty($this->args)){
			
				$result = $this->db->query("select * from category");
				if($result->num_rows > 0){
					return array("success" => 1, "items" => $result->rows);
				} else {
					return array("success" => 0, "error_message" => "CATEGORY IS EMPTY");
				}
				
			} else {
			
				$result = $this->db->query("select * from category where id = '".$this->args[0]."'");
				if($result->num_rows > 0){
					return array("success" => 1, "items" => $result->rows);
				} else {
					return array("success" => 0, "error_message" => "CATEGORY NOT FOUND");
				}
				
			}
        } 
	}
 }
 