<?php
/**
 * Created by PhpStorm.
 * User: dings
 * Date: 19/11/2017
 * Time: 上午1:21
 */
class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('html');
        $this->load->database();
    }

    public function index(){
        $this->load->view("home");
    }

}

?>