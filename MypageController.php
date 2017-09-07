<?php
/**
 * Created by PhpStorm.
 * User: kogamitsuhiro
 * Date: 2017/08/23
 * Time: 12:44
 */
// セッション開始
session_start();

//session_regenerate_id(true);

// 設定ファイルを読み込み
include('./Define.php');

// 関数ファイルを読み込み
include('./MypageModel.php');

// ログイン状態を擬似的に作るため、ここでセッション変数を設定。後で消す
//$_SESSION["account_name"] = "makoto";

// 変数を用事
$account_name = ""; // アカウント名
$password = ""; // パスワード
$sm_category = ""; // ユーザータイプ(S/M)
$tweet_count = 0; // ツイート数
$content = ""; // こがり内容
$date_time = ""; // 日時
$dontmind_message = ""; // ドンマイメッセージ

// セッション変数：アカウント名
if (isset($_SESSION["account_name"])) {
    $account_name = $_SESSION["account_name"];
//    var_dump($account_name);
}

// ツイート情報取得（内容、日時）
$tweet_info = getTweetInfoFromPost();
$content = $tweet_info['content'];
$date_time = $tweet_info['date_time'];

// DB接続
$db = getDbConnect();

// DBから取得する連想キーを小文字に統一する
$db -> setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);

// セッションがもつユーザー名からuser_idを取得する。
$user_id = getUserIdFromAccountName($db, $account_name);

// ツイート内容と時間を、ユーザ固有テーブルに挿入する
storeTweetToUserTable($db, $user_id, $date_time, $content);

// user_idを配列に格納数する
$user_id_array = [];
$user_id_array[] = $user_id;

// 投稿テーブル内のツイート内容を取得する
$kogari_tweets = getTweetsFromPostsTableByUserId($db, $user_id_array);

// セッションがもつユーザー名からSorMを取得する。
$sm_category = getUserTypeFromAccountName($db, $account_name);

// ユーザーの投稿数を取得する
$tweet_count = count($kogari_tweets);

// ログインユーザーがフォローしているユーザーの数
$following_num = count(following($db, $user_id));

// ログインユーザーがフォローされているユーザーの数
$followed_num = count(followed($db, $user_id));

// ドンマイメッセージを取得する
$dontmind_message = getDontMindMessage($db, $sm_category);

// ログインユーザーがドンマイしているポストのidリストを取得
$dontmind_list = dontmind($db, $user_id);
//var_dump($dontmind_list);

// ポストIDからドンマイされている数を取得
//$dontmind_count = dontmind_count($db, $post_id);

// ユーザーがドンマイされている数の総数を取得
$dontmind_receive_all = getReceivedDontmindByUseId($db, $user_id);
//var_dump($dontmind_receive_all);

// 全こがり投稿のIDリストを取得
$all_posts = getAllPostIds($db);
//var_dump($all_posts);

// 新規登録のViewファイルを読み込み
include('./MypageView.php');