<?php
session_start();
include_once 'class.user.php';
$user = new User();
$uid = $_SESSION['uid'];
if (!$user->get_session()){
header("location:login.php");
}
if (isset($_GET['q'])){
$user->user_logout();
header("location:login.php");
} ?>
<?php
// conectare la baza de date database
include("Conectare.php");
// se verifica daca id a fost primit
if (isset($_GET['id']) && is_numeric($_GET['id']))
{
// preluam variabila 'id' din URL
$id = $_GET['id'];
// stergem inregistrarea cu ib=$id
if ($stmt = $mysqli->prepare("UPDATE articles SET approved = '1' WHERE id = ? LIMIT 1"))
{
$stmt->bind_param("i",$id);
$stmt->execute();
$stmt->close();
}
else
{
echo "ERROR: Nu se poate aproba.";
}
$mysqli->close();
echo "<div>Articolul a fost aprobat</div>";
}
echo "<p><a href=\"Articole_neaprobate.php\">Inapoi</a></p>";
?>