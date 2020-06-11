<?php 
	session_start();

	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";
    $_SESSION['id'] = "";

	// connect to database
	$db = mysqli_connect("10.169.0.177","whatmovi_mattr","Password1","whatmovi_project");

    if(!$db) {
        die("Connection Timeout: ".mysqli_connect_error());
    }

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
        
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
        $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }
		if ($password_1 != $password_2) { array_push($errors, "The two passwords do not match"); }
        $checkEmail = $db->query("SELECT id FROM users WHERE email = '".$email."'");
        if($checkEmail->num_rows != 0) { array_push($errors, "That Email is currently in use. Please try a different email."); }
        
        
		// register user if there are no errors in the form
		if (count($errors) == 0) {
            $password = password_hash($password_1, PASSWORD_BCRYPT);
            
            $today = getdate();
            $register_date = $today["year"].'-'.$today["mon"].'-'.$today["mday"];
            
			$query = "INSERT INTO users (username, firstname, lastname, email, password, date_registered, last_login) 
					  VALUES('$username', '$firstname', '$lastname', '$email', '$password', '$register_date', '$register_date')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {            
            $sql = $db->query("SELECT id, password FROM users WHERE username='$username'");
            if($sql->num_rows > 0){
                $data = $sql->fetch_array();
                if (password_verify($password, $data['password'])){
                    
                    $today = getdate();
                    $last_login = $today["year"].'-'.$today["mon"].'-'.$today["mday"];
                    
                    $query = "UPDATE users SET last_login='".$last_login."' WHERE id=".$data["id"].";";
			         mysqli_query($db, $query);                    
                    
                    $_SESSION['id'] = $data["id"];
                    $_SESSION['username'] = $username;
                    $_SESSION['success'] = "You are now logged in";
                    header('location: index.php');
                } else {
                    array_push($errors, "Wrong username/password combination.");
                }
            }
			//$password = md5($password);
			//$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			//$results = mysqli_query($db, $query);

			//if (mysqli_num_rows($results) >= 1) {
                //$_SESSION['id'] = $results->fetch_assoc()["id"];
				//$_SESSION['username'] = $username;
				//$_SESSION['success'] = "You are now logged in";
				//header('location: index.php');
			//}else {
				//array_push($errors, "Wrong username/password combination");
		}
	}

?>