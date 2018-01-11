<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('category_model');
    }

    public function index()
    {
        $this->load->view('welcome_message');
    }

    public function category()
    {
        $this->load->view('form/category');
    }

    public function banner(){
        $this->load->view('form/banner', array("error" => ""));
    }

    public function image(){
        $categorys = $this->category_model->get_all();
        $data["categorys"] = $categorys;
        $data["error"] = "";
        $this->load->view('form/image', $data);
    }
}
