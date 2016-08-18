<?php
    
//    $link = mysqli_connect("localhost", "root", "", "bloghere");
//    if (mysqli_connect_error()){
//        die('Unable to connect to the database');
//    }
//   
//    session_start();
//
//    if (array_key_exists("id", $_COOKIE)){
//        $_SESSION['id'] = $_COOKIE['id'];
//    }
//    if (array_key_exists("permission", $_COOKIE)){
//        $_SESSION['permission'] = $_COOKIE['permission'];
//    }
//    print_r($_SESSION);
//
//    if (array_key_exists("id", $_SESSION) && !array_key_exists("permission", $_SESSION)){
//        
//        // CODE FOR FUNCTIONS ON THIS PAGE
//        $id = $_SESSION['id'];
//        $query = "SELECT * FROM `bloggers` WHERE blogger_id =".$id;
//        $result = mysqli_query($link, $query);
//        $row = mysqli_fetch_array($result);
//        
//        // ON ANY SUMBIT BUTTON CLICK
//        if (array_key_exists("submit", $_POST)){
//            print_r($_POST);
//            // EDIT PROFILE POPUP
//            if (array_key_exists('edit-prof-pop', $_POST)){
//                $query = "UPDATE `bloggers` SET email='".$_POST['email']."', username='".$_POST['username']."', country='".$_POST['country']."' WHERE blogger_id = ".$id."";
//                mysqli_query($link, $query);
//                header("Location: blogger.php");
//            }
//            // CHANGE PASSWORD POPUP
//            if (array_key_exists('change-pass-pop', $_POST)){
//                $query = "UPDATE `bloggers` SET password='".md5(md5($id).$_POST['password'])."' WHERE blogger_id = ".$id."";
//                mysqli_query($link, $query);
//                header("Location: blogger.php");
//            }
//        }
//       
//        
//    }
//    else if(array_key_exists("id", $_SESSION) && array_key_exists("permission", $_SESSION)) {
//        header("Location: admin.php");
//    }
//    else{
//        header("Location: index.php");
//    }
    
    // there will be two cookies 
    // one for blogger/admin id 
    // one for the profile blogger id
    // permission cookie not required


    session_start();
    
    if (array_key_exists("id", $_COOKIE)){
        $_SESSION['id'] = $_COOKIE['id'];
    }
