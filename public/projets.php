<section class="section" id="projects">
      <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="section-heading">
                    <h6>Nos évenements</h6>
                    <h2>Quelques-uns de nos évenements</h2>
                </div>
                <div class="filters">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        <li data-filter=".des">Initiation aux métiers du numérique</li>
                        <li data-filter=".dev">Protection de l’environnement</li>
                        <li data-filter=".gra">Évènements sportifs et culturels</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="filters-content">
                    <div class="row grid">

                          <!-- Futsal -->
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 all gra">
                          <div class="item">
                            <a href="assets/images/img/footsal_enfants2.jpg" data-lightbox="image-1" data-title="Our Projects"><img src="assets/images/img/footsal_enfants.jpg" alt=""></a>
                          </div>
                          <form action="inscrit_events.php" method="post">
                            <?php //echo 'id: '.$_SESSION['id'] ;?>
                            <input type="hidden" name="event_id" value="1">
                            <input type="submit" value="S'inscrire à l'événement Futsal" onclick="return confirm('Êtes-vous sûr de vouloir vous inscrire à cet évenements');">
                          </form>
                          <div id="flashMessage" class="success" style="display: <?= isset($_SESSION['flashMessage']) ? 'block' : 'none' ?>">
                              <?php if(isset($_SESSION['flashMessage'])) {echo $_SESSION['flashMessage']; unset($_SESSION['flashMessage']);} ?>
                          <script>
                            setTimeout(function(){
                              document.getElementById("flashMessage").style.display = "none";
                            }, 5000);
                          </script>
                          </div>
                          <?php unset($_SESSION['flashMessage']); ?>
                        </div>

                          <!-- Environnement -->
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 all dev">
                          <div class="item">
                            <a href="assets/images/img/main.png" data-lightbox="image-1" data-title="Our Projects"><img src="assets/images/img/main.png" alt=""></a>
                          </div>
                          <form action="inscrit_events.php" method="post">
                            <?php //echo 'id: '.$_SESSION['id'] ;?>
                            <input type="hidden" name="event_id" value="2">
                            <input type="submit" value="S'inscrire à l'événement truc" onclick="return confirm('Êtes-vous sûr de vouloir vous inscrire à cet évenements');">
                          </form>
                        </div>
                          <div id="flashMessage" class="success" style="display: <?= isset($_SESSION['flashMessage']) ? 'block' : 'none' ?>">
                              <?php if(isset($_SESSION['flashMessage'])) {echo $_SESSION['flashMessage']; unset($_SESSION['flashMessage']);} ?>
                          <script>
                            setTimeout(function(){
                              document.getElementById("flashMessage").style.display = "none";
                            }, 5000);
                          </script>
                          </div>
                          <?php unset($_SESSION['flashMessage']); ?>
                        
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 all des">
                          <div class="item">
                            <a href="assets/images/img/develop_.webp" data-lightbox="image-1" data-title="Our Projects"><img src="assets/images/img/develop_.webp" alt=""></a>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 all dev">
                          <div class="item">
                            <a href="assets/images/img/poubelle.jpg" data-lightbox="image-1" data-title="Our Projects"><img src="assets/images/img/poubelle.jpg" alt=""></a>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 all gra">
                          <div class="item">
                            <a href="assets/images/img/develop.jpg" data-lightbox="image-1" data-title="Our Projects"><img src="assets/images/img/develop.jpg" alt=""></a>
                          </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 all des">
                          <div class="item">
                            <a href="assets/images/img/foot.jpg" data-lightbox="image-1" data-title="Our Projects"><img src="assets/images/img/foot.jpg" alt=""></a>
                          </div>
                        </div>

                    </div>
                  </div>
                </div>
              </div>
            <hr>
          </div>
        </section>

<style>
#flashMessage {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  padding: 20px;
  background-color: #b0e0e6;
  border-radius: 10px;
  font-size: 20px;
  font-family: Arial, sans-serif;
}
</style>