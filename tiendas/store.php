<?php 
include('common/utils.php');
//print_r($_SESSION['user']);

$user_id = $_GET['id_store'];
$products = getProductsStore($conn, $user_id);
$comments = getComment($conn, $user_id);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Productos por tienda</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

	<h2>Tienda: <?php echo $products[0]['user'].' '.$products[0]['store']; ?></h2>

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

	<a href="new_comment.php?id_store=<?php echo $user_id;?>">Agregar comentarios</a>
	</br>
	<a href="home.php">Regresar</a>


</body>
</html>