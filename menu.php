<html>
    <style>
nav {
  background-color: #333;
  color: #fff;
  height: 50px;
}

nav ul {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 100%;
}

nav ul li {
  margin: 0 10px;
}

nav ul li a {
  color: #fff;
  text-decoration: none;
  font-size: 18px;
  padding: 10px;
  display: block;
  height: 100%;
  transition: all 0.3s ease-in-out;
}

nav ul li a:hover {
  background-color: #fff;
  color: #333;
}
</style>

<?php
include "dades_connexio_BD.php";
include "classe_cine.php";
include "classe_ciutat.php";
include "classe_genere.php";
include "classe_peli_cine.php";
include "classe_peli_genere.php";
include "classe_pelicula.php";
?>
<nav>
  <ul>
    <li><a href="/form_alta_cine.php" target="_Blank">Alta_cine</a></li>
    <li><a href="/form_alta_ciutat.php" target="_Blank">Alta_ciutat</a></li>
    <li><a href="/form_alta_genere.php" target="_Blank">Alta_genere</a></li>
    <li><a href="/form_alta_pelicula.php" target="_Blank">Alta_pelicula</a></li>
    <li><a href="/form_alta_peli_cine.php" target="_Blank">Alta_peli_cine</a></li>
    <li><a href="/form_alta_peli_genere.php" target="_Blank">Alta_peli_genere</a></li>
  </ul>
</nav>
</html>