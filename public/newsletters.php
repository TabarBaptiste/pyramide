<?php
require_once 'fonction.php';

if (isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
    $user = idUser($id_user);
}
?>
<section class="section" id="subscribe">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="section-heading">
                    <h6>Abonnez-vous aux NewsLetters</h6>
                    <h2>Ne manquez pas cette chance!</h2>
                </div>
                <div class="subscribe-content">
                    <p>Soyez informé des dernières actualités concernant .La Pyramides (...)</p>
                    <div class="subscribe-form">
                        <form id="subscribe-now" action="index.php" method="post">
                            <div class="row">
                                <div class="col-md-8 col-sm-12">
                                    <fieldset>
                                        <label for="email" class="sr-only">Adresse email</label>
                                        <input value='<?php if (isset($_SESSION['id'])) {
                                            echo $user->email;
                                        } ?>' name="email" type="text" id="email" placeholder="Entrer votre email..."
                                            required>
                                    </fieldset>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <fieldset>
                                        <button type="submit" name="subscribe" id="form-submit"
                                            class="main-button">S'abonner</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_SESSION['id'])) {
                            if ($_SESSION['role'] == 'ROLE_ADMIN') {
                                echo '<div style="text-align: center;">
                                    <a href="form_newsletter.php"><button id="form-submit" class="main-button">Créer</button></a>
                                </div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>