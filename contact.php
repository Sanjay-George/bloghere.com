<?php
    // hide all warnings here
    error_reporting(0);  

    session_start();

    $link = mysqli_connect("localhost", "root", "", "bloghere");
    $error = "";
    if (mysqli_connect_error()){
        die('Unable to connect to the database');
    }

   
    print_r($_POST);
    

    // SIGNUP/LOGIN SECTION 
    if (array_key_exists('submit', $_POST)){
        
        if (!$_POST['email']){
            $error = "Please enter your email";
        }
        if (!$_POST['message']){
            $error = "Please enter a message";
        }
        if ($error != "")
        {
            
        }
        else{
            
            $query = "INSERT INTO `contact` (`email`, `message`) VALUES ('".$_POST['email']."', '".$_POST['message']."')";
            mysqli_query($link, $query);
            
            header("Location: index.php");
            

         
            
        }
    }

   
    

?>


<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
        <link rel='stylesheet' href="css/materialize_red_black_theme.css">
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    </head>
    
    <body>
        
        <header>
           <nav class='z-depth-3'>
            <div class="nav-wrapper">
              <a href="#" class="brand-logo left">bloghere.com</a>
              <ul id="nav-mobile" class="right">
                <li class='waves-effect waves-light'><a id='nav-change-option' class='js-scrollto-login' href="index.php?loggedin=1">Home</a></li>
                
              </ul>
            </div>
          </nav>
            
        </header>
        
        <main>
           
           <div class='container z-depth-5'>
           
                <div id='login-form' class='row login section'>
                    <h1 class='center'>Trouble ? </h1>
                    <h3 class='center'>send us a line and we'll get in touch with you</h3>
                    
           
                   
                    <!-- LOGIN -->
                    <div class="col s12 l8 offset-l2">
                        <div class="row">
                            <form name='login' method='post' id='login' class="col s12">
                             <div class="row">
                                <div class="input-field col s12">
                                  <input id="email" type="email" name="email" class="validate" autocomplete="email">
                                  <label for="email">Email</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                    <textarea name='message' id="content" class="materialize-textarea"><?php echo $_POST['content']; ?></textarea>
                                    <label for="content">Write your message here</label>
                                </div>
                            </div>
                            
                            <div class='col l12 center'><button name='submit' class="waves-effect waves-light btn z-depth-2 black-btn">send</button></div>
                            
                            <div class='col l12 center'><p class='form-error center'><?php echo $error; ?></p></div>
                            </form>
                        </div>    
                    </div>
                    
               </div>
               
            </div>
                              
              
            
        </main>
        

        
    
     
     
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
        <script src="js/jquery.waypoints.min.js"></script>
        <script src="js/typed.js"></script>

        <script>
            
            
            
           // WHEN DOC READY
            $(document).ready(function(){
                // FOR SELECTING TABS
                $('ul.tabs').tabs();
                
                // TO GIVE ALTERNATE RED AND BLACK THEMES TO BLOGS
                $('#best-blog').children('div:odd').addClass('red-theme');
                $('#search-results').children('div:odd').addClass('red-theme');
            });
            
           
            
    
      </script>
     
    </body>
</html>