<?php include("includes/header.php"); $session = new Session() ;?>
<?php 
 if (!$session->is_signed_in()) {
     
    redirect("login.php");
 }
?>
<?php 

if (empty($_GET['id'])) {
   redirect("photos.php");
}

$comments = Comment::find_comments($_GET['id']);

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
                           users
                           
                        </h1>
                        <a href="add_user.php" class="btn btn-info btn-xs">Add User</a>
                       <div class="col-md-12">
                           <table class="table table-hover  table-dark">
                               <thead>
                                   <tr>
                                       <th scope="col">ID</th>
                                       <th scope="col">Author</th>
                                       
                                       <th scope="col">Body</th>
                                   </tr>
                               </thead>
                               <tbody>
                                <?php if($comments){ foreach ($comments as $comment) { ?>
                                   
                              
                                   <tr>
                                      <td width="30%"><?php echo $comment->id;  ?></td>
                                     
                                      <td width="20%"><?php echo $comment->author;  ?>
                                        <div class="action_links">
                                              <a href="delete_comment_photo.php?id=<?php echo $comment->id ; ?>" class="btn btn-danger btn-xs" style="margin-top: 5px;">Delete</a>
                                              <a href="edit_comment.php?id=<?php echo $comment->id ; ?>" class="btn btn-success btn-xs" style="margin-top: 5px;">Edit</a>
                                             
                                          </div>


                                       </td>
                                      
                                       <td width="50%"><?php echo $comment->body;  ?></td>
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


 