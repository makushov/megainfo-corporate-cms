<?

require_once 'API_Base.php';

class ExtendedAPI extends API_Base
{
    public function __construct($request, $origin) {
	
        parent::__construct($request);

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
					
				} else if(empty($this->verb) && count($this->args) == 1) {
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
					
					$result = $this->db->query("select * from category where id = '".$id."'");															// category by id
						
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $result->rows);
					} else {
						return array("success" => 0, "error_message" => "CATEGORY NOT FOUND");
					}
						
				} else if($this->verb == 'filter' && count($this->args) == 1){
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
					
					$result = $this->db->query("select id, parent_id, position, field_group, name, short_desc, title, keywords, description, url from category");
					
					$items = $result->rows;
					
					$items = removeChilds($items, $id);
										
					$items = array_values($items);
										
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
					
					$query = "insert into category (parent_id, position, name, title, short_desc, url, image, keywords, description, fetch_pages, per_page, order_by, sort_order, comments_default, field_group, category_field_group, created, updated) VALUES (";
					$query .= "'".$data['parent_id']."', '0', '".$data['name']."', '".$data['title']."', '".$data['short_desc']."', '".$data['url']."', '', '".$data['keywords']."', '".$data['description']."', 'b:0;', '15', 'id', 'asc', '0', '7', '-1', '".$data['created']."', '".$data['created']."')";
									
					$result = $this->db->query($query);

					if($result->errno)
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					else { 
						$lastId = $this->db->getLastId();
						$this->log("Создана категория. Id: ".$lastId, $data['username'], $data['device']);
						return array("success" => 1, "insert_id" => $lastId);
					}
					
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
					else { 
						$this->log("Изменена категория. Id: ".$id, $data['username'], $data['device']);
						return array("success" => 1);
					}
						
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				}
				
				break;
			
			case 'DELETE':
			
				if(empty($this->verb) && count($this->args) == 1){
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
					
					$result = $this->db->query("delete from category where id = '".$id."'");
					
					if(!$this->db->countAffected())
						return array("success" => 0, "error_message" => "CATEGORY NOT FOUND");	
					else {
						$data = $this->request;
						$this->log("Удалена категория. Id: ".$id, $data['username'], $data['device']);
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
			
				if(empty($this->args) && empty($this->verb)) {
			
					$result = $this->db->query("select id, title, meta_title, url, keywords, description, prev_text, full_text, category, post_status from content");								// all pages
					
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $result->rows);
					} else {
						return array("success" => 0, "error_message" => "PAGES LIST EMPTY");
					}
				
				} else if(empty($this->verb) && count($this->args) == 1) {
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
				
					$result = $this->db->query("select id, title, meta_title, url, keywords, description, prev_text, full_text, category, post_status from content where id = '".$id."'");			// single page by id
					
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $result->rows);
					} else {
						return array("success" => 0, "error_message" => "PAGE NOT FOUND");
					}
					
				} else if(count($this->args) == 1 && $this->verb == 'category'){
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
					
					$result = $this->db->query("select id, title, meta_title, url, keywords, description, prev_text, full_text, category, post_status from content where category = '".$id."'");	// pages by category
					
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
					$result = $this->db->query("select id, parent_id, url from category");

					$path = buildPath($result->rows, $cat_id);
										
					$query = "insert into content (title, meta_title, url, cat_url, keywords, description, prev_text, full_text, category, post_status, author, publish_date, created, updated, lang, lang_alias) VALUES (";
					$query .= "'".$data['title']."', '".$data['meta_title']."', '".$data['url']."', '".$path."', '".$data['keywords']."', '".$data['description']."', '".$data['prev_text']."', '".$data['full_text']."', '".$data['category']."', '".$data['post_status']."', '".$data['author']."', '".$data['created']."', '".$data['created']."', '".$data['created']."', '3', '0')";
							
					$result = $this->db->query($query);
					
					if($result->errno)
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					else{ 
						$lastId = $this->db->getLastId();
						$this->log("Создана страница. Id: ".$lastId, $data['username'], $data['device']);
						return array("success" => 1, "insert_id" => $lastId);
					}
					
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
					$result = $this->db->query("select id, parent_id, url from category");

					$path = buildPath($result->rows, $cat_id);
					
					$data['updated'] = date_timestamp_get($date);
					$data['cat_url'] = $path;
					
					$query = "update content set title = '".$data['title']."', meta_title = '".$data['meta_title']."', url = '".$data['url']."', cat_url = '".$data['cat_url']."', keywords = '".$data['keywords']."', description = '".$data['description']."', prev_text = '".$data['prev_text']."', full_text = '".$data['full_text']."', category = '".$data['category']."', updated = '".$data['updated']."', post_status='".$data['post_status']."' where id = '".$id."'";
											
					$result = $this->db->query($query);
					
					if(!$this->db->countAffected())
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					else{
						$this->log("Изменена страница. Id: ".$id, $data['username'], $data['device']);
						return array("success" => 1);
					}
						
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				}
				
				break;
			
			case 'DELETE':			
				
				if(empty($this->verb) && count($this->args) == 1){
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
	
					$result = $this->db->query("delete from content where id = '".$id."'");
					
					if(!$this->db->countAffected())
						return array("success" => 0, "error_message" => "PAGE NOT FOUND");	
					else {	
						$data = $this->request;
						$this->log("Удалена страница. Id: ".$id, $data['username'], $data['device']);
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
			
				if(empty($this->verb) && empty($this->args)){
				
					$result = $this->db->query("select id, name, main_title, expand_level from menus");												// all menus
					
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $result->rows);
					} else {
						return array("success" => 0, "error_message" => "MENU LIST EMPTY");
					}
					
				} else if (empty($this->verb) && count($this->args) == 1) {
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
				
					$result = $this->db->query("select id, name, main_title, expand_level, from menus where id = '".$id."'");							// menu by id
					
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $result->rows);
					} else {
						return array("success" => 0, "error_message" => "MENU NOT FOUND");
					}
					
				} else if($this->verb == 'item' && count($this->args) == 1){
				
					$id = htmlspecialchars(strip_tags($this->args[0]));
				
					$result = $this->db->query("select id, menu_id, item_id, item_type, title, parent_id, position, add_data, hidden from menus_data where id = '".$id."'");							// menu item by id
					
					$newResult = $result->rows;
					
					foreach($newResult as $key => $value){
					
						$add_data = unserialize($value['add_data']);
																		
						$url = isset($add_data['url']) ? str_ireplace("\\/", "/", $add_data['url']) : '';
						
						unset($newResult[$key]['add_data']);
						
						$newResult[$key]['url'] = $url;
						
					}
					
					$newResult = array_values($newResult);
					
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $newResult);
					} else {
						return array("success" => 0, "error_message" => "MENU ITEM NOT FOUND");
					}
					
				} else if($this->verb == 'branch' && count($this->args) == 1){
				
					$id = htmlspecialchars(strip_tags($this->args[0]));
				
					$result = $this->db->query("select id, menu_id, item_id, item_type, title, parent_id, position, add_data, hidden from menus_data where menu_id = '".$id."'");							// menu items by branch id
					
					$newResult = $result->rows;
					
					foreach($newResult as $key => $value){
					
						$add_data = unserialize($value['add_data']);
												
						$url = isset($add_data['url']) ? $add_data['url'] : '';
						
						unset($newResult[$key]['add_data']);
						
						$newResult[$key]['url'] = $url;
						
					}
					
					$newResult = array_values($newResult);
					
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $newResult);
					} else {
						return array("success" => 0, "error_message" => "MENU NOT FOUND");
					}
					
				} else if($this->verb == 'filter' && count($this->args) == 2){
				
					$menuId = htmlspecialchars(strip_tags($this->args[0]));
					
					$itemId = htmlspecialchars(strip_tags($this->args[1]));
				
					$result = $this->db->query("select id, menu_id, item_id, item_type, title, parent_id, position, add_data, hidden from menus_data where menu_id = '".$menuId."'");							// menu items by branch id
					
					$newResult = $result->rows;
					
					foreach($newResult as $key => $value){
					
						$add_data = unserialize($value['add_data']);
												
						$url = isset($add_data['url']) ? $add_data['url'] : '';
						
						unset($newResult[$key]['add_data']);
						
						$newResult[$key]['url'] = $url;
						
					}
					
					$newResult = removeChilds($newResult, $itemId);
															
					$newResult = array_values($newResult);
										
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $newResult);
					} else {
						return array("success" => 0, "error_message" => "MENU NOT FOUND");
					}
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				}
				
				break;
			
			case 'POST':			
				
				if(empty($this->args) && empty($this->verb)){
			
					$data = $this->request;

					$result = $this->db->query("insert into menus (name, main_title, expand_level, created) VALUES ( '".$data['name']."', '".$data['main_title']."', '".$data['expand_level']."', NOW() )");
					
					if($result->errno)
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					else {
						$lastId = $this->db->getLastId();
						$this->log("Создано меню. Id: ".$lastId, $data['username'], $data['device']);
						return array("success" => 1, "insert_id" => $lastId);
					}
					
				} else if ($this->verb == 'item' && empty($this->args)) {
				
					$data = $this->request;
					
					$add_data_serialized = null;
					
					if($data['item_type'] === 'url'){
						
						$add_data = array();
						
						$add_data['url'] = $data['url'];
						
						$add_data['newpage'] = '';
						
						$add_data_serialized = serialize($add_data);
						
					}
										
					$query = "insert into menus_data (menu_id, item_id, item_type, title, parent_id, position, add_data, hidden) VALUES ( '".$data['menu_id']."', '".$data['item_id']."', '".$data['item_type']."', '".$data['title']."', '".$data['parent_id']."', '".$data['position']."', '".$add_data_serialized."', '".$data['hidden']."' )";
							
					$result = $this->db->query($query);
					
					if($result->errno)
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					else {
						$lastId = $this->db->getLastId();
						$this->log("Создан пункт меню. Id: ".$lastId, $data['username'], $data['device']);
						return array("success" => 1, "insert_id" => $lastId);
					}
						
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				}
				
				break;
				
			case 'PUT':
			
				if(count($this->args) == 1 && empty($this->verb)){
				
					$id = htmlspecialchars(strip_tags($this->args[0]));
			
					$data = $this->request;
	
					$result = $this->db->query("update menus set name='".$data['name']."', main_title='".$data['main_title']."', expand_level='".$data['expand_level']."' where id = '".$id."'");
					
					if($result->errno)
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					else{
						$this->log("Изменено меню. Id: ".$id, $data['username'], $data['device']);
						return array("success" => 1);
					}
					
				} else if ($this->verb == 'item' && count($this->args) == 1) {
				
					$id = htmlspecialchars(strip_tags($this->args[0]));
				
					$data = $this->request;
					
					$add_data_serialized = null;
					
					if($data['item_type'] === 'url'){
						
						$add_data = array();
						
						$add_data['url'] = $data['url'];
						
						$add_data['newpage'] = '';
						
						$add_data_serialized = serialize($add_data);
						
					}
										
					$query = "update menus_data set menu_id='".$data['menu_id']."', item_id='".$data['item_id']."', item_type='".$data['item_type']."', title='".$data['title']."', parent_id='".$data['parent_id']."', position='".$data['position']."', add_data='".$add_data_serialized."', hidden='".$data['hidden']."' where id='".$id."'";
							
					$result = $this->db->query($query);
					
					if($result->errno)
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					else {
						$this->log("Изменен пункт меню. Id: ".$id, $data['username'], $data['device']);
						return array("success" => 1);
					}
						
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				}			
				break;
			
			case 'DELETE':
			
				if (empty($this->verb) && count($this->args) == 1) {
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
				
					$result = $this->db->query("delete from menus where id = '".$id."'");								// menu by id
					
					$data = $this->request;
					
					if($this->db->countAffected() > 0){
						$this->log("Удалено меню. Id: ".$id, $data['username'], $data['device']);
						$result = $this->db->query("delete from menus_data where menu_id = '".$id."'");						
						return array("success" => 1);
					} else {
						return array("success" => 0, "error_message" => "MENU NOT FOUND");
					}
					
				} else if($this->verb == 'item' && count($this->args) == 1) {
				
					$id = htmlspecialchars(strip_tags($this->args[0]));
				
					$result = $this->db->query("delete from menus_data where id = '".$id."'");							// menu item by id
										
					if($this->db->countAffected() > 0){
						$data = $this->request;
						$this->log("Удален пункт меню. Id: ".$id, $data['username'], $data['device']);
						return array("success" => 1);
					} else {
						return array("success" => 0, "error_message" => "MENU ITEM NOT FOUND");
					}
					
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				}	
				
				break;
				
			default:
			
				break;
		}
	}
	
	//============= END MENU
	
	//============= SITE SETTINGS
	
	protected function setting() {
	
		switch($this->method){
		
			case 'GET':
				
				if($this->verb == 'info' && empty($this->args)){
					
					$result = $this->db->query("select siteinfo from settings");	
					
					$newResult = $result->row;
					
					$newResult = unserialize($newResult['siteinfo']); 
				
					$newResult = oneDimArray($newResult); 
					
					unset($newResult['corporate']);	
					unset($newResult['skype']);
					unset($newResult['email']);					
			
					return array("success" => 1, "items" => array($newResult));
				
				} else if($this->verb == 'metatag' && count($this->args) == 1){
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
					
					$result = $this->db->query("select lang_ident, name, short_name, keywords, description from settings_i18n where lang_ident = '".$id."'");

					return array("success" => 1, "items" => array($result->row));
					
				} else if($this->verb == 'metatag' && empty($this->args)){
									
					$result = $this->db->query("select create_keywords, create_description, add_site_name, add_site_name_to_cat, delimiter from settings");
												
					return array("success" => 1, "items" => array($result->row));
					
				} else if($this->verb == 'general' && empty($this->args)){
									
					$result = $this->db->query("select main_type, main_page_id, main_page_cat from settings");
						
					return array("success" => 1, "items" => array($result->row));
					
				} else if($this->verb == 'access' && empty($this->args)){
									
					$result = $this->db->query("select site_offline, robots_status from settings");
						
					return array("success" => 1, "items" => array($result->row));
					
				} else if($this->verb == 'lang' && empty($this->args)){
					
					$result = $this->db->query("select id, lang_name, identif, folder, `default`, locale from languages");
						
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $result->rows);
					} else {
						return array("success" => 0, "error_message" => "LANGUAGES LIST EMPTY");
					}	
					
				} else if($this->verb == 'lang' && count($this->args) == 1){
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
					
					$result = $this->db->query("select id, lang_name, identif, folder, `default`, locale from languages where id = '".$id."'");
						
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $result->array(row));
					} else {
						return array("success" => 0, "error_message" => "LANGUAGE NOT FOUND");
					}				
				}
				
				else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				}	
				
				break;
			
			case 'POST':
						
				if($this->verb == 'lang' && empty($this->args)){
					
					$data = $this->request;
										
					$result = $this->db->query("insert into languages (lang_name, identif, folder, `default`, locale) VALUES ( '".$data['lang_name']."', '".$data['identif']."', '".$data['folder']."', '".$data['default']."', '".$data['locale']."' )");
					
					if($result->errno)
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					else {
						$lastId = $this->db->getLastId();
						$this->log("Добавлен язык. Id: ".$lastId, $data['username'], $data['device']);
						return array("success" => 1, "insert_id" => $lastId);
					}
					
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				}  
						
				break;
				
			case 'PUT':
				
				if($this->verb == 'info' && empty($this->args)){
					
					$result = $this->db->query("select siteinfo from settings");						
					$newResult = $result->row;					
					$newResult = unserialize($newResult['siteinfo']);
					
					$data = $this->request;
					
					$newResult['ru']['siteinfo_companytype'] = $data['siteinfo_companytype'];
					$newResult['ru']['siteinfo_address'] = $data['siteinfo_address'];
					$newResult['ru']['siteinfo_mainphone'] = $data['siteinfo_mainphone'];
					$newResult['ru']['siteinfo_adminemail'] = $data['siteinfo_adminemail'];
					
					$newResult = serialize($newResult);
					

							
					$result = $this->db->query("update settings set siteinfo='".$newResult."'");
					
					if($result->errno)
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					else {
						$this->log("Изменена информация о сайте", $data['username'], $data['device']);
						return array("success" => 1);
					}
										
				} else if($this->verb == 'metatag' && count($this->args) == 1){
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
					
					$data = $this->request;
					
					$result = $this->db->query("update settings_i18n set name='".$data['name']."', short_name='".$data['short_name']."', keywords='".$data['keywords']."', description='".$data['description']."' where lang_ident = '".$id."'");

					if($result->errno)
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					else {
						$this->log("Изменена информация о мета-тегах для языка. Id: ".$id, $data['username'], $data['device']);
						return array("success" => 1);
					}
					
				} else if($this->verb == 'metatag' && empty($this->args)){
				
					$data = $this->request;
							
					$result = $this->db->query("update settings set create_keywords='".$data['create_keywords']."', create_description='".$data['create_description']."', add_site_name='".$data['add_site_name']."', add_site_name_to_cat='".$data['add_site_name_to_cat']."', delimiter='".$data['delimiter']."'");
												
					if($result->errno)
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					else {
						$this->log("Изменена информация о мета-тегах", $data['username'], $data['device']);
						return array("success" => 1);
					}
					
				} else if($this->verb == 'general' && empty($this->args)){
						
					$data = $this->request;
						
					$result = $this->db->query("update settings set main_type='".$data['main_type']."', main_page_id='".$data['main_page_id']."', main_page_cat='".$data['main_page_cat']."'");
						
					if($result->errno)
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					else {
						$this->log("Изменена общая информация о сайте", $data['username'], $data['device']);
						return array("success" => 1);
					}
					
				} else if($this->verb == 'access' && empty($this->args)){
						
					$data = $this->request;
						
					$result = $this->db->query("update settings set site_offline='".$data['site_offline']."', robots_status='".$data['robots_status']."'");
						
					if($result->errno)
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					else {
						$this->log("Изменены настройки доступа к сайту", $data['username'], $data['device']);
						return array("success" => 1);
					}
					
				} else if($this->verb == 'lang' && count($this->args) == 1){
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
					
					$result = $this->db->query("update languages set lang_name='".$data['lang_name']."', identif='".$data['identif']."', folder='".$data['folder']."', `default`='".$data['default']."', locale='".$data['locale']."' where id = '".$id."'");
						
					if($result->errno)
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					else {
						$this->log("Изменена информация о языках. Id: ".$id, $data['username'], $data['device']);
						return array("success" => 1);
					}
				}
				
				else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				}	
				
				break;
			
			case 'DELETE':
				
				if ($this->verb == 'lang' && count($this->args) == 1) {
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
				
					$result = $this->db->query("delete from languages where id = '".$id."'");		
					
					if($this->db->countAffected() > 0){						
						$data = $this->request;
						$this->log("Удален язык. Id: ".$id, $data['username'], $data['device']);
						return array("success" => 1);
					} else {
						return array("success" => 0, "error_message" => "LANGUAGE NOT FOUND");
					}
					
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				} 
				
				break;
				
			default:
			
				break;
		}
	}
	
	//============= END SITE SETTINGS

	//============= JOURNAL
	
	protected function journal() {
	
		switch($this->method){
		
			case 'GET':
				
				if(empty($this->verb) && empty($this->args)){
					
					$result = $this->db->query("select * from logs order by ID DESC limit 50");	
								
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $result->rows);
					} else {
						return array("success" => 0, "error_message" => "JOURNAL EMPTY");
					}					
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				} 				
				
				break;
			
			case 'POST':
				
				return array("success" => 0, "error_message" => "BAD REQUEST");
				
				break;
				
			case 'PUT':
					
				return array("success" => 0, "error_message" => "BAD REQUEST");
					
				break;
			
			case 'DELETE':
				
				return array("success" => 0, "error_message" => "BAD REQUEST");
				
				break;
				
			default:
			
				break;
		}
	}
	
	//============= END JOURNAL
	
	//============= COMMENTS
	
	protected function comment() {
	
		switch($this->method){
		
			case 'GET':							
				
				if(empty($this->verb) && empty($this->args)){
					
					$result = $this->db->query("select id, user_id, user_name, user_mail, item_id, text, date, status from comments order by date");	
					
					$newResult = $result->rows;
					
					stripTrash($newResult);
								
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $newResult);
					} else {
						return array("success" => 0, "error_message" => "COMMENT LIST EMPTY");
					}
					
				} else if (empty($this->verb) && count($this->args) == 1){
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
					
					$result = $this->db->query("select id, user_id, user_name, user_mail, item_id, text, date, status from comments where id = '".$id."'");	
							
					$newResult = $result->rows;
					
					stripTrash($newResult);
							
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $newResult);
					} else {
						return array("success" => 0, "error_message" => "COMMENT NOT FOUND");
					}
					
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				} 
				
				break;
			
			case 'POST':
										
				break;
				
			case 'PUT':
							
				break;
			
			case 'DELETE':
					
				if (empty($this->verb) && count($this->args) == 1){
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
					
					$result = $this->db->query("delete from comments where id = '".$id."'");	
							
					if($this->db->countAffected() > 0){						
						$data = $this->request;
						$this->log("Удален комментарий. Id: ".$id, $data['username'], $data['device']);
						return array("success" => 1);
					} else {
						return array("success" => 0, "error_message" => "COMMENT NOT FOUND");
					}
					
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				} 
					
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
			
				if(empty($this->verb) && empty($this->args)){
					
					$result = $this->db->query("select id, role_id, username, email, banned, ban_reason, phone from users");	
					
					$newResult = $result->rows;
					
					nullToEmptyString($newResult);
								
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $newResult);
					} else {
						return array("success" => 0, "error_message" => "USER LIST EMPTY");
					}
					
				} else if ($this->verb == 'role' && empty($this->args)){
										
					$result = $this->db->query("select id, alt_name, locale, description from shop_rbac_roles_i18n where locale = 'ru'");	
								
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $result->rows);
					} else {
						return array("success" => 0, "error_message" => "ROLE LIST EMPTY");
					}
					
				} else if ($this->verb == 'role' && count($this->args) == 1){
							
					$id = htmlspecialchars(strip_tags($this->args[0]));
							
					$result = $this->db->query("select id, alt_name, locale, description from shop_rbac_roles_i18n where locale = 'ru' and id = '".$id."'");	
								
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $result->rows);
					} else {
						return array("success" => 0, "error_message" => "ROLE NOT FOUND");  
					}
					
				} else if (empty($this->verb) && count($this->args) == 1){
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
					
					$result = $this->db->query("select id, role_id, username, email, banned, ban_reason, phone from users where id = '".$id."'");	

					$newResult = $result->rows;
					
					nullToEmptyString($newResult);
								
					if($result->num_rows > 0){
						return array("success" => 1, "items" => $newResult);
					} else {
						return array("success" => 0, "error_message" => "USER NOT FOUND");
					}											
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				} 
					
				break;
			
			case 'POST':
					
				if (empty($this->verb) && empty($this->args)){
					
					$data = $this->request;
					
					$hash = _encode($data['user_password'], $this->encryption_key);
					
					$hash = crypt($hash);
					
					$result = $this->db->query("insert into users (role_id, username, password, email, phone) values ('".$data['role_id']."', '".$data['login']."', '".$hash."', '".$data['email']."', '".$data['phone']."')");		
								
					if($result->errno){
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					} else {
						$lastId = $this->db->getLastId();
						$this->log("Добавлен пользователь. Id: ".$lastId, $data['username'], $data['device']);
						return array("success" => 1, "insert_id" => $lastId);
					}											
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				} 
					
				break;
				
			case 'PUT':
			
				if (empty($this->verb) && count($this->args) == 1){
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
					
					$data = $this->request;					
					
					if(isset($data['user_password']) && !empty($data['user_password'])) {
						$hash = _encode($data['user_password'], $this->encryption_key);					
						$hash = crypt($hash);
						$result = $this->db->query("update users set role_id='".$data['role_id']."', username='".$data['login']."', password='".$hash."', email='".$data['email']."', phone='".$data['phone']."' where id = '".$id."'");	
					} else {
						$result = $this->db->query("update users set role_id='".$data['role_id']."', username='".$data['login']."', email='".$data['email']."', phone='".$data['phone']."' where id = '".$id."'");
					}
						
					if($this->db->countAffected() > 0){
						$this->log("Изменен аккаунт пользователя. Id: ".$id, $data['username'], $data['device']);
						return array("success" => 1);
						
					} else {
						return array("success" => 0, "error_message" => "INCORRECT DATA");
					}											
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				}
				
				break;
			
			case 'DELETE':
			
				if (empty($this->verb) && count($this->args) == 1){
					
					$id = htmlspecialchars(strip_tags($this->args[0]));
					
					$result = $this->db->query("delete from users where id = '".$id."'");		
								
					if($this->db->countAffected() > 0){						
						$data = $this->request;						
						$this->log("Удален пользователь. Id: ".$id, $data['username'], $data['device']);
						return array("success" => 1);						
					} else {
						return array("success" => 0, "error_message" => "USER NOT FOUND");
					}											
				} else {
					return array("success" => 0, "error_message" => "BAD REQUEST");
				}   
				
				break;
				
			default:
			
				break;
		}
	}
	
	//============= END USERS
	
	private function log($message, $username, $device){
		
		$result = $this->db->query("select id, username from users where email = '".$username."'");		
		$row = $result->row;		
		$id = $row['id'];
		$name = $row['username'];
		
		$date = date_create();
		$date = date_timestamp_get($date);
		
		if(!empty($device)){
			$message .= " (Мобильное приложение для ".$device.") ";
		} else {
			$message .= ' (Бабушкин кампутыр) ';
		}
		
		$result = $this->db->query("insert into logs (user_id, username, message, date) values ('".$id."', '".$name."', '".$message."', '".$date."')");
		
	}
 }
 