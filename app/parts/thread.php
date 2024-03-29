<?php

include_once("./app/datebase/connect.php");

// $title = "Geniecode";
$error_message = array();

if(isset($_POST["submitButton"])) {

    if(empty($_POST["username"])) {
        $error_message["username"] = "書き込み内容が空です";
    } else {
        $escaped["username"] = htmlspecialchars($_POST["username"], ENT_QUOTES, "UTF-8");
    }

    if(empty($_POST["body"])) {
        $error_message["body"] = "コメントを入力してください";
    } else {
        $escaped["body"] = htmlspecialchars($_POST["body"], ENT_QUOTES, "UTF-8");
    }

    if(empty($error_message)) {
        $post_date = date("Y-m-d H:i:s");

        $sql = "INSERT INTO `comment` (`username`, `body`, `post_date`) VALUES (:username, :body, :post_date);";
        $statement = $pdo->prepare($sql);

        $statement->bindParam(":username", $escaped["username"], PDO::PARAM_STR);
        $statement->bindParam(":body", $escaped["body"], PDO::PARAM_STR);
        $statement->bindParam(":post_date", $post_date, PDO::PARAM_STR);

        $statement->execute();
    }
}
$comment_array = array();
//コメントデータをテーブルから取得してくる
$sql = "SELECT * FROM comment";
$statement = $pdo->prepare($sql);
$statement->execute();

$comment_array = $statement;

// var_dump($comment_array->fetchObject());
?>

<div class="threadWrapper">
        <div class="childWrapper">
            <div class="threadTitle">
                <span>スレッドタイトル</span>
                <h1>掲示板を作ってみた</h1>
            </div>
            <?php include("commentSection.php"); ?>
            <?php include("commentForm.php"); ?>
        </div>
    </div>

