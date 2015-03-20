<?
define('BASEPATH', str_replace("\\", "/", $system_path));
require_once 'API_Base.php';
require_once 'db/mysqli.php';
require_once 'helper/functions.php';

class ExtendedAPI extends API_Base
{
    public function __construct($request, $origin) {
        parent::__construct($request);
    }
	
    protected function greeting() {
        if ($this->method == 'GET') {
			if($this->verb == 'answerme'){
				return array("Response" => "Yo, Bitch");
			} else { 
				return null;
			}
        } else {
            return "Go away";
        }
    }
	protected function auth(){
		if ($this->method == 'POST') {
			$hashed = $this->args;
			$data = $_POST;
			$username = htmlspecialchars(strip_tags($data['username']));
			$password = htmlspecialchars(strip_tags($data['password']));
			
			require_once('../../application/config/database.php');
			require_once('../../application/config/config.php');
			
			$db = new DBMySQLi($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);

			$result = $db->query("select email, password from users where email = '".$username."'");			
			
			if($result->num_rows > 0){
				$user = $result->row;
				
				$hash = _encode($password, $config['encryption_key']);
				$hash = crypt($hash, $user['password']);
								
				if($user['password'] == $hash){
					return array("success" => 1);
				} else {
					return array("success" => 0, "error_message" => "wrong password");
				}
			} else {
				return array("success" => 0,	"error_message" => "this login does not exists");
			}
			
        }
	}
 }
 