//    if (array_key_exists("permission", $_COOKIE)){
//        $_SESSION['permission'] = $_COOKIE['permission'];
//    }
    print_r($_SESSION);
    $loggedin = 0;
    if (array_key_exists('id',$_SESSION)){
        // logged in
        echo "You are logged in bro";
        $loggedin = 1;
    }
    else{
        echo "You are not logged in bro";
        $loggedin = 0;
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
        <script type="text/javascript" src="js/jquery-1.11.3.js"></script>
    </head>

    <body>
        
        <header>
           <nav class='z-depth-3'>
            <div class="nav-wrapper">
              <a href="index.php?loggedin=1" class="brand-logo left">bloghere.com</a>
              <ul id="nav-mobile" class="right">
                <li class='waves-effect waves-light'><a href="index.php?loggedin=1">Home</a></li>
                <li id='nav-sign-up' class='waves-effect waves-light'><a href="index.php">Sign Up</a></li>
                <li id='nav-profile-page' class='waves-effect waves-light'><a href="blogger.php">Profile Page</a></li>
                <li id='nav-log-out' class='waves-effect waves-light'><a href="index.php?logout=1">Log out</a></li>
              </ul>
            </div>
          </nav>
            <?php
                if ($loggedin == 0){
                    // show sign up link and hide log out 
            ?>  
                <script>
                    $('#nav-log-out').hide();
                    $('#nav-profile-page').hide();
            
                </script>
            <?php               
                }
                else{
                    // show log out and hide sign up
            ?>
               <script>
                    $('#nav-sign-up').hide();
                </script>
            <?php
                }
            
            ?>    
        </header>
        
        <main>
           
           <div class='container z-depth-5'>
           
               <div class='row profile-header '>
                   <div class='col l12  card-panel z-depth-0 valign-wrapper'>
                       <div id='profile-info' class='col l12'>
                           <h1>Name</h1>
                           <h3>Email</h3>
                           <h4>Country</h4>
                       </div>

                   </div>
               </div>
               
               <div id='all-blogs' class= 'row best-blog section'>
                    
                    
                    <div class='col l12 blog z-depth-1'>
                       <h4>Name of the blog</h4>
                       <div class='col l12 blog-info'>
                        <h5 class='valign-wrapper'>
                           <span><i class="material-icons">person</i></span>
                           <span><a>Total buttwad</a></span>
                        </h5>
                        <h5 class='valign-wrapper'>
                            <span><i class="material-icons">watch_later</i></span>
                            <span>22/07/2016</span>
                        </h5>
                       </div>
                       <div class='col l12 blog-info'>
                        <h5 class='valign-wrapper'>
                           <span><a><i class="material-icons">thumb_up</i></a></span>
                           <span>50</span>
                        </h5>
                        <h5 class='valign-wrapper'>
                            <span><a><i class="material-icons">thumb_down</i></a></span>
                            <span>10</span>
                        </h5>
                       </div>
                       <div class='col l12 blog-content'>
                           <p>This is the content of the blog. Show only for a few lines and give a read more option that expands the content.There is more to this content than meets the eye. Therhis rights to publish anything new as well will delete thything new as well will delete that particular bl as well will delete that particular blog.</p>
                       </div>
                       <div class='col l12 center'><a class="waves-effect waves-light btn z-depth-2 read-more js-expand">Show more</a></div>
                   </div> 
                      
                    
                    <div class='col l12 blog red-theme z-depth-1'>
                       <h4>Name of the blog</h4>
                       <div class='col l12 blog-info'>
                        <h5 class='valign-wrapper'>
                           <span><i class="material-icons">person</i></span>
                           <span><a>Total buttwad</a></span>
                        </h5>
                        <h5 class='valign-wrapper'>
                            <span><i class="material-icons">watch_later</i></span>
                            <span>22/07/2016</span>
                        </h5>
                       </div>
                       <div class='col l12 blog-info'>
                        <h5 class='valign-wrapper'>
                           <span><a><i class="material-icons">thumb_up</i></a></span>
                           <span>50</span>
                        </h5>
                        <h5 class='valign-wrapper'>
                            <span><a><i class="material-icons">thumb_down</i></a></span>
                            <span>10</span>
                        </h5>
                       </div>
                       <div class='col l12 blog-content'>
                           <p>This is the content of the blog. Show only for a few lines and give a read more option that expands the content.There is more to this content than meets the eye. There is also a method to hide this text until fully read. What makes this so good is the fact that a beautiful mind cannot accept this but a total retard can.</p>
                       </div>
                       <div class='col l12 center'><a class="waves-effect waves-light btn z-depth-2 read-more js-expand">Show more</a></div>
                   </div>
                   
               </div>

                     
           </div>
            
        </main>
        
        
       
        
               
  
    
     
     
        
        <script src="materialize/js/materialize.min.js"></script>
        <script src="js/jquery.waypoints.min.js"></script>
        <script src="js/typed.js"></script>

        <script>
            
            // FOR EXPANDING/COLLAPSING BLOG CONTENT
            $('.js-expand').click(function(){
               $(this).parents().siblings('.blog-content').toggleClass('expand');
                
                if ($(this).parents().siblings('.blog-content').hasClass('expand'))
                    $(this).text("Show less");
                else
                    $(this).text("Show More");
            });
            
           // WHEN DOC READY
            $(document).ready(function(){
                // FOR SELECTING TABS
                $('ul.tabs').tabs();
                $('.tooltipped').tooltip({delay: 50});
            });
            
        /*-------------COMMON FOR ALL POPUPS -----------------*/


            $(function() {
                //----- OPEN
                $('[data-popup-open]').on('click', function(e)  {
                    var targeted_popup_class = $(this).attr('data-popup-open');
                    $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

                    e.preventDefault();
                });

                //----- CLOSE BUTTONS
                $('[data-popup-close]').on('click', function(e)  {
                    var targeted_popup_class = $(this).attr('data-popup-close');
                    $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

                    e.preventDefault();
                });
                
        

                
                //------ ESCAPE KEY PRESS 
                // These features to be added later
//                $(document).keyup(function(e) {
//                    if (e.keyCode == 27) 
//                    {
//                        var targeted_popup_class = $('[data-popup-close]').attr('data-popup-close');
//                        $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
//                    }
//                });
//
//                //------ CLICK ANYWHERE ELSE
//                $('.popup').click(function(){
//                    var targeted_popup_class = $('[data-popup-close]').attr('data-popup-close');
//                    $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);    
//                })


            });
            
        
      </script>
    </body>
</html>