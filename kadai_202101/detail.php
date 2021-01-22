<?php
session_start();
/**
 * １．PHP
 * [ここでやりたいこと]
 * まず、クエリパラメータの確認 = GETで取得している内容を確認する
 * イメージは、select.phpで取得しているデータを一つだけ取得できるようにする。
 * →select.phpのPHP<?php ?>の中身をコピー、貼り付け
 * ※SQLとデータ取得の箇所を修正します。
 */

// var_dump($_GET)
require_once('funcs.php');
$pdo = db_conn();
$id = $_GET['id'];
loginCheck();



//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_movie_table WHERE id = " . $id . ';');
$status = $stmt->execute();


//３．データ表示

if ($status == false) {
    sql_error($status);
} else {
    $row = $stmt->fetch();
}


?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
(入力項目は「登録/更新」はほぼ同じになるから)
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  
  <style>
 .app1{
    display: flex;
    font-size: 15px;
    overflow: scroll;
    margin-bottom: 60px;
  }
  
  .autoplay-slider2{
    display: flex;
    margin-top: 20px;
    min-width:100%;
    width:min-content;
    animation: 25s linear infinite sliderAnimation;
  }
  
  .autoplay-slider2:hover {
    animation-play-state: paused;
  }
  
  .app2 {
    display: flex;
    font-size: 15px;
  }
  
  @keyframes sliderAnimation {
    100% {
      transform: translatex(-50%);
    }
  }
  
  .title_1{
      margin: 50px auto;
      width: 100%;
      font-size: 80%;
  }
  
  .word{
      font-size: 30px;
      margin-bottom: 20px;
  }
  
  
  .t2{
      margin-top:20px;
      margin-bottom: 5px;
      font-size: 25px;
  }
  
  body{
      background-color: #ddfaff;
  }
  


</style>
</head>

<body>
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>フリーアンケート</legend>

  <div class='autoplay-slider1'>
  <h1>公開中の映画</h1>
  <div class="app1"></div>
  </div>

 <h1>オススメ</h1>
 <div class='autoplay-slider2'>
 <div class="app2"></div>
 </div>

  <div id='searchCondition'>
    <h4 class="word">映画/ドラマ評価シート</h4>

    <label>名前：<input type="text" name="name" value="<?= $row['name'] ?>"></label><br>
    <label>Email：<input type="text" name="email" value="<?= $row['email'] ?>"></label><br>

    <form id='searchConditionForm'>
      <dl>
        <p class="t2">タイトル</p>
        <dd><input name='title' id='title' style='width: 500px; height: 25px;' type='text'/></dd>
        <p class="t2">主演俳優</p>
        <dd><input name='Name' id='Name' style='width: 500px; height: 25px;' type='text'/></dd>
        <p class="t2">監督</p>
        <dd><input name='Director' id='Director' style='width: 500px; height: 25px;' type='text'/></dd>
        <p class="t2">ジャンル</p>
        <dd><input name='Music' id='Music' style='width: 500px; height: 25px;' type='text'/></dd>
        <p class="t2">評価</p>
        <dd>
          <input name='evaluation' type='radio' value="なし"<?= ($row['evaluation'] === 'なし') ? 'checked': ";" ?>><label>未選択</label>
          <input name='evaluation' type='radio' value="最高"<?= ($row['evaluation'] === '最高') ? 'checked': ";" ?>><label>最高</label>
          <input name='evaluation' type='radio' value="おもしろい"<?= ($row['evaluation'] === 'おもしろい') ? 'checked': ";" ?>><label>おもしろい</label>
          <input name='evaluation' type='radio' value="普通"<?= ($row['evaluation'] === '普通') ? 'checked': ";" ?>><label>普通</label>
          <input name='evaluation' type='radio' value="つまらない"<?= ($row['evaluation'] === 'つまらない') ? 'checked': ";" ?>><label>つまらない</label>
          <input name='evaluation' type='radio' value="二度と見ない"<?= ($row['evaluation'] === '二度と見ない') ? 'checked': ";" ?>><label>二度と見ない</label>
        </dd>
        <p class="t2" >見た日付</p><dd><input name='Date' id='Date' type='date'/></dd>
        <p class="t2">何で観たか</p>
        <dd>
            <input name='movietype' type='radio' value="Amazon Prime"<?= ($row['movietype'] === 'Amazon Prime') ? 'checked': ";" ?>>Amazon Prime</input>
            <input name='movietype' type='radio' value="Netflix"<?= ($row['movietype'] === 'Netflix') ? 'checked': ";" ?>>Netflix</input>
            <input name='movietype' type='radio' value="Hulu"<?= ($row['movietype'] === 'Hulu') ? 'checked': ";" ?>>Hulu</input>
            <input name='movietype' type='radio' value="Disney+"<?= ($row['movietype'] === 'Disney+') ? 'checked': ";" ?>>Disney+</input>
            <input name='movietype' type='radio' value="U-NEXT"<?= ($row['movietype'] === 'U-NEXT') ? 'checked': ";" ?>>U-NEXT</input>
        </dd>
      </dl>
      <p>感想</p>
      <textArea name="naiyou" rows="4" cols="40" ><?= $row['naiyou'] ?></textArea><br>
      <input type="hidden" name ="id" value="<?= $row['id'] ?>">

    </form>
  </div>

  <input id='favBtn' type='submit' value='登録'/>
  <input id='clearBtn' type='reset' value='条件をクリア'/>

  <div id='favorite'>
    <h4>リスト</h4>
    <form id='favoriteForm'>
      <select name='favoriteList' id='favoriteList'  size=10>
      </select>
    </form>
    <input id='useBtn' type='button' value='もう一回'/>
    <input id='deleteBtn' type='button' value='削除'/>
  </div>


  </fieldset>
