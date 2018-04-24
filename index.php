<style type="text/css">.activepage{background: #000 !important;color: #fff !important;}</style>
<?php include("includes/header.php"); ?>
<?php 

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1 ;
$items_per_page = 4;
$items_total_count = Photo::count_all() ;

$paginate = new Paginate($page,$items_per_page,$items_total_count);

// $sql = "SELECT * FROM photos ";
// $sql .= "LIMIT {$items_per_page} ";
// $sql .= "OFFSET {$paginate->offset()} ";

$sql = $paginate->sql();

$photos = Photo::find_by_query($sql);

// $photos = Photo::find_all();


?>

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <div class="thumbnails row">
               <?php
                 if($photos){
                    foreach ($photos as $photo) {  ?>
                 
                     <div class="col-xs-3 col-md-3">
                       <a href="photo.php?id=<?php echo $photo->id; ?>" class="thumbnail">
                           
                        <img class="img-responsive home_page_photo" src="admin/<?php echo $photo->picture_path(); ?>">

                       </a>  

                         
                     </div>
                
               <?php } } ?>   
                 
                 </div>

                 <div class="row">
                    <ul class="pager">
                       <?php 
                          if ($paginate->page_total() > 1) {  
                             if ($paginate->has_next()) { ?>
                           
                            <li class='next'><a href='index.php?page=<?php echo $paginate->next() ;?>'>Next</a></li>   
                        
                      <?php } for($i=1 ; $i<= $paginate->page_total() ;$i++){
                            if($i == $paginate->current_page){
                            

                        ?>
               
                        <li><a class="activepage" style="" href="index.php?page=<?php echo $i ;?>"><?php echo $i ; ?></a></li>

                     <?php }else {  ?>
                         
                    <li><a class="" href="index.php?page=<?php echo $i ;?>"><?php echo $i ; ?></a></li>
                    <?php } }if($paginate->has_prev()){ ?>
                     
                      <li class='previous'><a href='index.php?page=<?php echo $paginate->prev() ;?>'>Previous</a></li>

                    <?php } } ?>
                    </ul> 
                 </div>

              </div>

            </div>


            <!-- Blog Sidebar Widgets Column -->
         <!--    <div class="col-md-4"> -->

            
              <!--    <?php //include("includes/sidebar.php"); ?> -->
       <!--   </div> -->



        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
