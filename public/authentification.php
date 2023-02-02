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
                    <h3>Connexion</h3>
                        <a href="index.php" class="arrow">⇦</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="email">Adresse mail :</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="email" class="form-control" id="email" placeholder="Votre adresse mail" name="email" autocomplete="on">
                            </div>
                            <small class="form-text text-danger" id="email-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe :</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" class="form-control" id="password" placeholder="Votre mot de passe" name="password">
                            </div>
                        </div>
                        <!-- Se connecter -->
                        <div class="form-group">
                            <input type="submit" value="Se connecter" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <div class="links">
                      Nouvel utilisateur? <a href="register.php">S'inscrire</a>
                    </div>
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
  background-image: url('assets/images/img/DJI_0006.JPG');
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
  margin-top: 8%;
  margin-bottom: 8%;
  background-color: rgba(255, 255, 255, 0.7);

  background-image: url('assets/images/img/logo.png');
  background-size: 100%;
  background-repeat: no-repeat;
  background-position: center;
  background-blend-mode: screen;
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
  margin-left: 8%;
}

.arrow:hover {
  transform: rotate(360deg) skew(15deg);
  text-decoration: none;
  font-size: 30px;
}
</style>