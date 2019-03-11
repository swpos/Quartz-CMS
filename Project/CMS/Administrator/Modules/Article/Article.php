<?php

namespace CMS\Administrator\Modules\Article;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Article extends ModuleExtended {
	
   	public function __construct($container) {
		parent::__construct($container);
    }
	
	public function article_edit_article_update() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$form = $this->system_form->init('article', ['articles' => ['title','username','date','time','category','publish','shortcut','modules','content']], 'send', $post);
		$info = [
			'data' => $form['articles'],
			'where' => ['id' => $get['id_article']]
		];
		$listed = $this->system_model->init("Article", "Listed");
		$listed->articleUpdate($info);
    }
	
	public function article_edit_article() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();

		$edit = $this->system_model->init("Article", "Edit");
		$articles = $edit->getArticle(['id' => $get['id_article']]);
		$form = $this->system_form->init('article', ['articles' => ['title','username','date','time','category','publish','shortcut','modules','content']], 'form', ['articles' => $articles]);
		
        $this->system_view->init('Article', 'ModArticle');
        $this->system_view->assign('form', $form);
        $this->system_view->assign('id', $articles->id);
        return $this->system_view->render();
    }
	
	public function article_add_article_update() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$form = $this->system_form->init('article', ['articles' => ['title','username','category','modules','shortcut','date','time','order1','content','publish']], 'send', $post);
		
		$add = $this->system_model->init("Article", "Add");
		$add->addArticle($form['articles']);
    }
	
	public function article_add_article() {		
		$form = $this->system_form->init('article', ['articles' => ['title','category','modules','shortcut','date','time','order1','content','publish']], 'form', []);        
        $this->system_view->init('Article', 'AddArticle');
        $this->system_view->assign('form', $form);
        return $this->system_view->render();
    }
	
	public function article_listed_article() {
		$get = $this->v->_gA();
		$post = $this->v->_pA(['search_article', 'category_article', 'order_article', 'time_article', 'date_article', 'published_article', 'post_order_article']);	
		
		$info = [
			'al_search' => $post['search_article'],
			'al_category' => $post['category_article'],
			'al_order' => $post['order_article'],
			'al_time' => $post['time_article'],
			'al_date' => $post['date_article'],
			'al_published' => $post['published_article'],
			'al_post_order' => $post['post_order_article']
		];
		
		$listed = $this->system_model->init("Article", "Listed");
		$articles = $listed->articleListed($info);

        $this->system_view->init('Article', 'ListArticle');
        $this->system_view->assign('al_fetch_articles', $articles['rows']);
        $this->system_view->assign('al_init_articles_rows', $articles['total']);
        return $this->system_view->render();
    }
	
	public function article_listed_order() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
				
		$listed = $this->system_model->init("Article", "Listed");
		
        foreach ($post['order'] as $al_key => $al_value) {
			$info = [
				'data' => ['order1' => $al_value], 
				'where' => ['id' => $al_key]
			];
			$listed->articleUpdate($info);            
        }
    }
	
	public function article_listed_delete() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$listed = $this->system_model->init("Article", "Listed");	
        $listed->deleteArticle(['id' => $get['id']]);
    }
	
	public function article_listed_publish () {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		$al_enable = ($get['state'] == 'Yes') ? 0 : 1;
		
		$info = [
			'data' => ['publish' => $al_enable],
			'where' => ['id' => $get['id']]
		];
		$listed = $this->system_model->init("Article", "Listed");
        $listed->articleUpdate($info);
    }
	
	
	/************************BASIC FUNCTIONS***********************/
	
	public function _add_module() {
		$name = $this->class_name;
		
        $this->system_view->init(ucfirst($name), 'AddModule');
        $form = $this->system_form->init($name, ['modules' => $this->add_module_fields], 'form', []);
	    $this->system_view->assign('form', $form);
        return $this->system_view->render();
    }

    public function _add_module_update() {		
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		$name = $this->class_name;
		
		$module = $this->system_form->init($name, ['modules' => $this->add_module_update_fields], 'send', $post);
		$post[$name]['category'] = $module['modules']['title'];
		$category = $this->system_form->init($name, ['category' => ['category','date','time']], 'send', $post);
      
		$add = $this->system_model->init("Module", "Add");
		$module_id = $add->addModuleVerify($module['modules']);
		$add->addCategory($category['category']);
    }

    public function _edit_module() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$name = $this->class_name;
        $edit = $this->system_model->init("Module", "Edit");
		$module = $edit->getModuleById(['id' => $get['id']]);
		
		$form = $this->system_form->init($name, ['modules' => $this->edit_module_fields], 'form', ['modules' => $module]);

        $this->system_view->init(ucfirst($name), ucfirst($name));
		$this->system_view->assign('form', $form);
		$this->system_view->assign('id', $module->id);
        return $this->system_view->render();
    }

    public function _edit_module_update() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$name = $this->class_name;
		$module = $this->system_form->init($name, ['modules' => $this->edit_module_update_fields], 'send', $post);
		$old_category = $post[$name]['category'];
		$post[$name]['category'] = $module['modules']['title'];
		$category = $this->system_form->init($name, ['category' => ['category','date','time']], 'send', $post);
		
		$info = [
			'category' => [
				'data' => $category['category'], 
				'where' => ['category' => $old_category]
			],
			'module' => [
				'data' => $module['modules'],
				'where' => ['id' => $get['id']]
			]
		];
		
		$edit = $this->system_model->init("Module", "Edit");
		$edit->moduleUpdateVerify($info);
    }
	
	public function _delete_module() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$name = $this->class_name;
        $edit = $this->system_model->init("Module", "Edit");
		$module = $edit->getModuleById(['id' => $get['id']]);
        $al_category = $module->category;
		
		$listed = $this->system_model->init("Article", "Listed");
		$listed->deleteArticle(['category' => $al_category]);
		
		$listed = $this->system_model->init("Module", "Listed");
		$listed->deleteCategory(['category' => $al_category]);
		$listed->deleteModule(['id' => $get['id']]);
    }
	
	/************************END BASIC FUNCTIONS***********************/

}

?>