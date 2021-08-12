<?php
class Users extends Controller
{
    public function __construct(){
        $this->userModel = $this->model('User'); 
    }
    
    public function index(){

    }


    public function register(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // Sanitize DATA
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init Data
            $data = [
                'name' => trim($_POST['name']) ,
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmed_password' => trim($_POST['confirmed_password']),
                'name_error' => (!empty($_POST['name'])) ? '' : 'Please enter the name.',
                'email_error' => (!empty($_POST['email'])) ? '' : 'Please enter the email.',
                'password_error' => (!empty($_POST['password'])) ? '' : 'Please enter the password.',
                'confirmed_password_error' => (!empty($_POST['confirmed_password'])) ? '' : 'Please enter the confirmed password.',
            ];

            // var_dump($this->userModel->findUserByEmail($data['email'])); exit;
            if ($this->userModel->findUserByEmail($data['email']) ){
                $data['email_error'] = 'Email is already taken';
            }
            if (strlen($data['password']) < 6){
                $data['password_error'] = 'Password must be at least 6 characters';
            }

            if ($data['password'] != $data['confirmed_password']){
                $data['confirmed_password_error'] = 'Passwords do not match.';
            }


            // Check Errors 
            if(empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['confirmed_password_error'])){
                
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                
                if($this->userModel->register($data)){
                    flash('register_success', 'Your are now registered and log in.');
                    redirect('users/login');
                }else{
                    die('Something goes wrong ...');
                }


            }else{
                // Load the View with Errors
                $this->view('users/register', $data );;
            }
        }else {
            // Init Data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirmed_password' => '',
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirmed_password_error' => ''
            ];

            // Load the View
            $this->view('users/register', $data );;

        }
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize DATA
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Init Data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => (!empty($_POST['email'])) ? '' : 'Please enter the email.',
                'password_error' => (!empty($_POST['password'])) ? '' : 'Please enter the password.',
            ];
            
            if (strlen($data['password']) < 6){
                $data['password_error'] = 'Password must be at least 6 characters';
            }

            if($this->userModel->findUserByEmail($data['email'])){

            }else{
                $data['email_error'] = 'No User Found';
            }

            // Check Errors 
            if(empty($data['email_error']) && empty($data['password_error'])){
                // Validated
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if($loggedInUser){
                    // Create Session
                    // die('LOG IN SUCCEED.');
                    $this->createUserSession($loggedInUser);

                }else{
                    $data['password_error'] = 'Password is incorrect.';
                    $this->view('users/login', $data );;
                }
            }else{
                $this->view('users/login', $data );;
            }
        
        }else {
            // Init Data
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => '',
            ];

        // Load the View
        $this->view('users/login', $data );;

        }
    }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_email'] = $user->email;

        redirect('posts/index');
    }

    public function logout(){

        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);

        session_destroy();

        redirect('users/login');
    }

    
}
