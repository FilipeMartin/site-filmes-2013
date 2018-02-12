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

$maxRows_Re_Home_Series = 10;
$pageNum_Re_Home_Series = 0;
if (isset($_GET['pageNum_Re_Home_Series'])) {
  $pageNum_Re_Home_Series = $_GET['pageNum_Re_Home_Series'];
}
$startRow_Re_Home_Series = $pageNum_Re_Home_Series * $maxRows_Re_Home_Series;

$buscar_series_Re_Home_Series = "-1";
if (isset($_GET['buscaseries'])) {
  $buscar_series_Re_Home_Series = $_GET['buscaseries'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Re_Home_Series = sprintf("SELECT * FROM conteudo_seriados WHERE status = 'Ativado' AND conteudo_seriados.titulo LIKE %s OR conteudo_seriados.sinopse LIKE %s AND conteudo_seriados.status = 'Ativado' ORDER BY id DESC", GetSQLValueString("%" . $buscar_series_Re_Home_Series . "%", "text"),GetSQLValueString("%" . $buscar_series_Re_Home_Series . "%", "text"));
$query_limit_Re_Home_Series = sprintf("%s LIMIT %d, %d", $query_Re_Home_Series, $startRow_Re_Home_Series, $maxRows_Re_Home_Series);
$Re_Home_Series = mysql_query($query_limit_Re_Home_Series, $Mundo_Download) or die(mysql_error());
$row_Re_Home_Series = mysql_fetch_assoc($Re_Home_Series);

if (isset($_GET['totalRows_Re_Home_Series'])) {
  $totalRows_Re_Home_Series = $_GET['totalRows_Re_Home_Series'];
} else {
  $all_Re_Home_Series = mysql_query($query_Re_Home_Series);
  $totalRows_Re_Home_Series = mysql_num_rows($all_Re_Home_Series);
}
$totalPages_Re_Home_Series = ceil($totalRows_Re_Home_Series/$maxRows_Re_Home_Series)-1;

$queryString_Re_Home_Series = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Re_Home_Series") == false && 
        stristr($param, "totalRows_Re_Home_Series") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Re_Home_Series = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Re_Home_Series = sprintf("&totalRows_Re_Home_Series=%d%s", $totalRows_Re_Home_Series, $queryString_Re_Home_Series);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Home</title>

<link href="../../estrutura_css/pesquisar_series.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

</head>

<body>

<div id="geral-home">

<table width="479" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="middle">
	<?php if($row_Re_Home_Series['titulo']<='0') {?>
    <span class="resultado-nao-encontrado">Nenhum resultado para o termo pesquisado.</span>      
	<?php }else {?>    
    </td>
  </tr>
</table>

<?php do { ?>
<div id="home">
      
<div id="home-img">
        
<div id="texto-home-img">
          
     <a href="../../../index.php?pag=series&amp;id=<?php echo $row_Re_Home_Series['id']; ?>" class="texto-home-img">
     <span class="texto-home-img"><?php echo $row_Re_Home_Series['titulo']; ?></span></a>      
     
</div> <!-- Fim da div "texto-home-img" -->
<br />

<div class="clear"></div>
<div id="texto-home-img-1"> 

     <a href="../../../index.php?pag=series&amp;id=<?php echo $row_Re_Home_Series['id']; ?>" class="texto-home-img-1">
     <span class="texto-home-img">Todas as Temporadas – Dublado / Legendado</span></a>

</div> <!-- Fim da div "texto-home-img-1" -->
        
<div id="texto-postado-dia-home-img">
          
     <span class="texto-postado-dia-home-img">Postado dia: </span>
     <span class="texto-data-home-img"><?php echo $row_Re_Home_Series['data_da_postagem']; ?></span>        

</div> <!-- Fim da div "texto-postado-dia-home-img" -->
      
</div> <!-- Fim da div "home-img" -->
<div class="clear"></div>
    
<div id="home-conteudo">
  
<div id="home-img-series">     

<a href="../../../index.php?pag=series&amp;id=<?php echo $row_Re_Home_Series['id']; ?>" class="img-series-link"><img src="../../../conteudo/seriados/img/<?php echo $row_Re_Home_Series['imagem']; ?>" width="220" height="310" border="0" /></a></div> 
<!-- Fim da div "home-img-series" -->
  
<div id="home-sinopse">   

     <span class="sinopse">Sinopse: </span>
     <span class="texto-sinopse"><?php echo $row_Re_Home_Series['sinopse']; ?></span>
                
<div class="clear"></div>
</div> <!-- Fim da div "home-sinopse" -->
  
<div id="dados-da-serie">    

     <span class="dados-da-serie">Dados da Série:</span>
     <p>
     <span class="texto2-dados-da-serie"><?php echo $row_Re_Home_Series['dados_do_seriado']; ?></span>

</div> <!-- Fim da div "dados-da-serie" -->
  
<div id="home-box">
    
<div id="home-box-esquerda">   

     <a href="../../../index.php?pag=series&amp;id=<?php echo $row_Re_Home_Series['id']; ?>"><img src="../../estrutura_img/Pasta de download - IMG.png" width="66" height="49" border="0" align="right" /></a>   

</div> <!-- Fim da div "home-box-esquerda" -->
    
<div id="home-box-centro"> 

     <span class="baixar-gratis-texto-box">Assistir Online - Grátis</span>
     </p>
     <span class="titulo-texto-box"><a href="../../../index.php?pag=series&amp;id=<?php echo $row_Re_Home_Series['id']; ?>"  class="titulo-texto-box"><?php echo $row_Re_Home_Series['titulo']; ?></a></span>     

</div> <!-- Fim da div "home-box-centro" -->
    
<div id="home-box-direita">   

     <a href="../../../index.php?pag=series&amp;id=<?php echo $row_Re_Home_Series['id']; ?>"><img src="../..//estrutura_img/Baixar -IMG.png" width="110" height="49" border="0" align="left" /></a>   

</div> <!-- Fim da div "home-box-direita" -->

<div class="clear"></div>    
</div> <!-- Fim da div "home-box" -->

<br />  

</div> <!-- Fim da div "home-conteudo" -->
        
</div> <!-- Fim da div "home" -->
<?php } while ($row_Re_Home_Series = mysql_fetch_assoc($Re_Home_Series)); ?>



<table border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>
<div id="paginacao">

<?php if ($pageNum_Re_Home_Series > 0) { // Show if not first page ?> 
<div id="paginacao-um"> 

<a href="<?php printf("%s?pageNum_Re_Home_Series=%d%s", $currentPage, 0, $queryString_Re_Home_Series); ?> " class="texto-primeiro-ultimo-link-paginacao"><strong>« Primeira</strong></a>
 
</div> <!-- Fim da div "paginacao-um" -->
<?php } // Show if not first page ?>

<?php if ($pageNum_Re_Home_Series > 0) { // Show if not first page ?>

<div id="paginacao-dois">

<?php if ($pageNum_Re_Home_Series > 0) { // Show if not first page ?>

<a href="<?php printf("%s?pageNum_Re_Home_Series=%d%s", $currentPage, max(0, $pageNum_Re_Home_Series - 1), $queryString_Re_Home_Series); ?>" class="texto-link-paginacao"><strong>« Páginas Anteriores</strong></a>

<?php } // Show if not first page ?>

</div> <!-- Fim da div "paginacao-dois" -->
<?php } // Show if not first page ?>


<?php if ($totalPages_Re_Home_Series) { // Não mostrar quando, tiver menos de 11 resultados ?>
<div id="paginacao-tres">
    
<span class="texto-paginacao"><strong>Página</strong></span>
<span class="texto-paginacao"><strong><?php echo ($pageNum_Re_Home_Series + 1) ?></strong></span>
<span class="texto-paginacao"><strong>de</strong></span>
<span class="texto-paginacao"><strong><?php echo ($totalPages_Re_Home_Series + 1)?> </strong></span>    
    
</div> <!-- Fim da div "paginacao-tres" -->
<?php } // Não mostrar quando, tiver menos de 11 resultados ?> 


<?php if ($pageNum_Re_Home_Series < $totalPages_Re_Home_Series) { // Show if not last page ?>
<div id="paginacao-quatro">

<?php if ($pageNum_Re_Home_Series < $totalPages_Re_Home_Series) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_Re_Home_Series=%d%s", $currentPage, min($totalPages_Re_Home_Series, $pageNum_Re_Home_Series + 1), $queryString_Re_Home_Series); ?>" class="texto-link-paginacao"><strong>Próximas Páginas »</strong></a>
      <?php } // Show if not last page ?>

</div> <!-- Fim da div "paginacao-quatro" -->
<?php } // Show if not last page ?>


<?php if ($pageNum_Re_Home_Series < $totalPages_Re_Home_Series) { // Show if not last page ?>
<div id="paginacao-cinco"> 

<a href="<?php printf("%s?pageNum_Re_Home_Series=%d%s", $currentPage, $totalPages_Re_Home_Series, $queryString_Re_Home_Series); ?>" class="texto-primeiro-ultimo-link-paginacao"><strong>Última »</strong></a> 

</div> <!-- Fim da div "paginacao-cinco" -->
<?php } // Show if not last page ?>

<div class="clear"></div>
</div> <!-- Fim da div "paginacao" -->
</td>
</tr>
<?php }?>
</table>



</div> <!-- Fim da div "geral-home" -->

</body>
</html>
<?php
mysql_free_result($Re_Home_Series);
?>