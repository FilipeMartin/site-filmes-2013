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
  $updateSQL = sprintf("UPDATE conteudo_seriados SET temporadas=%s WHERE id=%s",
                       GetSQLValueString($_POST['temporadas'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_Mundo_Download, $Mundo_Download);
  $Result1 = mysql_query($updateSQL, $Mundo_Download) or die(mysql_error());

  $updateGoTo = "../../../../index_admin.php?pag=adicionar_series_conteudo";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Rs_Temporadas = "-1";
if (isset($_GET['id'])) {
  $colname_Rs_Temporadas = $_GET['id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Rs_Temporadas = sprintf("SELECT * FROM conteudo_seriados WHERE id = %s", GetSQLValueString($colname_Rs_Temporadas, "int"));
$Rs_Temporadas = mysql_query($query_Rs_Temporadas, $Mundo_Download) or die(mysql_error());
$row_Rs_Temporadas = mysql_fetch_assoc($Rs_Temporadas);
$totalRows_Rs_Temporadas = mysql_num_rows($Rs_Temporadas);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Admin</title>

<link href="../../../estrutura_css/seriados/temporadas.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

</head>

<body>

<?php if ($totalRows_Rs_Temporadas > 0) { // Show if recordset not empt ?>
<div id="geral">
 
<div id="conteudo">
  <form action="<?php echo $editFormAction; ?>" target="_parent" method="post" name="form1" id="form1">
    <table align="center">
      <tr valign="baseline">
        <td align="right" valign="top" nowrap="nowrap">
          <textarea name="temporadas" >
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/1.php" target="t">1ª Temporada</a></p>
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/2.php" target="t">2ª Temporada</a></p>
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/3.php" target="t">3ª Temporada</a></p>
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/4.php" target="t">4ª Temporada</a></p>
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/5.php" target="t">5ª Temporada</a></p>
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/6.php" target="t">6ª Temporada</a></p>
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/7.php" target="t">7ª Temporada</a></p>
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/8.php" target="t">8ª Temporada</a></p>
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/9.php" target="t">9ª Temporada</a></p>
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/10.php" target="t">10ª Temporada</a></p>
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/11.php" target="t">11ª Temporada</a></p>
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/12.php" target="t">12ª Temporada</a></p>
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/13.php" target="t">13ª Temporada</a></p>
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/14.php" target="t">14ª Temporada</a></p>
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/15.php" target="t">15ª Temporada</a></p>
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/16.php" target="t">16ª Temporada</a></p>
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/17.php" target="t">17ª Temporada</a></p>
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/18.php" target="t">18ª Temporada</a></p>
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/19.php" target="t">19ª Temporada</a></p>
<a class="t-s" href="t/<?php echo $row_Rs_Temporadas['id']; ?>/20.php" target="t">20ª Temporada</a>
</textarea></td>
        </tr>
      <tr valign="baseline">
        <td align="center" valign="middle" nowrap="nowrap"><input type="submit" value="Adicionar" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="id" value="<?php echo $row_Rs_Temporadas['id']; ?>" />
  </form>
  <p>&nbsp;</p>
</div> <!-- Fim da div "conteudo" -->

</div> <!-- Fim da div "geral" -->
<?php } // Show if recordset not empt ?>

</body>
</html>
<?php
mysql_free_result($Rs_Temporadas);
?>
