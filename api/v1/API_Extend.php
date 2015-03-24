<?

require_once 'API_Base.php';

class ExtendedAPI extends API_Base
{
    public function __construct($request, $origin) {
        parent::__construct($request);

    }
	
    protected function greeting() {
	
		switch($this->method){
		
			case 'GET':
			
				if($this->verb == 'answerme'){			
					return array("Success" => 1, "Response" => "Yo, Bitch");
				} else { 
					return array("success" => 0, "error_message" => "NO ACCESS");
				}	
				
				break;
				
			default:
			
				return array("success" => 0, "error_message" => "NO ACCESS");
				
				break;
		}
    }
	
	protected function auth($auth = false) {
	
		switch($this->method){
		
			case 'POST':
			
				if($this->verb == 'login') {
					$data = $this->request;
				
					if($this->checkAuth($data['username'], $data['password'])){
						return array("success" => 1);
					} else {
						return array("success" => 0, "error_message" => "WRONG_PASS");
					}
				}
													
				break;
			
			default:
			
				return array("success" => 0, "error_message" => "NO ACCESS");
				
				break;
		}
	}
	
	//============= CATEGORY
	
	protected function category() {
	
		switch($this->method){
		
			case 'GET':
			
				if(empty($this->args) && empty($this->verb)) {
			
					$result = $this->db->query("select id, parent_id, position, field_group, name, short_desc, title, keywords, description, url from category");										// all categories
					
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $result->rows);
					} else {
						return array("success" => 0, "error_message" => "CATEGORY LIST EMPTY");
					}
					
				} else if(empty($this->verb) && !empty($this->args)) {
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
					
					$result = $this->db->query("select * from category where id = '".$id."'");															// category by id
						
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $result->rows);
					} else {
						return array("success" => 0, "error_message" => "CATEGORY NOT FOUND");
					}
						
				} else if($this->verb == 'filter' && !empty($this->args)){
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
					
					$result = $this->db->query("select id, parent_id, position, field_group, name, short_desc, title, keywords, description, url from category");
					
					$items = $result->rows;
					
					$items = removeChilds($items, $id);
										
					if(count($items) > 0){
						return array("success" => 1, "items" => $items);
					} else {
						return array("success" => 0, "error_message" => "CATEGORY NOT FOUND");
					}
					
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");	
				}
				break;
			
			case 'POST':
		
				if(empty($this->args) && empty($this->verb)){
			
					$data = $this->unsafe_request;
					$exceptions = array("short_desc");
					stripFields($data, $exceptions);				
					
					$date = date_create();
					
					$data['created'] = date_timestamp_get($date);
					
					$query = "insert into category (parent_id,position,name,title,short_desc,url,image,keywords,description,fetch_pages,main_tpl,tpl,page_tpl,per_page,order_by,sort_order,comments_default,field_group,category_field_group,settings,created,updated) VALUES (";
					$query .= "'".$data['parent_id']."', '0', '".$data['name']."', '".$data['title']."', '".$data['short_desc']."', '".$data['url']."', '', '".$data['keywords']."', '".$data['description']."', 'b:0;', '', '', '', '15', 'id', 'asc', '0', '7', '-1', 'NULL', '".$data['created']."', '".$data['created']."')";
									
					$result = $this->db->query($query);

					if($result->errno)
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					else 
						return array("success" => 1, "insert_id" => $this->db->getLastId());
					
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				}
				
				break;
				
			case 'PUT':
			
				if(empty($this->verb) && count($this->args) == 1){
				
					$id = htmlspecialchars(strip_tags($this->args[0]));
					$data = $this->unsafe_request;
					
					$exceptions = array("short_desc");
					stripFields($data, $exceptions);
					
					$date = date_create();
					$data['updated'] = date_timestamp_get($date);
					
					$query = "update category set parent_id = '".$data['parent_id']."', name = '".$data['name']."', title = '".$data['title']."', short_desc = '".$data['short_desc']."', url = '".$data['url']."', keywords = '".$data['keywords']."', description = '".$data['description']."', updated = '".$data['updated']."' where id = '".$id."'";
											
					$result = $this->db->query($query);

					if($result->errno)
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					else 
						return array("success" => 1);
						
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				}
				
				break;
			
			case 'DELETE':
			
				if(empty($this->verb) && count($this->args) == 1){
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
	
					$query = "delete from category where id = ".$id;
					
					$result = $this->db->query($query);
					
					if(!$this->db->countAffected())
						return array("success" => 0, "error_message" => "CATEGORY NOT FOUND");	
					else {

						$query = "delete from content where category = ".$id;					
						$result = $this->db->query($query);	
						
						return array("success" => 1);
					}
						
					
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				}	
				
				break;
				
			default:
			
				break;
		}
	}
	
	//============= END CATEGORY
	
	//============= PAGE
	
	protected function page() {
	
		switch($this->method) {
		
			case 'GET':
			
				if(empty($this->args) && empty($this->verb)){
			
					$result = $this->db->query("select id, title, meta_title, url, keywords, description, prev_text, full_text, category from content");							// all pages
					
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $result->rows);
					} else {
						return array("success" => 0, "error_message" => "PAGES LIST EMPTY");
					}
				
				} else if(empty($this->verb) && !empty($this->args)){
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
				
					$result = $this->db->query("select id, title, meta_title, url, keywords, description, prev_text, full_text, category from content where id = '".$id."'");		// single page by id
					
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $result->rows);
					} else {
						return array("success" => 0, "error_message" => "PAGE NOT FOUND");
					}
					
				} else if(!empty($this->args) && $this->verb == 'category'){
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
					
					$result = $this->db->query("select id, title, meta_title, url, keywords, description, prev_text, full_text, category from content where category = '".$id."'");	// pages by category
					
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $result->rows);
					} else {
						return array("success" => 0, "error_message" => "NO PAGES IN CATEGORY");
					}		
					
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");									
				}
				
				break;
			
			case 'POST':		
				
				if(empty($this->args) && empty($this->verb)){
			
					$data = $this->unsafe_request;
					$exceptions = array("prev_text", "full_text");
					stripFields($data, $exceptions);				
					
					$date = date_create();
					
					$data['created'] = date_timestamp_get($date);
					
					$cat_id = $data['category'];
					$query = "select id, parent_id, url from category";
					$result = $this->db->query($query);

					$path = buildPath($result->rows, $cat_id);
										
					$query = "insert into content (title, meta_title, url, cat_url, keywords, description, prev_text, full_text, category, full_tpl, main_tpl, position, comments_status, comments_count, post_status, author, publish_date, created, updated, showed, lang, lang_alias) VALUES (";
					$query .= "'".$data['title']."', '".$data['meta_title']."', '".$data['url']."', '".$path."', '".$data['keywords']."', '".$data['description']."', '".$data['prev_text']."', '".$data['full_text']."', '".$data['category']."', '', '', '', '', '', 'publish', '".$data['author']."', '".$data['created']."', '".$data['created']."', '".$data['created']."', '0', '3', '0')";
							
					$result = $this->db->query($query);
					
					if($result->errno)
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					else 
						return array("success" => 1, "insert_id" => $this->db->getLastId());
					
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				}
				
				break;
							
			case 'PUT':				
				
				if(empty($this->verb) && count($this->args) == 1){
				
					$id = htmlspecialchars(strip_tags($this->args[0]));
					$data = $this->unsafe_request;
					
					$exceptions = array("prev_text", "full_text");
					stripFields($data, $exceptions);
					
					$date = date_create();
					
					$cat_id = $data['category'];
					$query = "select id, parent_id, url from category";
					$result = $this->db->query($query);

					$path = buildPath($result->rows, $cat_id);
					
					$data['updated'] = date_timestamp_get($date);
					$data['cat_url'] = $path;
					
					$query = "update content set title = '".$data['title']."', meta_title = '".$data['meta_title']."', url = '".$data['url']."', cat_url = '".$data['cat_url']."', keywords = '".$data['keywords']."', description = '".$data['description']."', prev_text = '".$data['prev_text']."', full_text = '".$data['full_text']."', category = '".$data['category']."', updated = '".$data['updated']."' where id = '".$id;
											
					$result = $this->db->query($query);

					if(!$this->db->countAffected())
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					else 
						return array("success" => 1);
						
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				}
				
				break;
			
			case 'DELETE':			
				
				if(empty($this->verb) && count($this->args) == 1){
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
	
					$query = "delete from content where id = ".$id;
					
					$result = $this->db->query($query);
					
					if(!$this->db->countAffected())
						return array("success" => 0, "error_message" => "PAGE NOT FOUND");	
					else {						
						return array("success" => 1);
					}						
					
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				}	
				
				break;
				
			default:
			
				break;
		}
	}
	
	//============= END PAGE

	//============= MENU
	
	protected function menu() {
	
		switch($this->method){
		
			case 'GET':
								
				break;
			
			case 'POST':
										
				break;
				
			case 'PUT':
							
				break;
			
			case 'DELETE':
							
				break;
				
			default:
			
				break;
		}
	}
	
	//============= END MENU
	
	//============= COMMENTS
	
	protected function comment() {
	
		switch($this->method){
		
			case 'GET':
								
				break;
			
			case 'POST':
										
				break;
				
			case 'PUT':
							
				break;
			
			case 'DELETE':
							
				break;
				
			default:
			
				break;
		}
	}
	
	//============= END COMMENTS
	
	//============= USER
	
	protected function user() {
		switch($this->method){
		
			case 'GET':
								
				break;
			
			case 'POST':
										
				break;
				
			case 'PUT':
							
				break;
			
			case 'DELETE':
							
				break;
				
			default:
			
				break;
		}
	}
	
	//============= END USERS
	
	
	
	/*private function getError($code){
		$errors = array(
			"1022" => "DUPLICATE PRIMARY KEY",
			"1027" => "TABLE LOCKED",
			"1028" => "SORT ABORTED",
			"1032" => "KEY NOT FOUND",
			"1036" => "TABLE IS READ ONLY",
			"1040" => "TOO MANY CONNECTIONS",
			"1045" => "ACCESS DENIED FOR THIS USER",
			"1046" => "NO DATABASE SELECTED",
			"1053" => "SERVER SHUTDOWN",
			"1065" => "QUERY IS EMPTY"
		 );
	}*/
	
 }
 