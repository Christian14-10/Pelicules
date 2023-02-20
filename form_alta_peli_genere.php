<!DOCTYPE HTML>  
<html>
<head>
<style>
* {
    font-family: Arial, Helvetica, sans-serif;;
}

body {
    background-color: goldenrod;
}

header {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    background-color: #333;
    color: white;
}

header a:hover {
    background: #eca023;
}

ul {
    display: flex;
    flex-direction: row;
    list-style: none;
    overflow: hidden;
}

nav ul li a {
    display: block; 
    padding: 20px;
    color: #fff;
    text-decoration: none;
    font-size: 20px;
}


form {
    background-color: white;
    width: 500px;
    margin-top: 100px;
    margin:  auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
}

input[type="text"] {
    width: 90%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: red;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #3E8E41;
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

.error {
    color: red;
}
</style>
</head>
<body>  

<?php
include "dades_connexio_BD.php";
include "classe_peli_genere.php";
include "classe_genere.php";
include "classe_pelicula.php";

// define variables and set to empty values
$idErr = "";
$id = ""; 

    
  if ($idErr != "") //Hi ha errors
  {
    $id = test_input($_POST["data"]);
  }
  else  //Les dades són correctes
  {
    $peli_genere = new peli_genere();
    $peli_genere -> inserir($servername,$username,$password,$id);
    $id="";
  }



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <?php $pelicula1=new pelicula();?> 
 Pelicula <select name="pelicula" id="pelicula">
<?php
$resultat =$pelicula1->consultaTots("localhost","root","iesmanacor");
$res = $resultat->fetchAll(PDO::FETCH_ASSOC);
foreach ($res as $fila){
    echo "<option value='" .$fila["id"]. "'>".$fila["titol"]. "</option>";
    }
?>
  <span class="error">* <?php echo $peliculaErr;?></span>
</select>
  </input>
  <br>
  <?php $genere1=new genere();?> 
 Genere: <select name="genere" id="genere">
<?php
$resultat =$genere1->consultaTots("localhost","root","iesmanacor");
$res = $resultat->fetchAll(PDO::FETCH_ASSOC);
foreach ($res as $fila){
    echo "<option value='" .$fila["id"]. "'>".$fila["nom"]. "</option>";
    }
?>
  <span class="error">* <?php echo $genereErr;?></span>
</select>
  <input type="submit" name="submit" value="Submit"> 
  </input>
</form>



<?php
/*
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
*/
?>

</body>
</html>