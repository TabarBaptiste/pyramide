<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php require_once 'header.php'; 
        require_once 'fonction.php'; 

        if (isset($_POST['ajout'])){
            ajoutUser($_POST);
        }
        elseif (isset($_POST['delete'])){
            supprimerCompte($id);
        }
        elseif (isset($_POST['news'])){
            creatNewsletter($_POST);
        }
        elseif (isset($_POST['subscribe'])){
            idMail();
        }
        ?>
    </head>

    <!-- ***** Search Area ***** -->
    <!-- <div id="search">
        <button type="button" class="close">×</button>
        <form id="contact" action="#" method="get">
            <fieldset>
                <input type="search" name="q" placeholder="SEARCH KEYWORD(s)" aria-label="Search through site content">
            </fieldset>
            <fieldset>
                <button type="submit" class="main-button">Search</button>
            </fieldset>
        </form>
    </div> -->

    <!-- ***** Main Banner Area Start ***** -->
    <?php require_once "start.php" ?>    
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** About Area Starts ***** -->
    <?php require_once "about_us.php" ?>    
    <!-- ***** About Area Ends ***** -->

    <!-- ***** Features Big Item Start ***** -->
    <?php require_once "fusée.php" ?>    

    <!-- ***** Features Big Item End ***** -->

    <!-- ***** Features Big Item Start ***** -->
    <?php require_once "newsletters.php" ?>    
    <!-- ***** Features Big Item End ***** -->

    <!-- ***** Projects Area Starts ***** -->
    <?php require_once "projets.php" ?>    
    <!-- ***** Projects Area Ends ***** -->

    <!-- ***** Testimonials Starts ***** -->
    <?php //require_once "equipe.php" ?>    

    <!-- ***** Testimonials Ends ***** -->

    <!-- ***** Contact Us Area Starts ***** -->
        <?php require_once "contact_us.php" ?>    
    <!-- ***** Contact Us Area Ends ***** -->

    <!-- ***** Footer Start ***** -->
    <?php require_once "footer.php" ?>    

    <!-- jQuery -->
    <div>
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    <script src="assets/js/slick.js"></script> 
    <script src="assets/js/lightbox.js"></script> 
    <script src="assets/js/isotope.js"></script> 
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>
    </div>

    <script>

        $(function() {
            var selectedClass = "";
            $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
              $("."+selectedClass).fadeIn();
              $("#portfolio").fadeTo(50, 1);
            }, 500);
                
            });
        });

    </script>

  </body>
</html>