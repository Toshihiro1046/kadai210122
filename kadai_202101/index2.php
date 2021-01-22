<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  
  <style>
  .body1{
    background-color:#EEEEEE;
  }

  div {
            padding: 10px;
            font-size: 16px;
        }



.header-box{
  display:flex;
  font color:white;
  font-size:20px;
  padding left:10px;
  background-color:darkblue;
  height: auto;
}

a:link { color: white; 
}

a:visited { color: white; 
}

.sheet1{
    font-size:25px;
}

.public-movie{
  background-color:black;
}

.sheet2{
    font-size:20px;
    color:white;
}

 #app1{
    display: flex;
    width:1150px;
    font-size: 15px;
    overflow-x: scroll;
    margin-bottom: 60px;
  }

  #menu::-webkit-scrollbar {  
  display:none;
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

<body class = body1>
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
  <p class = "sheet1">マイチェックリスト</p>
    <div class="header-box">
    <div class="header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    <div class="header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="jumbotron">
   

  
  <div class='public-movie'>
   <legend class = "sheet2">公開中の映画</legend>
  <div id ="app1"></div>
  </div>

 
<form method="POST" action="insert2.php">
  <div id='searchCondition'>
    <form id='searchConditionForm'>
      <dl>
        <p class="t2">タイトル</p>
        <dd><input name='title' id='title' style='width: 500px; height: 25px;' type='text'/></dd>
        <p class="t2">主演俳優</p>
        <dd><input name='Name' id='Name' style='width: 500px; height: 25px;' type='text'/></dd>
        <p class="t2">監督</p>
        <dd><input name='Director' id='Director' style='width: 500px; height: 25px;' type='text'/></dd>
        <p class="t2">ジャンル</p>
        <dd><input name='genre' id='genre' style='width: 500px; height: 25px;' type='text'/></dd>
        <p class="t2">評価</p>
        <dd>
          <input name='evaluation' type='radio' value='なし' checked><label>未選択</label>
          <input name='evaluation' type='radio' value='最高'><label>最高</label>
          <input name='evaluation' type='radio' value='おもしろい'><label>おもしろい</label>
          <input name='evaluation' type='radio' value='普通'><label>普通</label>
          <input name='evaluation' type='radio' value='つまらない'><label>つまらない</label>
          <input name='evaluation' type='radio' value='二度と見ない'><label>二度と見ない</label>
        </dd>
        <p class="t2" >見た日付</p><dd><input name='Date' id='Date' type='date'/></dd>
        <p class="t2">何で観たか</p>
        <dd>
            <input name='movietype' type='radio' value='Amazon Prime'>Amazon Prime</input>
            <input name='movietype' type='radio' value='Netfilx'>Netflix</input>
            <input name='movietype' type='radio' value='Hulu'>Hulu</input>
            <input name='movietype' type='radio' value='Disney+'>Disney+</input>
            <input name='movietype' type='radio' value='U-NEXT'>U-NEXT</input>
        </dd>
      </dl>
      <p>感想</p>
      <textArea name="naiyou" rows="4" cols="40"></textArea><br>

    </form>
  </div>

  <input id='favBtn' type='submit' value='登録'/>
  <input id='clearBtn' type='reset' value='条件をクリア'/>



</div>
</form>

</body>

<!-- Main[End] -->
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
fetch('https://api.themoviedb.org/3/movie/now_playing?api_key=<>&language=en-US&page=1')
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

 

</script>

</html>