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
<?php // connectare bazadedate
include("Conectare.php");
//Modificare datelor
// se preia id din pagina vizualizare
$error='';
?>
<html> <head><title> <?php if ($_GET['id'] != '') { echo "Articol show inregistrare"; }?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/></head>
<body class ="bg-light">
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
<div>
<?php if ($_GET['id'] != '') { ?>
<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
<p>ID: <?php echo $_GET['id'];
if ($result = $mysqli->query("SELECT * FROM articles where id='".$_GET['id']."'"))
{
if ($result->num_rows > 0)
{   $row = $result->fetch_object();?></p>
<?php
$result2 = $mysqli->query("SELECT * FROM users where id='".$row->author_id."'");
$row2=$result2->fetch_object();
?>
<strong>Title:<?php echo$row->title;?> </strong><br/>
<strong>Content: <?php echo$row->content;?> </strong> <br/>
<strong>Categorie: <?php echo$row->category;?> </strong>
<strong>Price: <?php echo$row->price;?> </strong> 
<strong>Author: <?php echo$row2->name;?> </strong>
<?php 
}}} ?>
<br/>
<br/>
<a href="Vizualizare.php">Index</a>
</div></form></body> </html>
