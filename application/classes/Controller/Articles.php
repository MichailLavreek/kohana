<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Articles extends Controller_Common {

    public function action_index()
    {
        $articles = Model::factory('Article')->getAll();

        $content = View::factory('/pages/articles')
            ->set('articles', $articles);

        $this->template->content = $content;
    }

    public function action_article()
    {
        $id = $this->request->param('id');

        $content = View::factory('/pages/article')
            ->bind('article', $article)
            ->bind('comments', $comments);

        $article = Model::factory('Article')->getById($id);

        $comments_url = 'comments/' . $id;
        $comments = Request::factory($comments_url)->execute();

        $this->template->content = $content;
    }

    public function action_addArticle()
    {
        $content = View::factory('/pages/article-form')
            ->bind('errors', $result);

        if ($_POST) {
            $result = Model::factory('Article')->create($_POST);
        }

        if ($_POST && !$result) {
            $content = View::factory('/parts/article-add-success');
        }

        $this->template->content = $content;
    }

    public function action_deleteArticle()
    {
        /* Перенаправление на главную, если запрос пришел не со страницы статьи нашего сайта */
        if (!isset($_SERVER['HTTP_REFERER']) || !stristr($_SERVER['HTTP_REFERER'], URL::site('articles'))) {
            HTTP::redirect(URL::site());
        }

        $id = (int) $this->request->param('id');

        Model::factory('Article')->delete($id);
        HTTP::redirect(URL::site('articles'));
    }
}