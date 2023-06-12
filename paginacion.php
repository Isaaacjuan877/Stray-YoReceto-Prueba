
<?php
try{
	$conexion=new PDO ('mysql: host=localhost;dbname=stray','root','');
}catch(PDOExeception $e){
	echo 'ERROR: ' . $e->getMessage();
	die();
}


$pagina=isset($_GET['pagina'])?(int)$_GET['pagina']:1;
$postPorPagina=3;
$inicio=($pagina>1)?($pagina*$postPorPagina - $postPorPagina):0;
$stray=$conn->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM perdidos LIMIT $inicio, $postPorPagina");
$stray->execute();
$stray=$stray->fetchAll();
if (!$stray) {
	header('Location: http://localhost/Estilos/');
}
$totalArticulos=$conn->query("SELECT FOUND_ROWS()as total");
$totalArticulos=$totalArticulos->fetch()['total'];
$numeroPaginas= ceil($totalArticulos/$postPorPagina);
include 'index.php';

?>