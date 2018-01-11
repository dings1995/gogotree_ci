<?php

/**
 * Created by PhpStorm.
 * User: SuenYuen
 * Date: 9/4/2016
 * Time: 上午12:51
 */
class Category_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function login($username, $password){
        $md5_password = do_hash($password, 'md5');
        $query = $this->db->get_where('user', array('user_name' => $username, 'password' => $md5_password));
        return $query->row_array();
    }

    public function add_category($arr){
        $now = time();
        $arr["status"] = "active";
        $arr["created_at"] = $now;
        $arr["updated_at"] = $now;

        $result = $this->db->insert('category', $arr);
        echo $result;
    }

    function get_all($status = "active"){
        $query = $this->db->select('`id`, `title`, `desc`, `show_text`')->get_where('category', array('status' => $status));
//        $query = $this->db->get('category');
//        id	title	desc	showText
        $data = $query->result_array();
        return $data;
    }
    
//    public function get_news($slug = FALSE)
//    {
//        if ($slug === FALSE)
//        {
//            $query = $this->db->get('news');
//            return $query->result_array();
//        }
//
//        $query = $this->db->get_where('news', array('slug' => $slug));
//        return $query->row_array();
//    }
//
//    public function set_news()
//    {
//        $this->load->helper('url');
//
//        $slug = url_title($this->input->post('title'), 'dash', TRUE);
//
//        $data = array(
//            'title' => $this->input->post('title'),
//            'slug' => $slug,
//            'text' => $this->input->post('text')
//        );
//
//        return $this->db->insert('news', $data);
//    }
}