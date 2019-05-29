<?php 
include('../common/utils.php');

if($_POST) {
	if (isset($_POST['comment'])  && isset($_POST['id_store']) && !empty($_POST['comment']) && !empty($_POST['id_store'])) {
		
		$comment = $_POST['comment'];
		$id_store = $_POST['id_store'];
		$user_id = $_SESSION['user']['id'];

		$sql_insert = "INSERT INTO comment
		(comment, user, id_store)
		VALUES ('$comment','$user_id', '$id_store')";

		echo $sql_insert;
		$conn->query($sql_insert);

		if ($conn->error) {
			echo 'Ocurrió un error ' . $conn->error;
		} else {
			redirect('../store.php?id_store='.$_POST['id_store']);
		}
	} else {
		redirect('../new_comment.php?error_message=Ingrese todos los datos!&id_store='.$_POST['id_store']);
	}
} else {
	redirect('../new_comment.php?id_store='.$_POST['id_store']);
}