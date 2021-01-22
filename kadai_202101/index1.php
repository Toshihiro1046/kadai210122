<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    
  #app1{
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
  
  #app2 {
    display: flex;
    font-size: 15px;
  }
  
  @keyframes sliderAnimation {
    100% {
      transform: translatex(-50%);
    }
  }


    </style>
</head>

<body>
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="login.php">ログイン</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="legister.php">新規登録</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

  <div class='autoplay-slider1'>
  <h1>公開中の映画</h1>
  <div id="app1"></div>
  </div>

 <h1>オススメ</h1>
 <div class='autoplay-slider2'>
 <div id="app2"></div>
 </div>

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


// リスト一覧
fetch('https://api.themoviedb.org/3/movie/11/recommendations?api_key=<>&language=en-US&page=1')
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

</script>

</body>

</html>