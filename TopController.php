<?php
/**
 * Created by PhpStorm.
 * User: kogamitsuhiro
 * Date: 2017/08/23
 * Time: 12:37
 */

// セッション開始
session_start();

//session_regenerate_id(true);

// 設定ファイルを読み込み
include('./Define.php');

// 関数ファイルを読み込み
include('./TopModel.php');

// 変数を用事
$account_name = ""; // アカウント名

// セッション変数：アカウント名
if (isset($_SESSION["account_name"])) {
    $account_name = $_SESSION["account_name"];
//    var_dump($account_name);
}

// DB接続
$db = getDbConnect();

// セッションがもつユーザー名からuser_idを取得する。
$user_id = getUserIdFromAccountName($db, $account_name);

// ログインユーザーがフォローしているユーザーのidリストを取得
$following_list = following($db, $user_id);
// 自分のユーザーidも入れておく
$following_list[] = $user_id;

// ユーザー固有テーブル内のツイート内容を取得する
$kogari_tweets = getTweetsFromPostsTableByUserId($db, $following_list);
//var_dump($kogari_tweets);

// セッションがもつユーザー名からSorMを取得する。
$sm_category = getUserTypeFromAccountName($db, $account_name);

// ユーザーの投稿数を取得する
$tweet_count = count($kogari_tweets);

// ログインユーザーがフォローしているユーザーの数
$following_num = count(following($db, $user_id));

// ログインユーザーがフォローされているユーザーの数
$followed_num = count(followed($db, $user_id));

// ログインユーザーがドンマイしているポストのidリストを取得
$dontmind_list = dontmind($db, $user_id);
//var_dump($dontmind_list);

// 全こがり投稿のIDリストを取得
$all_posts = getAllPostIds($db);
//var_dump($all_posts);

// ユーザーがドンマイされている数の総数を取得
$dontmind_receive_all = getReceivedDontmindByUseId($db, $user_id);

// 新規登録のViewファイルを読み込み
include('./TopView.php');