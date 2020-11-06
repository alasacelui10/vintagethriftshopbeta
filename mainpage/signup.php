<?php 
require '../config/connection.php';

$error = array('name' =>'' , 'username'=>'' , 'email' => '' , 'password'=>'' , 'password2'=>'');

if(isset($_POST['register'])) {

$name = htmlentities($_POST['name']);
$username = htmlentities($_POST['username']);
$email = htmlentities($_POST['email']);
$password = htmlentities($_POST['password']);
$password2 = htmlentities($_POST['password2']);

 if(empty($name)) {
     $error['name'] = "Name is required";
 }else if(strlen($name)<4) {
    $error['name'] = "Name must atleast 4 characters";
}else if(!preg_match('/^[a-zA-Z\s]+$/',$name)) {
     $error['name'] = "Name must be letter only !";
 }
if(empty($username)) {
    $error['username'] = "Username is required";
}else if(strlen($username)<4) {
    $error['username'] = "Username must atleast 4 characters";
}
if(empty($email)) {
    $error['email'] = "Email is required";
}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error['email'] = "Invalid email address";
}
if(empty($password)) {
    $error['password'] = "Password is required";
}else if(strlen($password)<5) {
    $error['password'] = "password must atleast 5 characters";
}

if(empty($password2)) {
    $error['password2'] = "Re-type password is required";
 }else if($password !== $password2) {
    $error['password2'] = "The two password do not match ";
}
 
if(array_filter($error)) {
    // if there is an error
}else {
    //if there is no error then its time to sanitize the variables
    $name = mysqli_real_escape_string($conn, $name);
    $username = mysqli_real_escape_string($conn,$username);
    $email = mysqli_real_escape_string($conn,$email);
    $password = mysqli_real_escape_string($conn,$password);
    $password2 = mysqli_real_escape_string($conn,$password2);

    // then its time to query .. lets check if the email already exist . 

    $querySelect = "SELECT * from users WHERE email = '$email' LIMIT 1";
    
    // execute query & get the result
    $result = mysqli_query($conn, $querySelect);

    //fetch the result
    $users = mysqli_fetch_assoc($result);
    

    if($users > 0) {
        echo 'Email already exist!';
    }else {
        
       $password = md5($password);
        //query insert 
        $queryInsert = "INSERT INTO users (name, username , email , password) VALUES ('$name','$username','$email','$password')";
        //execute query insert
        if(mysqli_query($conn, $queryInsert)) {

            // if register success 
             $userid = $conn->insert_id;
             $_SESSION['id'] = $userid;
             $_SESSION['username'] = $username;
             $_SESSION['email'] = $email;
             
             $_SESSION['message'] = "You are now logged in! ";
             $_SESSION['msg_type'] = "alert alert-success"; 
            header("location:vintage-shop.php");
            exit();
        }else {
          echo  'Insert Error'. mysqli_error($conn); 
        }

    }

    
}

}


?>


<?php include 'header.php' ?>



<div id="particles-js">

<!-- scripts -->

        <div class="container d-flex justify-content-center" >
                <form action="signup.php" method="POST">
                    <br><br>
                <h1 class="">Create an account</h1>
                
                <div class="form-group ">
                    <label for="name" >Name:</label>
                    <input type="text" name="name" class="form-control">
                    <div class="alert text-danger"><?= $error['name'] ?></div>
                </div>
                
                <div class="form-group ">
                    <label for="username">Username:</label>
                    <input type="text" name="username" class="form-control">
                    <div class="alert text-danger"><?= $error['username'] ?></div>
                </div>

                <div class="form-group ">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="form-control">
                    <div class="alert text-danger"><?= $error['email'] ?></div>
                </div>

                <div class="form-group ">
                    <label for="password">Password:</label>
                    <input type="text" name="password" class="form-control">
                    <div class="alert text-danger"><?= $error['password'] ?></div>
                </div>

                <div class="form-group ">
                    <label for="password2">Re-Type Password:</label>
                    <input type="text" name="password2" class="form-control">
                    <div class="alert text-danger"><?= $error['password2'] ?></div>
                </div>

                <div class="form-group ">
                    <input type="submit" class="btn btn-primary" value="Register" name="register">
                </div>
                </form>

        </div>
</div>
<?php include 'footer.php' ?>


