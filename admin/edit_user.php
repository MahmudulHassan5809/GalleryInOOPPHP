
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
}

?>      
<?php 
 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update']) ) {
    
    if ($user) {
       $user->username = $_POST['username'];
       $user->password = $_POST['password'];
       $user->first_name = $_POST['first_name'];
       $user->last_name = $_POST['last_name'];

      if (empty($_FILES['user_image'])) {
         $user->save();
         $session->message("User Updated Successfully");
         redirect("users.php?id={$user->id}");

      }else{
        $user->set_file($_FILES['user_image']); 
        $user->upload_photo();
        $user->save();
         $session->message("User Updated Successfully");
        // redirect("edit_user.php?id={$user->id}");
        redirect("users.php?id={$user->id}");
      }


       
       
      
    }
 


 }
?>




 <?php include('includes/photo_modal.php') ; ?>





        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <?php include("includes/top_nav.php") ; ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("includes/side_nav.php") ;?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
           <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Photos
                            <small>Subheading</small>
                        </h1>
                       <div class="col-md-6 user-image-box">
                          <a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-responsive " src="<?php echo $user->image_path_placeholder(); ?>"></a> 
                        </div>  
                      <form action="" method="POST" enctype="multipart/form-data">   
                       <div class="col-md-6 ">
                            
                         

                          
                          <div class="form-group">
                            <label for="text">User Name:</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $user->username; ?>">
                          </div>

                          <div class="form-group">
                            <label for="file">User Image:</label>
                            <input type="file"  name="user_image">
                          </div>

                           <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" value="<?php echo $user->password ; ?>">
                          </div>

                          <div class="form-group">
                            <label for="text">First Name:</label>
                            <input type="text" class="form-control" name="first_name" value="<?php echo $user->first_name; ?>">
                          </div>

                           <div class="form-group">
                            <label for="text">Last Name:</label>
                            <input type="text" class="form-control" name="last_name" value="<?php echo $user->last_name; ?>">
                          </div>
                          
                           <div class="form-group">
                              <a id="user-id" href="delete_user.php?id=<?php echo $user->id ; ?>" class="btn btn-danger pull-left" style="margin-top: 5px;">Delete</a>
                           </div>
                        

                           <div class="form-group">
                            
                            <input type="submit" class="btn btn-primary pull-right" name="update" value="Update">
                          </div>


                         
                       </div> 

                       
                    </div>
                 </form>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
          
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>


 