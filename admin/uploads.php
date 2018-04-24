<?php include("includes/header.php"); $session = new Session() ;?>
<?php 
 if (!$session->is_signed_in()) {
     
    redirect("login.php");
 }
?>
<?php 
$message="";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
  
   $photo = new Photo();
   $photo->title = $_POST['title'];
   $photo->set_file($_FILES['file_upload']);
   
   if($photo->save() && $photo->upload_photo()){
     $message = "Photo uploades successfully";
   }else{
        $message = join("<br>",$photo->errors);
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
                           Uploads
                            <small>Subheading</small>
                        </h1>
           <div class="row">          
            <div class="col-md-6">
              <?php  echo $message ;  ?>        
                <form action="uploads.php" method="POST" enctype="multipart/form-data">
                          <div class="form-group">
                            <label for="text">Title:</label>
                            <input type="text" class="form-control" name="title">
                          </div>

                          <div class="form-group">
                            <label for="file">Photo:</label>
                            <input type="file"  name="file_upload">
                          </div>
                          
                          
                          <input type="submit" name="submit" value="Submit" class="btn btn-info">
                    </form>   
                </div> 
            </div> 
            
            <!-- <div class="row">
              
                 <div class="col-lg-12">
                    <form action="uploads.php" class="dropzone">
                      
                    </form>
                 </div>

            </div> -->





                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
          
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>


 