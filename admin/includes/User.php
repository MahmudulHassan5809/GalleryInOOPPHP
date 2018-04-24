<?php 
 class User extends Db_object{
    
    protected static $db_table = 'users';
    protected  $db_table_field = array('username','password','first_name','last_name','user_image');
    public $id;
    public $user_image;
    public $upload_directory = "images";
    public $image_placeholder = "http://placehold.it/50x50";
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $errors = array();
    public $upload_errors_array = array(

    UPLOAD_ERR_OK => 'There is no error, the file uploaded with success',
    UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded',
    UPLOAD_ERR_NO_FILE => 'No file was uploaded',
    UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
    UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
    UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload.',
  );

  

  // public function db_tabel_fun(){
  
  // return  $this->db_tabel = "users";

  // }

    public function set_file($file){

    if (empty($file) or !$file or !is_array($file)) {
      
      $this->errors[] = "There was no file uploaded here";
      return flase;
    }

    if ($file['error'] !=0) {
      
      $this->errors[] = $this->upload_errors_array[$file['error']];
      return false;
    }else{
       
       $this->user_image = basename($file['name']);
       $this->tmp_path = $file['tmp_name'];
       $this->type     = $file['type'];
       $this->size     = $file['size']; 

    }
 }


  public function upload_photo() {
       
       

          if (!empty($this->errors)) {
             return false ;
          } if (empty($this->user_image) or empty($this->tmp_path)) {
             return false ;
          }

          $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image ;
          if (file_exists($target_path)) {
             $this->errors[] = "The file {$this->user_image} already exists";
             return false;
          }
       
         if(move_uploaded_file($this->tmp_path, $target_path)) {


               unset($this->tmp_path);
               return true ;

          

         }else{

           $this->errors[] = "The file probably does not have permission";
           return false;
         }
         
       
  }



   public function image_path_placeholder(){
       return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image ;
   }





  public static function verify_user($username,$password){
    global $database ;

    $username =$database->escape_string($username);
    $password =$database->escape_string($password);
    
    $sql = "SELECT * FROM " . self::$db_table . " WHERE ";
    $sql .= "username = '{$username}' ";
    $sql .= "AND password = '{$password}' ";
    $sql .= "LIMIT 1";
   
    
    $the_result_array = self::find_by_query($sql);
    
    return !empty($the_result_array) ? array_shift($the_result_array) : false;
    


  }


  public  function delete_user(){
    
     if ($this->delete()) {
         
         $target_path =  $target_path = SITE_ROOT . DS . 'admin' . DS . $this->image_path_placeholder() ;

         return unlink($target_path) ? true : false ;
     }else{
   
       return false ;
     }
}
    public function ajax_save_user_image($user_image,$user_id){
       global $database ;
       $user_image = $database->escape_string($user_image);
       $id = $database->escape_string($user_id);
    
       $this->user_image = $user_image ;
       $this->id = $user_id ;
       $sql = "UPDATE " . self::$db_table . " SET user_image ='{$this->user_image}'";
       $sql .= " WHERE id= {$this->id} "; 

       // $sql = "UPDATE users 
       //        SET
       //        user_image='$user_image'
       //        WHERE id='$id'";       
     $updated_image = $database->query($sql);

    echo $this->image_path_placeholder();

    }



  

  




 

  
  













 }//End Of The User Class