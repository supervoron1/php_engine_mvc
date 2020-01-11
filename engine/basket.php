<?php
function deleteFromBasket($id)
{
	$id = (int)$id;
	$session_id = session_id();
	$sql = "DELETE FROM `basket` WHERE `basket`.`id` = {$id} AND `session_id`='$session_id'";
	return executeQuery($sql);
}

function summFromBasket()
{
	$session_id = session_id();
	$sql = "SELECT SUM(catalog.price) as summ FROM `basket`, `catalog` WHERE basket.goods_id=catalog.id AND `session_id` ='$session_id'";
	return getAssocResult($sql)[0]['summ'];
}

function getBasket()
{
	$session_id = session_id();
	$sql = "SELECT basket.id as basket_id, catalog.id as goods_id, catalog.name as name, catalog.price as price, catalog.image as image FROM `basket`, `catalog` WHERE basket.goods_id=catalog.id AND `session_id`='{$session_id}'";
	$basket = getAssocResult($sql);
	return $basket;
}

function getBasketCount()
{
	$session_id = session_id();
	$sql = "SELECT COUNT(*) as count FROM `basket` WHERE `session_id`='$session_id'";
	$result = getAssocResult($sql);
	$count = [];
	if (isset($result[0]))
		$count = $result[0];
	return $count['count'];
}

function addToBasket($id)
{
	$id = (int)$id;
	$session_id = session_id();
	$sql = "INSERT INTO `basket` (`session_id`, `goods_id`) VALUES ('{$session_id}', '{$id}');";
	return executeQuery($sql);
}
