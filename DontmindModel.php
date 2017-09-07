<?php
/**
 * Created by PhpStorm.
 * User: watarukume
 * Date: 2017/08/30
 * Time: 8:48
 */

// 共通の関数ファイルを読み込み
include('./ModelBase.php');

/*
* 他ユーザーのポストへドンマイしているかどうか、0/1で返す。
*/
//function dontmind_check_count($db, $first, $second){
//
//    $sql = "SELECT count(*) FROM dontmind_map
//            WHERE post_id ='$first' and user_id='$second'";
//    $result = $db -> prepare($sql);
//    $result_bool = $result -> execute();
//
//    $rows = $result->fetchall(PDO::FETCH_ASSOC);
//
//    return $rows[0]['count(*)'];
//
//}

/*
* 他ユーザーの投稿へドンマイを送る
*/
function dontmind_post($db, $it, $me){
    $count = dontmind_check_count($db, $it, $me);

    if ($count == 0){
        $sql = "INSERT INTO dontmind_map (post_id, user_id)
                VALUES ($it, $me)";
        $result = $db -> prepare($sql);
        $result_bool = $result -> execute();

        return $result_bool;
    }
}

/*
* 他ユーザーの投稿へのドンマイをやめる
*/
function undontmind_post($db, $it, $me){
    $count = dontmind_check_count($db, $it, $me);

    if ($count != 0){
        $sql = "DELETE FROM dontmind_map
                WHERE post_id='$it' AND user_id='$me'
                limit 1";

        $result = $db -> prepare($sql);
        $result_bool = $result -> execute();

        return $result_bool;
    }
}