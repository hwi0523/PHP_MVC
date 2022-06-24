<?php
// 네임스페이스 : 태그같은 느낌이다
namespace application\controllers;
// 같은 네임스페이스면 use를 안써줘도 된다.

use application\models\BoardModel;

class BoardController extends Controller
{
    public function list()
    {
        $model = new BoardModel();
        // $this->$list = $model->selBoardList();
        $this->addAttribute('title', '리스트');
        $this->addAttribute('list', $model->selBoardList());
        $this->addAttribute('js', ['board/list']);
        $this->addAttribute('css', ['board/list']);
        $this-> addAttribute(_HEADER,$this->getView("template/header.php"));
        $this-> addAttribute(_MAIN,$this->getView("board/list.php"));
        $this-> addAttribute(_FOOTER,$this->getView("template/footer.php"));
        return "template/t1.php";
        // return 'board/list.php'; //view 파일명
    }
    public function detail()
    {
        $i_board = $_GET['i_board'];
        $model = new BoardModel();
        // print "i_board : {$i_board}<br>";
        $param = ['i_board' => $i_board];
        $this->addAttribute('data', $model->selBoard($param));
        $this->addAttribute('js', ['board/detail']);
        return 'board/detail.php';

        // 글번호, 제목, 내용, 글쓴이 이름, 작성일
    }
    public function del(){
        $param = ["i_board" => $_GET["i_board"]];
        $model = new BoardModel();
        $model->delBoard($param);
        return "redirect:/board/list";
    }
    public function mod(){
        $i_board = $_GET["i_board"];
        $model = new BoardModel();
        $param =['i_board'=> $i_board];
        $this-> addAttribute("data",$model->selBoard($param));
        $this->addAttribute('title', '수정');
        $this-> addAttribute(_HEADER,$this->getView("template/header.php"));
        $this-> addAttribute(_MAIN,$this->getView("board/mod.php"));
        $this-> addAttribute(_FOOTER,$this->getView("template/footer.php"));
        return"template/t1.php";
    }
    public function modProc(){
        $i_board =$_POST["i_board"];
        $title =$_POST["title"];
        $ctnt =$_POST["ctnt"];

        $model = new BoardModel();
        $param =[
            'i_board'=> $i_board,
            'title' => $title,
            'ctnt'=> $ctnt
        ];
        $this-> addAttribute("data",$model->upBoard($param));
        return "redirect:/board/detail?i_board={$i_board}";
    }
    public function write(){
        $this->addAttribute('title', '글쓰기');
        $this-> addAttribute(_HEADER,$this->getView("template/header.php"));
        $this-> addAttribute(_MAIN,$this->getView("board/write.php"));
        $this-> addAttribute(_FOOTER,$this->getView("template/footer.php"));
        return"template/t1.php";
    }

    public function writeProc(){
        $title =$_POST["title"];
        $ctnt =$_POST["ctnt"];

        $model = new BoardModel();
        $param =[
            'title' => $title,
            'ctnt'=> $ctnt,
            'i_user'=>$_SESSION[_LOGINUSER]->i_user
        ];
        $this-> addAttribute("data",$model->insBoard($param));
        return "redirect:/board/list";
    }
}