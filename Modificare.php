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
if (!empty($_POST['id']))
{ if (isset($_POST['submit']))
{ // verificam daca id-ul din URL este unul valid
if (is_numeric($_POST['id']))
{ // preluam variabilele din URL/form
$id = $_POST['id'];
$title = htmlentities($_POST['title'], ENT_QUOTES);
$date = new DateTime('NOW');
$date = $date->format('Y-m-d');
$content = htmlentities($_POST['content'], ENT_QUOTES);
$category = htmlentities($_POST['category'], ENT_QUOTES);
$price = htmlentities($_POST['price'], ENT_QUOTES);
$author_id = $uid;
// verificam daca numele, prenumele, an si grupa nu sunt goale
if ($title == '' || $content == ''||$date==''||$category==''||$author_id=='')
{ // daca sunt goale afisam mesaj de eroare
echo "<div> ERROR: Completati campurile obligatorii!</div>";
}else
{ // daca nu sunt erori se face update name, code, image, price, descriere, categorie
if ($stmt = $mysqli->prepare("UPDATE articles SET title=?,content=?,category=?,price=?,date=?, author_id=? WHERE id='".$id."'"))
{ $stmt->bind_param("sssdss", $title, $content,$category,$price,$date,$author_id);
$stmt->execute();
 $stmt->close();
 }// mesaj de eroare in caz ca nu se poate face update
else
{echo "ERROR: nu se poate executa update.";}
}
}
// daca variabila 'id' nu este valida, afisam mesaj de eroare
else
{echo "id incorect!";} }}?>
<html> <head><title> <?php if ($_GET['id'] != '') { echo "Modificare inregistrare"; }?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/></head>
<body>
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
{ $row = $result->fetch_object();?></p>
<strong>Title: </strong> <input type="text" name="title" value="<?php echo$row->title;
?>"/><br/>
<strong>Content: </strong><br/> <textarea rows="4" cols="50" id="content"  name="content">
<?php echo $row->content;?>
</textarea>
<br/>
<strong>Categorie: </strong>
<select id='category' name='category' class="block mt-1 w-full">

    <option value="">Choose Category</option>
    <?php
    if($row->category == 'Artistic')
    {
    echo '<option value="Artistic" selected>Artistic</option>';    
    }
    else{
        echo '<option value="Artistic">Artistic</option>';
    }?>
    <?php
    if($row->category == 'Tehnic')
    {
    echo '<option value="Tehnic" selected >Tehnic</option>';    
    }
    else{
        echo '<option value="Tehnic">Tehnic</option>';
    }?>
    <?php
    if($row->category == 'Science')
    {
    echo '<option value="Science" selected >Science</option>';    
    }
    else{
        echo '<option value="Science">Science</option>';
    }?>
    <?php
    if($row->category == 'Moda')
    {
    echo '<option value="Moda" selected >Moda</option>';    
    }
    else{
        echo '<option value="Moda">Moda</option>';
    }?>
</select>
<strong>Price: </strong> <input type="text" name="price" value="<?php echo $row->price; 
}}} ?>"/><br/>
<br/>
<input type="submit" name="submit" value="Submit" />
<a href="Vizualizare.php">Index</a>
<a href="Articole_jurnalist.php">Articole proprii</a>
</div></form></body> </html>
