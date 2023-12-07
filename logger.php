<?php
if($_POST) {
  $password = htmlspecialchars($_POST['X']);
  $hash = 'hash'; 
  if($password && password_verify($password, $hash)){
    $_SESSION['connected'] = true;
  }  
  else {
    $error = "Mot de passe incorrect";
  }
  if (isset($_POST['flashnews-logout'])) {
    $_SESSION['connected']=false;
    session_destroy();
  }
}
?>
