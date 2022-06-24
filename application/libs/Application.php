<?php
namespace application\libs;

class Application
{
    public $controller;
    public $action;

    public function __construct()
    {
        $getUrl = '';
        if (isset($_GET['url'])) {
            // url 맨 앞에 /를 지워줌
            $getUrl = rtrim($_GET['url'], '/');
            $getUrl = filter_var($getUrl, FILTER_SANITIZE_URL);
        }
        // explode : 문자열을 앞에 인자 '/' 로 나눠서 배열로 만듬
        $getParams = explode('/', $getUrl);
        $controller = isset($getParams[0]) && $getParams[0] != '' ? $getParams[0] : 'board';
        $action = isset($getParams[1]) && $getParams[1] != '' ? $getParams[1] : 'index';

        if (!file_exists('application/controllers/' . $controller . 'Controller.php')) {
            echo '해당 컨트롤러가 존재하지 않습니다.';
            exit();
        }
        $controllerName = 'application\controllers\\' . $controller . 'controller';
        new $controllerName($action);
    }
}
