<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Тестовый магазин</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Тестовый магазин</h1>
    <div class="well">
        @if (count($errors))
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ print_r($error, true) }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="/auth/login">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="login">Логин</label>
                <input id="login" class="form-control" type="text" name="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input id="password" class="form-control" type="password" name="password">
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox" name="remember"> Запомнить меня
                </label>
            </div>
            <div class="form-group">
                <button class="btn btn-default" type="submit">Войти</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>