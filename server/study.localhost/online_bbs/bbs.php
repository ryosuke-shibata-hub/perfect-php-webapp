<?php
    date_default_timezone_set("Asia/Tokyo");
    $link = mysqli_connect('2a8bb028c9c0','docker','docker');

    if(!$link) {
        die('データベースに接できません:' . mysqli_connect_error());
    }

    mysqli_select_db($link,"database");
    $link->set_charset('utf-8');
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
        $sql = "insert into `posts`(`name`,`comment`,`create_at`) value('"
            . mysqli_real_escape_string($link,$name) . "','"
            . mysqli_real_escape_string($link,$comment) . "','"
            . date('Y-m-d H:i:s') . "')";

        mysqli_query($link,$sql);
        mysqli_close($link);
        header('Location:http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    }
    }
    $sql = "select * from `posts` order by `create_at` desc";
    $result = mysqli_query($link,$sql);
    $psots = array();
    if($result !== false && mysqli_num_rows($result)) {
        while($post = mysqli_fetch_assoc($result)) {
            $posts[] = $post;
        }
    }
    mysqli_free_result($result);
    mysqli_close($link);

    include('view/bbs_view.php');
?>