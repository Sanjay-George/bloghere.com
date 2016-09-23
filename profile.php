<?php
   
//    error_reporting(0);
    $link = mysqli_connect("localhost", "root", "", "bloghere");
    if (mysqli_connect_error()){
        die('Unable to connect to the database');
    }
   
    session_start();

//    if (array_key_exists("id", $_COOKIE)){
//        $_SESSION['id'] = $_COOKIE['id'];
//    }
//    if (array_key_exists("permission", $_COOKIE)){
//        $_SESSION['permission'] = $_COOKIE['permission'];
//    }
//    print_r($_SESSION);
//
//    if (array_key_exists("id", $_SESSION) && !array_key_exists("permission", $_SESSION)){
//        // logged in as blogger
//        // CODE FOR FUNCTIONS ON THIS PAGE
//        $id = $_SESSION['id'];
//        echo "<script>var likerId = ".$id."</script>"; // setting bloggerid in js also
//        
//        $query = "SELECT * FROM `bloggers` WHERE uesrname =".$_GET['username'];
//        $result = mysqli_query($link, $query);
//        $row = mysqli_fetch_array($result);
//        $name = $row['username'];
//        $country = $row['country'];
//        $email = $row['email'];
//        $permission = $row['permission'];
//        
//        // CHECKING IF PERMISSION TO ADD NEW BLOG
//        if ($permission == 0){
//            $_SESSION['add-blog-block'] = 1;
//        }
//        
//        // ON ANY SUMBIT BUTTON CLICK
//        if (array_key_exists("submit", $_POST)){
//            print_r($_POST);
//            // EDIT PROFILE POPUP
//            if (array_key_exists('edit-prof-pop', $_POST)){
//                $query = "UPDATE `bloggers` SET username='".$_POST['username']."', country='".$_POST['country']."' WHERE blogger_id = ".$id."";
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
//        // logged in as admin
//        header("Location: admin.php");
//    }
//    else{
//        // not logged in at all
//        header("Location: index.php");
//    }

//    print_r($_GET);

    $query = "SELECT * FROM `bloggers` WHERE username ='".$_GET['username']."' LIMIT 1";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
//    print_r($row);
    $id = $row['blogger_id'];
    $name = $row['username'];
    $country = $row['country'];
    $email = $row['email'];
    $permission = $row['permission'];
   
    
    

?>


<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="materialize/css/materialize.min.css">
        <link rel='stylesheet' href="css/materialize_red_black_theme.css">
        <link rel="stylesheet" href="css/blogger.css">
        <link rel="stylesheet" href="css/style_queries.css">
        <script type="text/javascript" src="js/jquery-1.11.3.js"></script>
    </head>

    <body>
        
        <header>
           <nav class='z-depth-3'>
            <div class="nav-wrapper">
              <a href="index.php?loggedin=1" class="brand-logo left hide-on-small-only">bloghere.com</a>
              <ul id="nav-mobile" class="right">
                <li class='waves-effect waves-light'><a href="index.php?loggedin=1">Home</a></li>
<!--                <li class='waves-effect waves-light'><a href="#">Sign Up</a></li>-->
<!--                <li id='nav-change-option' class='waves-effect waves-light'><a href="index.php?logout=1">Log Out</a></li>-->
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
               

                  <?php
                    $query = "SELECT * FROM `blogs` WHERE blogger_id=".$id."";
                    
                           
                    if ($result = mysqli_query($link , $query)){
                        while($row = mysqli_fetch_array($result)){
                            
                            
                            // getting number of likes
                            $like_query = "SELECT COUNT(liker_id) FROM `likes` WHERE blog_id = ".$row['blog_id']." ";
                            $like_result = mysqli_query($link,$like_query);
                            $likes = mysqli_fetch_array($like_result);

                            
                            // setting privacy terms
                            if ($row['private'] == 0){
                                $privacy = "public";
                            }
                            else{
                                $privacy = "private";
                            }
                            echo "<div class='col l12 blog z-depth-1'>
                       <h4>".$row['title']."</h4>
                       <div class='col l12 blog-info'>
                        <h5 class='valign-wrapper'>
                           <span><i class='material-icons'>person</i></span>
                           <span><a>".$name."</a></span>
                        </h5>
                        <h5 class='valign-wrapper'>
                            <span><i class='material-icons'>lock_outline</i></span>
                            <span>".$privacy."</span>
                        </h5>
                       </div>
                       <div class='col l12 blog-info hide'>
                        <h5 class='valign-wrapper'>
                           <span><a class='like-btn' data-blog-id='".$row['blog_id']."'><i class='material-icons'>thumb_up</i></a></span>
                           <span>".$likes[0]."</span>
                        </h5>
                        
                       </div>
                       
                       <div class='col l12 blog-content'>
                           <p>".$row['content']."</p>
                       </div>
                       <div class='col l12 center'><a class='waves-effect waves-light btn z-depth-2 read-more js-expand'>Show more</a></div>
                   </div> ";
                                
                        
                            
                        }
                    }

                ?>   
                
                
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
                
                // TO GIVE ALTERNATE RED AND BLACK THEMES TO BLOGS
                $('#all-blogs').children('div:odd').addClass('red-theme');
            });
            
            
            /*// FOR THE LIKE BUTTON  
           $(".like-btn").click(function(){
                //CHECK FROM DB IF LIKED , ADDCLASS LIKE 
                
               
                if ($(this).hasClass('liked')){
                    // already liked
                    $(this).removeClass('liked');
                    var likeCount = $(this).parent().siblings('span').text();
                    likeCount = Number(likeCount);
                    $(this).parent().siblings('span').text(likeCount-1);
                    
                    var likedBlogId = $(this).attr('data-blog-id');
                    likedBlogId = Number(likedBlogId);
                    
                    // ajax
                    $.ajax({
                      method: "POST",
                      url: "likeupdate.php",
                      data: { blog_id: likedBlogId, blogger_id: likerId, like: 0 }
                    });
                }
                else{
                    // not liked 
                    $(this).addClass('liked');
                    var likeCount = $(this).parent().siblings('span').text();
                    likeCount = Number(likeCount);
                    $(this).parent().siblings('span').text(likeCount+1);
                    
                    var likedBlogId = $(this).attr('data-blog-id');
                    likedBlogId = Number(likedBlogId);
                    
                    // ajax
                    $.ajax({
                      method: "POST",
                      url: "likeupdate.php",
                      data: { blog_id: likedBlogId, blogger_id: likerId, like: 1 }
                    });
                    
                }
           }); */
            
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