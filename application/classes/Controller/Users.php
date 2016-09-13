<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Users extends Controller_Common {

    // Главная страница
    public function action_index()
    {

        $content = View::factory('/pages/show')
            ->bind('users', $users)
            ->bind('errors', $errors);

        $userModel = Model::factory('User');

        if ($_POST) {
            if ($userModel->isValid()) {
                $userModel->createUser();
            } else {
                $errors = $userModel->getErrors();
            }
        }

        $users = $userModel->getAll();

        $this->template->content = $content;
    }

    public function action_deleteUser()
    {
        $id = (int) $this->request->param('id');
        Model::factory('User')->deleteUser($id);

        HTTP::redirect(URL::site());
    }

    public function action_changeStatus()
    {
        $id = (int) $this->request->param('id');
        Model::factory('User')->changeStatus($id);

        HTTP::redirect(URL::site());
    }

}