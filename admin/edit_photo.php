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
}

?>      
<?php 
 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update']) ) {
    
    if ($photo) {
       $photo->title = $_POST['title'];
       $photo->caption = $_POST['caption'];
       $photo->alternate_text = $_POST['alternate_text'];
       $photo->description = $_POST['description'];

       if (empty($_FILES['file_upload'])) {
         $photo->save();
      }else{
        $photo->set_file($_FILES['file_upload']); 
        $photo->upload_photo();
        $photo->save();

        redirect("edit_photo.php?id={$photo->id}");
      }

     
      
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
                       <div class="col-md-8">
                           
                           <div class="form-group">
                           
                            <a href=""><img class="thumbnail" src="<?php echo $photo->picture_path(); ?>"></a>
                          </div>

                          <div class="form-group">
                            <label for="text">Title:</label>
                            <input type="text" class="form-control" name="title" value="<?php echo $photo->title ;  ?>">
                          </div>

                          <div class="form-group">
                            <label for="file">Photo:</label>
                            <input type="file"  name="file_upload">
                          </div>

                           <div class="form-group">
                            <label for="text">Caption:</label>
                            <input type="text" class="form-control" name="caption" value="<?php echo $photo->caption ;  ?>">
                          </div>

                          <div class="form-group">
                            <label for="text">Alternate Text:</label>
                            <input type="text" class="form-control" name="alternate_text" value="<?php echo $photo->alternate_text ;  ?>">
                          </div>

                          <div class="form-group">
                            <label for="textarea">Description:</label>
                            <textarea class="form-control" name="description">
                                <?php echo $photo->description ; ?>
                            </textarea>
                          </div>

                        

                       </div> 

                        <div class="col-md-4" >
                            <div  class="photo-info-box">
                                <div class="info-box-header">
                                   <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                </div>
                            <div class="inside">
                              <div class="box-inner">
                                 <p class="text">
                                   <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                                  </p>
                                  <p class="text ">
                                    Photo Id: <span class="data photo_id_box">34</span>
                                  </p>
                                  <p class="text">
                                    Filename: <span class="data">image.jpg</span>
                                  </p>
                                 <p class="text">
                                  File Type: <span class="data">JPG</span>
                                 </p>
                                 <p class="text">
                                   File Size: <span class="data">3245345</span>
                                 </p>
                              </div>
                              <div class="info-box-footer clearfix">
                                <div class="info-box-delete pull-left">
                                    <a  href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
                                </div>
                                <div class="info-box-update pull-right ">
                                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                </div>   
                              </div>
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


 