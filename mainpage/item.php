<?php

include '../config/connection.php'; 

if(isset($_GET['itemId'])){

    $queryshow = "SELECT * FROM hats WHERE id = '$_GET[itemId]'";

    $results = mysqli_query($conn, $queryshow);

    $hats = mysqli_fetch_all($results, MYSQLI_ASSOC);

    mysqli_free_result($results);

}

if(isset($_POST['btn_submit'])){
    $conn->query("INSERT INTO comments (item_id, user_id, message) values ('$_GET[itemId]', '$_SESSION[id]', '$_POST[ta_comment]')");
}

?>
<?php include 'header.php' ?>

<div class="container my-5">
    <?php foreach($hats as $hat): ?>
        <div class="col-md-6 mx-auto">
            <div class="d-flex flex-column">
                <img src="../uploads<?= '/'.$hat['img'] ?>" class="img-thumbnail mx-auto my-2" width="300" alt="image">
                <h1 class="text-center"><?php echo $hat['title'] ?></h1>
            </div>
        </div>
    <?php endforeach ?>
    <div class="col-md-6 mx-auto">
        <form action="" method="POST" class="col-md-9 mx-auto">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Add Comment</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="ta_comment"></textarea>
                <button type="submit" class="btn btn-primary my-2" name="btn_submit">Submit</button>
            </div>
        </form>
    </div>
    <div class="col-md-6 mx-auto">
        <h4 class="text-center text-white">Comments</h4>
        <?php
             $getComments = "SELECT a.email, b.message FROM users a, comments b WHERE b.item_id = '$_GET[itemId]' and a.id = b.user_id";
             $commentsResults = mysqli_query($conn, $getComments);
             $comments = mysqli_fetch_all($commentsResults, MYSQLI_ASSOC);
         
             mysqli_free_result($commentsResults);
        ?>
        <?php foreach($comments as $comment): ?>
            <div class="p-2 text-white">
                <p><?php echo $comment['message'] ?></p>
                <label><?php echo $comment['email'] ?></label>
            </div>
        <?php endforeach ?>
    </div>
</div>