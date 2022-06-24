<?php
namespace application\models;
use PDO;

class BoardModel extends Model
{
    public function selBoardList()
    {
        $sql = "SELECT i_board, title, created_at 
                FROM t_board
                ORDER BY i_board DESC";
        // 문자열에 홑따옴표, 숫자에 홑따옴표 빼기 stmt 에서 prepare를 사용하면 가능
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function selBoard(&$param)
    {
        $sql = "SELECT A.i_board, A.title, A.ctnt, A.created_at, B.nm,B.i_user 
        FROM t_board A
        INNER JOIN t_user B
        ON A.i_user= B.i_user WHERE i_board = :i_board";
        $stmt = $this->pdo->prepare($sql);
        // $stmt->bindValue(':i_board', $param['i_board']);
        $stmt->execute(array($param['i_board']));
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function upBoard(&$param){
        $sql = 
        "UPDATE t_board 
        SET title = :title , ctnt = :ctnt
        WHERE i_board = :i_board";
        $stmt = $this->pdo->prepare($sql);
        // $stmt->bindValue(':title', $param["title"]);
        // $stmt->bindValue(':ctnt', $param["ctnt"]);
        // $stmt->bindValue(':i_board', $param["i_board"]);
        return $stmt->execute(array($param["title"], $param["ctnt"],$param["i_board"]));
    }

    public function delBoard(&$param) {
        $sql = "DELETE FROM t_board 
        WHERE i_board = :i_board";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':i_board', $param["i_board"]);
        return $stmt->execute();
    }

    public function insBoard(&$param){
        $sql="INSERT INTO t_board
        (title,ctnt,i_user)
        VALUES
        (:title,:ctnt,:i_user)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':title', $param["title"]);
        $stmt->bindValue(':ctnt', $param["ctnt"]);
        $stmt->bindValue(':i_user', $param["i_user"]);
        $stmt->execute();
    }
}
