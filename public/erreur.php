<html>

<body>
  <p>Veuillez remplir les champs demandés</p>
  <div id="div1" style="visibility: hidden">
    <a href="authentification.php">Retour</a>
  </div>
</body>
<script type="text/javascript">
  function showDiv1() {
    document.getElementById("div1").style.visibility = "visible";
  }
  setTimeout("showDiv1()", 7000); // aprés 15 sec
</script>

</html>