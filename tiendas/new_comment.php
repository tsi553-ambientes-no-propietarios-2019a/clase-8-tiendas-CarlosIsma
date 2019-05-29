<?php 
if($_GET) {
	if(isset($_GET['error_message'])) {
		$error_message = $_GET['error_message'];
	}
}

$id_store = $_GET['id_store'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Comentarios</title>
</head>
<body>
	<h1>Nuevo comentario</h1>

<?php if(isset($error_message)) { ?>
	<div><strong><?php echo $error_message; ?></strong></div>
<?php } ?>
	<form action="php/process_newComment.php" method="post">
		<div>
			<!--label>Id tienda</label-->
			<input type="hidden" name="id_store" value="<?php echo $id_store; ?>" required="required" readonly="readonly">
			<label>Comentario</label>
			<input type="text" name="comment" required="required">
		</div>
		<div>
			<button>Agregar</button>
		</div>
	</form>
</body>
</html>