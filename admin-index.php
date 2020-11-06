<?php include 'config/connection.php' ;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
    require 'vendor/autoload.php';

$hat['title']= "";
$hat['price']= "";
$hat['email']="";
$update = false;
// $id = 0;
//write query for show all
$queryshowall = "SELECT * FROM hats ";

// execute query for the show all

$result = mysqli_query($conn, $queryshowall);

//fetch the results 

$hats = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result
mysqli_free_result($result);

//close connection;

//mysqli_close($conn);

#---------------------------------------------------

$errors = array('title'=>'', 'price'=>'', 'email'=>'');
if(isset($_POST['submit'])) {
    
    $title = htmlentities($_POST['title']);
    $price = htmlentities($_POST['price']);
    $email = htmlentities($_POST['email']);
  


    if(empty($_POST['title'])) {
        $errors['title'] = 'title field is required';
    }else {
        if(!preg_match('/^[a-zA-Z\s]+$/',$title)) {
            $errors['title'] = 'Title must contain letter and spaces only !';
        }
    }
    if(empty($_POST['price'])) {
        $errors['price']= 'price field is required';
    }else {
        if(!preg_match('^[0-9]*[1-9][0-9]*$^', $price)) {
            $errors['price'] = 'Price must be an integer';
        }
    }
    if(empty($_POST['email'])) {
        $errors['email'] = "Email field is required";
    }
    

    if(array_filter($errors)) {

    }else {
        
        $title = mysqli_real_escape_string($conn,$_POST['title']);
        $price = mysqli_real_escape_string($conn,$_POST['price']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);

        $image = $_FILES['image']['name'];
        $imgSize = $_FILES['image']['size'];
        $imageType = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];

        //set directory
        $dir = "uploads/";
        if($imageType != "image/jpeg" && $imageType != "image/jpg" && $imageType != "image/png" && $imageType != "image/svg" &&
        $imageType != "image/gif") {
            echo "Only JPG , JPEG, PNG , SVG, GIF images allowed. ";
        }elseif ($imgSize > 200000) {
            echo "Image is too large ";
        }else {
            move_uploaded_file($tmp_name, $dir.$image);
        }
    

        //write query
        $queryadd = "INSERT into hats (title , price , email, img) VALUES ('$title','$price','$email', '$image') ";
        
        //execute query
        if(mysqli_query($conn,$queryadd)) {
            //if success

            $_SESSION['message'] = "Added Successfully !";
            $_SESSION['msg_type'] = "alert alert-success";
            //header("location:index.php");

     

        }else {
              echo 'Database Error !' . mysqli_error($conn);
        }

      

        
    }

}


#-----------------------------------------------------

if(isset($_GET['id'])) {

    $id = $_GET['id'];
    $querydelete = "DELETE FROM hats WHERE id = $id ";

    if(mysqli_query($conn,$querydelete)) {
          
        
        $_SESSION['message'] = "Deleted Successfully !";
        $_SESSION['msg_type'] = "alert alert-danger";

    }else {
    echo 'Delete error' . mysqli_error($conn);
    
    }
    //mysqli_query($conn,$querydelete);
    //header("location:index.php");


}

if(isset($_GET['edit'])) {
    error_reporting(0);
    $id = htmlentities($_GET['edit']);
    $update = true;

    $queryedit = "SELECT * from hats WHERE id = $id";

    $result = mysqli_query($conn,$queryedit);

    $hat = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    

                if(isset($_POST['update'])) {
                    
                        
                        $id = $_GET['edit'];
                        $utitle = mysqli_real_escape_string($conn, $_POST['title']);
                        $uprice = mysqli_real_escape_string($conn,$_POST['price']);
                        $uemail = mysqli_real_escape_string($conn,$_POST['email']);

                        $image = $_FILES['image']['name'];
                        $imgSize = $_FILES['image']['size'];
                        $imageType = $_FILES['image']['type'];
                        $tmp_name = $_FILES['image']['tmp_name'];

                        //set directory
                        $dir = "uploads/";
                        if($imageType != "image/jpeg") {
                            echo "Only Jpg images allowed. ";
                        }elseif ($imageSize > 200000) {
                            echo "Image is too large ";
                        }else {
                            move_uploaded_file($tmp_name, $dir.$image);
                        }
                        
                        $queryupdate = "UPDATE hats SET title ='$utitle' , price=$uprice , email='$uemail', img ='$image' WHERE id = $id";
                        
                        mysqli_query($conn,$queryupdate);
                        //send text
                        // $result = itexmo("09659312003","Your Product Updated Successfully","TR-ACELU042702_3F92H", "cz(uwga@e#");
                        // if ($result == ""){
                        // echo "iTexMo: No response from server!!!
                        // Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
                        // Please CONTACT US for help. ";	
                        // }else if ($result == 0){
                        // echo "Message Sent!";
                        // }
                        // else{	
                        // echo "Error Num ". $result . " was encountered!";
                        // }
                        //send mail


                        $mail = new PHPMailer(true);
                        try {
                            //Server settings
                            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                            $mail->isSMTP();                                            // Send using SMTP
                            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                            $mail->Username   = 'alasacelui010@gmail.com';                     // SMTP username
                            $mail->Password   = 'aceluimanalo010';                               // SMTP password
                            $mail->SMTPSecure = "ssl";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                        
                            //Recipients
                            $mail->setFrom('alasacelui010@gmail.com', 'Vintage Thrift Shop');
                            $mail->addAddress($uemail);     // Add a recipient
                            
                            $body = '<p><b>Hello</b> your product updated successfully ! your product now is ' . $utitle . ' and its price is ₱  '.' '. $uprice;
                            // Content
                            $mail->isHTML(true);                                  // Set email format to HTML
                            $mail->Subject = 'Updates';
                            $mail->Body    = $body;
                            $mail->AltBody = strip_tags($body);
                        
                            $mail->send();
                            //echo 'Message has been sent';
                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }
                       
                      
                        $_SESSION['message'] = "Updated Successfully !";
                        $_SESSION['msg_type'] = "alert alert-success";
                    
                        //header("location:index.php");

                        //mysqli_close($conn);              

}
    
}
// check if admin is logged in if its not then it will redirect back to home page
// if(isset($_SESSION['id'])) {

