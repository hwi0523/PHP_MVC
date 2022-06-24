<?php
namespace application\controllers;

use application\models\UserModel;

class UserController extends Controller{

    public function join(){
        $this-> addAttribute(_TITLE,"회원가입");
        $this-> addAttribute(_HEADER,$this->getView("template/header.php"));
        $this-> addAttribute(_MAIN,$this->getView("user/join.php"));
        $this-> addAttribute(_FOOTER,$this->getView("template/footer.php"));
        return "template/t1.php";
    }

    public function joinProc(){
        $param=[
            "uid" => $_POST["uid"],
            "upw" => $_POST["upw"],
            "nm" => $_POST["nm"],
            "gender" => $_POST["gender"]
        ];

        // 비밀번호 암호화 (다시 되돌릴수없는 암호화기법 -단방향)
        $param["upw"] = password_hash($param["upw"],PASSWORD_BCRYPT);
        $model = new UserModel();
        $model -> insUser($param);
        return "redirect:join";
    }

    public function login(){
        $this-> addAttribute(_TITLE,"로그인");
        $this-> addAttribute(_HEADER,$this->getView("template/header.php"));
        $this-> addAttribute(_MAIN,$this->getView("user/login.php"));
        $this-> addAttribute(_FOOTER,$this->getView("template/footer.php"));
        return "template/t1.php";
    }

    public function loginProc(){
        $param = [
            "uid" => $_POST["uid"],
            "upw" => $_POST["upw"]
        ];

        $model =new UserModel();
        $dbUser = $model->selUser($param);

        if($dbUser === false){ // 아이디 없음
            print "아이디없음 <br>";
            return $this->login();
        }else if(!password_verify($param["upw"],$dbUser->upw)){ // 비밀번호 다름
            print "비밀번호 다름 <br>";
            return $this->login();
        }
        flash(_LOGINUSER,$dbUser);

        return "redirect:/board/list";
    }

    public function logout(){
        flash(_LOGINUSER);

        return "redirect:/board/list";
    }

}