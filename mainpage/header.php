<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vintage Thrift Shop</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Grenze+Gotisch:wght@800&display=swap" rel="stylesheet">

<style>

h1 {
    font-family: 'Grenze Gotisch', cursive;
    color: #ffff;
}
label {
    color: #ffff !important;
}
html,body{ 
	width:100%;
	height:100%;
	background:#2c3e50;
}

html{
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}


/* canvas{
  display:block;
  vertical-align:bottom;
} */


/* ---- stats.js ---- */

.count-particles{
  background: #000022;
  position: absolute;
  top: 48px;
  left: 0;
  width: 80px;
  color: #13E8E9;
  font-size: .8em;
  text-align: left;
  text-indent: 4px;
  line-height: 14px;
  padding-bottom: 2px;
  font-family: Helvetica, Arial, sans-serif;
  font-weight: bold;
}

.js-count-particles{
  font-size: 1.1em;
}

#stats,
.count-particles{
  -webkit-user-select: none;
  margin-top: 5px;
  margin-left: 5px;
}

.count-particles{
  border-radius: 0 0 3px 3px;
}


/* ---- particles.js container ---- */

#particles-js{
  width: 100%;
  height: 100%;
  background-color: #2c3e50;
  background-image: url('');
  background-size: cover;
  background-position: 50% 50%;
  background-repeat: no-repeat;
}

</style>

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link " href="vintage-shop.php">
          Shop
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact Us</a>
      </li>
    </ul>
    <div>
     <?php if(!isset($_SESSION['id'])): ?>  
    <a href="login.php" class="text-decoration-none btn btn-secondary">Sign in</a>
    <a href="signup.php" class="text-decoration-none btn btn-info">Sign up</a>
<?php else: ?>
    <a href="vintage-shop.php?logout=1">Logout</a>
    <?php endif ?>
    </div>
  </div>
</nav>