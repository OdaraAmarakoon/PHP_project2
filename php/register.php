<?php include 'connection.php'; ?>

<?php  if(isset($_POST['submit'])){

  $firstName =  $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $userEmail =  $_POST['userEmail'];
  $userPassword = $_POST['userPassword'];
  $image = $_FILES['image']['name'];
  $image_size = $_FILES['image']['size'];
  $image_tmp_name = $_FILES['image']['tmp_name'];
  $image_folder = '../Images/'.$image;

  // need to check only the email.
  $select = mysqli_query($connection, "SELECT * FROM `user` WHERE userEmail = '$userEmail'") or die('query failed');

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
         $insert = mysqli_query($connection, "INSERT INTO `user`(firstName, lastName, userEmail, userPassword, image)
          VALUES(' $firstName', '$lastName' ,'$userEmail', '$userPassword', '$image')");

      //   check whether regitation is successfull or not
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
