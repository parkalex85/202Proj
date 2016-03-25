<?php

	require_once 'db_conn.php';

	$salt = "1973qpzm";

	if(isset($_POST['reg'])){

		$username = $_POST['un'];
		$password = $_POST['password'] . $salt;

		$conn = getConnection();

		$sql = "INSERT into users (username, password)
			VALUES ('$username', '$password')";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
		header("Location: index.php");
	}

?>

<html>
<head>
</head>
<body>
<h1>Register</h1>
<form method='post' name='reg'>
	Username: <input type='text' name='un'></br>
	Password: <input type='text' name='password'></br>
	<input type='submit' name='reg'>
</form>
</body>
</html>
