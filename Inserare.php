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
include("Conectare.php");
$error='';
if (isset($_POST['submit']))
{
// preluam datele de pe formular
$title = htmlentities($_POST['title'], ENT_QUOTES);
$date = new DateTime('NOW');
$date = $date->format('Y-m-d');
$content = htmlentities($_POST['content'], ENT_QUOTES);
$category = htmlentities($_POST['category'], ENT_QUOTES);
$price = htmlentities($_POST['price'], ENT_QUOTES);
$author_id = $uid;
$approved = 0;
// verificam daca sunt completate
if ($title == '' || $content == ''||$date==''||$category==''||$author_id=='')
{
// daca sunt goale se afiseaza un mesaj
$error = 'ERROR: Campuri goale!';
} else {
// insert
if ($stmt = $mysqli->prepare("INSERT into articles (title, content, date, category, price,author_id, approved) VALUES (?, ?, ?, ?, ?, ?, ?)"))
{
$stmt->bind_param("ssssdsi", $title, $content,$date,$category,$price,$author_id, $approved);
$stmt->execute();
$stmt->close();
}
// eroare le inserare
else
{
echo "ERROR: Nu se poate executa insert.";
}
}
}
// se inchide conexiune mysqli
$mysqli->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head> <title><?php echo "Inserare inregistrare"; ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head> <body class ="bg-light">
<h1><?php echo "Inserare inregistrare"; ?></h1>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
<div>
<strong>Title: </strong> <input type="text" name="title" value=""/><br/>
<strong> Content: </strong><br/> <textarea rows="4" cols="50" id="content"  name="content">

</textarea>
<br/>
<strong>Price: </strong> <input type="text" name="price" value=""/><br/>
<strong>Categorie: </strong><select id='category' name='category' class="block mt-1 w-full">
    <option value="" selected>Choose Category</option>
    <option value="Artistic">Artistic</option>
    <option value="Tehnic">Tehnic</option>
    <option value="Science">Science</option>
    <option value="Moda">Moda</option>
</select>
<br/>
<input type="submit" name="submit" value="Submit" />
<a href="Vizualizare.php">Index</a>
</div></form></body></html>