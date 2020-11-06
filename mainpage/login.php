<?php 
require '../config/connection.php';

$error = array('email' => '' , 'password'=>'' , 'invalidpw' =>'');

if(isset($_POST['login'])) {


$email = htmlentities($_POST['email']);
$password = htmlentities($_POST['password']);




if(empty($_POST['email'])) {
    $error['email'] = "Username / Email is required";
}
if(empty($_POST['password'])) {
    $error['password'] = "Password is required";
}

if(!array_filter($error)) {

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn,$password);

    // query , lets check if the password is correct 
    $password = md5($password);
    $queryForPw = "SELECT * FROM users WHERE email = '$email' OR username ='$email' LIMIT 1";

    //execute the query for checking password and get the result

    $result = mysqli_query($conn, $queryForPw);

    $user = mysqli_fetch_assoc($result);

    //mysqli_close($conn);
    if($user['username'] == 'admin' && $user['password'] = 'admin123') {

        
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
       
        $_SESSION['message'] = "You are now logged in! ";
        $_SESSION['msg_type'] = "alert alert-success"; 
       header("location: ../admin-index.php");
       exit();

    }

     if($user['password']== $password) {

        // if login success
      
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
       
        $_SESSION['message'] = "You are now logged in! ";
        $_SESSION['msg_type'] = "alert alert-success"; 
       header("location:vintage-shop.php");
       exit();
       
    } else {

        $error['invalidpw'] = "Invalid Username / Password ! ";

    }

    
}




    
}




?>


<?php include 'header.php' ?>



<div id="particles-js">

<!-- scripts -->
    <br><br><br>
        <div class="container d-flex justify-content-center" >
                <form action="login.php" method="POST">
                    <br><br>
                <h1 class="">Login</h1>
                
                <div class="form-group ">
                    <label for="email">Username / Email: <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/><path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/><path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/></svg></label>
                    <input type="text" name="email" class="form-control">
                    <div class="alert text-danger"><?= $error['email'] ?></div>
                </div>

                <div class="form-group ">
                    <label for="password">Password: <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-key" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                        <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg></label>
                    <input type="password" name="password" class="form-control">
                    <div class="alert text-danger"><?= $error['password'] ?></div>
                    <div class="alert text-danger"><?= $error['invalidpw'] ?></div>
                </div>

                <div class="form-group ">
                    <input type="submit" class="btn btn-primary" value="Login" name="login">
                   
                </div>
                <a href="signup.php" class=" text-decoration-none">Already have an account ?</a>
                </form>

        </div>
</div>
<?php include 'footer.php' ?>


