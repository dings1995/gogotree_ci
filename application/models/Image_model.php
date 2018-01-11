<?php
/**
 * Created by PhpStorm.
 * User: dings
 * Date: 19/11/2017
 * Time: 上午1:41
 */

class Image_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function add_image($arr){
        $arr["created_at"] = time();
        $result = $this->db->insert('image', $arr);
        echo $result;
    }

    public function getImage($category_id, $start_offset, $limit){
        $query = $this->db->query("select `image`.`id`, `image`.`path`, `image`.`title`, `image`.`sub_title` from `image`
	where `image`.`type` = 'category' and `image`.`item_id` = $category_id and `image`.`id` > $start_offset
		order by `image`.`updated_at` desc limit $limit");
        return $query->result_array();
    }

    public function get_by_category_id($category_id, $count){
        $query = $this->db->query("select `image`.`id`, `image`.`path`, `image`.`title`, `image`.`sub_title` from `image`
	where `image`.`type` = 'category' and `image`.`item_id` = $category_id
		order by `image`.`updated_at` desc limit $count");
        return $query->result_array();
    }

}