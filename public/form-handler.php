<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $firstName = $_POST['firstName'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  $to = 'baptiste97296@gmail.com';
  $subject = 'Formulaire de contact : ' . $subject;
  $headers = "From: $email\r\n";
  $headers .= "Reply-To: $email\r\n";

  mail($to, $subject, $message, $headers);

  echo 'Votre message a bien été envoyé.';
} else {
  error_log("Il y a une erreur!", 1);
}
header('Location: index.php#contact-us')
  ?>