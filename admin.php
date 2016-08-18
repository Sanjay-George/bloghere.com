<?php
    
    session_start();
     $error = "";
    $link = mysqli_connect('localhost','root','','bloghere');

    if (array_key_exists("id", $_COOKIE)){
        $_SESSION['id'] = $_COOKIE['id'];
    }

    if (array_key_exists("id", $_SESSION) && array_key_exists("permission", $_SESSION) && $_SESSION['permission']==2)
    {
        // do other stuff on this page with the session variable

        // UPDATE PERMISSIONS PART
        if (array_key_exists("submit", $_POST)){
//            print_r($_POST);  // comment this later
            // setting all to 0
            $query = "UPDATE `bloggers` SET permission=0 WHERE permission != 2";
            mysqli_query($link, $query);
            // setting to 1 those selected
            foreach ($_POST as $key => $value){
                if ($key != "submit"){
                    $query = "UPDATE `bloggers` SET permission=1 WHERE blogger_id=".$key."";
                    mysqli_query($link, $query);
                }
                
            }
            
        }
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
        <link rel='stylesheet' href="css/materialize_red_black_theme.css">
        <link rel="stylesheet" href="css/blogger.css">
        <link rel="stylesheet" href="css/admin.css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    </head>

    <body>
        
        <header>
           <nav class='z-depth-3'>
            <div class="nav-wrapper">
              <a href="#" class="brand-logo left">bloghere.com</a>
              <ul id="nav-mobile" class="right">
                <li class='waves-effect waves-light'><a href="index.php?loggedin=1">Home</a></li>
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
                           <h4>Welcome Admin !</h4>
                       </div>
                   </div>
               </div> 
               
                 <div class='row bloggers-list'>
                     <div class='col l12'>
                         <h5> LIST OF BLOGGERS </h5>
                     
                         <form name='permission' method="post" id='permission-form'>
                           <?php
                                $query = "SELECT * FROM `bloggers` WHERE permission != 2";
                                if ($result = mysqli_query($link , $query)){
                                    while($row = mysqli_fetch_array($result)){

                                        echo "<div class='col l8 offset-l2 card-panel z-depth-1 hoverable blogger-info'><div id='permission' class='col l12'><input type='checkbox' name='".$row['blogger_id']."' id='".$row['blogger_id']."'><label for='".$row['blogger_id']."'><span class='acc-user'>".$row['username']."</span></label><label for='".$row['blogger_id']."'><span class='acc-email'>".$row['email']."</span></label></div></div>";
                                        
                                        // set the checkbox to on if permission = 1
                                    }
                                }

                            ?>
                             
<!--
                             <div class='col l8 offset-l2 card-panel z-depth-1 hoverable blogger-info'>
                                 <div id='permission' class='col l12'>
                                 <input type='checkbox' name='$acc-perm-2' id='$acc-perm-2'>
                                 <label for='$acc-perm-2'><span class='acc-user'>$Name of the person</span></label>        
                                 <label for='$acc-perm-2'><span class='acc-email'>$email</span></label>                  
                                 </div> 
                             </div> 
-->
                       
                            <div class='col l12 center update-btn'><button name='submit' class="waves-effect waves-light btn z-depth-2 red-btn">Update permissions</button></div>      
                             
                             <div><h4><?php echo $error;?></h4></div>
                             
                        </form>
                       
                     </div>
                 </div>    
                 
                <?php
                    $query = "SELECT blogger_id FROM `bloggers` WHERE permission=1";
                    $result = mysqli_query($link, $query);
                    if ($result){
                        while ($row = mysqli_fetch_array($result)){
                            $id = $row['blogger_id'];
                            echo "<script type=text/javascript>$('#'+".$id.").prop('checked', true);</script>";
                       
                 
                        }
                    }
                
               ?>  
           </div>
        </main>
        
        <!-- FLOATING ADD NEW BUTTON -->
<!--        <a class="btn-floating btn-large waves-effect waves-light red z-depth-5"><i class="material-icons">add</i></a>-->
        
        <!-- ALL POP UPS -->
            
        <!--  DELETE ACCOUNT POPUP-->
<!--
        <div class="popup" data-popup="delete-account">
            <div class="popup-inner card-panel">
                <h5>Delete Blog</h5>
                <p>Are you sure you want to delete this blog ?</p>

                 ADD DELETE FUNCTIONALITY TO THIS BUTTON BELOW
                <a class='btn red-btn darken-4 z-depth-1 left' href="#">Delete</a>

                <a class='btn white z-depth-1 black-btn left ' data-popup-close="delete-account" href="#">Cancel</a>
                <a class="popup-close" data-popup-close="delete-account" href="#">x</a>
            </div>
        </div>       
-->
  
    
     
     
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
        <script src="js/jquery.waypoints.min.js"></script>
        <script src="js/typed.js"></script>

        <script>
            
            
            
           // WHEN DOC READY
            $(document).ready(function(){
                
            });
            
//        /*-------------DELETE ACC POPUP -----------------*/
//
//
//            $(function() {
//                //----- OPEN
//                $('[data-popup-open]').on('click', function(e)  {
//                    var targeted_popup_class = $(this).attr('data-popup-open');
//                    $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
//
//                    e.preventDefault();
//                });
//
//                //----- CLOSE BUTTONS
//                $('[data-popup-close]').on('click', function(e)  {
//                    var targeted_popup_class = $(this).attr('data-popup-close');
//                    $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
//
//                    e.preventDefault();
//                });
//
//                //------ ESCAPE KEY PRESS 
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
//
//
//            });
//            
        
      </script>
    </body>
</html>