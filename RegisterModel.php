<?php
/**
 * Created by PhpStorm.
 * User: kogamitsuhiro
 * Date: 2017/08/23
 * Time: 12:28
 */

// 共通の関数ファイルを読み込み
include('./ModelBase.php');

/*
* ユーザー情報の重複を確認する関数
*/
function duplicateConfirmation ($db, $data_to_check, $column_to_check, $err_comment)
{
    global $err_msg;

    $sql = "SELECT ${column_to_check} FROM users";
    $result = $db -> prepare($sql);
    $result_bool = $result->execute();
    $rows = [];
    $rows = $result->fetchall(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        foreach ($row as $value) {

            if ($value == $data_to_check) {
                $err_msg[] = "${err_comment}";
            }
        }
    }
}

/*
* ユーザー情報をDBに登録
*/
function addUserTable ($db, $account_name, $email, $password, $sm_type)
{
    $reg_time = date('Y-m-d H:i:s');


    $sql = "INSERT INTO users(account_name, email, password, judgement_sm, time_reg, user_flag) VALUES ('$account_name','$email','$password', '$sm_type', '$reg_time', 1)";
    $result = $db -> prepare($sql);
    $result_bool = $result -> execute();
}

/*
* ユーザー固有のテーブル（user_#）作成
*/
function genUserTable ($db, $email)
{
    // 新規登録ユーザーのuser_idを取得
    $sql_id_check = "SELECT user_id FROM users WHERE email = '${email}'";
    $result_id_check = $db -> prepare($sql_id_check);
    $result_id_check_bool = $result_id_check -> execute();

    // user_idの番号に応じたテーブル（user_#）を作成
    $rows_id_check = $result_id_check -> fetchAll(PDO::FETCH_ASSOC);
    $sql_create_table = "CREATE TABLE user_" . $rows_id_check[0]['user_id'] . "(kogari_id INT PRIMARY KEY AUTO_INCREMENT, kogari_time VARCHAR(255), contents TEXT, count_dontmind INT default 0)";
    $result_create_table = $db -> prepare($sql_create_table);
    $result_create_table_bool = $result_create_table -> execute();
}




