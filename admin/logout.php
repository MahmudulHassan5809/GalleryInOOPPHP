<?php require_once('includes/header.php'); $session = new Session() ; ?>
<?php 
 
 $session->logout();
 redirect('login.php');
?>





