<?php

namespace CMS\Libraries\Classes\Extended;

use CMS\Libraries\Classes\Standard as Standard;

class Form extends Standard {

    public function __construct($container) {
		parent::__construct($container);
    }
	
    public function init($module, $fields, $request, $data = null) {
		//show form $data ['table_name' => Single Object{}] 
		//post form $data ['table_name' => ['id' => $value]]
		//data $_POST
		$dir =  dirname($_SERVER['PHP_SELF']);
		$dirs = explode('/', $dir);
		$side = strtolower($dirs[1]);
		
		if($side == 'administrator'){
			$XML_DATA = file_get_contents('Modules/'.ucfirst($module).'/'.ucfirst($module).'.xml', true);
		} else {
			$XML_DATA = file_get_contents('Administrator/Modules/'.ucfirst($module).'/'.ucfirst($module).'.xml', true);
		}
		
		$structure = $this->v->object_to_array(simplexml_load_string($XML_DATA));
		$data_tables = [];
		
		foreach (array_keys($fields) as $index => $table) {
			//example tables : ['category'];
			$rows = [];
			$class = "\CMS\Libraries\Tables\\".ucfirst($table);
			$content = new $class($this->container, $module);
			
			foreach ($fields[$table] as $key => $field) {
				//example fields : ['table_name' => ['id']];
				if($request == 'send'){
					$data[$module][$field] = (isset($data[$module][$field]) && !empty($data[$module][$field])) ? $data[$module][$field] : 0;
					$return = $content->$field($data[$module][$field], $structure[$table][$field]['params']['validation']);
					$rows[$field] = $return;
				} else {
					$type = $structure[$table][$field]['params']['type'];
					$default_data = $structure[$table][$field]['value'];
					$required = !empty($structure[$table][$field]['params']['required']) ? $structure[$table][$field]['params']['required'] : '';
					$sent_data = isset($data[$table]->$field) ? $data[$table]->$field : '';
									
					$row = $this->$type($field, $default_data, $sent_data, $module, $required);
					$rows[$field] = $row;
				}
			}
			
			$data_tables[$table] = $rows;
		}
		
		return $data_tables;
    }
	
	public function show($name, $value, $sent_data, $module, $required) {
		$container = [];
		$label_required = ($required == 'required') ? '* ' : '';
		$container['label'] = $label_required.constant(strtoupper($name));
		$value = !empty($sent_data) ? $sent_data : '';
		
		$container['control'] = $value.'<input type="hidden" value="'.$value.'" size="30" name="'.$module.'['.$name.']" '.$required.' />';
		return $container;
	}
	
	public function input($name, $value, $sent_data, $module, $required) {
		$container = [];
		$label_required = ($required == 'required') ? '* ' : '';
		$container['label'] = $label_required.constant(strtoupper($name));
		$value = !empty($sent_data) ? $sent_data : '';
		
		$container['control'] = '<input type="text" value="'.$value.'" size="30" name="'.$module.'['.$name.']" class="form-control" '.$required.' />';
		return $container;
	}
	
	public function time($name, $value, $sent_data, $module, $required) {
		$container = [];
		$label_required = ($required == 'required') ? '* ' : '';
		$container['label'] = $label_required.constant(strtoupper($name));
		$value = !empty($sent_data) ? $sent_data : '';
		
		$container['control'] = '<div class="input-group date" id="time"><input type="text" value="'.$value.'" size="30" name="'.$module.'['.$name.']" class="form-control" '.$required.' /><span class="input-group-addon time-addon"><span class="glyphicon glyphicon-time"></span></span></div>';
		return $container;
	}
	
	public function date($name, $value, $sent_data, $module, $required) {
		$container = [];
		$label_required = ($required == 'required') ? '* ' : '';
		$container['label'] = $label_required.constant(strtoupper($name));
		$value = !empty($sent_data) ? $sent_data : '';
		
		$container['control'] = '<div class="input-group date" id="date"><input type="text" value="'.$value.'" size="30" name="'.$module.'['.$name.']" class="form-control" '.$required.' /><span class="input-group-addon date-addon"><span class="glyphicon glyphicon-calendar"></span></span></div>';
		return $container;
	}
	
	public function password($name, $value, $sent_data, $module, $required) {
		$container = [];
		$label_required = ($required == 'required') ? '* ' : '';
		$container['label'] = $label_required.constant(strtoupper($name));
		$value = !empty($sent_data) ? $sent_data : '';
		
		$container['control'] = '<input type="password" value="'.$value.'" size="30" name="'.$module.'['.$name.']" class="form-control" '.$required.' />';
		return $container;
	}
	
