<!-- Taking URLs and convert them in order to load controllers, pull functions, params  -->
<?php
// App Core Class, Create Url, Load Controllers, URL Format 
// EXAMPLE: /controller/method/params
    class Core{

        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){

            // var_dump(is_callable(Pages::class, 'about'));

            $url = $this->getUrl();

            if($url){
            //     // Look in controllers for the first value
                if(file_exists('../app/controllers/'. ucwords($url[0]. '.php'))){
                    // echo 'existed';
                    $this->currentController = ucwords($url[0]);
                    unset($url[0]);
                }

                // Look in controllers for the second value
                if(isset($url[1])){
                    if(is_callable($this->currentController, $url[1])){
                        $this->currentMethod = $url[1];
                        unset($url[1]);
                    }                    

                }
            }

            require_once '../app/controllers/'. $this->currentController. '.php';

            $this->currentController = new $this->currentController;

            $this->params = $url ? array_values($url) : [];

            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);


        }
        public function getUrl(){
            if(isset ($_GET['url']) ){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }

        public function index(){

        }

    }