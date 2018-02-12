<?php
$subject = "Вы прошли регистрацию!/You have been registered!";

$message = '';

$headers  = "";

mail($authorEmail, $subject, $message, $headers);
?> 