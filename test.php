<?php

require 'vendor/autoload.php'; 

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("kamil.sobieraj.dev@gmail.com", "Example User");
$email->setSubject("Sending with Twilio SendGrid is Fun");
$email->addTo("kellycmi62@gmail.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid('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');
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
?>