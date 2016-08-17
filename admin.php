<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
        <link rel='stylesheet' href="css/materialize_red_black_theme.css">
        <link rel="stylesheet" href="css/blogger.css">
        <link rel="stylesheet" href="css/admin.css">
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
                     
                         <div class='col l8 offset-l2 card-panel z-depth-1 hoverable blogger-info'>
                             <div id='permission' class='col l12'>
                                  <input type="checkbox" id='acc-perm' >
                                  <label for="acc-perm">Name of the blogger</label>
                             </div> 
                               
                         </div>
                        <div class='col l8 offset-l2 card-panel z-depth-1 hoverable blogger-info'>
                             <div id='permission' class='col l12'>
                                  <input type="checkbox" id='acc-perm' >
                                  <label for="acc-perm">Name of the blogger</label>
                             </div> 
                               
                         </div>
                        
                         
                     </div>
                     
                     <div class='col l12 center update-btn'><a class="waves-effect waves-light btn z-depth-1 red-btn hoverable">Update Permissions</a></div>
                 </div> 
         
                     
           </div>
            
        </main>
        
        <!-- FLOATING ADD NEW BUTTON -->
<!--        <a class="btn-floating btn-large waves-effect waves-light red z-depth-5"><i class="material-icons">add</i></a>-->
        
        <!-- ALL POP UPS -->
            
        <!--  DELETE ACCOUNT POPUP-->
        <div class="popup" data-popup="delete-account">
            <div class="popup-inner card-panel">
                <h5>Delete Blog</h5>
                <p>Are you sure you want to delete this blog ?</p>

                <!-- ADD DELETE FUNCTIONALITY TO THIS BUTTON BELOW-->
                <a class='btn red-btn darken-4 z-depth-1 left' href="#">Delete</a>

                <a class='btn white z-depth-1 black-btn left ' data-popup-close="delete-account" href="#">Cancel</a>
                <a class="popup-close" data-popup-close="delete-account" href="#">x</a>
            </div>
        </div>       
  
    
     
     
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
        <script src="js/jquery.waypoints.min.js"></script>
        <script src="js/typed.js"></script>

        <script>
            
            
            
           // WHEN DOC READY
            $(document).ready(function(){
                // FOR SELECTING TABS
                $('ul.tabs').tabs();
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