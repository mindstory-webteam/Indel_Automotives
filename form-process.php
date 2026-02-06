<?php

$errorMSG = "";

// FIRST NAME
if (empty(trim($_POST["fname"]))) {
    $errorMSG .= "First Name is required. ";
} else {
    $fname = trim($_POST["fname"]);
}

// LAST NAME
if (empty(trim($_POST["lname"]))) {
    $errorMSG .= "Last Name is required. ";
} else {
    $lname = trim($_POST["lname"]);
}

// EMAIL
if (empty(trim($_POST["email"]))) {
    $errorMSG .= "Email is required. ";
} elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $errorMSG .= "Enter a valid email address. ";
} else {
    $email = trim($_POST["email"]);
}

// PHONE
if (empty(trim($_POST["phone"]))) {
    $errorMSG .= "Phone is required. ";
} else {
    $phone = trim($_POST["phone"]);
}

// MESSAGE
if (empty(trim($_POST["message"]))) {
    $errorMSG .= "Message is required. ";
} else {
    $message = trim($_POST["message"]);
}


// SEND MAIL ONLY IF NO ERRORS
if ($errorMSG == "") {

    $EmailTo = "test@yourdomain.com"; // Change if needed
    $subject = "New contact inquiry from Indel Automotives Website ";

    // PROFESSIONAL EMAIL BODY
    $Body  = "New contact inquiry from Indel Automotives Website";
    $Body .= "---------------------------\n\n";

    $Body .= "First Name : $fname\n";
    $Body .= "Last Name  : $lname\n";
    $Body .= "Email      : $email\n";
    $Body .= "Phone      : $phone\n\n";

    $Body .= "Message:\n$message\n";


    // BETTER HEADERS (PREVENT SPAM)
    $headers = "From: Website Contact <no-reply@yourdomain.com>\r\n"; // change domain
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";


    if(mail($EmailTo, $subject, $Body, $headers)){
        echo "success";
    } else {
        echo "Something went wrong. Please try again.";
    }

} else {
    echo $errorMSG;
}

?>