//     if(!$_SESSION['username'] == 'admin' && $_SESSION['password'] = 'admin123' )
//        header("location:./mainpage/login.php");
// }else {
//     header("location:./mainpage/login.php");
// }
// if(!$_SESSION['username'] == 'admin' && $_SESSION['password'] = 'admin123' ) {
//     header("location:./mainpage/login.php");
// }
     
if(!isset($_SESSION['id'])) {
    header("location:./mainpage/login.php");
}
if($_SESSION['username'] !== 'admin' && $_SESSION['password'] !== 'admin123') {
    session_destroy();
    session_unset();
    header("location:./mainpage/login.php");
   
}



if(isset($_GET['logout'])) {
    session_destroy();
    session_unset();
    header("location: ./mainpage/login.php");
}



?>
<?php include 'layouts/header.php' ?>



<div class="container justify-content-center">
<?php if(isset($_SESSION['message'])): ?>
<div class="<?= $_SESSION['msg_type']?>">
<h1 class="text-center">
    <?= $_SESSION['message']?>
    <?php unset($_SESSION['message']); ?>
</h1>
</div>
<?php endif ?>
<?php echo $_SESSION['username']; ?>
<div class="row">
    <div class="col-md-6">
<h1><a href="admin-index.php" class="text-decoration-none">Add Vintage Hat </a> </h1><br>
</div>
<?php if(isset($_SESSION['id'])): ?>
<div class="col-md-6">
<a href="admin-index.php?logout=1">Logout</a>
</div>
<?php endif ?>
</div>
<form action="" method="POST" enctype="multipart/form-data">


<div class="form-group">
<label for="text">Title: </label>
<input type="text" name="title" value="<?php echo $hat['title'] ?>">
<div class="alert text-danger"><?php echo $errors['title'] ?></div>
</div>


<div class="form-group">
<label for="text">Price: </label>
<input type="text" name="price" class="form-group" value="<?= $hat['price'] ?>">
<div class="alert text-danger"><?php echo $errors['price'] ?></div>
</div>

<div class="form-group">
<label for="text">Email: </label>
<input type="text" name="email" class="form-group" value="<?= $hat['email'] ?>">
<div class="alert text-danger"><?php echo $errors['email'] ?></div>
</div>

<div class="form-group">
    <label for="img">Image: </label><br>
    <input type="file" name="image" >
</div>


<div class="form-group">
    <?php if($update ==true): ?>
        <input type="submit" name="update" value="Update" class="form-group btn btn-info" onclick="return confirm('Do you want to update ?')"> 
    <?php else: ?>
    <input type="submit" name="submit" value="Submit" class="form-group btn btn-primary">
    <?php endif; ?>
</div>


</form>

<table class="table table-responsive">

<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Price</th>
    <th>Email</th>
    <th>Image</th>
    <th>Date</th>
    <th>Action</th>
</tr>

<?php foreach($hats as $hat): ?>
<tr>

        <td><?php echo $hat['id'] ?></td>
        <td><?php echo $hat['title'] ?></td>
        <td><?php echo '₱'.$hat['price'] ?></td>
        <td><?php echo $hat['email'] ?></td>
        <td><img src="uploads<?php echo '/'. $hat['img'] ?>" width="150" alt="vintage" title="<?= $hat['title']?>"></td>
        <td><?php echo date($hat['created_at']) ?></td>
        <!-- <!-- <form action="index.php" method="GET"> -->
        
        <td><a href="admin-index.php?edit=<?php echo $hat['id']?>" class="btn btn-info" name="update">Edit</a></td>
        <td><a href="admin-index.php?id=<?php echo $hat['id']?>" class="btn btn-success" name="delete" onclick="return confirm('Do you want to delete ?')">Delete</a></td>
        </form>
    <?php endforeach ?>

</tr>

</table>


</div>




<?php include 'layouts/header.php' ?>