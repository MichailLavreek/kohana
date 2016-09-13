<?php defined('SYSPATH') or die('No direct script access.');

class Model_Comment extends Model
{
    protected $_tableComments = 'comments';
    protected $post;

    /**
     * Get comments for article
     * @return array
     */
    public function get_comments($article_id)
    {
        $query = DB::select('user', 'message')
            ->from($this->_tableComments)
            ->where('article_id', '=', $article_id)
            ->execute()
            ->as_array();

        if ($query) {
            return $query;
        }

        return [];
    }

    /**
     * Create new comment
     */
    public function create_comment($article_id, $user, $message)
    {
        DB::insert($this->_tableComments, ['article_id', 'user', 'message'])
            ->values([$article_id, $user, $message])
            ->execute();
    }

    public function isValid()
    {
        $this->post = Validation::factory($_POST)
            ->rule('user', 'not_empty')
            ->rule('user', 'max_length', [':value', 20])
            ->rule('message', 'not_empty');

        return $this->post->check();
    }

    public function getErrors()
    {
        return $this->post->errors();
    }
}