</div>
</form>

</body>

<!-- Main[End] -->
<script src="js/jquery-2.1.3.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
console.log(1)
fetch('https://api.themoviedb.org/3/movie/now_playing?api_key=cacc4e245101777ae23934e5b11e8551&language=en-US&page=1')
  .then(response => {
    return response.json();
  })
  .then(data => {
    //取得したJSONデータの処理
    data.results.map(movie => {
  const row = document.createElement('div');
  row.setAttribute('class', 'item');
  console.log(row)

  const title = document.createElement('p');
  title.setAttribute('class', 'title');
  title.textContent = movie.title;
  console.log(title)

  const poster = document.createElement('img');
  poster.src = `https://image.tmdb.org/t/p/w300_and_h450_bestv2/${movie.poster_path}`;
  console.log(poster)

  app1.appendChild(row)
  row.appendChild(poster);
  row.appendChild(title);
});
    console.log(data.results);
  })
  .catch(error => {
    //エラー発生時の処理
    console.log('error');
});


// リスト一覧
fetch('https://api.themoviedb.org/3/movie/11/recommendations?api_key=cacc4e245101777ae23934e5b11e8551&language=en-US&page=1')
  .then(response => {
    return response.json();
  })
  .then(data => {
    //取得したJSONデータの処理
    data.results.map(movie => {
  const row = document.createElement('div');
  row.setAttribute('class', 'item');
  console.log(row)

  const title = document.createElement('p');
  title.setAttribute('class', 'title');
  title.textContent = movie.title;
  console.log(title)

  const poster = document.createElement('img');
  poster.src = `https://image.tmdb.org/t/p/w300_and_h450_bestv2/${movie.poster_path}`;
  console.log(poster)

  app2.appendChild(row)
  row.appendChild(poster);
  row.appendChild(title);
   });
   console.log(data.results);
  })
  .catch(error => {
    //エラー発生時の処理
    console.log('error');
});




// 検索リスト
var favoriteList = {};

function registerFavorite() {
  var name = prompt('お気に入りの名前を入力してください。','お気に入り');
  if (name && name != '') {
    var condition = getCondition();
 
    favoriteList[name] = condition;
    savaConditionList();
    setFavoriteList();
    alert('お気に入りを保存しました。:' + name);
  }
}
 


function getCondition() {
  var condition = {};
 
  condition.title = $('#title').val();
  condition.Name = $('#Name').val();
  condition.Director = $('#Director').val();
  condition.Music = $('#Music').val();
  condition.evaluation = $('#searchConditionForm input[name="evaluation"]:radio:checked').val();
  condition.Date = $('#Date').val();
  condition.movieType = $('#movieType').val();
 
  return condition;
}
 

function setCondition() {
  var Name = $('#favoriteList').val();
  if(Name) {
    var condition = favoriteList[Name];
    if(condition) {
      $('#title').val(condition.title);
      $('#Name').val(condition.Name);
      $('#Director').val(condition.Director);
      $('#Music').val(condition.Music);
      $('#searchConditionForm input[name="evaluation"]').val([condition.evaluation]);
      $('#Date').val(condition.Date);
      $('#movieType').val(condition.movieType);
    }
  }
}
 

function removeFavorite() {
  var Name = $('#favoriteList').val();
  if(Name) {
    if(confirm('お気に入りを削除します。:' + Name)) {
      delete favoriteList[Name];
      setFavoriteList();
 
      if(existFavorite()) {
        savaConditionList();
      } else {
        localStorage.removeItem('favName');
      }
    }
  }
}
 


 

function savaConditionList() {
  localStorage.setItem('favoriteList', JSON.stringify(favoriteList));
}
 

function setFavoriteList() {
  $('#favoriteList').empty();
  for (var name in favoriteList) {
    $('#favoriteList').append('<option value="' + name + '">' + name + '</option>');
  }
}
 
$(function() {

  if(!localStorage) {
    alert('ローカルストレージが使えません。');
  }
 

  var favoriteStr = localStorage.getItem('favConditionList');
  if(favoriteStr){
    favoriteList = JSON.parse(favoriteStr);
    setFavoriteList();
  }
 

  $('#favBtn').on('click', registerFavorite);
  $('#useBtn').on('click', setCondition);
  $('#deleteBtn').on('click', removeFavorite);            
      
       
});
</script>

</html>