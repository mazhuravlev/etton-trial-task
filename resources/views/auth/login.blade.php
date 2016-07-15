<form method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <div>
        Email
        <input type="text" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Пароль
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Запомнить меня
    </div>

    <div>
        <button type="submit">Войти</button>
    </div>
</form>