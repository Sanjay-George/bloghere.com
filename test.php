
<?php
//    $link = mysqli_connect('localhost','root','','bloghere');
//
//    if (mysqli_connect_error()){
//        die('Unable to connect to the database');
//    }
//    
//    $query = "SELECT * FROM `bloggers` WHERE email='".mysqli_real_escape_string($link, $_POST['email'])."'";
//    $result = mysqli_query($link , $query);
//
//    if ($result){
//        $row = mysqli_fetch_array($result);
//        print_r($row);
//        echo '<br>'.mysqli_num_rows($result);
//    }else{
//        echo 'success';
//    }

    session_start();

    print_r($_SESSION);
    print_r($_COOKIE);
    if (array_key_exists("id", $_COOKIE)){
        $_SESSION["id"] =  $_COOKIE["id"];        
    }
print_r($_SESSION);
    if (array_key_exists("id", $_SESSION)){
        echo "You are logged in";
    }else{
        header("Location : index.php");
    }

?>

<form name='login' method='post' id='login' class="col s12">
 <div class="row">
    <div class="input-field col s12">
      <input name='email' id="email" type="email" class="validate" autocomplete="email">
      <label for="email">Email</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12">
      <input name='password' id="password" type="password" class="validate">
      <label for="password">Password</label>
    </div>
  </div>
    <div class='col l12 center'><button name='submit' class="waves-effect waves-light btn z-depth-2 black-btn">Login</button></div>
</form>