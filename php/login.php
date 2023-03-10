
<?php
   include("connection.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {

      // username and password sent from form 
      $user_email = mysqli_real_escape_string($connection,$_POST['user_email']);
      $user_password = mysqli_real_escape_string($connection,$_POST['user_password']); 
      
      $sql = "SELECT user_id FROM user WHERE user_email = '$user_email' and user_password = '$user_password'";
      $result = mysqli_query($connection,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
        $_SESSION['user_email'] = $user_email;
		$_SESSION['success'] = "You have logged in!";
        header("location: profile.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>



<?php
   include("connection.php");
   session_start();
if (isset($_POST['user_email']) && isset($_POST['user_password'])) {

    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
    $user_email = validate($_POST['user_email']);
    $user_password = validate($_POST['user_password']);

    if (empty($user_name)) {
        header("Location: ../login.html?error=User Name is required");
        exit();
    }else if(empty($user_password)){
        header("Location: ../login.html?error=Password is required");
        exit();
    }else{
        $sql = "SELECT * FROM user WHERE user_name='$uname' AND password='$pass'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if ($row['user_name'] === $uname && $row['password'] === $pass) {
                echo "Logged in!";

                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                header("Location: home.php");
                exit();
            }else{
                header("Location: index.php?error=Incorect User name or password");
                exit();
            }
        }else{
            header("Location: index.php?error=Incorect User name or password");
            exit();
        }
    }
}else{
    header("Location: user_profile.html");
    exit();

}