<?php include("includes/header.php"); $session = new Session() ;?>
<?php 
 if (!$session->is_signed_in()) {
     
    redirect("login.php");
 }
?>
<?php 
 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create']) ) {
    
       $user = new User();
       if($user){
       $user->username = $_POST['username'];
       $user->password = $_POST['password'];
       $user->first_name = $_POST['first_name'];
       $user->last_name = $_POST['last_name'];
       
       $user->set_file($_FILES['user_image']);

       $user->upload_photo();

       $user->save();
     }

 }
?>

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
                     <form action="" method="POST" enctype="multipart/form-data">   
                       <div class="col-md-6 col-md-offset-3">
                         <div class="form-group">
                            <label for="text">User Name:</label>
                            <input type="text" class="form-control" name="username">
                          </div>

                          <div class="form-group">
                            <label for="file">User Image:</label>
                            <input type="file"  name="user_image">
                          </div>

                           <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" >
                          </div>

                          <div class="form-group">
                            <label for="text">First Name:</label>
                            <input type="text" class="form-control" name="first_name">
                          </div>

                           <div class="form-group">
                            <label for="text">Last Name:</label>
                            <input type="text" class="form-control" name="last_name">
                          </div>

                        

                           <div class="form-group">
                            
                            <input type="submit" class="btn btn-primary pull-right" name="create">
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


 