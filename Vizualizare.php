<?php
session_start();
include_once 'class.user.php';
$user = new User();
$urole='';
if($user->get_session())
{$uid = $_SESSION['uid'];
    $urole=$_SESSION['urole'];}
if (isset($_GET['q'])){
$user->user_logout();
header("location:login.php");
} ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Vizualizare Inregistrari</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body class ="bg-light">
<h1>Inregistrarile din tabela articles</h1>
<p><b>Toate inregistrarile din articles</b</p>
<?php
// connectare bazadedate
 include("Conectare.php");
// se preiau inregistrarile din baza de date
if ($result = $mysqli->query("SELECT * FROM articles WHERE approved='1' ORDER BY id "))
{ // Afisare inregistrari pe ecran
if ($result->num_rows > 0)
{
    echo '<a style="display: inline; margin: 0px 5px 0px" href="Articole_artistice.php">Categoria Artistic</a>';
    echo '<a style="display: inline; margin: 0px 5px 0px" href="Articole_tehnice.php">Categoria Tehnic</a>';
    echo '<a style="display: inline; margin: 0px 5px 0px" href="Articole_science.php">Categoria Science</a>';
    echo '<a style="margin: 0px 5px 0px" href="Articole_moda.php">Categoria Moda</a>';
// afisarea inregistrarilor intr-o table
echo "<table border='1' cellpadding='10'>";
// antetul tabelului
if ($urole == 'Cititor' or $urole== ''){
    echo "<tr><th>ID</th><th>Titlu articol</th><th>Continut</th><th>Data</th><th>Pret</th><th>Categorie</th>";
}
else{
    echo "<tr><th>ID</th><th>Titlu articol</th><th>Continut</th><th>Data</th><th>Pret</th><th>Categorie</th>"."<th></th><th></th></tr>";
}
while ($row = $result->fetch_object())
{
// definirea unei linii pt fiecare inregistrare
echo "<tr>";
echo "<td>" . $row->id . "</td>";
if($urole == 'Cititor' or $urole== ''){
echo "<td><a href='Articol_show.php?id=" . $row->id . "'>". $row->title ."</a></td>";
echo "<td>" . substr($row->content, 0, 30) . "</td>";
}
else
{
echo "<td>" . $row->title . "</td>";
echo "<td>" . $row->content . "</td>";
}
echo "<td>" . $row->date . "</td>";
echo "<td>" . $row->price . "</td>";
echo "<td>" . $row->category . "</td>";
if (($urole == 'Jurnalist' and $row->author_id == $uid) or ($urole =='Editor'))
{
echo "<td><a href='Modificare.php?id=" . $row->id . "'>Modificare</a></td>";
echo "<td><a href='Stergere.php?id=" .$row->id . "'>Stergere</a></td>";
}
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
<?php
if ($urole == 'Jurnalist')
{
echo '<a href="Inserare.php">Creeaza un nou articol</a> </br>';
echo '<a href="Articole_jurnalist.php">Articole proprii</a>';
}
if ($urole == 'Editor')
{
echo '<a href="Jurnalisti_neaprobati.php">Jurnalisti neaprobati</a> </br>';
echo '<a href="Articole_neaprobate.php">Articole_neaprobate</a>';
}

?>
<div id="container">
    <?php
if($user->get_session()){
echo '<div id="header"><a href="Vizualizare.php?q=logout">LOGOUT</a></div>';
}
else{
    echo '<div id="header"><a href="Login.php">Login</a></div>';
}
?>
<div id="footer"></div>
</div>
</body>
</html>
