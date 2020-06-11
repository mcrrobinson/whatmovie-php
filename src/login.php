<?php include('server.php') ?>
<!DOCTYPE html>

<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <video autoplay muted loop id="myVideo">
        <source src="bg1/bg.mp4" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>
    <div class="wrapper">
        <form class="form-signin" method="post" action="login.php">
            
            <?php include('errors.php'); ?>
            <h2 class="header">Please login</h2>
            <input type="text" class="form-control topcurve" name="username" placeholder="Username" required="" autofocus="" />
            <input style="margin-bottom: 30px;" type="password" class="form-control bottomcurve" name="password" placeholder="Password" required="" />
            <label class="checkbox">
                <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
            </label>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="login_user">Login</button>
            <a href="https://www.whatmovie.tk/register.php"><p style="text-align: center;">Haven't got an account?</p></a>
        </form>
    </div>
</body>

</html>