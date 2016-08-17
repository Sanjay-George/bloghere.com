<?php
    // hide all warnings here
    error_reporting(0);  

    session_start();

    $link = mysqli_connect("localhost", "root", "", "bloghere");
    $error = "";
    if (mysqli_connect_error()){
        die('Unable to connect to the database');
    }

    // LOGOUT USER
    if (array_key_exists("logout", $_GET)){
        session_unset();
        setcookie("id", "", time()-60*60*24);
        $_COOKIE["id"] = "";
    }
    
    

    // SIGN UP SECTION 
    if (array_key_exists('signup', $_POST)){

        if (!$_POST['email']){
            $error = "One or more fields are empty";
        }
        if (!$_POST['username']){
            $error = "One or more fields are empty";
        }
        if (!$_POST['password']){
            $error = "One or more fields are empty";
        }
        if ($error != "")
        {
            
        }
        else{
            // check if email is taken DB access required
            $query = "SELECT blogger_id FROM `bloggers` WHERE email='".mysqli_real_escape_string($link, $_POST['email'])."'";
            
            $result = mysqli_query($link, $query);
            
            if (mysqli_num_rows($result) != 0){
                $error = "Email id already taken";
            } else{
                // INSERT ALL VALUES INTO DB
                $query = "INSERT INTO `bloggers` (`username`, `email`, `password`) values ( '".mysqli_real_escape_string($link, $_POST['username'])."', '".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";
                
                if (!mysqli_query($link, $query)){
                    $error = "Sign up failed ! Please try again later.";
                }
                else{
                    $query = "SELECT blogger_id FROM `bloggers` WHERE email='".mysqli_real_escape_string($link, $_POST['email'])."'";
                    $result = mysqli_query($link, $query);
                    $row = mysqli_fetch_array($result);
                    $id = $row['blogger_id'];
                    
                    //HASH PASSWORD
                    $query = "UPDATE `bloggers` SET password= '".md5(md5($id).$_POST['password'])."' WHERE blogger_id =".$id." LIMIT 1";
                    mysqli_query($link, $query);
                    
                    //setting cookie and session
                    $_SESSION["id"] = $id;
                    setcookie("id", $id, time() + 60*60*24*15);

                    header("Location: blogger.php"); 
                    
                }
            }
            
        }
    }

    // LOGIN SECTION
    

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
                <li class='waves-effect waves-light'><a id='nav-change-option' href="#">Login / Sign Up</a></li>
                <li class='waves-effect waves-light'><a href="#">Contact Us</a></li>
              </ul>
            </div>
          </nav>
            
        </header>
        
        <main>
           
           <div class='container z-depth-5'>
           
                <div id='login-form' class='row login section'>
                    <h1 class='center'>Welcome to bloghere.com</h1>
                    <h3 class='center'>Login / Sign up to continue</h3>
                    
           
                    <div class="col s12 tabs-col">
                      <ul class="tabs">
                        <li class="tab col s6 z-depth-1"><a  href="#login">Login</a></li>
                        <li class="tab col s6 z-depth-1"><a class="active" href="#signup">Sign Up</a></li> 
                      </ul>
                    </div>
                    <!-- LOGIN -->
<!--
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
                                  <input id="password" type="password" name="password" class="validate">
                                  <label for="password">Password</label>
                                </div>
                              </div>
                                <div class='col l12 center'><button name='submit' class="waves-effect waves-light btn z-depth-2 black-btn">Login</button></div>
                            </form>
                        </div>    
                    </div>
