<?php

namespace App\Controllers;

use \core\View;
use App\Models\Post;



class Posts extends \core\Controller
{
    public function index()
    {
        $posts = Post::getAll();
        View::renderTemplate('posts/index.html', ['posts'=>$posts]);
    }

    public function add()
    {
        if(isset($_POST['submit'])){
            $title = $_POST['title'];
            $content = $_POST['content'];
            $file = $_FILES['file'];
            $tail = ['image/jpeg', "image/png", 'image/jpg', 'image/PNG', 'image/JPG', "image/JPEG"];
            $check = 0;
            if($file['size'] != 0){
                if(!in_array($file['type'],$tail)){
                    $check = 1;
                }
            }
            $name = date("Y-m-d_H:i:s").$file['name'];
            if($file['size'] == 0){
                $check =1;
                $name = '';
            }
            if($check == 0){
                $data =[
                    'user_id'=>10,
                    'avata_user'=>'142022-06-13_16:07:073-8.png',
                    'name_user'=>'nghia',
                    'title'=>$title,
                    'content'=>$content,
                    'picture'=>$name
                ];
                $target = "/var/www/test.com/public/image";

                if(move_uploaded_file($file['tmp_name'], "$target/$name")){
                    Post::create($data);
                }else{
                    echo 'khoi tao hk thanh cong';
                }
            }
            
            
        }
        View::renderTemplate('posts/add.html');
       
    }

    
    public function delete()
    {   
        $url =$_SERVER['QUERY_STRING'];
        $strurl =  explode( '/', $url );
        $id_posts = $strurl[1];
        Post::delete($id_posts);
        $posts = Post::getAll();
        View::renderTemplate('posts/index.html', ['posts'=>$posts]);
    }
    
    public function edit()
    {
        $url =$_SERVER['QUERY_STRING'];
        $strurl =  explode( '/', $url );
        $id_posts = $strurl[1];
       
        if(isset($_POST['submit'])){
            
            $title = $_POST['title'];
            
            $content = $_POST['content'];
            $file = $_FILES['file'];
            $tail = ['image/jpeg', "image/png", 'image/jpg', 'image/PNG', 'image/JPG', "image/JPEG"];
            $check = 0;
            if($file['size'] != 0){
                if(!in_array($file['type'],$tail)){
                    $check = 1;
                }
            }
            $name = date("Y-m-d_H:i:s").$file['name'];
            if($file['size'] == 0){
                $name = '';
                $check = 1;
            }
            if($check == 0){
                $posts =[
                    'user_id'=>10,
                    'avata_user'=>'142022-06-13_16:07:073-8.png',
                    'name_user'=>'nghia',
                    'title'=>$title,
                    'content'=>$content,
                    'picture'=>$name
                ];
                $target = "/var/www/test.com/public/image";

                if(move_uploaded_file($file['tmp_name'], "$target/$name")){
                    Post::update($id_posts, $posts);
                    
                }else{
                    echo 'sua hk thanh cong';
                }
            }
            
        }
        $data = Post::find($id_posts);
        View::renderTemplate('posts/edit.html', ['posts'=>$data]);
    }
    

}

?>