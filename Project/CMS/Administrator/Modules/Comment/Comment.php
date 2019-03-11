<?php

namespace CMS\Administrator\Modules\Comment;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Comment extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function comment_listed_comments() {
		$get = $this->v->_gA();
		$post = $this->v->_pA(['username_comment', 'username_search_comment', 'title_search_comment', 'title_comment', 'date_comment','time_comment','email_comment', 'post_order_comment']);
		
		$info = [
			'al_username' => $post['username_comment'],
			'al_username_search' => $post['username_search_comment'],
			'al_title_search' => $post['title_search_comment'],
			'al_title' => $post['title_comment'],
			'al_time' => $post['time_comment'],
			'al_date' => $post['date_comment'],
			'al_email' => $post['email_comment'],
			'al_post_order' => $post['post_order_comment']
		];
		
		$listed = $this->system_model->init("Comment", "Listed");
		$comments = $listed->commentListed($info);
		
        $this->system_view->init('Comment', 'CommentList');
        $this->system_view->assign('al_fetch_comments', $comments['rows']);
        $this->system_view->assign('al_init_comments_rows', $comments['total']);
        return $this->system_view->render();
    }

    public function comment_show_comment_update() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$form = $this->system_form->init('comment', ['comments' => ['title','content','username','email']], 'send', $post);
		
		$info = [
			'data' => $form['comments'],
			'where' => ['id' => $get['id_comment']]
		];
		
		$edit = $this->system_model->init("Comment", "Edit");
		$edit->editComment($info);
    }

    public function comment_show_comment() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();

		$listed = $this->system_model->init("Comment", "Listed");
		$comments = $listed->showComment(['id' => $get['id_comment']]);
		$form = $this->system_form->init('comment', ['comments' => ['id','id_module','title','content','date','time','username','email']], 'form', ['comments' => $comments]);
        
		$this->system_view->init('Comment', 'ShowComment');
        $this->system_view->assign('id', $get['id_comment']);
        $this->system_view->assign('form', $form);
        return $this->system_view->render();
    }

    public function comment_delete_comment() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$listed = $this->system_model->init("Comment", "Listed");		
		$listed->deleteComment(['id' => $get['id_comment']]);
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
		
		$add = $this->system_model->init("Module", "Add");
		$module_id = $add->addModuleVerify($module['modules']);
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
		
		$info = [
			'category' => [],
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

		$listed = $this->system_model->init("Comment", "Listed");
		$listed->deleteComment(['id_module' => $get['id']]);
		
		$listed = $this->system_model->init("Module", "Listed");
		$listed->deleteModule(['id' => $get['id']]);
    }
	
	/************************END BASIC FUNCTIONS***********************/

}

?>