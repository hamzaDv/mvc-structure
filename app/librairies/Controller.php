<!-- Base Controller + Load all Controllers -->
<?php

class Controller{

    public function model($model){
        // Require Model File
        require_once '../app/models/'. $model. '.php';
        
        // Init Model
        return new $model();
    }

    public function view($view, $data = []){
        // Check for the view file  
        
        if (file_exists('../app/views/'. $view. '.php')){
            require_once '../app/views/'. $view. '.php';
        }else{
            die('View does not exist.');
        }
        
    }
}