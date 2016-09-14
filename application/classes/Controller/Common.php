<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Common extends Controller_Template {

    public $template = 'main';

    public function before()
    {
        parent::before();

        $config = Kohana::$config->load('mysite');

        View::set_global('title', $config['title']);
        View::set_global('description', $config['description']);
        $this->template->content = '';
    }
}