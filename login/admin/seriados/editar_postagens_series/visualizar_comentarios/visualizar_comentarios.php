<?php require_once('../../../../../Connections/Mundo_Download.php'); ?>
<?php
// Load the tNG classes
require_once('../../../../../includes/tng/tNG.inc.php');

// Make unified connection variable
$conn_Mundo_Download = new KT_connection($Mundo_Download, $database_Mundo_Download);

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_Mundo_Download, "../../../../../");
//Grand Levels: Level
$restrict->addLevel("GM");
$restrict->addLevel("ADMIN");
$restrict->Execute();
//End Restrict Access To Page

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

$colname_Re_comentarios = "-1";
if (isset($_GET['id'])) {
  $colname_Re_comentarios = $_GET['id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Re_comentarios = sprintf("SELECT * FROM s_comentarios_series WHERE localizacao = %s AND s_comentarios_series.status = 'Aprovado' ORDER BY id ASC", GetSQLValueString($colname_Re_comentarios, "text"));
$Re_comentarios = mysql_query($query_Re_comentarios, $Mundo_Download) or die(mysql_error());
$row_Re_comentarios = mysql_fetch_assoc($Re_comentarios);
$totalRows_Re_comentarios = mysql_num_rows($Re_comentarios);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Admin</title>

<link href="../../../estrutura_css/seriados/visualizar_comentarios_series.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

</head>

<body>

<div id="geral">

<div id="conteudo">

<?php if ($totalRows_Re_comentarios == 0) { // Show if recordset not empti ?>
<div id="msg-sem-comentarios">

       <span class="texto-msg-sem-comentarios">Não há comentários nesta postagem.</span>

</div> <!-- Fim da div "msg-sem-comentarios" -->
<?php } // Show if recordset not empti ?>

<?php if ($totalRows_Re_comentarios > 0) { // Show if recordset not empt ?>
<div id="pg-comentarios">

<div id="atualizar-pg">

       <a href="visualizar_comentarios.php?id=<?php echo $row_Re_comentarios['localizacao']; ?>" title="Clique aqui, para atualizar" class="texto-atualizar-pg">Atualizar</a>

</div> <!-- Fim da div "atualizar-pg" -->
<div class="clear"></div>

<div id="comentarios-total">

       <span class="texto-comentarios-total">Total de Comentários: <?php echo $totalRows_Re_comentarios ?> </span>

</div> 
<!-- Fim da div "comentarios-total" -->

<?php do { ?>
<div id="box-comentarios-filmes">

<div id="barra-img">

<div id="nome-usuario">

       <span class="texto-nome-usuario"><?php echo $row_Re_comentarios['nome']; ?>  Diz:</span>

</div> <!-- Fim da div "nome-usuario" -->

<div id="data-comentario">

       <span class="texto-data-comentario"><?php echo $row_Re_comentarios['data']; ?></span>

</div> <!-- Fim da div "data-comentario" -->

</div> <!-- Fim da div "barra-img" -->

<div class="clear"></div>
<div id="editar-comentario">

            <input name="botao-editar-comentario" id="botao-editar-comentario"  type="button" onclick="window.open('../../../../index_admin.php?pag=alterar_comentarios_series&amp;id=<?php echo $row_Re_comentarios['id']; ?>')" title="Clique aqui, para editar o comentário" value="Editar Comentário »">

</div> <!-- Fim da div "editar-comentario" -->

<div id="mensagem-comentario">

       <span class="texto-mensagem-comentario"><?php echo $row_Re_comentarios['mensagem']; ?></span>

</div> <!-- Fim da div "mensagem-comentario" -->

<div class="clear"></div>
</div> <!-- Fim da div "box-comentarios-filmes" -->
<?php } while ($row_Re_comentarios = mysql_fetch_assoc($Re_comentarios)); ?>

</div> <!-- Fim da div "pg-comentarios" -->
<?php } // Show if recordset not empt ?>

</div> <!-- Fim da div "conteudo" -->

</div> <!-- Fim da div "geral" -->

</body>
</html>
<?php
mysql_free_result($Re_comentarios);
?>
