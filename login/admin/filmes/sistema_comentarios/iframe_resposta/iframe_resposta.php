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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE s_comentarios_filmes SET mensagem=%s WHERE id=%s",
                       GetSQLValueString(nl2br($_POST['mensagem']), "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_Mundo_Download, $Mundo_Download);
  $Result1 = mysql_query($updateSQL, $Mundo_Download) or die(mysql_error());

  $updateGoTo = "../../../../index_admin.php?pag=alterar_comentarios_filmes";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Rs_resposta = "-1";
if (isset($_GET['id'])) {
  $colname_Rs_resposta = $_GET['id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Rs_resposta = sprintf("SELECT * FROM s_comentarios_filmes WHERE id = %s", GetSQLValueString($colname_Rs_resposta, "int"));
$Rs_resposta = mysql_query($query_Rs_resposta, $Mundo_Download) or die(mysql_error());
$row_Rs_resposta = mysql_fetch_assoc($Rs_resposta);
$totalRows_Rs_resposta = mysql_num_rows($Rs_resposta);

$colname_Re_nome_admin = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_Re_nome_admin = $_SESSION['kt_login_id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Re_nome_admin = sprintf("SELECT * FROM sistema_login WHERE id = %s", GetSQLValueString($colname_Re_nome_admin, "int"));
$Re_nome_admin = mysql_query($query_Re_nome_admin, $Mundo_Download) or die(mysql_error());
$row_Re_nome_admin = mysql_fetch_assoc($Re_nome_admin);
$totalRows_Re_nome_admin = mysql_num_rows($Re_nome_admin);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Admin</title>

<link href="../../../estrutura_css/filmes/iframe_resposta_filmes.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

</head>

<body>

<?php if ($totalRows_Rs_resposta > 0) { // Show if recordset not empt ?>
<div id="geral">
 
<div id="conteudo">

  <form action="<?php echo $editFormAction; ?>" target="_parent" method="post" name="form1" id="form1">
    <table align="center">
      <tr valign="baseline">
        <td align="right" valign="top" nowrap="nowrap">
          <textarea name="mensagem" id="mensagem" cols="70" rows="12"><?php echo htmlentities($row_Rs_resposta['mensagem'], ENT_COMPAT, 'iso-8859-1'); ?><hr><span class="r-a">Admin <?php echo $row_Re_nome_admin['usuario']; ?> Diz:</span><p></p></textarea>        </td>
        </tr>
      <tr valign="baseline">
        <td align="center" valign="middle" nowrap="nowrap"><input type="submit" value="Responder" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="id" value="<?php echo $row_Rs_resposta['id']; ?>" />
  </form>
  <p>&nbsp;</p>
  
</div> <!-- Fim da div "conteudo" -->

</div> <!-- Fim da div "geral" -->
<?php } // Show if recordset not empt ?>

</body>
</html>
<?php
mysql_free_result($Rs_resposta);

mysql_free_result($Re_nome_admin);
?>
