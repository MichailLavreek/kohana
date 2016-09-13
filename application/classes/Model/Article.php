<?php defined('SYSPATH') or die('No direct script access.');

class Model_Article extends Model
{
    protected $_tableArticles = 'articles';

    /**
     * @return array
     */
    public function get_all()
    {
        $data = DB::select()
            ->from($this->_tableArticles)
            ->execute()
            ->as_array();

        if (empty($data)) {
            return [];
        }

        return $data;
    }

    /**
     * @param string $id
     * @return array
     */
    public function get_article($id = '')
    {
        $article = DB::select()
            ->from($this->_tableArticles)
            ->where('id', '=', ':id')
            ->param(':id', (int)$id)
            ->execute()
            ->as_array()[0];

        if (empty($article)) {
            return [];
        }

        return $article;
    }
}
