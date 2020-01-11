<?php
function addOrder($login, $tel, $addr)
{
	$db = getDb();
	$session_id = session_id();
	$sql = "INSERT INTO orders (session_id, login, tel, address) VALUES('$session_id','$login','$tel','$addr')";
	$result = mysqli_query($db, $sql);

	if ($result == 'TRUE') {
		return 'Ваш заказ оформлен';
	} else {
		return "Ошибка! Что-то пошло не так";
	}
}

function getAllOrders()
{
	$sql = "SELECT * FROM orders WHERE 1";
	$result = getAssocResult($sql);
	return $result;
}

function getOrder($id)
{
	$id = (int)$id;
	$sql = "SELECT * FROM basket, orders, catalog WHERE basket.session_id = orders.session_id AND catalog.id=basket.goods_id AND orders.id='$id'";
	$result = getAssocResult($sql);
	return $result;
}

function orderTotalSum($id)
{
	$sql = "SELECT SUM(catalog.price) as summ FROM basket, orders, catalog WHERE basket.session_id = orders.session_id AND catalog.id=basket.goods_id AND orders.id='$id'";
	$result = getAssocResult($sql)[0]['summ'];
	return $result;
}
