<h1>Vous avez été deconnecté !</h1>
<h2>Vous allez être redirigé sur la page d'acceuil dans moins de 2 secondes.</h2>

<script>
function redirect() {
  window.location.replace("index.php");
}
document.addEventListener("DOMContentLoaded", function(event) {
  setTimeout(redirect,2000);
});
</script>
