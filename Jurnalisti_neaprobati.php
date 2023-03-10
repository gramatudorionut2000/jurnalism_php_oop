<?php
session_start();
include_once 'class.user.php';
$user = new User();
$uid = $_SESSION['uid'];
$urole=$_SESSION['urole'];
if (!$user->get_session()){
header("location:login.php");
}
if (isset($_GET['q'])){
$user->user_logout();
header("location:login.php");
} ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Vizualizare Jurnalisti neaprobati</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body class ="bg-light">
<?php
// connectare bazadedate
 include("Conectare.php");
// se preiau inregistrarile din baza de date
if ($result = $mysqli->query("SELECT * FROM users WHERE activated = '0' ORDER BY id "))
{ // Afisare inregistrari pe ecran
if ($result->num_rows > 0)
{
// afisarea inregistrarilor intr-o table
echo "<table border='1' cellpadding='10'>";
// antetul tabelului
echo "<tr><th>ID</th><th>Nume complet</th><th>username</th><th>Email</th></tr>";
while ($row = $result->fetch_object())
{
// definirea unei linii pt fiecare inregistrare
echo "<tr>";
echo "<td>" . $row->id . "</td>";
echo "<td>" . $row->name . "</td>";
echo "<td>" . $row->username . "</td>";
echo "<td>" . $row->email . "</td>";


echo "<td><a href='Aprobare_jurnalist.php?id=" . $row->id . "'>Aprobare</a></td>";
echo "<td><a href='Stergere_Jurnalist.php?id=" .$row->id . "'>Stergere</a></td>";
echo "</tr>";
}
echo "</table>";
}
// daca nu sunt inregistrari se afiseaza un rezultat de eroare
else
{
echo "Nu sunt inregistrari in tabela!";
}
}
// eroare in caz de insucces in interogare
else
{ echo "Error: " . $mysqli->error(); }
// se inchide
$mysqli->close();
?>
<div id="container">
<div id="header"><a href="Vizualizare.php?q=logout">LOGOUT</a></div>
<div id="footer"><a href="Vizualizare.php">Index</a></div>
</div>
</body>
</html>
