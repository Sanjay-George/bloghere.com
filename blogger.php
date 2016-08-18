<?php
    
    $link = mysqli_connect("localhost", "root", "", "bloghere");
    if (mysqli_connect_error()){
        die('Unable to connect to the database');
    }
   
    session_start();

    if (array_key_exists("id", $_COOKIE)){
        $_SESSION['id'] = $_COOKIE['id'];
    }
    if (array_key_exists("permission", $_COOKIE)){
        $_SESSION['permission'] = $_COOKIE['permission'];
    }
    print_r($_SESSION);

    if (array_key_exists("id", $_SESSION) && !array_key_exists("permission", $_SESSION)){
        
        // CODE FOR FUNCTIONS ON THIS PAGE
        $id = $_SESSION['id'];
        $query = "SELECT * FROM `bloggers` WHERE blogger_id =".$id;
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);
       
        
    }
    else if(array_key_exists("id", $_SESSION) && array_key_exists("permission", $_SESSION)) {
        header("Location: admin.php");
    }
    else{
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
              <a href="index.php?loggedin=1" class="brand-logo left">bloghere.com</a>
              <ul id="nav-mobile" class="right">
                <li class='waves-effect waves-light'><a href="index.php?loggedin=1">Home</a></li>
<!--                <li class='waves-effect waves-light'><a href="#">Sign Up</a></li>-->
                <li class='waves-effect waves-light'><a href="index.php?logout=1">Log Out</a></li>
              </ul>
            </div>
          </nav>
            
        </header>
        
        <main>
           
           <div class='container z-depth-5'>
           
               <div class='row profile-header '>
                   <div class='col l12  card-panel z-depth-0 valign-wrapper'>
                       <div id='profile-info' class='col l12'>
                           <h1><?php echo $row['username'];?></h1>
                           <h3><?php echo $row['email'];?></h3>
                           <h4><?php echo $row['country'];?></h4>
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
                       <div class='col l12 blog-info'>
                        <h5 class='valign-wrapper'>
                           <span><a><i class="material-icons">edit</i></a></span>
                           <span>edit</span>
                        </h5>
                        <h5 class='valign-wrapper'>
                            <span><a data-popup-open="delete-blog"><i class="material-icons">delete</i></a></span>
                            <span>delete</span>
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
                       <div class='col l12 blog-info'>
                        <h5 class='valign-wrapper'>
                           <span><a href='edit.html'><i class="material-icons">edit</i></a></span>
                           <span>edit</span>
                        </h5>
                        <h5 class='valign-wrapper'>
                            <span><a data-popup-open="delete-blog"><i class="material-icons">delete</i></a></span>
                            <span>delete</span>
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
        
        
        <!-- FLOATING PROFILE MENU BUTTONS -->
        <div class="fixed-action-btn horizontal click-to-toggle " style="bottom: 45px; right: 24px;">
            <a class="btn-floating btn-large red z-depth-5">
              <i class="material-icons">menu</i>
            </a>
            <ul>
                <li><a class="btn-floating tooltipped z-depth-3" data-position='bottom' data-tooltip='Edit Profile'><i class="material-icons">edit</i></a></li>
                <li><a class="btn-floating tooltipped z-depth-3" data-position='bottom' data-tooltip='Change Password'><i class="material-icons">https</i></a></li>
                <li><a class="btn-floating tooltipped z-depth-3" data-position='bottom' data-tooltip='Add Blog'><i class="material-icons">add</i></a></li>
            </ul>
          </div>
        
        <!-- ALL POP UPS -->
            
        <!--  DELETE BLOG POPUP-->
        <div class="popup" data-popup="delete-blog">
            <div class="popup-inner card-panel">
                <h5>Delete Blog</h5>
                <p>Are you sure you want to delete this blog ?</p>

                <!-- ADD DELETE FUNCTIONALITY TO THIS BUTTON BELOW-->
                <a class='btn red-btn darken-4 z-depth-1 left' href="#">Delete</a>

                <a class='btn white z-depth-1 black-btn left ' data-popup-close="delete-blog" href="#">Cancel</a>
                <a class="popup-close" data-popup-close="delete-blog" href="#">x</a>
            </div>
        </div>  
        
               
  
    
     
     
        <script type="text/javascript" src="js/jquery-1.11.3.js"></script>
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
                /*$(document).keyup(function(e) {
                    if (e.keyCode == 27) 
                    {
                        var targeted_popup_class = $('[data-popup-close]').attr('data-popup-close');
                        $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
                    }
                });

                //------ CLICK ANYWHERE ELSE
                $('.popup').click(function(){
                    var targeted_popup_class = $('[data-popup-close]').attr('data-popup-close');
                    $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);    
                })*/


            });
            
        
      </script>
    </body>
</html>