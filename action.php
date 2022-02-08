<?php
require_once 'vendor/autoload.php';
use App\classes\Blog;

if(isset($_GET['pages']))
{
    if($_GET['pages'] =='home')
    {
        include "pages/home.php";
    }
    elseif ($_GET['pages'] == 'all-blogs')
    {
        $blog = new Blog();
        $allBlogs = $blog->getAllBlog();
        include "pages/allBlogs.php";
    }
}
elseif (isset($_POST['btn'])){
    $blog = new Blog($_POST);
    $message=$blog->index();
    include 'pages/home.php';

}
