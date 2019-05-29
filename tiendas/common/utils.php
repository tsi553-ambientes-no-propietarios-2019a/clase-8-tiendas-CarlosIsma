<?php 
session_start();


$conn = new mysqli('localhost', 'root', '', 'tiendas');

if($conn->connect_error) {
	echo 'Existió un error en la conexión ' . $conn->connect_error;
	exit;
}

function redirect($url) {
	header('Location: ' . $url);
	exit;
}

function getProducts($conn) {
	$user_id = $_SESSION['user']['id'];
	$sql = "SELECT *
		FROM product
		WHERE user='$user_id'";

		$res = $conn->query($sql);

		if ($conn->error) {
			redirect('../home.php?error_message=Ocurrió un error: ' . $conn->error);
		}

		$products = [];
		if($res->num_rows > 0) {
			while ($row = $res->fetch_assoc()) {
				$products[] = $row;
			}
		}

		return $products;
}

function getTiendas($conn) {
	$tienda = $_SESSION['user']['store'];
	$sql = "SELECT store, id
		FROM user
		WHERE store not in ('$tienda')";

		$res = $conn->query($sql);

		if ($conn->error) {
			redirect('../home.php?error_message=Ocurrió un error: ' . $conn->error);
		}

		$stores = [];
		if($res->num_rows > 0) {
			while ($row = $res->fetch_assoc()) {
				$stores[] = $row;
			}
		}

		return $stores;
}

function getProductsStore($conn, $user_id) {

	$sql = "SELECT *
		FROM product p INNER JOIN user u ON u.id = p.user
		WHERE user='$user_id'";

		$res = $conn->query($sql);

		if ($conn->error) {
			redirect('../home.php?error_message=Ocurrió un error: ' . $conn->error);
		}

		$products = [];
		if($res->num_rows > 0) {
			while ($row = $res->fetch_assoc()) {
				$products[] = $row;
			}
		}

		return $products;
}

function getComment($conn, $user_id) {

	$sql = "SELECT c.comment, u1.username, u2.store
		FROM comment c 
		INNER JOIN user u1 ON c.user = u1.id
		INNER JOIN user u2 ON c.id_store = u2.id 
		WHERE id_store='$user_id'";

		$res = $conn->query($sql);

		if ($conn->error) {
			redirect('../home.php?error_message=Ocurrió un error: ' . $conn->error);
		}

		$comment = [];
		if($res->num_rows > 0) {
			while ($row = $res->fetch_assoc()) {
				$comment[] = $row;
			}
		}

		return $comment;
}



if ($_SERVER['SCRIPT_NAME'] != '/tiendas/index.php' && $_SERVER['SCRIPT_NAME'] != '/tiendas/php/process_login.php' && $_SERVER['SCRIPT_NAME'] != '/tiendas/php/process_registration.php' && !isset($_SESSION['user'])) {
	redirect($_SERVER["HTTP_HOST"] . 'tiendas/index.php');
} elseif( $_SERVER['SCRIPT_NAME'] == '/tiendas/index.php' && isset($_SESSION['user']) ) {

	redirect($_SERVER["HTTP_HOST"] . 'tiendas/home.php');
}

