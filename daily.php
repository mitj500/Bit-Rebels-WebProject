<?php
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
//   }

//   $cookie_name = "email_sent";

// if (isset($_COOKIE[$cookie_name])) {
//     echo "Email already sent today.";
//     exit;
// }


//   $user=$_SESSION['user'];

//   $query = "SELECT * FROM admin_credentials WHERE USERNAME='$user'";
//   $result = mysqli_query($con, $query);
//   $row = mysqli_fetch_array($result);
//   if($row){
//     $email = $row['EMAIL'];
//   }

//   $cookie_name = "email_sent";
// $cookie_value = "true";
// $cookie_expire = strtotime('tomorrow') - time();

// setcookie($cookie_name, $cookie_value, $cookie_expire);

    
// $to = $email;
// $subject = "Regarding your Inventory";
// $message = "Your inventory items are low in stock.";
// $headers = "From: 21102163.aaryan.chothani@gmail.com";

// if(mail($to, $subject, $message, $headers)) {
//     echo "Email sent successfully.";
//     $_SESSION['email_sent'] = true;
// } else {
//     echo "Email failed to send.";
// }
session_start();

if (!isset($_SESSION['email_sent'])) {
    // Send the email
    $to = "aaryanc1903@gmail.com";
    $subject = "Daily Email";
    $message = "This is your daily email.";
    $headers = "From: aaryanc1903@gmail.com";

    if (mail($to, $subject, $message, $headers)) {
        echo "Email sent successfully.";
        $_SESSION['email_sent'] = true;
    } else {
        echo "Email failed to send.";
    }
} else {
    echo "Email already sent today.";
}

?>
