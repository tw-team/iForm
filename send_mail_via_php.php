<?php
    require_once "Mail.php";

    $from     = "<iuli2507@gmail.com>";
    $to       = "<bdnrsc@yahoo.com>";
    $subject  = "IA PULA";
    $body     = "Hi,\n\nHow are you?";

    $host     = "ssl://smtp.gmail.com";
    $port     = "465";
    $username = "iuli2507@gmail.com";  //<> give errors
    $password = "hedonist";

    $headers = array(
        'From'    => $from,
        'To'      => $to,
        'Subject' => $subject
    );
    $smtp = Mail::factory('smtp', array(
        'host'     => $host,
        'port'     => $port,
        'auth'     => true,
        'username' => $username,
        'password' => $password
    ));

    $mail = $smtp->send($to, $headers, $body);

    if (PEAR::isError($mail)) {
        //echo("<p>" . $mail->getMessage() . "</p>");
    } else {
        echo("<p>Message successfully sent!</p>");
    }

?>  <!-- end of php tag-->