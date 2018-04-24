<?php include("includes/header.php"); $session = new Session() ;?>
<?php 
 if (!$session->is_signed_in()) {
     
    redirect("login.php");
 }
?>
<?php 

$users = User::find_all() ;

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
                      <p class="bg-success">
                        <?php  echo $session->message ;?>
                      </p>
                        <h1 class="page-header">
                           users
                           
                        </h1>
                        <a href="add_user.php" class="btn btn-info btn-xs">Add User</a>
                       <div class="col-md-12">

                           <table class="table table-hover  table-dark">
                               <thead>
                                   <tr>
                                       <th scope="col">ID</th>
                                       <th scope="col">Photo</th>
                                       <th scope="col">User Name</th>
                                       <th scope="col">First Name</th>
                                       <th scope="col">Last Name</th>
                                   </tr>
                               </thead>
                               <tbody>
                                <?php if($users){ foreach ($users as $user) { ?>
                                   
                              
                                   <tr>
                                      <td width="20%"><?php echo $user->id;  ?></td>
                                      <td width="30%"><img src="<?php echo $user->image_path_placeholder() ; ?>" class="img-responsive"></td>
                                      <td width="15%"><?php echo $user->username;  ?>
                                        <div class="action_links">
                                              <a href="delete_user.php?id=<?php echo $user->id ; ?>" class="btn btn-danger btn-xs" style="margin-top: 5px;">Delete</a>
                                              <a href="edit_user.php?id=<?php echo $user->id ; ?>" class="btn btn-success btn-xs" style="margin-top: 5px;">Edit</a>
                                              <a href="view_user.php?id=<?php echo $user->id ; ?>" class="btn btn-info btn-xs" style="margin-top: 5px;">View</a>
                                          </div>


                                       </td>
                                       <td width="15%"><?php echo $user->first_name;  ?></td>
                                       <td width="20%"><?php echo $user->last_name;  ?></td>
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


 