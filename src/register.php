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
        <form class="form-signin" method="post" action="register.php">
            
            <?php include('errors.php'); ?>
            <h2 class="header">Register</h2>
            
            <input style="margin-bottom: 30px;" type="text" class="form-control topcurve bottomcurve" name="username" placeholder="Username" required="" autofocus="" value="<?php echo $username; ?>" />
            
            <div style="margin-bottom: 30px;" class="container">
                <div class="row">
                    <div class="col-sm">
                        <input type="text" class="form-control topcurve bottomcurve" name="firstname" placeholder="First Name" required="" autofocus="" value="<?php echo $username; ?>" />
                    </div>
                    <div class="col-sm">
                        <input type="text" class="form-control topcurve bottomcurve" name="lastname" placeholder="Second Name" required="" autofocus="" value="<?php echo $username; ?>" />
                    </div>
                </div>
            </div>
            
            <input style="margin-bottom: 30px;" type="email" class="form-control topcurve bottomcurve" name="email" placeholder="Email" required="" value="<?php echo $email; ?>" />
            <input type="password" class="form-control topcurve" name="password_1" placeholder="Password" required="" autofocus="" />
            <input style="margin-bottom: 30px;" type="password" class="form-control bottomcurve" name="password_2" placeholder="Confirm Password" required="" />
            
            <label class="checkbox">
                <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
            </label>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="reg_user">Register</button>
            <a href="https://www.whatmovie.tk/login.php"><p style="text-align: center;">Already gotta' account?</p></a>
        </form>
    </div>
</body>

</html>