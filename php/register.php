<?php include 'connection.php'; ?>

<?php  if(isset($_POST['submit'])){

  $first_name =  $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $user_email =  $_POST['user_email'];
  $user_password = $_POST['user_password'];
  $image = $_FILES['image']['name'];
  $image_size = $_FILES['image']['size'];
  $image_tmp_name = $_FILES['image']['tmp_name'];
  $image_folder = '../Images/'.$image;

  $select = mysqli_query($connection, "SELECT * FROM `user` WHERE user_email = '$user_email' AND
   user_password = '$user_password'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }
   else{

    //image size must less than or equal to 2mb
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
       // upload the image before the query
         move_uploaded_file($image_tmp_name, $image_folder);

         //insert query
         $insert = mysqli_query($connection, "INSERT INTO `user`(first_name, last_name, user_email, user_password, image)
          VALUES(' $first_name', '$last_name' ,'$user_email', '$user_password', '$image')");

        
         if($insert){
            $message[] = 'registered successfully!';
            header("Location:../login.html");
            exit();

         }else{
            $message[] = 'registeration failed!';
         }
      }
   }
}
?>
