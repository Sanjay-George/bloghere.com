<?php

    error_reporting(0);  
    
    $link = mysqli_connect("localhost", "root", "", "bloghere");
    if (mysqli_connect_error()){
        die('Unable to connect to the database');
    }
    $error = "";
    session_start();

    if (array_key_exists("id", $_COOKIE)){
        $_SESSION['id'] = $_COOKIE['id'];
    }
    if (array_key_exists("permission", $_COOKIE)){
        $_SESSION['permission'] = $_COOKIE['permission'];
    }
//    print_r($_SESSION); // comment this
//    print_r($_GET); // comment this

    if (array_key_exists("id", $_SESSION) && !array_key_exists("permission", $_SESSION)){
       
        // logged in as blogger
        // CODE FOR FUNCTIONS ON THIS PAGE
        $blog_id = $_GET['bid'];
        $query = "SELECT * FROM `blogs` WHERE blog_id =".$blog_id;
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);
//        print_r($row);  //  comment this

        // ON ANY SUMBIT BUTTON CLICK
        if (array_key_exists("submit", $_POST)){
            print_r($_POST);

            // FOR ADDING NEW BLOG
            if (!$_POST['title']){
                $error = "One or more fields are empty";
            }
            if (!$_POST['content']){
                $error = "One or more fields are empty";
            }

            if (!$_POST['topic']){
                $error = "One or more fields are empty";
            }
            if ($error != "")
            {
            }
            else{

                $query = "UPDATE `blogs` SET title='".$_POST['title']."', content='".$_POST['content']."', topic = '".$_POST['topic']."', private = ".$_POST['private']." WHERE blog_id=".$blog_id."";
                
                mysqli_query($link, $query);
                header("Location: blogger.php");
            }
  
        }
   
    }
    else if(array_key_exists("id", $_SESSION) && array_key_exists("permission", $_SESSION)) {
        // logged in as admin
        header("Location: admin.php");
    }
    else{
        // not logged in at all
        header("Location: index.php");
    }
   
    
    

?>


<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="materialize/css/materialize.min.css">
        <link rel='stylesheet' href="css/materialize_red_black_theme.css">
        <link rel="stylesheet" href="css/blogger.css">
    </head>

    <body>
        
        <header>
           <nav class='z-depth-3'>
            <div class="nav-wrapper">
              <a href="index.html" class="brand-logo left">bloghere.com</a>
              <ul id="nav-mobile" class="right">
                <li class='waves-effect waves-light'><a href="index.php?loggedin=1">Home</a></li>
                <li class='waves-effect waves-light'><a href="blogger.php">Profile Page</a></li>
              </ul>
            </div>
          </nav>
            
        </header>
        
        <main>
           
           <div class='container z-depth-5'>
          
                   
              <div class='container add-blog'>
                    <h4> tell your story </h4>

                   <div class="col s12 l8 offset-l2">
                        <div class="row">
                            <form method="post" name='add-blog' id='add-blog' class="col s12 ">
                            <div class="row">
                                <div class="input-field col s12">
                                  <input name='title' id="title" type="text" length="50" autocomplete="off" value='<?php echo $row['title']; ?>'>
                                  <label for="title">Blog Title</label>
                                </div>
                            </div>
                              
                            <div class='row'>
                                <div class="input-field col s7">
                                    <select name='topic' id='blog-topic'>
                                        <option value="" disabled selected>Choose a topic</option>
                                        <option value="art">Art</option>
                                        <option value="automobiles">Automobiles</option>
                                        <option value="career">Career</option>
                                        <option value="environment">Environment</option>
                                        <option value="music">Music</option>
                                        <option value="personal style">Personal style</option>
                                        <option value="photography">Photography</option>
                                        <option value="physical fitness">Physical fitness</option>
                                        <option value="religion">Religion</option>
                                        <option value="sports">Sports</option>
                                        <option value="technology">Technology</option>
                                        <option value="web design">Web Design</option> 
                                    </select>
                                    <label>Topic</label>
                                  </div>
                                  
                      
                                  <div class="input-field col s5">
                                    <select name='private'>
                                      <option value="" disabled >Select Privacy status</option>
                                        <option value="0" selected>Public</option>
                                        <option value="1">Private</option>
                                    </select>
                                    <label>Blog Privacy</label>
                                  </div>
                            </div>
                           
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea name='content' id="content" class="materialize-textarea"><?php echo $row['content']; ?></textarea>
                                    <label for="content">Literally bloghere</label>
                                </div>
                            </div>
                            
                            <div class='col l12 center'><button name='submit' class="waves-effect waves-light btn z-depth-2 red-btn">Update Blog</button></div>
                            <div class='col l12 center'><p class='form-error center'><?php echo $error; ?></p></div>
                            </form>
                        </div>    
                    </div>
               </div>
               
              
           </div>
            
        </main>
     
        <script type="text/javascript" src="js/jquery-1.11.3.js"></script>
        <script src="materialize/js/materialize.min.js"></script>
        <script src="js/jquery.waypoints.min.js"></script>
        <script src="js/typed.js"></script>

        <script>
            
            
           // WHEN DOC READY
            $(document).ready(function(){
                // FOR SELECTING TABS
                $('ul.tabs').tabs();
                $('.tooltipped').tooltip({delay: 50});
                $('select').material_select();
                $('input#input_text, textarea#textarea1').characterCounter();
            });
            
            
        
      </script>
    </body>
</html>