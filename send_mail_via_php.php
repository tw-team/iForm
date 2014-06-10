<?php
    require_once "Mail.php";

    $from     = "<tw.team.01@gmail.com>";
    $to       = "<bdnrsc@yahoo.com>";
    $subject  = "[iForms]";
    $body     = "Hi,\n\nHow are you?";

    $host     = "ssl://smtp.gmail.com";
    $port     = "465";
    $username = "tw.team.01@gmail.com";  //<> give errors
    $password = "1-tw-team";

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
