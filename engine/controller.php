<?php

//Файл с функциями нашего движка

/*
 * Функция подготовки переменных для передачи их в шаблон
 */
function prepareVariables($page, $action, $id)
{
//Для каждой страницы готовим массив со своим набором переменных
//для подстановки их в соотвествующий шаблон
	$params = [];


	if (is_auth()) {
		$params['auth'] = true;
		$params['user'] = get_user();
		$params['tel'] = get_info($_SESSION['id']);
	}

	$params['count'] = getBasketCount();

	switch ($page) {
		case 'login':
			$login = $_POST['login'];
			$pass = $_POST['pass'];

			if (!auth($login, $pass)) {
				Die('Не верный логин пароль');
			} else {
				if (isset($_POST['save'])) {
					makeHashAuth();
					header("Location: /");
				}
			}
			header("Location: /");

			break;

		case 'logout':
			session_destroy();
			session_start();
			session_regenerate_id();
			setcookie("hash");
			header("Location: /");
			break;

		case 'news':
			$params["news"] = getNews();
			break;

		case 'newspage':
			if ($action == "addlike") {
				echo json_encode(["result" => 1]);
			}
			$content = getNewsContent($id);
			$params['prev'] = $content['prev'];
			$params['text'] = $content['text'];
			break;

		case 'feedback':
			doFeedbackAction($params, $action, $id);
			$params['feedback'] = getAllFeedback();
			break;

		case 'catalog':
			$params['goods'] = getAllGoods();
			break;

		//case 'item':
		//  $params['good'] = getOneGood($id);
		// break;

		case 'api':
			if ($action == "buy") {
				$data = json_decode(file_get_contents('php://input'), true);
				$id = $data['id'];
				addToBasket($id);

				$params['count'] = getBasketCount();

				header("Content-type: application/json");
				echo json_encode($params);
				die();
			}

			if ($action == "deleteFromBasket") {
				$data = json_decode(file_get_contents('php://input'), true);
				$id = $data['id'];
				deleteFromBasket($id);

				$params['count'] = getBasketCount();
				$params['summ'] = summFromBasket();
				$params['id'] = $id;

				header("Content-type: application/json");
				echo json_encode($params);
				die();
			}

			if ($action == "catalogItem") {
				$data = json_decode(file_get_contents('php://input'), true);
				$id = $data['idImg'];
				$oneGood = getOneGood($id);
				$response['desc'] = $oneGood['description'];
				$response['imgAddr'] = $oneGood['image'];
				$response['price'] = $oneGood['price'];
				echo json_encode($response, JSON_UNESCAPED_UNICODE);
				die();
			}

			if ($action == "add_user") {
				$data = json_decode(file_get_contents('php://input'), true);

				$login = $data['login'];
				$pass = $data['password'];
				if ($login == '') {
					unset($login);
				}
				if ($pass == '') {
					unset($pass);
				}

				if (empty($login) || empty($pass)) {
					exit('Имя и пароль обязательные поля!');
				}

				$email = $data['email'];
				$tel = $data['tel'];

				$login = trim(htmlspecialchars(strip_tags(stripslashes($login))));
				$pass = trim(htmlspecialchars(strip_tags(stripslashes($pass))));
				$email = trim(htmlspecialchars(strip_tags(stripslashes($email))));
				$tel = trim(htmlspecialchars(strip_tags(stripslashes($tel))));

				$pass = password_hash($pass, PASSWORD_DEFAULT);

				$response = addUser($login, $pass, $tel, $email);

				echo json_encode($response, JSON_UNESCAPED_UNICODE);
				die();
			}

			if ($action == "order") {
				$data = json_decode(file_get_contents('php://input'), true);

				$login = $data['login'];
				$tel = $data['tel'];
				$addr = $data['addres'];

				if ($login == '') {
					unset($login);
				}
				if ($tel == '') {
					unset($tel);
				}
				if ($addr == '') {
					unset($addr);
				}

				if (empty($login) || empty($tel) || empty($addr)) {
					exit("Заполните все поля формы");
				}

				$login = trim(htmlspecialchars(strip_tags(stripslashes($login))));
				$tel = trim(htmlspecialchars(strip_tags(stripslashes($tel))));
				$addr = trim(htmlspecialchars(strip_tags(stripslashes($addr))));

				$response = addOrder($login, $tel, $addr);

				echo json_encode($response, JSON_UNESCAPED_UNICODE);
				die();
			}

			break;

		case "basket":
			$params['basket'] = getBasket();
			$params['summ'] = summFromBasket();
			break;

		case "orders":
			$params['orders'] = getAllOrders();
			break;

		case "order":
			$params['order'] = getOrder($id);
			$params['summ'] = orderTotalSum($id);
			break;
	}

	return $params;
}





