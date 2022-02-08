<?php


namespace App\classes;



class Blog
{
    protected $title;
    protected $authorName;
    protected $description;
    protected $image;
    protected $imageName;
    protected $directory;
    protected $fileName;
    protected $file;
    protected $data;
    protected $array;
    protected $array1;
    protected $array2;

    public function __construct($post=null)
    {
//        echo '<pre>';
//        print_r($_POST);
//        print_r($_FILES);
        if($post){
            $this->title = $post['title'];
            $this->authorName=$post['author_name'];
            $this->description=$post['description'];

        }

    }
    public function index()
    {
        $this->image=$this->imageUpload();
//        echo $this->image;
//        exit();
        $this->fileName = 'db.txt';
        $this->file = fopen('db.txt','a');
        $this->data="$this->title,$this->authorName,$this->description,$this->image$";
        fwrite($this->file, $this->data);
        //fwrite($this->file,'Hello World');
        fclose($this->file);
        return 'Data Saved Successfully';

    }
    protected function imageUpload(){
        $this->imageName = $_FILES['image']['name'];
        $this->directory = 'assets/img/upload/'.$this->imageName;
        move_uploaded_file($_FILES['image']['tmp_name'],$this->directory);
        //echo 'success';
        return $this->directory;

    }
    public function getAllBlog(){
        $this->fileName = 'db.txt';
        $this->data = file_get_contents($this->fileName);
        $this->array=explode('$',$this->data);
//        echo '<pre>';
//        print_r($this->data);
//        echo $this->data;
        foreach ($this->array as $key =>$value){
//            echo $value;
//            echo '<br>';

            $this->array2 = explode(',',$value);
//            echo '<pre>';
//            print_r($this->array2);
            if($this->array2[0]){
            $this->array1[$key]['title'] = $this->array2[0];
            $this->array1[$key]['author'] = $this->array2[1];
            $this->array1[$key]['description'] = $this->array2[2];
            $this->array1[$key]['image'] = $this->array2[3];

        }
        }
//        echo '<pre>';
//        print_r($this->array1);
//        exit();
        return $this->array1;
    }

}