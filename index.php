<?php
require 'conexion.php';

$pagina=isset($_GET['pagina'])?(int)$_GET['pagina']:1;
$postPorPagina=10;
$inicio=($pagina>1)?($pagina*$postPorPagina - $postPorPagina):0;
$query=$conn->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM recetas LIMIT $inicio, $postPorPagina");
$query->execute();
$query=$query->fetchAll();
if (!$query) {
 	header('Location: http://localhost/STRAY-PRUEBA_YORECETO/');
}
$totalArticulos=$conn->query("SELECT FOUND_ROWS()as total");
$totalArticulos=$totalArticulos->fetch()['total'];
$numeroPaginas= ceil($totalArticulos/$postPorPagina);
include 'index.view.php';


?>



