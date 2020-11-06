<?php 

session_start();

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function


function itexmo($number,$message,$apicode,$passwd){
    $url = 'https://www.itexmo.com/php_api/api.php';
    $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
    $param = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($itexmo),
        ),
    );
    $context  = stream_context_create($param);
    return file_get_contents($url, false, $context);
}

$conn = mysqli_connect('localhost', 'root', '', 'vintagethriftshop');

if(!$conn) {
    echo 'error database'. mysqli_error($conn);
}

?>