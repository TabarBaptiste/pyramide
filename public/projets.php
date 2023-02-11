<section class="section" id="projects">
  <!-- Script pour message flash -->
  <div id="flashMessage" class="success" style="display: <?= isset($_SESSION['flashMessage']) ? 'block' : 'none' ?>">
    <?php if (isset($_SESSION['flashMessage'])) {
      echo $_SESSION['flashMessage'];
      unset($_SESSION['flashMessage']);
    } ?>
    <script>
      setTimeout(function () {
        document.getElementById("flashMessage").style.display = "none";
      }, 5000);
    </script>
  </div>
  <?php unset($_SESSION['flashMessage']); ?>
  <!-- Fin -->
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
                <a href="assets/images/img/footsal_enfants2.jpg" data-lightbox="image-1" data-title="Our Projects"><img
                    src="assets/images/img/footsal_enfants.jpg" alt=""></a>
              </div>
              <!-- Formulaire pour s'inscrire à l'évenement -->
              <form action="inscrit_events.php" method="post">
                <input type="hidden" name="event_id" value="1">
                <input class="inscrip" type="submit" value="S'inscrire à l'événement Futsal"
                  onclick="return confirm('Êtes-vous sûr de vouloir vous inscrire à cet évenements');">
              </form>
              <!-- Fin -->
            </div>

            <!-- Environnement -->
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 all dev">
              <div class="item">
                <a href="assets/images/img/main.png" data-lightbox="image-1" data-title="Our Projects"><img
                    src="assets/images/img/main.png" alt=""></a>
              </div>
              <form action="inscrit_events.php" method="post">
                <input type="hidden" name="event_id" value="2">
                <input class="inscrip" type="submit" value="S'inscrire à l'événement ramassage"
                  onclick="return confirm('Êtes-vous sûr de vouloir vous inscrire à cet évenements');">
              </form>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 all des">
              <div class="item">
                <a href="assets/images/img/develop_.webp" data-lightbox="image-1" data-title="Our Projects"><img
                    src="assets/images/img/develop_.webp" alt=""></a>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 all dev">
              <div class="item">
                <a href="assets/images/img/poubelle.jpg" data-lightbox="image-1" data-title="Our Projects"><img
                    src="assets/images/img/poubelle.jpg" alt=""></a>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 all des">
              <div class="item">
                <a href="assets/images/img/develop.jpg" data-lightbox="image-1" data-title="Our Projects"><img
                    src="assets/images/img/develop.jpg" alt=""></a>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 all gra">
              <div class="item">
                <a href="assets/images/img/foot.jpg" data-lightbox="image-1" data-title="Our Projects"><img
                    src="assets/images/img/foot.jpg" alt=""></a>
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
    border-radius: 10px;
    font-size: 20px;
    font-family: Arial, sans-serif;
    background-color: #b0e0e6;
  }

  .inscrip {
    background-color: #4CAF50;
    /* Green */
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    margin-top: 0px;
    border-radius: 0px 25px 25px 0px;
    transition: all 0.3s ease-in-out;
    cursor: pointer;
    font-size: 80%;
  }

  .inscrip:hover {
    transform: scale(1.1);
    background-color: #3e8e41;
    border-radius: 25px;

  }
</style>