<?php
// Load Config
require_once 'config/config.php';

// Load librairies
// require_once 'librairies/Controller.php';
// require_once 'librairies/Core.php';
// require_once 'librairies/Database.php';

// Auto Load Core Libraries
spl_autoload_register(function($className){
    require_once 'librairies/'. $className . '.php';
});

// Init Core
$core = new Core();