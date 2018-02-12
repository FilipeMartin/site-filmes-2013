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

$colname_Re_links_filmes_online = "-1";
if (isset($_GET['id'])) {
  $colname_Re_links_filmes_online = $_GET['id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Re_links_filmes_online = sprintf("SELECT * FROM conteudo_filmes WHERE id = %s", GetSQLValueString($colname_Re_links_filmes_online, "int"));
$Re_links_filmes_online = mysql_query($query_Re_links_filmes_online, $Mundo_Download) or die(mysql_error());
$row_Re_links_filmes_online = mysql_fetch_assoc($Re_links_filmes_online);
$totalRows_Re_links_filmes_online = mysql_num_rows($Re_links_filmes_online);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Admin</title>

<link href="../../../estrutura_css/filmes/links_filmes_online.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

</head>

<body>

<?php if ($totalRows_Re_links_filmes_online> 0) { // Show if recordset not empt ?>
<div id="geral">

<div id="conteudo">
     
     <span class="t-f-2">Assitir Filme Online Grátis - </span>
     <span class="t-f-2"><?php echo $row_Re_links_filmes_online['idioma']; ?></span>
     <p></p>
     <?php echo $row_Re_links_filmes_online['links_filmes_online']; ?>

</div> <!-- Fim da div "conteudo" -->

</div> <!-- Fim da div "geral" -->
<?php } // Show if recordset not empt ?>

</body>
</html>
<?php
mysql_free_result($Re_links_filmes_online);
?>
