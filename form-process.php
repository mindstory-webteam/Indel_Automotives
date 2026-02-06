<?php

$errorMSG = "";

// SANITIZE FUNCTION
function clean_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// FIRST NAME
if (empty($_POST["fname"])) {
    $errorMSG .= "First Name is required. ";
} else {
    $fname = clean_input($_POST["fname"]);
}

// LAST NAME
if (empty($_POST["lname"])) {
    $errorMSG .= "Last Name is required. ";
} else {
    $lname = clean_input($_POST["lname"]);
}

// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "Email is required. ";
} elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $errorMSG .= "Enter a valid email address. ";
} else {
    $email = clean_input($_POST["email"]);
}

// PHONE
if (empty($_POST["phone"])) {
    $errorMSG .= "Phone is required. ";
} else {
    $phone = clean_input($_POST["phone"]);
}

// MESSAGE
if (empty($_POST["message"])) {
    $errorMSG .= "Message is required. ";
} else {
    $message = clean_input($_POST["message"]);
}


// SEND MAIL ONLY IF NO ERRORS
if ($errorMSG == "") {

    $EmailTo = "info@indelauto.com";
    $subject = "New Website Inquiry - Indel Automotive";

    // EMAIL BODY
    $Body  = "New contact inquiry from Indel Automotive Website\n";
    $Body .= "---------------------------------------\n\n";

    $Body .= "First Name : $fname\n";
    $Body .= "Last Name  : $lname\n";
    $Body .= "Email      : $email\n";
    $Body .= "Phone      : $phone\n\n";

    $Body .= "Message:\n$message\n";


    // ✅ PROFESSIONAL HEADERS
    $headers  = "From: Indel Automotive <noreply@indelauto.com>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
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
