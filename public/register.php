<!DOCTYPE html>
<html>
<head>
    <title>Authentification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                  <div class="arrow-container">
                    <h3>Création du compte</h3>
                    <a href="register.php" class="arrow">⇦</a> 
                  </div>
                </div>
                <div class="card-body">
                    <form action="index.php" method="post">
                        <!-- Nom -->
                      <div class="form-group">
                        <label for="nom">Nom :</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="nom" class="form-control" id="nom" placeholder="Votre nom" name="nom" autocomplete="on" required>
                        </div>
                        <small class="form-text text-danger" id="nom-error"></small>
                      </div>
                        <!-- Prénom -->
                      <div class="form-group">
                        <label for="prenom">Prénom :</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="prenom" class="form-control" id="prenom" placeholder="Votre prénom" name="prenom" autocomplete="on" required>
                        </div>
                        <small class="form-text text-danger" id="prenom-error"></small>
                      </div>
                      <!-- Adresse mail -->
                      <div class="form-group">
                            <label for="email">Adresse mail :</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" id="email" placeholder="Votre adresse mail" name="email" autocomplete="on" required>
                            </div>
                            <small class="form-text text-danger" id="email-error"></small>
                        </div>
                        <!-- Mot de passe -->
                        <div class="form-group">
                          <label for="password">Mot de passe :</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" pattern="(?=.*\d)(?=.*[A-Z])[A-Za-z\d]{8,}" title="Le mot de passe doit contenir au moins 8 caractères, au moins 1 chiffre et au moins 1 caractère majuscule." placeholder="Votre mot de passe" name="password" required>
                            <span id="password-visibility-toggle" class="password-visibility-toggle">👀</span>
                          </div>
                        </div>
                        <!-- Confirmez le mot de passe -->
                        <div class="form-group">
                            <label for="password_confirm">Confirmez le mot de passe :</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" class="form-control" id="password_confirm" placeholder="Confirmez votre mot de passe" name="password_confirm" required>
                            </div>
                        </div>
                            <!-- Ajout -->
                        <input type="submit" value="Créer" class="btn float-right login_btn" name="ajout" id="submit">
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
                        <script>
                          $(document).ready(function() {
                            $("form").submit(function(e) {
                                e.preventDefault();
                                var form = $(this);
                                var url = form.attr('action');

                                $.ajax({
                                    type: 'POST',
                                    url: url,
                                    data: form.serialize(),
                                    success: function(response) {
                                        response = JSON.parse(response);
                                        if (response.status === "error") {
                                            $("#email-error").text(response.message);
                                        } else {
                                            window.location.href = "index.php";
                                        }
                                    }
                                });
                            });
                        });
                      </script>
                      <script>
                        const passwordInput = document.getElementById('password');
                        const passwordVisibilityToggle = document.getElementById('password-visibility-toggle');

                        passwordVisibilityToggle.addEventListener('click', function() {
                          if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            passwordVisibilityToggle.textContent = '🙈';
                          } else {
                            passwordInput.type = 'password';
                            passwordVisibilityToggle.textContent = '👀';
                          }
                        });
                      </script>

                        <!-- Se connecter -->
                        <div class="links">
                            Déjà inscrit? <a href="authentification.php">Se connecter</a>
                        </div>
                        <!-- Role -->
                        <div>
                            <label for="role"></label>
                            <input id="role" name="role" value="ROLE_USER" required>
                        </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>

<style>
	/* Styles généraux de la page */
body {
  /* background-color: #f1f1f1; */
  font-family: 'Open Sans', sans-serif;
  background-image: url('assets/images/img/DJI_0012.JPG');
  background-size: cover;
  background-repeat: no-repeat;
}

/* Styles pour la section de connexion */
.container {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
}

.card {
  box-shadow: 0px 0px 10px #bbb;
  border-radius: 10px;
  padding: 40px;
  margin-top: 2%;
  margin-bottom: 8%;
  background-color: rgba(255, 255, 255, 0.7);

  background-image: url('assets/images/img/logo.png');
  background-size: 100%;
  background-repeat: no-repeat;
  background-position: center;
  background-blend-mode: screen;
}
.card-header{
  margin-bottom: -5px;
  margin-top: -18px;
}
.card-body{
	flex: 0.7 1 auto;
}

/* Styles pour les entrées de formulaire */
.form-group {
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

/* Styles pour les icônes de formulaire */
.form-group .input-group-prepend .input-group-text i {
  color: #bbb;
  font-size: 20px;
}

/* Styles pour les erreurs de formulaire */
.form-text {
  position: absolute;
  bottom: -20px;
  font-size: 14px;
  color: red;
}
#role {
  display: none;
}
/* Styles pour la flèche */
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
.password-visibility-toggle {
  position: relative;
  top: 9px;
  left: 5px;
  cursor: pointer;
}
</style>