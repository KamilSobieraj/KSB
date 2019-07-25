<?php
//print_r(json_encode($_POST));
//die();
define('API_KEY', "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");
require 'vendor/autoload.php'; 

ini_set( 'display_errors', 'On' ); 
error_reporting( E_ALL );
header("Content-Type: application/json");

    $decoded = json_decode($_POST['emailData'], JSON_OBJECT_AS_ARRAY);
    $recipient = $decoded['recipient'];
    $senderName = $decoded['senderName'];
    $html = $decoded['html'];

    //E-mail to CPAB
    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom("$recipient", "Konfigurator Szkolen - Zamówienie");
    $email->setSubject("Zamówienie od: $senderName");
    $email->addTo("kamil.sobieraj.dev@gmail.com", "CPAB - Konfigurator Szkoleń");
    $email->addContent(
        "text/html", "$html"
    );
    $sendgrid = new \SendGrid("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");
    
    try {
        $response = $sendgrid->send($email);
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";}

    //E-mail to client
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("biuro@cpab.pl", "CPAB - Konfigurator Szkoleń");
        $email->setSubject("Potwierdzenie złożenia zamówienia");
        $email->addTo("$recipient", "");
        $email->addContent(
            "text/html", "<p><strong>Dziękujemy za złożenie zamówienia!</strong></p><br/>Twoje zamówienie na szkolenie to:<br/>$html<br/><strong><p>Odezwiemy się wkrótce!</p></strong><br/><p>+48 530360721<br/>+48 32 3073355</p><p>CPAB Sp. z o.o.  /  Jagiellońska 24 / 40-032 Katowice</p><p>cpab.pl</p><p>cpab@linkedin</p><p>wyjazdyrozwojowe.pl</p><p>cpab.co</p>"
        );
        $sendgrid = new \SendGrid("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");
        
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";}

?>