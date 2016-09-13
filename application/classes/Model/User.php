<?php defined('SYSPATH') or die('No direct script access.');

class Model_User extends Model
{
    protected $_table = 'users';
    protected $post;

    /**
     * Get comments for article
     * @return array
     */
    public function getAll()
    {
        $users = DB::select()
            ->from($this->_table)
            ->execute()
            ->as_array();

        if ($users) {
            return $users;
        }

        return [];
    }

    /**
     * @param $id
     * @return array
     */
    public function getById($id)
    {
        $user = DB::select()
            ->from($this->_table)
            ->where('id', '=', $id)
            ->execute()
            ->as_array();

        if ($user) {
            return $user[0];
        }

        return [];
    }

    /**
     * Create new comment
     * @internal param $name
     * @internal param $email
     * @internal param $pass
     * @internal param string $status
     */
    public function createUser()
    {
        DB::insert($this->_table, ['name', 'email', 'pass', 'status'])
            ->values([
                Arr::get($_POST, 'name'),
                Arr::get($_POST, 'email'),
                Arr::get($_POST, 'pass'),
                'user'
            ])
            ->execute();
    }

    /**
     * @param $id
     */
    public function deleteUser($id)
    {
        DB::delete($this->_table)->where('id', '=', $id)->execute();
    }

    /**
     * @param $id
     */
    public function changeStatus($id)
    {
        $user = $this->getById($id);

        if ($user) {
            var_dump($user);
            if ($user['status'] == 'user') {
                $value = 'blocked';
            } else {
                $value = 'user';
            }

            DB::update($this->_table)
                ->value('status', $value)
                ->where('id', '=', $id)
                ->execute();
        }
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $this->post = Validation::factory($_POST)
            ->rule(true, 'not_empty')
            ->rule('name', 'max_length', [':value', 20])
            ->rule('name', 'alpha_numeric')
            ->rule('email', 'email')
            ->rule('pass', 'min_length', [':value', 8])
            ->rule('pass2', 'matches', [':validation', ':field', 'pass']);

        if (!$this->unique_username(Arr::get($_POST, 'name'))) {
            $this->post->error('name', 'matches');
            return false;
        }

        return $this->post->check();
    }

    public function unique_username($name)
    {
         $match = DB::select()
            ->from('users')
            ->where('name', '=', $name)
            ->execute()
            ->as_array();

        if ($match) {
            return false;
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->post->errors();
    }
}