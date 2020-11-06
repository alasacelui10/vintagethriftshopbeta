<?php include '../config/connection.php'; 

// select query for all the products 


$queryshow = "SELECT * from hats";

// execute the query

$results = mysqli_query($conn, $queryshow);

$hats = mysqli_fetch_all($results, MYSQLI_ASSOC);

mysqli_free_result($results);

if(isset($_GET['logout'])) {
    session_destroy();
    session_unset();
 
    header("location:login.php");
    exit();
}

if(!isset($_SESSION['id'])) {
    header("location:index.php");
  
}
?>
<?php include 'header.php' ?>

<br>
<div class="container ">
    <?php if(isset($_SESSION['message'])): ?>
    <div class="<?php echo $_SESSION['msg_type']; ?>">
    <h4 class="text-center p-5">
        <?= $_SESSION['message']; ?>
        <?php unset($_SESSION['msg_type'])?>
        <?php unset($_SESSION['message'])?>
    </h4>
    <?php endif ?>
   </div>
<h1 class="text-center"><a href="index.php" class="text-decoration-none">Vintage Thrift Shop </a></h1><br>
<center >
<?php foreach($hats as $hat): ?>
    <div class="col-md">
    <img src="../uploads<?= '/'.$hat['img'] ?>" class="img-thumbnail " width="300" alt="image"> </div><br>
   
    <a href="" class="btn btn-primary text-decoration-none  mb-5">View More</a>
<?php endforeach ?>
   </div>
</center>

<?php include 'footer.php'?>