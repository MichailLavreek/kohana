<?php defined('SYSPATH') or die('No direct script access.');

class Model_Comment extends Model
{
    protected $_table = 'comments';
    protected $validator;

    /**
     * @param $id
     * @return array
     */
    public function getById($id)
    {
        $query = DB::select('user', 'message', 'id')
            ->from($this->_table)
            ->where('article_id', '=', ':id')
            ->param(':id', $id)
            ->execute()
            ->as_array();

        return $query ? $query : [];
    }

    /**
     * @param $article_id
     * @param array $post
     * @return mixed|null
     */
    public function create($article_id, array $post)
    {
        if ($this->isValidComment($post)) {
            DB::insert($this->_table, ['article_id', 'user', 'message'])
                ->values([':id', ':user', ':message'])
                ->parameters([
                    ':id' => $article_id,
                    ':user' => Arr::get($post, 'user'),
                    ':message' => Arr::get($post, 'message')
                ])
                ->execute();
            return null;
        } else {
            return $this->getValidationErrors();
        }
    }

    public function delete($id)
    {
        DB::delete($this->_table)
            ->where('id', '=', ':id')
            ->param(':id', $id)
            ->execute();
    }

    /**
     * @param array $post
     * @return bool
     */
    public function isValidComment(array $post)
    {
        $this->validator = Validation::factory($post)
            ->rule('user', 'not_empty')
            ->rule('user', 'max_length', [':value', 30])
            ->rule('message', 'not_empty')
            ->rule('message', 'max_length', [':value', 300]);


        return $this->validator->check();
    }

    /**
     * @return mixed
     */
    public function getValidationErrors()
    {
        return $this->validator->errors();
    }
}