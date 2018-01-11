<?php

class Upload extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('image_model');
        $this->load->database();
    }

    public function do_upload_image()
    {
        $config['upload_path']      = './images/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']     = 2048;
        $config['max_width']        = 1024;
        $config['max_height']       = 768;
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);



        if ( ! $this->upload->do_upload('image'))
        {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('form/image', $error);
        }
        else
        {
//            $upload_data = array('upload_data' => $this->upload->data());
//id	type	item_id		path	desc	status	created_at	updated_at
            $input = $this->input->post();
            $input["upload_data"] = $this->upload->data();
            $now = time();
            
            $data = array(
                "type" => "category",
                "item_id" => $input['item_id'],
                "path" => base_url() . "api/getImage/" . $input["upload_data"]["file_name"],
                "title" => $input["title"],
                "sub_title" => $input["sub_title"],
                "status" => "active",
                "created_at" => $now,
                "updated_at" => $now
            );
            $result = $this->image_model->add_image($data);
            echo $result;
            echo "<pre>";
            print_r($data);
            echo "</pre>";
            $this->load->view('upload_success', $input);
        }
    }
    
    public function do_upload_banner(){
//        id	 title	desc	status	created_at	updated_at
//        id	type	item_id		path	desc	status	created_at	updated_at
        $config['upload_path']      = './images/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']     = 2048;
        $config['max_width']        = 1024;
        $config['max_height']       = 768;
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        echo "<pre>";
        print_r($this->input->post());
        echo "</pre>";

//        $this->db->insert('posts', $post_data);
//        $insert_id = $this->db->insert_id();

        if ( ! $this->upload->do_upload('image'))
        {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('form/image', $error);
        }
        else
        {
//            $upload_data = array('upload_data' => $this->upload->data());
//id	type	item_id		path	desc	status	created_at	updated_at
            $input = $this->input->post();
            $input["upload_data"] = $this->upload->data();
            $now = time();
            
            $data = array(
                "title" => $input["title"],
                "desc" => $input["desc"],
                "status" => "active",
                "created_at" => $now,
                "updated_at" => $now
            );
            $result = $this->db->insert('banner', $data);
            $insert_id = $this->db->insert_id();
            $data = array(
                "type" => "banner",
                "item_id" => $insert_id,
                "path" => base_url() . "api/getImage/" . $input["upload_data"]["file_name"],
                "title" => $input["image_title"],
                "sub_title" => $input["image_sub_title"],
                "status" => "active",
                "created_at" => $now,
                "updated_at" => $now
            );
            $result = $this->image_model->add_image($data);
            echo $result;
            echo "<pre>";
            print_r($data);
            echo "</pre>";
            self::imageresize($input["upload_data"]["file_name"]);
            $this->load->view('upload_success', $input);
        }
    }

    function imageresize($goods_pic){
        $newwidth = 640;
        $newheight = 400;

        $small_width = 252;
        $small_height = 252;

        $filename = './images/' . $goods_pic;
        $newname = './images/big_images/' . $goods_pic;
        $small_newname = './images/small_images/' . $goods_pic;
        if(!empty($goods_pic) && file_exists($filename)){
            list($width, $height) = getimagesize($filename);
            $thumb = imagecreatetruecolor($newwidth, $newheight);
            $thumb_small = imagecreatetruecolor($small_width, $small_height);

            $suffix = strrchr($filename,'.');
            switch($suffix){
                case '.gif':
                    $source = imagecreatefromgif($filename);
                    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                    imagegif($thumb,$newname);
                    $small_source = imagecreatefromgif($filename);
                    imagecopyresized($thumb_small, $small_source, 0, 0, 0, 0, $small_width, $small_height, $width, $height);
                    imagegif($thumb_small, $small_newname);
                    break;
                case '.png':
                    $source = imagecreatefrompng($filename);
                    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                    imagepng($thumb,$newname);
                    $small_source = imagecreatefrompng($filename);
                    imagecopyresized($thumb_small, $small_source, 0, 0, 0, 0, $small_width, $small_height, $width, $height);
                    imagepng($thumb_small, $small_newname);
                    break;
                case '.jpg':
                    $source = imagecreatefromjpeg($filename);
                    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                    imagejpeg($thumb,$newname);
                    $small_source = imagecreatefromjpeg($filename);
                    imagecopyresized($thumb_small, $small_source, 0, 0, 0, 0, $small_width, $small_height, $width, $height);
                    imagejpeg($thumb_small, $small_newname);
                    break;
                case '.bmp':
                    $source = imagecreatefromwbmp($filename);
                    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                    imagewbmp($thumb,$newname);
                    $small_source = imagecreatefromwbmp($filename);
                    imagecopyresized($thumb_small, $small_source, 0, 0, 0, 0, $small_width, $small_height, $width, $height);
                    imagewbmp($thumb_small, $small_newname);
                    break;
            }

            imagedestroy($thumb);
            imagedestroy($thumb_small);
        }
    }
}
?>