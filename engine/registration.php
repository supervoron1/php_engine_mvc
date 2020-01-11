<?php

function addUser($login, $pass, $tel, $email)
{
	$db = getDb();
	$hash = '';
	$sql = "INSERT INTO `users`(`login`, `pass`, `hash`, `tel`, `email`) VALUES ('{$login}','{$pass}', '{$hash}','{$tel}','{$email}')";
	$result = mysqli_query($db, $sql);

	if ($result == 'TRUE') {
		return 'Вы успешно зарегистрированы';
	} else {
		return "Ошибка! Вы не зарегистрированы";
	}
}
