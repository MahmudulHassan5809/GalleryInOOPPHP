<?php include("includes/header.php"); $session = new Session() ;?>
<?php 
 if (!$session->is_signed_in()) {
     
    redirect("login.php");
 }


?>


<?php  
if (!isset($_GET['id'])or $_GET['id']==NULL) {
  echo "<script>window.location='users.php'</script>";
  //header("Location:catlist.php");
}else
{
   
  $id=$_GET['id'];
  $user=User::find_by_id($id);
  
  if($user){
  	 $user->delete_user();
  	 redirect("users.php");
  }else{

  	 redirect("users.php");
  }


  
}

?>      


 