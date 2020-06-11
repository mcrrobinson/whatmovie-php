<!DOCTYPE html>
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
                    <li class="nav-item active">
                        <a class="nav-link" href="browse.php">Browse Movies<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <div class="btn-group">
                        <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account <i class="fa fa-user"></i></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="options.php" class="dropdown-item" style="color:black;">Options</a>
                            <button class="dropdown-item" type="button">Log Out</button>
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
    <div id="outPopUp">
        <h1 style="font-family: 'Copse', serif;">Browse For Movies</h1>
        <div class="splitter-s"></div>
        <form id="demo-2" action="/search.php" method="get">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <select class="btn btn-outline-dark" name="channel" type="button" required>
                        <div class="dropdown-menu">
                            <option href="#">Movie</option>
                            <option href="#">TV Series</option>
                        </div>
                    </select>
                </div>
                <input type="search" name="search" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" value="Submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="footer" style="position: absolute">
        <div class="container">
            <div class="row">
                <div class="col-8 col-md-6" style="text-align: left;">
                    <h5>WhatMovie.tk</h5>
                </div>
                <div class="col-2 col-md-3" style="text-align: right;">Contact</div>
                <div class="col-2 col-md-3" style="text-align: right;">Created By Matt Robinson</div>
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