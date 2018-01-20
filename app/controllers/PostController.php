<?php 

    class PostController extends Controller{
        public function __construct() {
            parent::__construct();
            $this->postModel = $this->model('Post');
        }

        public function index() {
            $posts = $this->postModel->getPosts();
            $data = ['title'=>'Post Welcome', 'posts'=>$posts];
            $this->view('posts/index', $data);
        }
    }