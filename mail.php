<?php

$emailErr = $nameErr = $name = $text = $textErr = $subject = $subjectErr = $phpmailresponse ="";

$to= "info@martinmuthomi.co.ke";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["message"])) {
        $textErr = "Message is required";
    } else {
        $text = test_input($_POST["message"]);
    }

    if (empty($_POST["subject"])) {
        $subjectErr = "Subject is required";
    } else {
        $subject = test_input($_POST["subject"]);
    }
 }

    if( !empty($name) && !empty($subject) && !empty($text) && !empty($email) )
    {
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "From: " . $email . "\r\n"; // Sender's E-mail
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $message = '<table style="width:100%">
        <tr>
            <th>Subject: ' . $subject . '</th>
        </tr>
        <tr>
            <td>Name: ' . $name . '</td>
        </tr>
        <tr><td>Email: ' . $email . '</td></tr>
        <tr><td>Text: ' . $text . '</td></tr>
        
    </table>';

    if (@mail($to, $email, $message, $headers)) {
//        echo '<script type="text/javascript">
//
//                             window.location = "index.php#contact";
//
//
//                           </script>';
        $phpmailresponse = "The message has been sent.";

    } else {
        $phpmailresponse = "failed to send the message";
    }


}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>
