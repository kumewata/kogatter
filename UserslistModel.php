<?php

// 共通の関数ファイルを読み込み
include('./ModelBase.php');

/*
* usersテーブルからユーザー情報を取得
*/
function getUsersInfo($db)
{

    $sql = "SELECT account_name, introduction FROM users";
    $result = $db -> prepare($sql);
    $result_bool = $result->execute();
    $rows = $result->fetchall(PDO::FETCH_ASSOC);

    return $rows;

}

// 全ユーザーのIDリストを取得
function getAllUserIds($db){
    $users = [];
    $sql = "SELECT user_id, account_name FROM users";
    $result = $db -> prepare($sql);
    $result_bool = $result -> execute();
    $rows = $result->fetchall(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        $users[$row['user_id']] = $row['account_name'];
    }
    return $users;
}
