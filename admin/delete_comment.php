<?php include("includes/header.php"); $session = new Session() ;?>
<?php 
 if (!$session->is_signed_in()) {
     
    redirect("login.php");
 }


?>


<?php  
if (!isset($_GET['id'])or $_GET['id']==NULL) {
  echo "<script>window.location='comments.php'</script>";
  //header("Location:catlist.php");
}else
{
   
  $id=$_GET['id'];
  $comment=Comment::find_by_id($id);
  
  if($comment){
  	 $comment->delete_comment();
  	 redirect("comments.php");
  }else{

  	 redirect("comments.php");
  }


  
}

?>      


 