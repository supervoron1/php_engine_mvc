<? if (!$auth): ?>
    <form action="/login/" method="post">
        <input type='text' name='login' placeholder='Логин'>
        <input type='password' name='pass' placeholder='Пароль'>
        Save? <input type='checkbox' name='save'>
        <input type='submit' name='send' value="Войти">
    </form>
    <p>Еще не зарегистрированы? <a href="/registration/">Зарегистрироваться</a></p>
<? else: ?>
    Добро пожаловать, <?= $user ?> <a href='/logout/'>выход</a><br>
<? endif; ?>
    <br>
<div class="topmenu">
    <a class="menu-link" href="/">Главная</a>
    <a class="menu-link" href="/news/">Новости</a>
    <a class="menu-link" href="/catalog/">Каталог</a>
    <a class="menu-link" href="/feedback/">Отзывы</a>
    <a class="menu-link bask" href="/basket/">Корзина <span id="counter"><?= $count ?></span></a>

<? if (is_admin()): ?>
    <a class="menu-link" href="/orders/">Заказы</a>
<? endif; ?>
</div>
