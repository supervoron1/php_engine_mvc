<? if (is_admin()): ?>
    <h2>Оформленные заказы</h2>

    <table border="1" cellpadding="4" cellspacing="1">
        <tr style="background-color:#d3edf6; text-align: center">
            <td width="5%">Номер</td>
            <td width="20%">Логин</td>
            <td width="25%">Телефон</td>
            <td width="50%">Адрес</td>
        </tr>
	    <? foreach ($orders as $order): ?>
        <tr style="text-align: start">
	        <td width="5%" align="center">
		        <a href="/order/<?= $order['id'] ?>" id="<?= $order['id'] ?>"><?= $order['id'] ?> ...</a></td>
	        <td width="20%"><?= $order['login'] ?></td>
            <td width="25%"><?= $order['tel'] ?></td>
            <td width="50%"><?= $order['address'] ?></td>
        </tr>
	    <? endforeach; ?>
    </table>

<? else: ?>
    Restricted area. Authorized personnel only
<? endif; ?>
