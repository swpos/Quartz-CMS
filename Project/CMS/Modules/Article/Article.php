<?php

namespace CMS\Modules\Article;

use CMS\Functions\Load\Module as ModuleExtended;

class Article extends ModuleExtended {

	public function __construct($container) {
		parent::__construct($container);
    }

    public function load_article($id, $category, $title, $params) {
		$display = $this->system_model->init("Article", "Display");
		$articles = $display->load_article_select(['id' => $category]);
		
        $this->system_view->init('Article', 'Article');
        $this->system_view->assign('articles', $articles);
        $this->system_view->assign('params', $params);
        $this->system_view->assign('title', $title);
        return $this->system_view->render();
    }
	
	public function load_articles_real() {
		$display = $this->system_model->init("Article", "Display");
		$articles = $display->load_articles_real([]);
		return $articles;
	}

    public function load_article_real($row) {
		$display = $this->system_model->init("Article", "Display");
		$articles = $display->load_article_real_select(['id' => $row->id]);
		
        $this->system_view->init('Article','ArticleComponent');
        $this->system_view->assign('articles', $articles);
        $this->system_view->assign('params', $articles->modules);
        return $this->system_view->render();
    }

}

?>