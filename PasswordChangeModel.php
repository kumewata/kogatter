<?php
/**
 * Created by PhpStorm.
 * User: kogamitsuhiro
 * Date: 2017/08/23
 * Time: 12:27
 */

// 共通の関数ファイルを読み込み
include('./ModelBase.php');

//現在のパスワードが合っているか

function passConfirm($db,$current_password,$account_name)
{
    global $err_msg;

    $sql = "SELECT password FROM users WHERE account_name ='$account_name'";
    $result = $db -> prepare($sql);
    $result_bool = $result->execute();
    $rows = $result->fetchall(PDO::FETCH_ASSOC);

    var_dump($rows);
    var_dump($current_password);
    if (!($rows[0][password] == $current_password)) {
        $err_msg = "現在のパスワードが間違えています";
    }
}


function passSame($new_password,$confirm_password){
    global  $err_msg;

    if (!($new_password == $confirm_password)){
        $err_msg ="確認用のパスワードが間違っています";
    }
}


function passChange($db,$new_password,$account_name){

//    echo $new_password,$account_name;

    $sql_pass_change = "UPDATE users SET password = '$new_password' WHERE account_name = '$account_name'";
    $result_pass_change = $db -> prepare($sql_pass_change);
    $result_bool = $result_pass_change->execute();
    echo "パスワードを書き換えました。";
}