<?php

class App
{

    public $controller, $action, $params, $route, $urlCheck;
    function __construct()
    {
        global $routes;



        $this->route = new Route();


        if ($routes['default_controller']) {
            $this->controller = $routes['default_controller'];
        }
        $this->action = 'index';
        $this->params = [];
        $this->handleUrl();

    }





    public function handleUrl()
    {


        $urlArray = $this->UrlProcess();


        $url = $this->route->handleRoute($urlArray);

        $urlArray = array_filter(explode('/', $url));
        $urlArray = array_values($urlArray);


        if (empty($urlArray)) {
            $urlArray[0] = 'home';
            $urlArray[1] = 'index';

        }

        $this->urlCheck = '';
        if (!empty($urlArray)) {
            foreach ($urlArray as $key => $item) {
                $this->urlCheck .= $item . '/';
                $fileCheck = rtrim($this->urlCheck, '/');
                $fileArr = explode('/', $fileCheck);
                $fileArr[count($fileArr) - 1] = ucfirst($fileArr[count($fileArr) - 1]);
                $fileCheck = implode('/', $fileArr);
                if (!empty($urlArray[$key - 1])) {
                    unset($urlArray[$key - 1]);

                }
                if (file_exists("app/Controllers/" . $fileCheck . ".php")) {
                    $this->urlCheck = $fileCheck;
                    break;
                }
            }
            $urlArray = array_values($urlArray);

        }




        // Controller    
        if (!empty($urlArray[0])) {
            $this->controller = ucfirst($urlArray[0]);

        } else {
            $this->controller = ucfirst($this->controller);

        }

        if (file_exists("app/Controllers/" . $this->urlCheck . ".php")) {



            require_once "app/Controllers/" . $this->urlCheck . ".php";



            //Kiểm tra class $this->controller tồn tại
            if (class_exists($this->controller)) {

                $this->controller = new $this->controller();
                unset($urlArray[0]);
            } else {
                $this->loadError();


            }
        } else {
            $this->loadError();
        }



        //  Xử lý action


        if (!empty($urlArray[1])) {
            if (method_exists($this->controller, $urlArray[1])) {
                $this->action = $urlArray[1];


            }

            unset($urlArray[1]);


        }


        $this->params = $urlArray ? array_values($urlArray) : [];


        if (method_exists($this->controller, $this->action)) {
            // Tên controler, tên hàm muốn chạy là ai, tham số dùng để chạy
            call_user_func_array([$this->controller, $this->action], $this->params);
        } else {
            $this->loadError();

        }
    }



    public function UrlProcess()
    {
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
    }


    public function loadError($name = '404')
    {
        require './app/errors/' . $name . '.php';
    }


}

