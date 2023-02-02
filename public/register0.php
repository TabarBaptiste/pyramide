<!DOCTYPE html>
<html>
<head>
    <title>Authentification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<!-- Scirpt -->
<script>
    document.getElementById("submit").disabled = true;
    document.getElementById("password").addEventListener("input", function() {
        if (document.getElementById("password").value === document.getElementById("password_confirm").value) {
            document.getElementById("submit").disabled = false;
        } else {
            document.getElementById("submit").disabled = true;
        }
    });
    document.getElementById("password_confirm").addEventListener("input", function() {
        if (document.getElementById("password").value === document.getElementById("password_confirm").value) {
            document.getElementById("submit").disabled = false;
        } else {
            document.getElementById("submit").disabled = true;
        }
    });
</script>

<body>
<div class="container">
<div class="d-flex justify-content-center h-100">

  <div class="formul">
    <div class="formul-head">
      <div class="arrow-container">
        <h3>Création du compte</h3>
        <a href="index.php" class="arrow">⇦</a> 
      </div>
    </div>
    <form action="index.php" method="post">
      <div class="formul-body">
            <!-- Nom -->
            <div clas="nom">
              <div class="group-lign">

                <label for="nom">Nom :</label>
                <div class="lign">
                  <span><i class="fas fa-user"></i></span>
                  <input type="nom" id="nom" class="form-control" placeholder="Votre nom" name="nom" autocomplete="on" required>
                </div>
              </div>
              <small id="nom-error"></small>
            </div>

            <!-- Prénom -->
            <div class="prenom">
              <div class="group-lign">

                <label for="prenom">Prénom :</label>
                <div class="lign">
                  <span><i class="fas fa-user"></i></span>
                  <input type="prenom" id="prenom" class="form-control" placeholder="Votre prénom" name="prenom" autocomplete="on" required>
                </div>

              </div>
                <small id="prenom-error"></small>
            </div>

            <!-- Adresse mail -->
            <div class="email">
              <div class="group-lign">

                <label for="email">Adresse mail :</label>
                <div class="lign">
                  <span><i class="fas fa-envelope"></i></span>
                  <input type="email" id="email" class="form-control" placeholder="Votre adresse mail" name="email" autocomplete="on" required>
                </div> 
                <small id="email-error"></small>
            </div>
            <!-- Mot de passe -->
            <div class="motPass">
              <div class="group-lign">

                <label for="password">Mot de passe :</label>
                <div class="lign">
                  <span><i class="fas fa-key"></i></span>
                  <input type="password" id="password" class="form-control" pattern="(?=.*\d)(?=.*[A-Z])[A-Za-z\d]{8,}" title="Le mot de passe doit contenir au moins 8 caractères, au moins 1 chiffre et au moins 1 caractère majuscule." placeholder="Votre mot de passe" name="password" required>
                </div>
              </div>
            </div>
            <!-- Confirmez le mot de passe -->
            <div class="confMotPass">
              <div class="group-lign">

                <label for="password_confirm">Confirmez le mot de passe :</label>
                <div class="lign">
                  <span><i class="fas fa-key"></i></span>
                  <input type="password" id="password_confirm" class="form-control" placeholder="Confirmez votre mot de passe" name="password_confirm" required>
                </div>
              </div>
            </div>
              <!-- Ajout -->
            <input class="ajout" type="submit" value="Créer" class="btn float-right login_btn" name="ajout" id="submit">
            
      </div>
    </form>
    <div class="formul-footer">
          <!-- Se connecter -->
        <div class="connecter">
          Déjà inscrit? <a href="authentification.php">Se connecter</a>
        </div>
        <!-- Role -->
        <div>
          <label for="role"></label>
          <input id="role" name="role" value="ROLE_USER" required>
        </div>
    </div>
  </div>
</div>
</body>

<style>
body {
  /* background-color: #f1f1f1; */
  font-family: 'Open Sans', sans-serif;
  background-image: url('assets/images/img/DJI_0012.JPG');
  background-size: cover;
  background-repeat: no-repeat;
}

.container {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
}
.formul{
  box-shadow: 0px 0px 10px #bbb;
  border-radius: 10px;
  padding: 40px;
  margin-top: 2%;
  margin-bottom: 8%;
  background-color: rgba(255, 255, 255, 0.7);
}
.formul-header{
  margin-bottom: -5px;
  margin-top: -18px;
}
.formul-body{
	flex: 0.7 1 auto;
}
.group-lign{
  position: relative;
}
.form-control {
  border-radius: 30px;
  padding: 20px;
  border: none;
  box-shadow: 0px 0px 10px #bbb;
  margin-bottom: 20px;
}
/* Styles pour le bouton de connexion */
.login_btn {
  background-color: #3498db;
  color: white;
  border-radius: 30px;
  padding: 15px;
  border: none;
  font-size: 18px;
  cursor: pointer;
  transition: all 0.3s ease;
  margin-top: -6%;
}
.login_btn:hover {
  background-color: #2980b9;
}
.form-group span i {
    color: #bbb;
  font-size: 20px;
}
small{
    position: absolute;
  bottom: -20px;
  font-size: 14px;
  color: red;
}
#role {
  display: none;
}
.arrow-container {
  display: flex;
  align-items: center;
  justify-content: center;
}

.arrow {
  font-size:30px;
  text-decoration: none;
  color: #000;
  transition: transform 0.35s ease-in-out;
  margin-left: 4%;
  margin-bottom: 2%;
}

.arrow:hover {
  transform: rotate(360deg) skew(15deg);
  text-decoration: none;
  font-size: 30px;
}
</style>