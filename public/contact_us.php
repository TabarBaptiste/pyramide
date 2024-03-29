<!-- ***** Contact Us Area Starts ***** -->

<head>
  <link rel="stylesheet" href="../css/0contact_us.css">
  <?php
  require_once 'fonction.php';

  if (isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
    $user = idUser($id_user);
  }
  ?>
</head>

<section class="section" id="contact-us">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-xs-12">
        <div class="left-text-content">
          <div class="section-heading">
            <h6>Contactez nous</h6>
            <h2>N'hésitez pas à rester en contact avec nous !</h2>
          </div>
          <div>
            <li><img src="assets/images/img/contact-info-01.png" alt="numéro"><a class="lien"
                href="tel:+33 7 63 48 62 78">07 63 48 62 78</a></li>
            <li><img src="assets/images/img/contact-info-02.png" alt="e-mail"><a class="lien"
                href="mailto:rjweb53@gmail.com">rjweb53@gmail.com</a></li>
            <li><img src="assets/images/img/contact-info-03.png" alt="GYMNASE RENÉ LECOZ" target="_blank"><a
                class="lien" href="https://goo.gl/maps/pCsqgSvrtx3hoW5E7">GYMNASE RENÉ LECOZ</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-md-8 col-xs-12">
        <div class="contact-form">
          <form id="contact" action="form-handler.php" method="post">
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <fieldset>
                  <input name="name" type="text" id="name" value='<?php if (isset($_SESSION['id'])) {
                    echo $user->nom;
                  } ?>' placeholder="Nom *" required="" oninput="this.value = this.value.toUpperCase();">
                </fieldset>
              </div>
              <div class="col-md-6 col-sm-12">
                <fieldset>
                  <input name="firstName" type="text" id="firstName" value='<?php if (isset($_SESSION['id'])) {
                    echo $user->prenom;
                  } ?>' placeholder="Prénom *" required="" required
                    oninput="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);">
                </fieldset>
              </div>
              <!-- <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <input name="phone" type="text" id="phone" placeholder="Numéro de téléphone" required="">
                              </fieldset>
                            </div> -->
              <div class="col-md-6 col-sm-12">
                <fieldset>
                  <input name="email" type="email" id="email" value='<?php if (isset($_SESSION['id'])) {
                    echo $user->email;
                  } ?>' placeholder="E-mail *" required="">
                </fieldset>
              </div>
              <div class="col-md-6 col-sm-12">
                <fieldset>
                  <input name="subject" type="text" id="subject" placeholder="Sujet">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <textarea name="message" rows="6" id="message" placeholder="Message" required=""></textarea>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <button type="submit" name="submit" id="form-submit" class="main-button-icon">Envoyer <i
                      class="fa fa-arrow-right"></i></button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ***** Contact Us Area Ends ***** -->


<style>
  .lien {
    color: black;
    text-decoration: overline;
  }
</style>