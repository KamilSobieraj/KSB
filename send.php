<?php
 
if (count($_POST))  {
    $data = json_decode($_POST['emailData'], JSON_OBJECT_AS_ARRAY);
    var_dump($data);
    echo "\n";
    echo "Recipient: " . $data['recipient'] . "\n";
    echo "Sender Name: " . $data['senderName'] . "\n";
    echo "\n\n";
    $data = json_decode($_POST['emailData']);
    var_dump($data);
    echo "\n";
    echo "Recipient: " . $data->recipient . "\n";
    echo "Sender Name: " . $data->senderName . "\n";
 
    die();
}
 
?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>AJAX form fetch</title>
</head>
 
<body>
    <pre></pre>
    <script>
    const email = {
      recipient: "recipient@example.com",
      subject: "test subject"
    };
 
    const myhtml = "<p>Hello World</p>";
 
    const senderName = "khris";
 
    const emailData = {
      recipient: email.recipient,
      subject: email.subject,
      html: myhtml,
      senderName: senderName
    };
    let formData = new FormData();
    formData.append("emailData", JSON.stringify(emailData));
    fetch("", {
      method: "POST",
      body: formData
    })
    .then(r => r.text())
    .then(res => document.querySelector("pre").textContent = res);
    </script>
</body>
</html>