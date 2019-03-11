<?php

namespace CMS\Functions\Load;

class Module {

    protected $db;
    protected $container;
    protected $v;
    protected $system_editor;
    protected $system_model;
    protected $system_view;
    protected $system_repopulate;
    protected $system_skeleton;
    protected $system_template;
    protected $system_validation;
    protected $system_plugins;
    protected $system_config;
    protected $system_shortcut;
	protected $system_languages;
	protected $system_form;
    protected $data;
	
    protected $page;
    protected $category;
    protected $title_module;
    protected $id;
    protected $match;
    protected $model;

    public function __construct($container) {
        $this->db = $container->system_connexion->database();
        $this->container = $container;
        $this->system_editor = $container->system_editor;
        $this->system_repopulate = $container->system_repopulate;
        $this->system_skeleton = $container->system_skeleton;
        $this->system_template = $container->system_template;
        $this->system_validation = $container->system_validation;
        $this->system_plugins = $container->system_plugins;
        $this->system_shortcut = $container->system_shortcut;
		$this->system_languages = $this->container->system_languages;
		$this->system_form = $this->container->system_form;
        $this->system_config = $container->system_config;
        $this->data = $container->data;
        $this->system_model = $container->system_model;
        $this->system_view = $container->system_view;
		$this->v = $container->variables;
    }

    public function load_modules() {
        $article_real = [];
		$al_tableau = [];
		
		$this->system_languages->loadlangfilesite($this->v->_s('lang'), 'site');
		$page = empty($this->v->_g('page')) ? "index" : $this->v->_g('page');
		
		if (!empty($this->v->_g('action')) && !empty($page)) {
			$this->system_languages->loadlangfileplugin(ucfirst($page), $this->v->_s('lang'), 'site');
			$action = $this->v->_g('action');
			$_SESSION['page'] = strtolower($page);
			$class_name_final = "\CMS\Modules\\" . $page . "\\" . $page;
			$action_custom = new $class_name_final($this->container);
			return $action_custom->$action();
		}
		
		if (!$this->system_config->ifLinkUnpublished($page)) {
			
			$article_class = new \CMS\Modules\Article\Article($this->container);
			$articles = $article_class->load_articles_real();
			
            foreach ($articles as $row) {
				$shortcuts = explode(':', $row->shortcut);
				if (in_array($this->v->_g('page'), $shortcuts) || in_array("all", $shortcuts)) {
					$this->system_languages->loadlangfileplugin('Article', $this->v->_s('lang'), 'site');
				}
				
                $article = $article_class->load_article_real($row);
				if (!empty($article)) {
					$article_real[$row->id . '-article_component'] = $article;
					$al_tableau[] = empty($article_real) ? "" : $article_real;
				}
            }

            $al_i = 0;
			
			$published_modules = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_modules')
					->where('published = ?')
					->orderBy('order1', 'ASC')
					->setParameter(0, '1')
					->execute()
				);
				
            foreach ($this->v->d_a($published_modules) as $row) {
                $id = $row->id;
                $params_string = $row->modules;
                $position = $row->position;
                $category = $row->category;
                $title_module = $row->title;
                $shortcuts = $row->shortcut;
                $shortcut_array = explode(':', $shortcuts);

                if (!empty($position) && !empty($id) && !empty($title_module)) {
                    if (in_array($page, $shortcut_array) || in_array("all", $shortcut_array)) {						
						$params = json_decode(html_entity_decode($params_string), true);
						$get_key_params = array_keys($params);
						$custom_type = str_replace('type_', '', $get_key_params[0]);
							
						$functioName = "load_" . $custom_type;
						$className = ucfirst($custom_type);
						$this->system_languages->loadlangfileplugin($className, $this->v->_s('lang'), 'site');
						
						$retreive_published = $this->system_plugins->check_plugin();
						
						if (in_array($custom_type, $retreive_published)) {
							$array_var = "plugin_var_".$id;
							$$array_var = "";
							$content_var = "plugin_content_".$id;
							$$content_var = "";
						
							$classname_path = "\CMS\Modules\\" . $className . "\\" . $className;
							$classContainer = new $classname_path($this->container);
							${$content_var} = $classContainer->$functioName($id, $category, $title_module, $params[$get_key_params[0]]);
							
							if (${$content_var}) {
								${$array_var}[$id . '-' . $position] = ${$content_var};
								$al_tableau[] = ${$array_var};
							}	
						}
                    }
                }
                $al_i++;
            }	
			
			return $al_tableau;
        }
    }
}

?>