<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Pinacotheca</title>
    <link href="/themes/pinacotheca/css/bootstrap-grid.css" rel="stylesheet" type="text/css">
    <link href="/themes/pinacotheca/css/lightbox.min.css" rel="stylesheet" type="text/css">
    <link href="/themes/pinacotheca/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        <div class="container">
            <div class="row header-block">
                <div class="col-md-6">
                    <h1 id="site-name"><a href="/">Pinacotheca</a></h1>
                </div>
                <div class="col-md-6">
                    <div class="user-bar">
                    {if !empty($user)}
                        <span class="user-bar-item">{$user.nickname}</span>
                        <span class="user-bar-item"><a href="/load_picture/">Загрузка изображения</a></span>
                        <span class="user-bar-item"><a href="/logout/">Выход</a></span>
                    {else}
                        <span class="user-bar-item"><a href="/login/">Вход</a></span>
                        <span class="user-bar-item"><a href="/registration/">Регистрация</a></span>
                    {/if}
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="page">
        <div class="container">{block name="page"}{/block}</div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 flash-message"></div>
            </div>
        </div>
    </div>
    <footer>Something experimental</footer>
    <script src="/themes/pinacotheca/js/jquery-3.4.1.min.js"></script>
    <script src="/themes/pinacotheca/js/lightbox.min.js"></script>
    <script src="/themes/pinacotheca/js/custom.js"></script>
</body>
</html>