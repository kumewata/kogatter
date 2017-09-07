<?php
/**
 * Created by PhpStorm.
 * User: kogamitsuhiro
 * Date: 2017/08/23
 * Time: 12:38
 */
//セッション
session_start();
session_regenerate_id(true);

// 関数ファイルを読み込み
include('./ProfileEditModel.php');

//変数用意
$err_msg = []; // エラーメッセージ
//$account_name     = $_SESSION["$account_name"] ;
$account_name     = "aaa";
$introduction     = "";






























// 新規登録のViewファイルを読み込み
include('./ProfileEditView.php');