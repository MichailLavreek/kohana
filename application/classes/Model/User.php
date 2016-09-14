<?php defined('SYSPATH') or die('No direct script access.');

class Model_User extends Model
{
    protected $_table = 'users';
    protected $validator;

    /**
     * @return array
     */
    public function getAll()
    {
        $users = DB::select()
            ->from($this->_table)
            ->execute()
            ->as_array();

        return $users ? $users : [];
    }

    /**
     * @param $id
     * @return array
     */
    public function getById($id)
    {
        $user = DB::select()
            ->from($this->_table)
            ->where('id', '=', ':id')
            ->param(':id', $id)
            ->execute()
            ->as_array();

        return $user ? $user[0] : [];
    }

    /**
     * @param array $post
     * @return array|mixed
     */
    public function create(array $post)
    {
        if ($this->isValidUser($post)) {
            DB::insert($this->_table, ['name', 'email', 'pass', 'status'])
                ->values([':name', ':email', ':pass', ':status'])
                ->parameters([
                    ':name' => Arr::get($post, 'name'),
                    ':email' => Arr::get($post, 'email'),
                    ':pass' => Arr::get($post, 'pass'),
                    ':status' => 'user'
                ])
                ->execute();

            return [];
        } else {
            return $this->getValidationErrors();
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
     * @param $id
     */
    public function changeStatus($id)
    {
        $user = $this->getById($id);

        if ($user) {
            if ($user['status'] == 'user') {
                $value = 'blocked';
            } else {
                $value = 'user';
            }

            DB::update($this->_table)
                ->value('status', $value)
                ->where('id', '=', ':id')
                ->param(':id', $id)
                ->execute();
        }
    }

    /**
     * @param array $post
     * @return bool
     */
    public function isValidUser(array $post)
    {
        $this->validator = Validation::factory($post)
            ->rule(true, 'not_empty')
            ->rule('name', 'max_length', [':value', 30])
            ->rule('name', 'alpha_numeric')
            ->rule('email', 'email')
            ->rule('email', 'max_length', [':value', 100])
            ->rule('pass', 'min_length', [':value', 8])
            ->rule('pass', 'max_length', [':value', 100])
            ->rule('pass2', 'matches', [':validation', ':field', 'pass']);

        if ($this->validator->check() && !$this->isUniqueUsername(Arr::get($post, 'name'))) {
            $this->validator->error('name', 'matches');
            return false;
        }

        return $this->validator->check();
    }

    /**
     * @param $name
     * @return bool
     */
    public function isUniqueUsername($name)
    {
         $match = DB::select()
             ->from('users')
             ->where('name', '=', ':name')
             ->param(':name', $name)
             ->execute()
             ->as_array();

        return $match ? false : true;
    }

    /**
     * @return mixed
     */
    public function getValidationErrors()
    {
        return $this->validator->errors();
    }
}