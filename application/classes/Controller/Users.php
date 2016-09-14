<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Users extends Controller_Common {

    public function action_index()
    {
        $content = View::factory('/pages/users')
            ->bind('users', $users)
            ->bind('errors', $result);

        $userModel = Model::factory('User');

        if ($_POST) {
            $result = $userModel->create($_POST);
        }

        $users = $userModel->getAll();

        $this->template->content = $content;
    }

    public function action_deleteUser()
    {
        $id = (int) $this->request->param('id');
        Model::factory('User')->delete($id);

        HTTP::redirect(URL::site());
    }

    public function action_changeStatus()
    {
        $id = (int) $this->request->param('id');
        Model::factory('User')->changeStatus($id);

        HTTP::redirect(URL::site());
    }

}