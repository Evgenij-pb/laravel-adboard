<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Продавайк@ - Объявления Каменского</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <link rel="stylesheet" href="{{url('/storage/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<header class="header">
    <div class="header-container">
        <div class="title">
            <a href="/">
                <img src="{{url('/storage/img/sticky-note.png')}}" height="35" alt="">
                Продавайк@
            </a>
        </div>
        <div class="header-btn">
            <div class="profile">
                <img src="{{url('/storage/img/user.png')}}" height="30" alt="">
                {{Auth::user()->name ?? 'Мой профиль'}}
                <i class="fa fa-angle-down" aria-hidden="true"></i>

                @if (Auth::guest())
                    <ul class="profile-submenu">
                        <li><a href="{{ url('/login') }}">Вход</a></li>
                        <li><a href="{{ url('/register') }}">Регистрация</a></li>
                    </ul>
                @else
                    <ul class="profile-submenu">
                        <li><a href="{{ route('myaccount.ad.index') }}">Ваши объявления</a></li>
                        <li><a href="{{ route('myaccount.ad.index') }}">Избранные</a></li>
                        <li><a href="{{ url('/logout') }}">Выйти</a></li>
                    </ul>
                @endif

            </div>
            <div class="create-btn">
                <a href="{{ route('myaccount.ad.create') }}">
                    Подать объявление
                </a>
            </div>
        </div>
    </div>
</header>

<main>

    @yield('content')

</main>

<footer class="footer">
    <div>
        <div class="footer-conteiner">
            <div>
                <ul>
                    <li>
                        <a href="">Помощь</a>
                    </li>
                    <li>
                        <a href="">Обратная связь</a>
                    </li>
                </ul>
            </div>
            <div>
                <ul>
                    <li>
                        <a href="">Политика конфиденциальности</a>
                    </li>
                    <li>
                        <a href="">Реклама</a>
                    </li>
                </ul>
            </div>
            <div class="app-icon-box">
                <div>
                    <img class="app-icon" src="{{url('/storage/img/andplay.png')}}" height="36" alt="">
                </div>
                <div>
                    <img class="app-icon" src="{{url('/storage/img/appstore.png')}}" height="36" alt="">
                </div>
            </div>
        </div>

        <div class="footer-botom">
            Evgenij Frolov 2022 ©
        </div>

    </div>
</footer>

</body>
</html>
