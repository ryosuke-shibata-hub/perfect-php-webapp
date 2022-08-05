<?php
 $link = mysqli_connect('127.0.0.1','docker','');
 if(!$link) {
    die('データベースに接できません:' . mysqli_connect_error());
 }

 mysql_select_db('database',$link);
 $errors = array();

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = null;
    if(!isset($_POST['name']) || !strlen($_POST['name'])) {
        $errors['name'] = '名前を入力してください';
    } else if (strlen($_POST['name']) > 40) {
        $errors['name'] = '名前は40文字以内で入力してください';
    } else {
        $name = $_POST['name'];
    }
    $comment = null;
    if(!isset($_POST['comment']) || !strlen($_POST['comment'])) {
        $errors['comment'] = '一言を入力してください';
    } else if (strlen($_POST['comment']) > 200) {
        $errors['comment'] = 'ひとことは200文字以内で入力してください。';
    } else {
        $comment = $_POST['comment'];
    }

    if(count($errors) === 0) {
        $sql = "insert into `posts`('name`,`comment`,`created_at`) value('"
            . mysql_real_escape_string($name) . "','"
            . mysql_real_escape_string($comment) . "','"
            .date('Y-m-d H-i-s') . "')";

        mysql_query($sql,$link);
    }
}

?>




<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ひとこと掲示板</title>
</head>
<body>
  <h1>ひとこと掲示板</h1>
  <form action="bbs.php" method="post">
    名前:<input type="text" name="name" /><br>
    ひとこと:<input type="text" name="comment" size="60" /><br>
    <input type="submit" name="submit" value="送信">
  </form>
</body>
</html>