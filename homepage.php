<?php
	session_start();
	require_once('db_conn.php');

	function get_projects(){
		$conn = getConnection();

		$id = $_SESSION['id'];

		$sql = "SELECT * from projects
			INNER JOIN users
			ON users.id = projects.o_id";

		$stmt = $conn->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	if(isset($_POST['change'])){

		$conn = getConnection();

		$descript = $_POST['text'];
		$p_id = $_POST['res_id'];

		$sql = "UPDATE projects
			SET description = '$descript'
			WHERE id = $p_id";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
	}

	if(isset($_POST['sub_change'])){
		$conn = getConnection();

		$p_name = $_POST['p_name'];
		$desc = $_POST['desc'];
		$o_id = $_SESSION['id'];

		$sql = "INSERT into projects
			(o_id, name, description)
			VALUES ($o_id, '$p_name', '$desc')";

		$stmt = $conn->prepare($sql);
		$stmt -> execute();

	}
?>

<html>
<head></head>
<body>
<h1>Welcome <?php echo $_SESSION['user']; ?></h1>
<h2>Projects</h2>
<table border='1'>
	<tr>
		<td><b>Owner</b></td><td><b>Name</b></td><td><b>Description</b></td><td></td>
	</tr>
	<?php
		$results = get_projects();

		foreach($results as $result){
			$result['id'];	
			echo '<form method="post"><tr>';
				echo '<td>' . $result['username'] . '</td>';
				echo '<td>';
					echo $result['name'];
				echo '</td>';
				echo '<td>';
					echo '<input type="text" name="text" value=\'';
					echo $result['description'] . '\'>';
				echo '</td>';
				if($_SESSION['id'] == $result['o_id']){
					echo "<input type='hidden' name='res_id' value='" . $result['id'] . "'>";
					echo "<td><input type='submit' name='change' value='Change'></td>";
				}
			echo '</tr></form>';
		}

	?>
</table>

<h3>Add A Project</h3>
<form name = 'sub_change' method='post'>
Project Name: <input type='text' name='p_name'></br>
Project Description: <input type='text' name='desc'></br>
<input type='submit' name='sub_change'>
</form>
</body>
</html>
