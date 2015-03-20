<?
require_once 'API_Base.php';
class ExtendedAPI extends API_Base
{
    protected $User;

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
 }
 