<?php 
include('common/utils.php');
//print_r($_SESSION['user']);

$products = getProducts($conn);
$tiendas = getTiendas($conn);
$user_id = $_SESSION['user']['id'];
$comments = getComment($conn, $user_id);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Inicio</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<div><a href="php/logout.php">Cerrar sesión</a></div>

	<h1>Bienvenido <?php echo $_SESSION['user']['username']; ?></h1>
	<h2>Tienda: <?php echo $user_id.' '.$_SESSION['user']['store']; ?></h2>

	<a href="new_product.php">Añadir producto</a>

	<table>
		<thead>
			<tr>
				<th>Código</th>
				<th>Nombre</th>
				<th>Tipo</th>
				<th>Stock</th>
				<th>Precio</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($products as $p) { ?>
				<tr>
					<td><?php echo $p['code'] ?></td>
					<td><?php echo $p['name'] ?></td>
					<td><?php echo $p['type'] ?></td>
					<td><?php echo $p['stock'] ?></td>
					<td><?php echo $p['price'] ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

<h2>Tiendas disponibles: </h2>

<table>
		<thead>
			<tr>
				<th>Identificador tienda</th>
				<th>Nombre tienda</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($tiendas as $t) {?>
				<tr>
					<td><?php echo $t['id'] ?></td>
					<td><a href="store.php?id_store=<?php echo $t['id'];?>">
							<?php echo $t['store'] ?>
						</a>
					</td>
				</tr>
			<?php } ?>
</tbody>
	</table>

	<h2>Comentarios: </h2>

<table>
		<thead>
			<tr>
				<th>Tienda</th>
				<th>Usuario</th>
				<th>Comentario</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($comments as $c) {?>
				<tr>
					<td><?php echo $c['store'] ?></td>
					<td><?php echo $c['username'] ?></td>
					<td><?php echo $c['comment'] ?></td>
				</tr>
			<?php } ?>
</tbody>
	</table>

</body>
</html>