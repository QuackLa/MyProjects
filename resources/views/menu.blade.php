<div class="menu">

    <div class="menuContainer">
        <a href="{{ route('home') }}"> Главная </a>
        <a href="{{ route('myAdmin') }}"> Администрирование </a>
        <a href="{{ route('howToPay') }}"> Как оплатить? </a>
        <a href="{{ route('contacts') }}"> Контакты </a>
        <a href="{{ route('changeCounter') }}"> Замена счётчика </a>
        <a href="{{ route('account') }}"> Настройки аккаунта </a>
        <a href="{{ route('logout') }}"> Выйти </a>
    </div>

    <div class="blockLang">
        <form method="POST" action=" {{ route('changeLanguage') }} " id="form"> 
        @csrf
            <div class="lang"> Выбран: </div>
            @if( App::getLocale() == "en" )
                <button name="language" class="languageButton" value="ru"> EN </button>
            @endif
            @if( App::getLocale() == "ru" )
                <button name="language" class="languageButton" value="en"> RU </button>
            @endif
        </form>
    </div>

</div>