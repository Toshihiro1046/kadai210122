<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

function db_conn() 
{
 try {
    $db_name = "gs_db";    //データベース名
    $db_id   = "root";      //アカウント名
    $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
    $db_host = "localhost"; //DBホスト
    $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
    return $pdo;
 } catch (PDOException $e) {
    exit('DB Connection Error:'.$e->getMessage());
 }
}


//SQLエラー関数：sql_error($stmt)

function sql_error($stmt){
$error = $stmt->errorInfo();
exit("SQLError:".$error[2]);
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name){
header("Location:" . $file_name);
exit();
}

// ログインチェク処理 loginCheck()

function loginCheck(){
   if(!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()){
       exit('LOGIN ERROR!!');
     }else{
         // SESIION IDがチェックできた場合
         // SESSION IDを即座に更新する。
         session_regenerate_id(true);
         $_SESSION['chk_ssid'] = session_id();
     }
   }
   
