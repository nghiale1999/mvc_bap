<?php 

namespace App\Controllers;

use core\View;
use App\Models\User;
use App\Models\Post;

class Home extends \core\Controller
{
    
    protected function before()
    {
        // echo 'before';
    }

    protected function after()
    {
        // echo 'after';
    }
    public function indexAction()
    {
        $posts = Post::getAll();

        View::render('Home/index.html', ['data'=>$posts]);
    }

    public function add()
    {
        $data = Post::getAll();
        View::render('Home/index.php',['data'=>$data]);
    }
}
?>

