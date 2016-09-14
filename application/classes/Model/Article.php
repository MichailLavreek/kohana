<?php defined('SYSPATH') or die('No direct script access.');

class Model_Article extends Model
{
    protected $_table = 'articles';
    protected $validator;

    /**
     * @return array
     */
    public function getAll()
    {
        $data = DB::select()
            ->from($this->_table)
            ->execute()
            ->as_array();

        return $data ? $data : [];
    }


    /**
     * @param $id
     * @return array
     */
    public function getById($id)
    {
        $article = DB::select()
            ->from($this->_table)
            ->where('id', '=', ':id')
            ->param(':id', (int)$id)
            ->execute()
            ->as_array()[0];

        return $article ? $article : [];
    }

    /**
     * @param $post
     * @return array
     */
    public function create($post)
    {
        if ($this->isValidArticle($post)) {
            $post['message'] = strip_tags($post['message']);
            $post = $this->addSomeColumns($post);

            DB::insert($this->_table, ['title', 'alt_title', 'author', 'content_short', 'content_full'])
                ->values([':title', ':alt_title', ':user', ':content_short', ':content_full'])
                ->parameters([
                    ':title' => Arr::get($post, 'title'),
                    ':alt_title' => Arr::get($post, 'alt_title'),
                    ':user' => Arr::get($post, 'user'),
                    ':content_short' => Arr::get($post, 'content_short'),
                    ':content_full' => Arr::get($post, 'message')
                ])
                ->execute();

            return [];
        } else {
            return $this->validator->errors();
        }
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        DB::delete($this->_table)
            ->where('id', '=', ':id')
            ->param(':id', $id)
            ->execute();
    }

    /**
     * @param $post
     * @return bool
     */
    public function isValidArticle($post)
    {
        $this->validator = Validation::factory($post)
            ->rule(true, 'not_empty')
            ->rule('user', 'max_length', [':value', 50])
            ->rule('title', 'max_length', [':value', 200])
            ->rule('message', 'max_length', [':value', 5000]);

        return $this->validator->check();
    }

    /**
     * @param $post
     * @return mixed
     */
    protected function addSomeColumns($post)
    {
        // Приведение заголовка в транслит
        $alphabet = Kohana::$config->load('to_translit_alphabet');
        $str = strtr($post['title'], $alphabet->alpha);
        $str = strtolower($str);
        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
        $str = trim($str, "-");
        $str = mb_strimwidth($str, 0, 20);

        $post['alt_title'] = $str;
        $post['content_short'] = mb_strimwidth($post['message'], 0, 350, '...');

        return $post;
    }
}
