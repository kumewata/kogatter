<?php
/**
 * Created by PhpStorm.
 * User: kogamitsuhiro
 * Date: 2017/08/23
 * Time: 12:27
 */

// 共通の関数ファイルを読み込み
include('./ModelBase.php');

// ドンマイメッセージを取得する
function getDontMindMessage ($db, $sm_category)
{
    $sql = "SELECT message FROM dontmind_message WHERE sm_category = '$sm_category'";
    $result = $db -> prepare($sql);
    $result_bool = $result -> execute();
    $rows = $result->fetchall(PDO::FETCH_ASSOC);

    $rand_num = rand(0, count($rows) - 1);

    return $rows[$rand_num]['message'];
}