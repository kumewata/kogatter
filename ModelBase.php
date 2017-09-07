<?php
/**
 * Created by PhpStorm.
 * User: kogamitsuhiro
 * Date: 2017/08/29
 * Time: 10:15
 */


/*
* DB接続（文字コードをutf-8に設定済み）
*/
function getDbConnect()
{
    if (!$db = new PDO("mysql:host=localhost;dbname=kogatter;charset=utf8", "root", "root")) {
        die('error:' . $db -> errorInfo());
    }

    return $db;
}

/*
* $account_nameからuser_idを取得し$user_idを返す
*/
function getUserIdFromAccountName($db, $account_name)
{
    $sql = "SELECT user_id FROM users WHERE account_name = '$account_name'";
    $result = $db -> prepare($sql);
    $result_bool2 = $result -> execute();
    $rows = $result->fetchall(PDO::FETCH_ASSOC);

    return intval($rows[0]['user_id']);
}

/*
* ツイート内容と時間を、ユーザ固有テーブルに格納する
*/
function storeTweetToUserTable($db, $user_id, $date_time, $content)
{
    if (!empty($content)) {
        $sql = "INSERT INTO all_posts(user_id, kogari_time, contents) VALUES ($user_id, '$date_time', '$content')";
        $result = $db -> prepare($sql);
        $result_bool = $result -> execute();
        $content = "";
    }
}

/*
* ユーザー固有テーブル内のツイート内容を取得する
*/
function getTweetsFromPostsTableByUserId($db, $user_id)
{
    $posts = [];

    $user_string = implode(',', $user_id);
//    $extra = " and user_id in (${user_string})";

//    if ($limit_display > 0) {
//        $extra .= " limit ${limit_display}";
//    } else {
//        $extra = ' ';
//    }

    $sql = "SELECT account_name, contents, kogari_time, kogari_id FROM all_posts JOIN users ON all_posts.user_id = users.user_id WHERE all_posts.user_id in (${user_string}) ORDER BY kogari_time DESC";
    $result = $db -> prepare($sql);
    $result_bool = $result -> execute();

    while ($data =  $result->fetch(PDO::FETCH_ASSOC)) {
        $posts[] = [
            'account_name' => $data['account_name'],
            'contents' => $data['contents'],
            'kogari_time' => $data['kogari_time'],
            'kogari_id' => $data['kogari_id']
        ];
    }

    return $posts;
}

/*
* ツイートした内容と日時を取得する
*/
function getTweetInfoFromPost()
{
//    $tweet_info = [];
    if (!empty($_POST['content'])) {
        $tweet_info = [
            'content' => $_POST['content'],
            'date_time' => date('Y-m-d H:i:s')
        ];

        return $tweet_info;
    }
}

/*
* ユーザーがフォローしているユーザーのidリストを取得
*/
function following($db, $user_id)
{

    $following_list = [];

    $sql = "SELECT DISTINCT followed FROM follow_map WHERE following = '${user_id}'";
    $result = $db -> prepare($sql);
    $result_bool = $result -> execute();
    $rows = $result->fetchall(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        $following_list[] = $row['followed'];
    }
    return $following_list;
}

/*
* ユーザーがフォローされているユーザーのidリストを取得
*/
function followed($db, $user_id)
{

    $followed_list = [];

    $sql = "SELECT DISTINCT following FROM follow_map WHERE followed = '${user_id}'";
    $result = $db -> prepare($sql);
    $result_bool = $result -> execute();
    $rows = $result->fetchall(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        $followed_list[] = $row['following'];
    }
    return $followed_list;
}

/*
* $account_nameからjudgement_smカラムの値を取得しtype_s/type_mを返す
*/
function getUserTypeFromAccountName($db, $account_name)
{
    $sql = "SELECT judgement_sm FROM users WHERE account_name = '$account_name'";
    $result = $db -> prepare($sql);
    $result_bool = $result -> execute();
    $rows = $result->fetchall(PDO::FETCH_ASSOC);

    return $rows[0]['judgement_sm'];
}

/*
* ログインユーザーがドンマイしているポストのidリストを取得
*/
function dontmind($db, $user_id)
{

    $dontmind_list = [];

    $sql = "SELECT DISTINCT post_id FROM dontmind_map WHERE user_id = '${user_id}'";
    $result = $db -> prepare($sql);
    $result_bool = $result -> execute();
    $rows = $result->fetchall(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        $dontmind_list[] = $row['post_id'];
    }
    return $dontmind_list;
}

/*
* 全こがり投稿のIDリストを取得
*/
function getAllPostIds($db)
{
    $posts = [];
    $sql = "SELECT kogari_id FROM all_posts";
    $result = $db -> prepare($sql);
    $result_bool = $result -> execute();
    $rows = $result->fetchall(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        $posts[] = $row['kogari_id'];
    }
    return $posts;
}

/*
* ポストIDからドンマイされている数を取得
*/
function dontmind_count($db, $post_id)
{

    $sql = "SELECT count(*) FROM dontmind_map WHERE post_id = '${post_id}'";
    $result = $db -> prepare($sql);
    $result_bool = $result -> execute();
    $rows = $result->fetchall(PDO::FETCH_ASSOC);

    return $rows[0]['count(*)'];
}

/*
* ユーザーIDからユーザーがドンマイされている数の総数を取得
*/
function getReceivedDontmindByUseId($db, $user_id)
{
//    $sql = "SELECT dontmind_map.post_id, all_posts.user_id FROM dontmind_map JOIN all_posts ON dontmind_map.post_id = all_posts.kogari_id WHERE all_posts.user_id = ${user_id}";
    $sql = "SELECT count(*) FROM dontmind_map JOIN all_posts ON dontmind_map.post_id = all_posts.kogari_id WHERE all_posts.user_id = ${user_id}";
    $result = $db -> prepare($sql);
    $result_bool = $result -> execute();
    $rows = $result->fetchall(PDO::FETCH_ASSOC);

    return $rows[0]['count(*)'];
}

/*
* 他ユーザーのポストへドンマイしているかどうか、0/1で返す。
*/
function dontmind_check_count($db, $first, $second){

    $sql = "SELECT count(*) FROM dontmind_map 
            WHERE post_id ='$first' and user_id='$second'";
    $result = $db -> prepare($sql);
    $result_bool = $result -> execute();

    $rows = $result->fetchall(PDO::FETCH_ASSOC);

    return $rows[0]['count(*)'];

}