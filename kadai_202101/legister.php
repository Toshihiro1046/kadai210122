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
    </style>
</head>
<body>
<form method="POST" action="insert.php">
        <div class="jumbotron">
            <fieldset>
                <legend>新規登録</legend>
                <label>名前：<input type="text" name="name"></label><br>
                <label>email：<input type="text" name="email"></label><br>
                <label>id：<input type="text" name="lid"></label><br>
                <label>passward：<input type="text" name="lpw"></label><br>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
</body>
</html>