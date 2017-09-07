<?php
/**
 * Created by PhpStorm.
 * User: watarukume
 * Date: 2017/08/29
 * Time: 20:05
 */
session_start();

session_regenerate_id(true);

// 設定ファイルを読み込み
include('./Define.php');

// 関数ファイルを読み込み
include('./UserpageModel.php');

// 変数を用事
$account_name = ""; // アカウント名
$password = ""; // パスワード
$content = ""; // こがり内容
$date_time = ""; // 日時
$user_name = ""; // 見ているページのユーザー名

// ユーザー一覧からリンクで飛んできて、GETのアカウント名を$user_nameに渡す。
if(isset($_GET['user_name'])){
    $user_name = $_GET['user_name'];
}

// セッション変数：アカウント名
if (isset($_SESSION["account_name"])) {
    $account_name = $_SESSION["account_name"];
}

// ツイート情報取得（内容、日時）
//$tweet_info = getTweetInfoFromPost();
//$content = $tweet_info['content'];
//$date_time = $tweet_info['date_time'];

// DB接続
$db = getDbConnect();

// DBから取得する連想キーを小文字に統一する
$db -> setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);

// ユーザー名からuser_idを取得する。
$user_id = getUserIdFromAccountName($db, $user_name);

// user_idを配列に格納数する
$user_id_array = [];
$user_id_array[] = $user_id;

// ツイート内容を取得する
$kogari_tweets = getTweetsFromPostsTableByUserId($db, $user_id_array);

// セッションがもつユーザー名からSorMを取得する。
$sm_category = getUserTypeFromAccountName($db, $user_name);

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
include('./UserpageView.php');