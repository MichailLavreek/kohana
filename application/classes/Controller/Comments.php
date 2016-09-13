<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Comments extends Controller {

    public function action_index()
    {
        if($this->request->is_initial()) {
            HTTP::redirect(URL::site());
        }

        $article_id = $this->request->param('id');

        $content = View::factory('/comments/show')
            ->bind('comments', $comments)
            ->bind('errors', $errors);

        if($_POST) {
            $post = Model::factory('Comment');
            if ($post->isValid()) {
                Model::factory('Comment')
                    ->create_comment($article_id, Arr::get($_POST, 'user'), Arr::get($_POST, 'message'));
            } else {
                $errors = $post->getErrors();
            }
        }

        $comments = Model::factory('Comment')->get_comments($article_id);

        $this->response->body($content);
    }

} // Comments