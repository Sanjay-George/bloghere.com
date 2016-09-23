<?php
    
//    $link = mysqli_connect("localhost", "root", "", "bloghere");
    $link = mysqli_connect("localhost", "cl20-bloghere", "2mU-qBFw-","cl20-bloghere");
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
//    print_r($_SESSION);

    if (array_key_exists("id", $_SESSION) && !array_key_exists("permission", $_SESSION)){
        // logged in as blogger
        // CODE FOR FUNCTIONS ON THIS PAGE
        $id = $_SESSION['id'];
        echo "<script>var likerId = ".$id."</script>"; // setting bloggerid in js also
        
        $query = "SELECT * FROM `bloggers` WHERE blogger_id =".$id;
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);
        $name = $row['username'];
        $country = $row['country'];
        $email = $row['email'];
        $permission = $row['permission'];
        
        // CHECKING IF PERMISSION TO ADD NEW BLOG
        if ($permission == 0){
            $_SESSION['add-blog-block'] = 1;
        }
        
        // ON ANY SUMBIT BUTTON CLICK
        if (array_key_exists("submit", $_POST)){
//            print_r($_POST);
            // EDIT PROFILE POPUP
            if (array_key_exists('edit-prof-pop', $_POST)){
                $query = "UPDATE `bloggers` SET username='".$_POST['username']."', country='".$_POST['country']."' WHERE blogger_id = ".$id."";
                mysqli_query($link, $query);
                header("Location: blogger.php");
            }
            // CHANGE PASSWORD POPUP
            if (array_key_exists('change-pass-pop', $_POST)){
                $query = "UPDATE `bloggers` SET password='".md5(md5($id).$_POST['password'])."' WHERE blogger_id = ".$id."";
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
                <li class='waves-effect waves-light'><a href="index.php?logout=1">Log Out</a></li>
              </ul>
            </div>
          </nav>
            
        </header>
        
        <main>
           
           <div class='container z-depth-5'>
           
               <div class='row profile-header '>
                   <div class='col s12 l12  card-panel z-depth-0 valign-wrapper'>
                       <div id='profile-info' class='col s12 l12'>
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
                            echo "<div class='col s12 l12 blog z-depth-1'>
                       <h4>".$row['title']."</h4>
                       <div class='col s12 l12 blog-info'>
                        <h5 class='valign-wrapper'>
                           <span><i class='material-icons'>person</i></span>
                           <span><a>".$name."</a></span>
                        </h5>
                        <h5 class='valign-wrapper'>
                            <span><i class='material-icons'>lock_outline</i></span>
                            <span>".$privacy."</span>
                        </h5>
                       </div>
                       <div class='col s12 l12 blog-info hide'>
                        <h5 class='valign-wrapper'>
                           <span><a class='like-btn' data-blog-id='".$row['blog_id']."'><i class='material-icons'>thumb_up</i></a></span>
                           <span>".$likes[0]."</span>
                        </h5>
                        
                       </div>
                       <div class='col s12 l12 blog-info'>
                        <h5 class='valign-wrapper'>
                           <span><a href='editblog.php?bid=".$row['blog_id']."'><i class='material-icons'>edit</i></a></span>
                           <span>edit</span>
                        </h5>
                       </div>
                       <div class='col s12 l12 blog-content'>
                           <p>".$row['content']."</p>
                       </div>
                       <div class='col s12 l12 center'><a class='waves-effect waves-light btn z-depth-2 read-more js-expand'>Show more</a></div>
                   </div> ";
                                
                        
                            
                        }
                    }

                ?>   
                
                
               </div>

                     
           </div>
            
        </main>
        
        
        <!-- FLOATING PROFILE MENU BUTTONS -->
        <div class="fixed-action-btn horizontal click-to-toggle " style="bottom: 45px; right: 24px;">
            <a class="btn-floating btn-large red z-depth-5">
              <i class="material-icons">menu</i>
            </a>
            <ul>
                <li><a class="btn-floating tooltipped z-depth-3" data-position='bottom' data-tooltip='Edit Profile' data-popup-open="edit-profile"><i class="material-icons">edit</i></a></li>
                <li><a class="btn-floating tooltipped z-depth-3" data-position='bottom' data-tooltip='Change Password' data-popup-open="change-password"><i class="material-icons">https</i></a></li>
                <li><a href='addblog.php' class="btn-floating tooltipped z-depth-3 add-blog-btn" data-position='bottom' data-tooltip='Add Blog'><i class="material-icons">add</i></a></li>
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
        
        <!-- EDIT PROFILE POPUP -->
        <div class="popup" data-popup="edit-profile">
            <div class="popup-inner card-panel">
                <h5>Edit profile</h5>
                
                <form name='edit-profile' method='post'>
                    <div class="row">
                        <div class="input-field col s12">
                          <input id="username" name='username' type="text" class="validate" autocomplete='name' required value='<?php echo $name; ?>'>
                          <label for="username">Username</label>
                        </div>
                      </div>
                     <div class="row">
                        <div class="input-field col s12">
                          <input id="email" type="email" name="email" class="validate" autocomplete="email" required value='<?php echo $email; ?>' disabled>
                          <label for="email">Email</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <input id="country" name='country' type="text" class="validate" autocomplete='name' value='<?php echo $country; ?>'>
                          <label for="country">Country</label>
                        </div>
                      </div>
                    
                    <input type="hidden" name='edit-prof-pop'>
                    <div class='col s12 l12 center'><button name='submit' class="waves-effect waves-light btn z-depth-2 black-btn">Update</button></div>
                            
                </form>
                
                <a class="popup-close" data-popup-close="edit-profile" href="#">x</a>
            </div>
        </div> 
        
        <!-- CHANGE PASSWORD POPUP -->
        <div class="popup" data-popup="change-password">
            <div class="popup-inner card-panel">
                <h5>Change Password</h5>
                
                <form name='change-password' method='post'>
                    <div class="row">
                        <div class="input-field col s12">
                          <input id="password" type="password" name='password' class="validate" required>
                          <label for="password">New Password</label>
                        </div>
                    </div>
                    
                    <input type="hidden" name='change-pass-pop'>
                    <div class='col s12 l12 center'><button name='submit' class="waves-effect waves-light btn z-depth-2 black-btn">Update</button></div>
                            
                </form>
                
                <a class="popup-close" data-popup-close="change-password" href="#">x</a>
            </div>
        </div> 
        
               
  
    
     
     
        
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