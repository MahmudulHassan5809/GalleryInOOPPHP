<?php include("includes/header.php"); $session = new Session() ;?>
<?php 
 if (!$session->is_signed_in()) {
     
    redirect("login.php");
 }
?>
<?php 

$photos = Photo::find_all() ;

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
                       <div class="col-md-12">
                           <table class="table table-hover  table-dark">
                               <thead>
                                   <tr>
                                       <th scope="col">Photo</th>
                                       <th scope="col">Id</th>
                                       <th scope="col">File Name</th>
                                       <th scope="col">Title</th>
                                       <th scope="col">Size</th>
                                       <th>Comment</th>
                                   </tr>
                               </thead>
                               <tbody>
                                <?php if($photos){ foreach ($photos as $photo) { ?>
                                   
                              
                                   <tr>
                                       <td width="30%"><img src="<?php echo $photo->picture_path() ; ?>" class="img-responsive">

                                          <div class="pictures_link">
                                              <a href="delete_photo.php?id=<?php echo $photo->id ; ?>" class="btn btn-danger btn-xs" style="margin-top: 5px;">Delete</a>
                                              <a href="edit_photo.php?id=<?php echo $photo->id ; ?>" class="btn btn-success btn-xs" style="margin-top: 5px;">Edit</a>
                                              <a href="../photo.php?id=<?php echo $photo->id ; ?>" class="btn btn-info btn-xs" style="margin-top: 5px;">View</a>
                                              <a href="Photo_comment.php?id=<?php echo $photo->id ; ?>" class="btn btn-info btn-xs" style="margin-top: 5px;">Comment</a>
                                          </div>

                                       </td>
                                       <td width="10%"><?php echo $photo->id;  ?></td>
                                       <td width="15%"><?php echo $photo->filename;  ?></td>
                                       <td width="15%"><?php echo $photo->title;  ?></td>
                                       <td width="20%"><?php echo $photo->size;  ?></td>
                                       <td width="10%">
                                        <?php $comments = Comment::find_comments($photo->id); 
                                         echo count($comments);
                                         
                                        ?>
                                       </td>
                                   </tr>

                               <?php } } else { ?> 
                                <tr>
                                    <td colspan="5">Not Data Available</td>
                                </tr> 
                                <?php } ?>  
                               </tbody>
                           </table>

                       </div> 






                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
          
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>


 