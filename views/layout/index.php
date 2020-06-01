<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title><?=$Title?></title>
</head>
<body>
<ul style="display: flex;  list-style: none;   ">
    <li style="    padding: 15px;  "><a href="/site/index">Головна сторінка </a></li>
    <li style="    padding: 15px;  "><a href="/About_me/index">Про нас </a></li>
    <li style="    padding: 15px;  "><a href="/Corustuvachi/index">Користувачі </a></li>
    <li style="    padding: 15px;  "><a href="/news/index">Новини </a></li>

</ul>
<?php
echo $Content;
echo $info;
//foreach($model as $item):
?><br/>


<?PHP //endforeach;?>
</body>
</html>
