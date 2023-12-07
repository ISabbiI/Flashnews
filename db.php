
<?php

$servername = "X; // nom du serveur de la base de donnée
$username = "X"; // login de la base de donnée
$password = "X"; // mot de passe de la base de donnée
$dbname = "x"; // nom de la base de donnée

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=3306", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
