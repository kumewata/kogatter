<?php
/**
 * Created by PhpStorm.
 * User: watarukume
 * Date: 2017/08/27
 * Time: 11:16
 */

// ユーザー名重複チェック
//$sql_account_name = "SELECT account_name FROM users";
//$result_account_name = $db -> prepare($sql_account_name);
//$result_account_name_bool = $result_account_name -> execute();
////        var_dump($result_account_name_bool);
//$rows_account_name = $result_account_name -> fetchall(PDO::FETCH_ASSOC);
////        print_r($rows_account_name); // ユーザー名一覧確認
//foreach ($rows_account_name as $row_account_name) {
//    foreach ($row_account_name as $value_account_name) {
//        if ($value_account_name === $account_name) {
//            $err_msg[] = "そのユーザー名は既に使用されています。";
//        }
//    }
//}

function duplicateConfirmation ($data_to_check, $err_comment)
{
    $sql = "SELECT $data_to_check FROM users";
    $result = $db->prepare($sql);
    $result_bool = $result->execute();
    $rows = $result->fetchall(PDO::FETCH_ASSOC);
    print_r($rows);

    foreach ($rows as $row) {
        foreach ($row as $value) {
            if ($value === $data_to_check) {
                $err_msg[] = "$err_comment";
            }
        }
    }
}


