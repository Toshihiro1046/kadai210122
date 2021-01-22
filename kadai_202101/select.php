<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index2.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>

<?php
session_start();
require_once('funcs.php');
loginCheck();

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_movie_table");
$status = $stmt->execute();

//３．データ表示
$view="";

echo '<div class="w-75">';
    echo '<table class="table">';
    echo '<thead class="thead-dark">';
    echo '<tr>';
    echo '<th class = "table1">名前</th><th class = "table1">ジャンル</th>';
    echo '<th class = "table1">評価</th><th class = "table1">媒体</th>';
    echo '<th class = "table1">内容</th><th class = "table1">日付</th>';
    echo '</tr>';

if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view = '<a href="detail.php?id=' . $result['id'] . '">' . h($result['name']) . ' / ' . h($result['email']) . ' / ' . 
            h($result['evaluation']) . ' / ' . h($result['movietype']) . ' / ' .
            h($result['naiyou']) . ' / ' . h($result['indate']) . '</a>' .
            '<a href="delete.php?id=' . $result['id'] . '">' . '<削除>' . '</a>';
    //[.=]は上書きではなく、追加
    $newview = explode(' / ', $view);
        echo '<tr>';
        foreach ($newview as $key => $val) {
          // $valは使わない
          echo '<td>' . $newview[$key] . '</td>';
         }
        echo '</tr>';
}
}

echo '</table>';
echo '</div>';


?>



<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <!-- <div class="container jumbotron"><?= $view ?></div> -->
</div>
<!-- Main[End] -->

</body>
</html>
