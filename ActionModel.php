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
* 他ユーザーをフォローしているかどうか、0/1で返す。
*/
function check_count($db, $first, $second){

    $sql = "SELECT count(*) FROM follow_map 
            WHERE following ='$second' and followed='$first'";
    $result = $db -> prepare($sql);
    $result_bool = $result -> execute();

    $rows = $result->fetchall(PDO::FETCH_ASSOC);

    return $rows[0]['count(*)'];

}

/*
* 他ユーザーをアンフォローする
*/
function follow_user($db, $them, $me){
    $count = check_count($db, $them, $me);

    if ($count == 0){
        $sql = "INSERT INTO follow_map (following, followed)
                VALUES ($me, $them)";
        $result = $db -> prepare($sql);
        $result_bool = $result -> execute();

        return $result_bool;
    }
}

/*
* 他ユーザーをアンフォローする
*/
function unfollow_user($db, $them, $me){
    $count = check_count($db, $them, $me);

    if ($count != 0){
        $sql = "DELETE FROM follow_map
                WHERE following='$me' AND followed='$them'
                limit 1";

        $result = $db -> prepare($sql);
        $result_bool = $result -> execute();

        return $result_bool;
    }
}