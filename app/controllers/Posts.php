<?php

class Posts extends Controller
{   
    public function __construct(){
        
        if(!isLoggedIn()) { redirect('users/login'); }

        $this->postModel = $this->model('Post'); 
        $this->userModel = $this->model('User'); 

    }

    public function index(){

        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts
        ];
        $this->view('posts/index', $data);
    }

    public function add(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // Sanitize DATA
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']) ,
                'title_error' => isset($_POST['title'])  ? '' : 'Please enter a title.' ,
                'body' => trim($_POST['body']),
                'body_error' => isset($_POST['body'])  ? '' : 'Please enter a body.' ,
                'user_id' => $_SESSION['user_id']
            ];

             // Check Errors 
             if(empty($data['title_error']) && empty($data['body_error'])) {
                    if($this->postModel->addPost($data)){
                        flash('post_msg', 'Post Added');
                        redirect('posts');
                    }else{
                        die('Something goes wrong ...');
                    }

                }else{
                    $this->view('posts/add', $data );;
                }

            
        }else{
            $data = [
                'title' => '',
                'body' => ''
            ];
            
            $this->view('posts/add', $data );;
        }



        $this->view('posts/add', $data);

    }

    public function show($postId){

        $post = $this->postModel->getPostDetails($postId);
        $user = $this->userModel->findUserById($post->user_id);

        $data = [
            'post' => $post,
            'user' => $user
        ];
        $this->view('posts/show', $data);
    }

    public function edit($postId){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // Sanitize DATA
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']) ,
                'title_error' => isset($_POST['title'])  ? '' : 'Please enter a title.' ,
                'body' => trim($_POST['body']),
                'body_error' => isset($_POST['body'])  ? '' : 'Please enter a body.' ,
                'user_id' => $_SESSION['user_id'],
                'post_id' => $postId
            ];

             // Check Errors 
             if(empty($data['title_error']) && empty($data['body_error'])) {
                    if($this->postModel->updatePost($data)){
                        flash('post_msg', 'Post Updated');
                        redirect('posts');
                    }else{
                        die('Something goes wrong ...');
                    }

                }else{
                    $this->view('posts/add', $data );;
                }

            
        }else{
            // Get Existing Post 
            $post = $this->postModel->getPostDetails($postId);

            // Redirect No Existing Post Owners
            if ($post->user_id != $_SESSION['user_id']){ redirect('posts');} 

            $data = [
                'id' => $postId,
                'title' => $post->title,
                'body' => $post->body
            ];
            
            $this->view('posts/edit', $data );;
        }

    }

    public function delete($postId){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

             // Get Existing Post 
            $post = $this->postModel->getPostDetails($postId);

            // Redirect No Existing Post Owners
            if ($post->user_id != $_SESSION['user_id']){ redirect('posts');} 

            if ($this->postModel->deletePost($postId)){
                flash('post_msg', 'Post Deleted', 'alert alert-danger');
                redirect('posts');
            }else{
                die('Something went wrong.');
            }
        }else{
            
            redirect('posts');
        }
    }
}
