<?php include("includes/header.php"); $session = new Session() ;?>
<?php 
 if (!$session->is_signed_in()) {
     
    redirect("login.php");
 }


?>


<?php  
if (!isset($_GET['id'])or $_GET['id']==NULL) {
  echo "<script>window.location='photos.php'</script>";
  //header("Location:catlist.php");
}else
{
   
  $id=$_GET['id'];
  $photo=Photo::find_by_id($id);
  
  if($photo){
  	 $photo->delete_photo();
  	 redirect("photos.php");
  }else{

  	 redirect("photos.php");
  }


  
}

?>      


 