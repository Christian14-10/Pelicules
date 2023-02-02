<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
include "dades_connexio_BD.php";
include "classe_cine.php";
include "classe_ciutat.php";

// define variables and set to empty values
$nameErr =$ciutatErr ="";
$name =$ciutat = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
      } 
      else
      {
        $gender = test_input($_POST["gender"]);
      }
  }
  if ($nameErr != "") //Hi ha errors
  {
    $name = test_input($_POST["name"]);
  }
  else  //Les dades són correctes
  {
    $cine = new cine();
    $cine -> inserir($servername,$username,$password,$name);
    $name="";
  }

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<?php $ciutat1=new ciutat(); ?> 
<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <input type="submit" name="submit" value="Submit">  
  Ciutat:<select type="text" name="ciutat" value="<?php echo $nom;?>">
  <span class="error">* <?php echo $ciutatErr;?></span>
<?php foreach ($arrayValues as $name){
    echo "<option>";
    foreach ($name as $key => $val){
        echo "<td>$val</td>";
    }
    echo "</option>\n";
}?>
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