<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('category_model');
        $this->load->model('image_model');

    }

    public function index()
    {
        $this->load->view('welcome_message');
    }
    
    public function home()
    {
        $where = array("type" => "banner", "status" => "active");
        $query = $this->db->query("select `image`.`path` as imgUrl, `image`.`title` as image_description, `image`.`sub_title` as image_sub_title, `banner`.`title` as banner_title, `banner`.`desc` as banner_description, `banner`.`updated_at` as time
	from image join banner on image.item_id = banner.id 
		where image.type = 'banner' and image.status = \"active\" 
			order by `banner`.`updated_at` desc limit 5");
        $arr = $query->result_array();
//        foreach ($arr as $banner){
//            $banner["time"]= date('m/d/Y H:i:s', $banner["time"]);
//            echo "<pre>";
//            print_r($banner);
//            echo "</pre>";
//        }
        $categorys = $this->category_model->get_all();

        for ($i = 0; $i < count($categorys); $i++){
            $category = $categorys[$i];
            $category_images = $this->image_model->get_by_category_id($category["id"], 5);
            $categorys[$i]["contents"] = $category_images;
            $categorys[$i]["showMore"] = array("title" => $categorys[$i]["show_text"]);
            unset($categorys[$i]["show_text"]);
        }
        $output["error"] = 0;
        $output["data"]["cards"] = $categorys;
        $output["data"]["banners"] = $arr;
//        foreach ($categorys as $category){
//            $category_images = $this->image_model->get_by_category_id($category["id"], 5);
//            echo "<pre>";
//            print_r($category_images);
//            echo "</pre>";
//        }
//        echo "<pre>";
//        print_r($arr);
//        print_r($categorys);
        echo json_encode($output, JSON_PRETTY_PRINT);
//        echo "</pre>";
    }

    public function addCategory(){
        echo "<pre>";
        print_r($this->input->post());
        echo "</pre>";

        $data = $this->input->post();
        if (empty($data["title"])){
            return;
        }
        $this->category_model->add_category($data);
    }

    public function getImage($image_name){

        $file = "./images/" . $image_name;
        if(file_exists($file)){
            $ext = pathinfo($image_name, PATHINFO_EXTENSION);
            header("content-type:image/".$ext);
            echo file_get_contents($file);
        }else{
            echo "image not exist";
        }


    }

    public function images(){
        $req = array(
            "category_id", "startOffset", "limit"
        );
        $input = $this->input->get();

        $data = array();
        foreach ($req as $value){
            if(isset($input[$value])){
                unset($req[$value]);
            }else{
                $data["error"] = "1";
            }
        }
        if(isset($data["error"])){
            $data["description"] = "the require data " . var_dump($req) . " is not set";
            return;
        }
        $data["error"] = 0;
        
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}
