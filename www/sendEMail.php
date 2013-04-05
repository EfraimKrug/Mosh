<?php
$to = "EfraimMKrug@GMail.com";
$subject = "Test mail";
$message = "Hello! This is a simple email message.";
$from = "KosherMIT@GMail.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
echo "Mail Sent.";
?> 