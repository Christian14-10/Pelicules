<!DOCTYPE HTML>  
<html>
<head>
<style>
  form {
  width: 500px;
  margin: 50px auto;
  text-align: center;
  padding: 20px;
  background-color: lightgray;
  border-radius: 10px;
}

input[type="text"], input[type="email"], textarea {
  width: 100%;
  padding: 10px;
  margin-top: 10px;
  border-radius: 5px;
  border: none;
  font-size: 18px;
}

input[type="submit"] {
  width: 100%;
  padding: 10px;
  margin-top: 20px;
  background-color: blue;
  color: white;
  border-radius: 5px;
  border: none;
  font-size: 18px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: darkblue;
}
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
include "dades_connexio_BD.php";
include "classe_cine.php";
include "classe_pelicula.php";

// define variables and set to empty values
$dataErr = "";
$data = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["data"])) {
    $nameErr = "data is required";
  } else {
    $name = test_input($_POST["data"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$data)) {
      $dataErr = "Only letters and white space allowed";
    }
    
  }
  if ($dataErr != "") //Hi ha errors
  {
    $data = test_input($_POST["data"]);
  }
  else  //Les dades són correctes
  {
    $peli_cine = new peli_cine();
    $peli_cine -> eliminar($servername,$username,$password,$data);
    $data="";
  }


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
  date: <input type="date" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $dataErr;?></span>
<br>
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
  <?php $cine1=new cine();?> 
 Cine: <select name="cine" id="cine">
<?php
$resultat =$cine1->consultaTots("localhost","root","iesmanacor");
$res = $resultat->fetchAll(PDO::FETCH_ASSOC);
foreach ($res as $fila){
    echo "<option value='" .$fila["id"]. "'>".$fila["nom"]. "</option>";
    }
?>
  <span class="error">* <?php echo $cineErr;?></span>
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