-->
                    <!-- SIGNUP -->
                    <div class="col s12 l8 offset-l2">
                        <div class="row">
                            <form method="post" name='signup' id='signup' class="col s12" novalidate>
                              <div class="row">
                                <div class="input-field col s12">
                                  <input id="username" name='username' type="text" class="validate" autocomplete='name' required value='<?php echo $_POST['username']; ?>'>
                                  <label for="username">Username</label>
                                </div>
                              </div>
                             <div class="row">
                                <div class="input-field col s12">
                                  <input id="email" type="email" name="email" class="validate" autocomplete="email" required value='<?php echo $_POST['email']; ?>'>
                                  <label for="email">Email</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  <input id="password" type="password" name='password' class="validate" required>
                                  <label for="password">Password</label>
                                </div>
                              </div>
                              <div class='col l12 center'><button name='signup' class="waves-effect waves-light btn z-depth-2 black-btn">Sign Up</button></div>
                              
                              <div class='col l12 center'><p class='form-error center'><?php echo $error; ?></p></div>
                            </form>
                    </div>
                </div> 
               </div>
               
    
                              
               <div  class='row main-info section'>
                   <div class='col l12 info-points valign-wrapper'>
                       <div class='col l5 red-filter img-holder'><img class='responsive-img' src="images/main-photo-2.jpg"></div>
                       <div class='col l7'><h4>Blog on any topic</h4></div>
                   </div>
                   <div class='col l12 info-points valign-wrapper'>
                       <div class='col l7 right-align'><h4>Click on bloggers to see their blogs</h4></div>
                       <div class='col l5 img-holder'><img class='responsive-img gray-filter' src="images/main-photo-3.jpg"> </div>
                   </div>
                    <div class='col l12 info-points valign-wrapper'>
                       <div class='col l5 red-filter img-holder'><img class='responsive-img' src="images/main-photo-1.jpg"></div>
                       <div class='col l7'><h4>Upvote your favourite blogs</h4></div>
                   </div>
                   <div class='col l12 info-nav'>
                       <h3 class='center'>Get started now or browse for more </h3>
                        <div class='col l12 center'>
                            <a href='#signup' class="waves-effect waves-light btn z-depth-1 red-btn hoverable">Wanna BLog</a>
                            <a href='#best-blog' class="waves-effect waves-light btn z-depth-1 black-btn hoverable">Read blogs</a>
                        </div>
                         
                   </div>
               </div>
               
            <?php
        
                // visiting home page still logged in
                if (array_key_exists("loggedin", $_GET)){
                    // hide sign up form 
                    // show profile instead of home in navbar
                    $error  = 'logged in'; 
            ?>
                        
               <script>$('#login-form').hide();
                   $('.main-info .info-nav').hide();
                   $('.main-info').css('padding-top','100px');
                   $('#nav-change-option').text("Profile Page");
                   $('#nav-change-option').attr("href", "blogger.php");
               </script>
            <?php
                    
                }

            ?>
               
               <div id='best-blog' class= 'row best-blog section'>
                    <div class='col l12'>
                       <h3>the best ones</h3>
                    </div>
                    
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
                           <p>This is the content of the blog. Show only for a few lines and give a read more option that expands the content.There is more to this content than meets the eye. There is also a method to hide this text until fully read. What makes this so good is the fact that a beautiful mind cannot accept this but a total retard can. But then if someone just writes some crap then the admin will take away his rights to publish anything new as well will delete that particular blog.But then if someone just writes some crap then the admin will take away his rights to publish anything new as well will delete that particular blog.
                           But then if someone just writes some crap then the admin will take away his rights to publish anything new as well will delete that particular blog.But then if someone just writes some crap then the admin will take away his rights to publish anything new as well will delete that particular blog.But then if someone just writes some crap then the admin will take away his rights to publish anything new as well will delete that particular blog.But then if someone just writes some crap then the admin will take away his rights to publish anything new as well will delete that particular blog.</p>
                       </div>
                       <div class='col l12 center'><a class="waves-effect waves-light btn z-depth-2 read-more js-expand">READ MORE</a></div>
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
                       <div class='col l12 center'><a class="waves-effect waves-light btn z-depth-2 read-more js-expand">READ MORE</a></div>
                   </div>
                   
               </div>
                    
                <div class ='row search-blog section'>
                   <!-- SEARCH BAR -->
                    <div class='col l12'>
                        <form name='search' id='search' class="col s12">
                          <div class="col l8 offset-l2 valign-wrapper">
                                <div class="input-field col l11">
                                  <input id="search" class='autotype' type="text">
                                  
                                </div>
                                <div class='col l1 center'><a class="waves-effect waves-light btn z-depth-2 black"> <i class="material-icons">search</i></a></div>
                          </div>
                        </form>   
                    </div> 
                    
                    <!-- SEARCH RESULTS -->
                    <div id='best-blog search-results' class= 'row best-blog section hide'>
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
                           <p>This is the content of the blog. Show only for a few lines and give a rethe fact that a beautiful mind cannot accept this but a total retard can.</p>
                       </div>
                       <div class='col l12 center'><a class="waves-effect waves-light btn z-depth-2 read-more js-expand">READ MORE</a></div>
                   </div>  
                  </div>
               </div>
               
            
           
                
                     
           </div>
            
        </main>
        

        
    
     
     
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
        <script src="js/jquery.waypoints.min.js"></script>
        <script src="js/typed.js"></script>

        <script>
            
            // FOR EXPANDING/COLLAPSING BLOG CONTENT
            $('.js-expand').click(function(){
               $(this).parents().siblings('.blog-content').toggleClass('expand');
                
                if ($(this).parents().siblings('.blog-content').hasClass('expand'))
                    $(this).text("Collapse");
                else
                    $(this).text("Read More");
            });
            
           // WHEN DOC READY
            $(document).ready(function(){
                // FOR SELECTING TABS
                $('ul.tabs').tabs();
            });
            
            // TYPING EFFECT
            $(function(){
              $(".autotype").typed({
                strings: ["Search for any topic",'Technology','Music'],
                typeSpeed: 100,
                startDelay : 100, 
                loop : true,
                backDelay : 1000,
                backspeed : 500
              });
          });
            // STOP TYPING EFFECT WHEN ON FOCUS
            $('.autotype').focusin(function(){
                $(this).typed({
                    strings : ['']
                });
                $(this).val('');
                
            });
            
            
            
            
            
           

      </script>
     
    </body>
</html>