<?php

//  BLOCK DIRECT ACCESS
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Access denied.");
}

if(isset($_POST['mail'])){

    $email = filter_var(trim($_POST['mail']), FILTER_SANITIZE_EMAIL);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        die("Invalid email address");
    }

    // GOOGLE RECAPTCHA
    $secretKey = "6Leff2IsAAAAALKcRL0RCmjYpbAJv7v15h1gs-5p";

    if(empty($_POST['g-recaptcha-response'])){
        die("Please complete the CAPTCHA.");
    }

    //  cURL verification
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'secret' => $secretKey,
        'response' => $_POST['g-recaptcha-response']
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $responseData = json_decode($response);

    if(!$responseData->success){
        die("Captcha verification failed.");
    }

    //  SEND EMAIL
    $to = "janavalsan@mindstory.in";
    $subject = "New Newsletter Subscriber - Indel Automotives";

    $message = "New subscriber:\n\nEmail: $email";

    $headers = "From: Indel Automotive Website <noreply@indelauto.com>\r\n";
    $headers .= "Reply-To: noreply@indelauto.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if(mail($to, $subject, $message, $headers)){
        echo "success";
    }else{
        echo "Something went wrong.";
    }

}
?>