	public function textarea($name, $value, $sent_data, $module, $required) {
		$container = [];
		$label_required = ($required == 'required') ? '* ' : '';
		$container['label'] = '';
		$value = !empty($sent_data) ? $sent_data : '';
		include('../config.php');
		
		function include_in_variable($file){
			ob_start();
			require($file);
			return ob_get_clean();
		}
		
		if(file_exists('../Plugins/'.$editor.'/files/editor.php')){
			$container['control'] = $label_required.'<textarea name="'.$module.'['.$name.']" id="editor" '.$required.'>'.$value.'</textarea>';
			$container['control'] .= include_in_variable('../Plugins/'.$editor.'/files/editor.php');
		} else {
			$container['control'] = $label_required.'<textarea name="'.$module.'['.$name.']" id="editor" '.$required.'>'.$value.'</textarea>';
		}
		return $container;
	}
	
	public function select($name, $values, $sent_data, $module, $required) {
		$container = [];
		$label_required = ($required == 'required') ? '* ' : '';
		$container['label'] = $label_required.constant(strtoupper($name));
		$build = [];
		$build[] = '<select name="'.$module.'['.$name.']" class="chosen-select form-control" '.$required.'>';
		
		foreach($values as $key => $value) {
			$build[] = '<option value="'.$value.'"';
			
			if($sent_data == $value) {
				$build[] = ' selected="selected" ';
			}
			
			$build[] = '>'.constant(strtoupper($key)).'</option>';
		}
		$build[] = "</select>";
		$container['control'] = implode('', $build);
		
		return $container;
	}
	
	public function params($name, $values, $sent_data, $module, $required) {
		if(!empty($sent_data)){
			$sent = json_decode(html_entity_decode($sent_data), true);
		}
		
		$container = [];
		
		//Exemple array ['article' => ['show_title' => '']]
		foreach($values as $key => $value) {
			$subcontainer = [];
			$label_required = ($required == 'required') ? '* ' : '';
			$subcontainer['label'] = "<h5>".$label_required.constant(strtoupper($key))."</h5>";
			$selects = [];
			
			foreach($value as $field => $default) {
				$options = [];
				$options['show'] = $field;
				$options['hide'] = '0';
				$sent_option = isset($sent['type_'.$module][$key][$field]) ? $sent['type_'.$module][$key][$field] : '';
				$selects[] = $this->select($field, $options, $sent_option, $module.'['.$name.']'.'['.$key.']', $required);
			}
			$subcontainer['control'] = $selects;
			$container[] = $subcontainer;
		}
		
		return $container;
	}
	
	public function categories($name, $values, $sent_data, $module, $required) {
		$categories = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_category')
				->execute()
			);
					
		$container = [];
		$build = [];
		$label_required = ($required == 'required') ? '* ' : '';
		$container['label'] = $label_required.constant(strtoupper($name));
		$build[] = '<select name="'.$module.'['.$name.']" class="chosen-select form-control" '.$required.'><option value="0">None/Aucunes</option>';
		foreach((is_array($categories) ? $categories : [$categories]) as $key => $value) {
			$build[] = '<option value="'.$value->category.'"';
			

			if(!empty($sent_data)){
				if($sent_data == $value->category) {
					$build[] = ' selected="selected" ';
				}
			}
			
			$build[] = '>'.$value->category.'</option>';
		}
		$build[] = "</select>";
		$container['control'] = implode('', $build);
		
