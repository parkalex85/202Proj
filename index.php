<?php

	session_start();
	require_once 'db_conn.php';

	$salt = "1973qpzm";
	$conn = getConnection();

	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['pass'] . $salt;

		$conn = getConnection();

		$sql = "SELECT * from users
			WHERE username = '$username' AND
			password = '$password'";		

		$stmt = $conn->prepare($sql);	
		try{
			$stmt->execute();
		} catch (Exception $e){
			echo $e;
		}
	
		$results = $stmt -> fetchAll();
		
		if(!empty($results)){
			foreach($results as $result){
				if($result['username'] == $username
				&& $result['password'] == $password){
					$_SESSION['user'] = $username;
					$_SESSION['id'] = $result['id'];
					header("Location: homepage.php");
				}
			}
		}

		echo "Incorrect password";
	} else if(isset($_POST['guest'])){
		$_SESSION['user'] = 'Guest';
		$_SESSION['id'] = -1;
		header("Location: homepage.php");
	}

?>

<html>
	<head>
		<title></title>
	</head>

	<body>

		<h1>Login</h1>

		<form method="post" name="login">
			Username: <input type="text" name="username"><br>
			Password: <input type="text" name="pass"><br>
			<input type="submit" name="login"></br></br>
		

		<a href ="register.php">Register</a><br/>
		<input type='submit' name='guest' value='Continue As Guest'>
		</form>
	</body>


</html>
