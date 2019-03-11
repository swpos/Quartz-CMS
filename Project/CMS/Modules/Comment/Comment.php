<?php

namespace CMS\Modules\Comment;

use CMS\Functions\Load\Module as ModuleExtended;

class Comment extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function load_comment($id, $category, $title, $params) {
		$post = $this->v->_pA();
		$get = $this->v->_gA();

		$display = $this->system_model->init("Comment", "Display");
		$comments = $display->load_comment_select(['page' => $get['page']]);

        $this->system_view->init('Comment', 'Comment');
        $this->system_view->assign('comments', $comments);
        $this->system_view->assign('page', $this->v->_g('page'));
        $this->system_view->assign('id', $id);
        $this->system_view->assign('params', $params);
        return $this->system_view->render();
    }

    public function post_comment() {
		$post = $this->v->_pA();
		$get = $this->v->_gA();

        if ($post['question'] == "53") {
			$form = $this->system_form->init('comment', ['comments' => ['id_module','title','content','date','time','username','email','shortcut']], 'send', $post);
			$display = $this->system_model->init("Comment", "Display");
			$display->post_comment_insert($form['comments']);
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function delete_comment() {
		$post = $this->v->_pA();
		$get = $this->v->_gA();
		
		$display = $this->system_model->init("Comment", "Display");
		$display->delete_comment(['id' => $get['id']]);       
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

}

?>