		return $container;
	}
	
	
	public function position($name, $values, $sent_data, $module, $required) {
		$al_fetch_template = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_template')
				->where('active = ?')
				->andWhere('admin = ?')
				->setParameter(0, '1')
				->setParameter(1, '0')
				->execute()
			);
		
		include('../Templates/' . $al_fetch_template->title . '/information.php');
		$container = [];
		$label_required = ($required == 'required') ? '* ' : '';
		$container['label'] = $label_required.constant(strtoupper($name));
		$build[] = '<select name="'.$module.'['.$name.']" class="chosen-select form-control" '.$required.'>';
		foreach($al_position as $key => $value) {
			$build[] = '<option value="'.$value.'"';
						
			if(!empty($sent_data)){
				if($sent_data == $value) {
					$build[] = ' selected="selected" ';
				}
			}
			
			$build[] = '>'.$value.'</option>';
		}
		$build[] = "</select>";
		$container['control'] = implode('', $build);
		
		return $container;
	}
	
	public function gen_menStruc($al_shortcut_multiple, $module, $required) {
		$al_shortcut_multiple = isset($al_shortcut_multiple) ? $al_shortcut_multiple : array(); 
		$al_fetch_section_names = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_section_name')
				->execute()
			);
		$label_required = ($required == 'required') ? '* ' : '';
		$al_content_display = $label_required."
		<ul>
			<li>
				<input type=\"checkbox\" id=\"select_all\" /> ".PAGE_AFFECTED_CHECK_ALL_UNCHECK_ALL."
			</li>";
        foreach ((is_array($al_fetch_section_names) ? $al_fetch_section_names : array($al_fetch_section_names)) as $al_fetch_section_name) {
            $al_id = $al_fetch_section_name->id;
            $al_section = $al_fetch_section_name->section;
            $al_content_display.="
				<li style='float:left; margin:20px;'>$al_section
					<ul style='padding:0px; margin:0px; list-style-type:none;'>";
			
			$al_fetch_link_menus = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_link_menu')
					->where('id_index = ?')
					->orderBy('order1', 'ASC')
					->setParameter(0, $al_id)
					->execute()
				);
			
            foreach ((is_array($al_fetch_link_menus) ? $al_fetch_link_menus : array($al_fetch_link_menus)) as $al_fetch_link_menu) {
                $al_name = $al_fetch_link_menu->name;
                $al_shortcut_unique = $al_fetch_link_menu->shortcut;
                if (in_array($al_shortcut_unique, $al_shortcut_multiple)) {
                    $al_content_display.="<li><input type='checkbox' name='".$module."[shortcut][]' value='$al_shortcut_unique' checked='checked' /> $al_name</li>";
                } else {
                    $al_content_display.="<li><input type='checkbox' name='".$module."[shortcut][]' value='$al_shortcut_unique' /> $al_name</li>";
                }
            }
            $al_content_display.="
					</ul>
				</li>";
        }
		$al_content_display.="
		</ul>";
		
        return $al_content_display;
	}

	
	public function shortcut($name, $values, $sent_data, $module, $required) {
		$container = [];
		$label_required = ($required == 'required') ? '* ' : '';
		$container['label'] = $label_required.constant(strtoupper($name));
		$container['control'] =  $this->gen_menStruc(explode(':', $sent_data), $module, $required);
		
		return $container;
	}
	
	public function date_day($name, $values, $sent_data, $module, $required) {
		$container = [];
		$label_required = ($required == 'required') ? '* ' : '';
		$container['label'] = $label_required.constant(strtoupper($name));
		$build = [];
		$build[] = '<select name="'.$module.'['.$name.']" class="chosen-select form-control" '.$required.'>';
		
		foreach (range(1, 31) as $number){
			$build[] = '<option value="'.$number.'"';
			
			if($sent_data == $number) {
				$build[] = ' selected="selected" ';
			}
			
			$build[] = '>'.$number.'</option>';
		}
		$build[] = "</select>";
		$container['control'] = implode('', $build);
		
		return $container;
	}
	
	public function date_month($name, $values, $sent_data, $module, $required) {
		$container = [];
		$label_required = ($required == 'required') ? '* ' : '';
		$container['label'] = $label_required.constant(strtoupper($name));
		$build = [];
		$build[] = '<select name="'.$module.'['.$name.']" class="chosen-select form-control" '.$required.'>';
		
		foreach (range(1, 12) as $number){
			$build[] = '<option value="'.$number.'"';
			
			if($sent_data == $number) {
				$build[] = ' selected="selected" ';
			}
			
			$build[] = '>'.$number.'</option>';
		}
		$build[] = "</select>";
		$container['control'] = implode('', $build);
		
		return $container;
	}
	
	public function date_year($name, $values, $sent_data, $module, $required) {
		$container = [];
		$label_required = ($required == 'required') ? '* ' : '';
		$container['label'] = $label_required.constant(strtoupper($name));
		$build = [];
		$build[] = '<select name="'.$module.'['.$name.']" class="chosen-select form-control" '.$required.'>';
		
		foreach (range(date('Y'), 1920) as $number){
			$build[] = '<option value="'.$number.'"';
			
			if($sent_data == $number) {
				$build[] = ' selected="selected" ';
			}
			
			$build[] = '>'.$number.'</option>';
		}
		$build[] = "</select>";
		$container['control'] = implode('', $build);
		
		return $container;
	}
	
	public function regex($name, $values, $sent_data, $module, $required) {
		include('../regex.php');
		$container = [];
		$sent_data = json_decode($sent_data, true);
		$container['label'] = constant(strtoupper($name));
		$build = [];
		$build[] = '<select name="'.$module.'['.$name.'][]" class="chosen-select form-control" multiple '.$required.'>';
		
		foreach ($types as $key => $number){
			$build[] = '<option value="'.$key.'"';

			if(is_array($sent_data)){
				if(in_array($key, $sent_data)) {
					$build[] = ' selected="selected" ';
				}
			}
						
			$build[] = '>'.$key.'</option>';
		}
		$build[] = "</select>";
		$container['control'] = implode('', $build);
		
		return $container;
	}
	
}

?>