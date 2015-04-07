<?
	function _encode($password, $key){
		$majorsalt = '';

        if ($key != '') {
            $_password = $key . $password;
        } else {
            $_password = $password;
        }

        $_pass = str_split($_password);

        foreach ($_pass as $_hashpass) {
            $majorsalt .= md5($_hashpass);
        }
		
        return md5($majorsalt);
	}
	
	function stripAllFields(&$fields){
	
		foreach ($fields as $key => $value){ 
			$fields[$key] = strip_tags($value); 
		}  
		
	}
	
	function stripFields(&$fields, $exceptions){
	
		foreach($fields as $key => $value){
			if(!in_array($key, $exceptions)){
				$fields[$key] = strip_tags($value); 
			}
		}
		
	}
	
    function buildTree($elements, $parentId = 0) {
        $branch = array();
		
        foreach ($elements as $element) {
		
            if ($element['parent_id'] == $parentId) {
			
                $children = buildTree($elements, $element['id']);
				
                if ($children) {
                    $element['sub'] = $children;
                }
				
                $branch[] = $element;
				
            }
			
        }
        return $branch;
    }
	
	function removeChilds($elements, $id, $head = true){
	
		foreach($elements as $key => $element){
		
			if($element['id'] == $id && $head) {
				unset($elements[$key]);
				$head = false;
			}
		
			if($element['parent_id'] == $id){
			
				$newId = $element['id'];
				unset($elements[$key]);
				$elements = removeChilds($elements, $newId, $head);
				
			}

		}
		
		return $elements;
	}
	
	function buildPath($elements, $id, $path = ''){
	
		foreach ($elements as $element) {
		
            if ($element['id'] == $id) {
                
				$path = $element['url'] . "/" . $path;				
				$id = $element['parent_id'];				
				$path = buildPath($elements, $id, $path);
            }
        }
		
        return $path;
	}
	
	function oneDimArray($elements){
		$iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($elements));

		$result = array();
		foreach($iterator as $key => $value) {
			$result[$key] = $value;
		}
		
		return $result;
	}
	
	function nullToEmptyString(&$elements){
	
		foreach($elements as $k=>$element){
			foreach($element as $j=>$el){
				if($el == null)
					$elements[$k][$j] = '';
			}
		}
		
	}
	
	function stripTrash(&$elements){
	
		foreach($elements as $k=>$element){
			foreach($element as $j=>$el){				
				$elements[$k][$j] = str_replace('[removed]', '', $el);				
			}
		}
		
	}