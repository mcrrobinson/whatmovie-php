<?php 

session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

//Key used in API maybe make a include document later?
$apikey = "1025f3429a7803a6570aa7e8ebee1ae8";


$db = mysqli_connect("10.169.0.177","whatmovi_mattr","Password1","whatmovi_project");
$sql = $db->query("SELECT * FROM `users` WHERE id = '".$_SESSION['id']."';");
$data = $sql->fetch_array();

$errors = array();

if (isset($_POST['submit'])) {
        $newemail = mysqli_real_escape_string($db, $_POST['newemail']); //New Email
        $confirmemail = mysqli_real_escape_string($db, $_POST['confirmemail']);
    
        $newpassword = mysqli_real_escape_string($db, $_POST['newpassword']); //New Password
        $confirmpassword = mysqli_real_escape_string($db, $_POST['confirmpassword']);
    
		$password = mysqli_real_escape_string($db, $_POST['password']); //OG Password
    
        if(!empty($_POST["firstname"])){
            mysqli_query($db, "UPDATE users SET firstname='".$_POST["firstname"]."' WHERE id='".$_SESSION['id']."';"); 
        }
        if(!empty($_POST["lastname"])){
            mysqli_query($db, "UPDATE users SET lastname='".$_POST["lastname"]."' WHERE id=".$_SESSION['id'].";"); 
        }
    
        if(!empty($_POST["newemail"])){ 
            if(!empty($_POST["confirmemail"])){
                if($_POST["newemail"] == $_POST["confirmemail"]){
                    $sql = $db->query("SELECT password FROM users WHERE id='".$_SESSION["id"]."'");
                    $data = $sql->fetch_array();
                    if (password_verify($password, $data['password'])){
                        $updatepassword = password_hash($newpassword, PASSWORD_BCRYPT);
                        mysqli_query($db, "UPDATE users SET password='".$updatepassword."' WHERE id=".$_SESSION['id'].";"); 
                        echo "Email Updated.";
                        
                    } else { array_push($errors, "Please enter the correct password to confirm."); }
                } else { array_push($errors, "The emails aren't the same!"); }
            } else { array_push($errors, "You need to confirm your email."); }
        }
    
        if(!empty($_POST["newpassword"])){ 
            if(!empty($_POST["confirmpassword"])){
                if($_POST['newpassword'] == $_POST['confirmpassword']){
                    
                    $sql = $db->query("SELECT password FROM users WHERE id='".$_SESSION["id"]."'");
                    $data = $sql->fetch_array();
                    if (password_verify($password, $data['password'])){
                        $updatepassword = password_hash($newpassword, PASSWORD_BCRYPT);
                        mysqli_query($db, "UPDATE users SET password='".$updatepassword."' WHERE id=".$_SESSION['id'].";"); 
                        echo "Password Updated.";
                        
                    } else { array_push($errors, "Please enter the correct password to confirm."); }
                } else { array_push($errors, "The passwords aren't the same!"); }
            } else { array_push($errors, "You need to confirm your new password."); }
        }
	}
?>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Copse" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<body>
    <div class="particles-body">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">WhatMovie</a>
            <button id="collapse" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ranks.php">Ranks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="browse.php">Browse Movies</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <div class="btn-group">
                        <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account <i class="fa fa-user"></i></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="options.php" class="dropdown-item" style="color:black;">Options</a>
                            <button class="dropdown-item" type="button"><a href="index.php?logout='1'" style="color: red;">Logout</a></button>
                        </div>
                    </div>
                </span>
            </div>
        </nav>
        <div id="particles-js"></div>
        <div class="ms">
            <div id="titleMs" class="hidden">
                <h1 class="titleHeader">WhatMovie</h1>
                <p>By Matt Robinson</p>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div>
            <header class="page-title" style="margin-bottom: 3%;">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <h1 class="my-0">Profile</h1>
                    </div>
                </div>
            </header>
            <div class="row">
                <div class="col-sm-4">
                    <div class="model">
                        <div class="card-body">
                            <img src="https://www.gravatar.com/avatar/84aa6416ca5647f70aa7d50253bf8b71?d=mm&amp;s=128" alt="User profile picture">
                            <p class="text-muted mb-0">
                                <? echo $data["email"];?>
                            </p>
                        </div>
                    </div>

                    <div class="splitter-s"></div>

                    <div class="model">
                        <div class="card-body">
                            <h3 class="today-value">
                                <? echo $data["date_registered"]; ?>
                            </h3>
                            <span>Date Registered</span>
                        </div>
                    </div>

                    <div class="splitter-s"></div>

                    <div class="model">
                        <div class="card-body">
                            <h3 class="today-value">
                                <? echo $data["last_login"]; ?>
                            </h3>
                            <span>Last Login</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="model">
                        <div class="card-header">
                            Your Details
                        </div>
                        <form method="POST" action="options.php">
                            <input type="hidden">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="firstname" value="" placeholder="<? echo $data["firstname"]; ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="lastname" value="" placeholder="<? echo $data["lastname"]; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>New Email Address</label>
                                            <input type="text" class="form-control" name="newemail" value="" placeholder="<? echo $data["email"]; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Confirm Email Address</label>
                                            <input type="text" class="form-control" name="confirmemail" value="" placeholder="<? echo $data["email"]; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" class="form-control" name="newpassword" placeholder="New Password.." aria-autocomplete="list">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Confirm New Password</label>
                                            <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm New Password..">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Confirm Current Password</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin: auto; width: 20%; padding: 10px; color: grey;">
                                    <? include('errors.php'); ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p><b>Note! Placeholders will change upon page reload/login.</b></p>
                                <button type="submit" name="submit" class="btn btn-dark">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="model">
                <div class="card-body row" style="padding: 2%;">
                    <div class="row">
                        <div class="col-12">
                            <h4>Delete Account</h4>
                            <p>If needed I can delete your account from the database and any information that lies with it. If this option is chosen you will be redirected to another page in which you can confirm with your password if desired.</p>
                            <button class="btn btn-dark">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Required -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <!-- Messages -->
    <script src="js/header/popupmsgDefault.js"></script>

    <script src='js/dependencies/jquery-3.3.1.min.js'></script>
    <script src='js/header/particles.min.js'></script>
    <script src="js/header/particlescfg.js"></script>
</body>

</html>