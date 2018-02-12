<?php require_once('../../../Connections/Mundo_Download.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Re_Home = 10;
$pageNum_Re_Home = 0;
if (isset($_GET['pageNum_Re_Home'])) {
  $pageNum_Re_Home = $_GET['pageNum_Re_Home'];
}
$startRow_Re_Home = $pageNum_Re_Home * $maxRows_Re_Home;

mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Re_Home = "SELECT * FROM conteudo_filmes WHERE status = 'Ativado' AND conteudo_filmes.idioma = 'Dublado' AND conteudo_filmes.ano <> 'antigo' AND conteudo_filmes.genero <> 'shows' ORDER BY id DESC";
$query_limit_Re_Home = sprintf("%s LIMIT %d, %d", $query_Re_Home, $startRow_Re_Home, $maxRows_Re_Home);
$Re_Home = mysql_query($query_limit_Re_Home, $Mundo_Download) or die(mysql_error());
$row_Re_Home = mysql_fetch_assoc($Re_Home);

if (isset($_GET['totalRows_Re_Home'])) {
  $totalRows_Re_Home = $_GET['totalRows_Re_Home'];
} else {
  $all_Re_Home = mysql_query($query_Re_Home);
  $totalRows_Re_Home = mysql_num_rows($all_Re_Home);
}
$totalPages_Re_Home = ceil($totalRows_Re_Home/$maxRows_Re_Home)-1;

$queryString_Re_Home = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Re_Home") == false && 
        stristr($param, "totalRows_Re_Home") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Re_Home = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Re_Home = sprintf("&totalRows_Re_Home=%d%s", $totalRows_Re_Home, $queryString_Re_Home);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Home</title>

<link href="../../estrutura_css/filmes_categorias.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

</head>

<body>

<?php if ($row_Re_Home > 0) { // Show if recordset not empty ?>
<div id="geral-home">

<?php do { ?>
<div id="home">
      
<div id="home-img">
        
<div id="texto-home-img">
          
     <a href="../../../index.php?pag=filmes&amp;id=<?php echo $row_Re_Home['id']; ?>" class="texto-home-img">
     <span class="texto-home-img">Baixar Filme </span>
     <span class="texto-home-img"><?php echo $row_Re_Home['titulo']; ?></span>
     <span class="texto-home-img"> – </span>
     <span class="texto-home-img"><?php echo $row_Re_Home['idioma']; ?></span></a>        
     
</div> <!-- Fim da div "texto-home-img" -->
        
<div id="texto-postado-dia-home-img">
          
     <span class="texto-postado-dia-home-img">Postado dia: </span>
     <span class="texto-data-home-img"><?php echo $row_Re_Home['data_da_postagem']; ?></span>        

</div> <!-- Fim da div "texto-postado-dia-home-img" -->
      
</div> <!-- Fim da div "home-img" -->
<div class="clear"></div>
    
<div id="home-conteudo">
  
<div id="home-img-filmes">     

<a href="../../../index.php?pag=filmes&amp;id=<?php echo $row_Re_Home['id']; ?>" class="img-filmes-link"><img src="../../../conteudo/filmes/img/<?php echo $row_Re_Home['imagem']; ?>" width="220" height="310" border="0" /></a>

</div> <!-- Fim da div "home-img-filmes" -->
  
<div id="home-sinopse">   

     <span class="sinopse">Sinopse: </span>
     <span class="texto-sinopse"><?php echo $row_Re_Home['sinopse']; ?></span>
                
<div class="clear"></div>
</div> <!-- Fim da div "home-sinopse" -->
  
<div id="dados-do-filme">    

     <span class="dados-do-filme">Dados do Filme:</span>
     <p>
     <span class="texto2-dados-do-filme"><?php echo $row_Re_Home['dados_do_filme']; ?></span>

</div> <!-- Fim da div "dados-do-filme" -->
  
<div id="home-box">
    
<div id="home-box-esquerda">   

     <a href="../../../index.php?pag=filmes&amp;id=<?php echo $row_Re_Home['id']; ?>"><img src="../../estrutura_img/Pasta de download - IMG.png" width="66" height="49" border="0" align="right" /></a>   

</div> <!-- Fim da div "home-box-esquerda" -->
    
<div id="home-box-centro"> 

     <span class="baixar-gratis-texto-box">Baixar Grátis</span>
     </p>
     <span class="titulo-texto-box"><a href="../../../index.php?pag=filmes&amp;id=<?php echo $row_Re_Home['id']; ?>"  class="titulo-texto-box"><?php echo $row_Re_Home['titulo']; ?></a></span>     

</div> <!-- Fim da div "home-box-centro" -->
    
<div id="home-box-direita">   

     <a href="../../../index.php?pag=filmes&amp;id=<?php echo $row_Re_Home['id']; ?>"><img src="../../estrutura_img/Baixar -IMG.png" width="110" height="49" border="0" align="left" /></a>   

</div> <!-- Fim da div "home-box-direita" -->

<div class="clear"></div>    
</div> <!-- Fim da div "home-box" -->

<br />  

</div> <!-- Fim da div "home-conteudo" -->
        
</div> <!-- Fim da div "home" -->
<?php } while ($row_Re_Home = mysql_fetch_assoc($Re_Home)); ?>



<table border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>
<div id="paginacao">

<?php if ($pageNum_Re_Home > 0) { // Show if not first page ?> 
<div id="paginacao-um"> 

<a href="<?php printf("%s?pageNum_Re_Home=%d%s", $currentPage, 0, $queryString_Re_Home); ?> " class="texto-primeiro-ultimo-link-paginacao"><strong>« Primeira</strong></a>
 
</div> <!-- Fim da div "paginacao-um" -->
<?php } // Show if not first page ?>

<?php if ($pageNum_Re_Home > 0) { // Show if not first page ?>

<div id="paginacao-dois">

<?php if ($pageNum_Re_Home > 0) { // Show if not first page ?>

<a href="<?php printf("%s?pageNum_Re_Home=%d%s", $currentPage, max(0, $pageNum_Re_Home - 1), $queryString_Re_Home); ?>" class="texto-link-paginacao"><strong>« Páginas Anteriores</strong></a>

<?php } // Show if not first page ?>

</div> <!-- Fim da div "paginacao-dois" -->
<?php } // Show if not first page ?>


<?php if ($totalPages_Re_Home) { // Não mostrar quando, tiver menos de 11 resultados ?>
<div id="paginacao-tres">
    
<span class="texto-paginacao"><strong>Página</strong></span>
<span class="texto-paginacao"><strong><?php echo ($pageNum_Re_Home + 1) ?></strong></span>
<span class="texto-paginacao"><strong>de</strong></span>
<span class="texto-paginacao"><strong><?php echo ($totalPages_Re_Home + 1)?> </strong></span>    
    
</div> <!-- Fim da div "paginacao-tres" -->
<?php } // Não mostrar quando, tiver menos de 11 resultados ?> 


<?php if ($pageNum_Re_Home < $totalPages_Re_Home) { // Show if not last page ?>
<div id="paginacao-quatro">

<?php if ($pageNum_Re_Home < $totalPages_Re_Home) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_Re_Home=%d%s", $currentPage, min($totalPages_Re_Home, $pageNum_Re_Home + 1), $queryString_Re_Home); ?>" class="texto-link-paginacao"><strong>Próximas Páginas »</strong></a>
      <?php } // Show if not last page ?>

</div> <!-- Fim da div "paginacao-quatro" -->
<?php } // Show if not last page ?>


<?php if ($pageNum_Re_Home < $totalPages_Re_Home) { // Show if not last page ?>
<div id="paginacao-cinco"> 

<a href="<?php printf("%s?pageNum_Re_Home=%d%s", $currentPage, $totalPages_Re_Home, $queryString_Re_Home); ?>" class="texto-primeiro-ultimo-link-paginacao"><strong>Última »</strong></a> 

</div> <!-- Fim da div "paginacao-cinco" -->
<?php } // Show if not last page ?>

<div class="clear"></div>
</div> <!-- Fim da div "paginacao" -->
</td>
</tr>
</table>



</div> <!-- Fim da div "geral-home" -->
<?php } // Show if recordset not empty ?>

</body>
</html>
<?php
mysql_free_result($Re_Home);
?>