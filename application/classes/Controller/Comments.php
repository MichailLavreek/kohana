<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Comments extends Controller {

    public function action_index()
    {
        if($this->request->is_initial()) {
            HTTP::redirect(URL::site());
        }

        $commentModel = Model::factory('Comment');
        $article_id = $this->request->param('id');

        if($_POST) {
            $result = $commentModel->create($article_id, $_POST);
        }

        $comments = $commentModel->getById($article_id);

        $content = View::factory('/comments/show')
            ->set('comments', $comments)
            ->bind('errors', $result);

        $this->response->body($content);
    }

    public function action_deleteComment()
    {
        /* Перенаправление на главную, если запрос пришел не со страницы статьи нашего сайта */
        if (!isset($_SERVER['HTTP_REFERER']) || !stristr($_SERVER['HTTP_REFERER'], URL::site('articles'))) {
            HTTP::redirect(URL::site());
        }

        $id = (int) $this->request->param('id');
        Model::factory('Comment')->delete($id);

        HTTP::redirect($_SERVER['HTTP_REFERER']);
    }
}