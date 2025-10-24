<?php
class Router
{
    public $url;

    function __construct()
    {
        if(isset($_GET['url'])){
            $this->url=$_GET['url'];
        }else{
            $this->url='index';
        }
    }
    function yonlendir()
    {
        $data = explode('/', $this->url);
        $function_name = $data[0];

        require('controller/home.php');
        $controller = new home();

        if (method_exists($controller, $function_name)) {
            if (!empty($data[1])) {
                $gonderilen_deger = $data[1];
                $controller->$function_name($gonderilen_deger);
            } else {
                $controller->$function_name();
            }
        } else {
            include('view/404.php');
        }
    }

}