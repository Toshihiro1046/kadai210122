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

   
