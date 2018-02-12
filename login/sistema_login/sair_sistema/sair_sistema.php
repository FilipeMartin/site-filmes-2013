<?php require_once('../../../Connections/Mundo_Download.php'); ?>
<?php
// Load the common classes
require_once('../../../includes/common/KT_common.php');

// Load the tNG classes
require_once('../../../includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../../../");

// Make unified connection variable
$conn_Mundo_Download = new KT_connection($Mundo_Download, $database_Mundo_Download);

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_Mundo_Download, "../../../");
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

$colname_Rs_Dados_Usuarios_Sair = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_Rs_Dados_Usuarios_Sair = $_SESSION['kt_login_id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Rs_Dados_Usuarios_Sair = sprintf("SELECT * FROM sistema_login WHERE id = %s", GetSQLValueString($colname_Rs_Dados_Usuarios_Sair, "int"));
$Rs_Dados_Usuarios_Sair = mysql_query($query_Rs_Dados_Usuarios_Sair, $Mundo_Download) or die(mysql_error());
$row_Rs_Dados_Usuarios_Sair = mysql_fetch_assoc($Rs_Dados_Usuarios_Sair);
$totalRows_Rs_Dados_Usuarios_Sair = mysql_num_rows($Rs_Dados_Usuarios_Sair);

// Make a logout transaction instance
$logoutTransaction = new tNG_logoutTransaction($conn_Mundo_Download);
$tNGs->addTransaction($logoutTransaction);
// Register triggers
$logoutTransaction->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "GET", "KT_logout_now");
$logoutTransaction->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../../login.php");
// Add columns
// End of logout transaction instance

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscustom = $tNGs->getRecordset("custom");
$row_rscustom = mysql_fetch_assoc($rscustom);
$totalRows_rscustom = mysql_num_rows($rscustom);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Admin</title>

<link href="../../admin/estrutura_css/sistema_login/sair_sistema.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

<link href="../../../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../../../includes/common/js/base.js" type="text/javascript"></script>
<script src="../../../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../../../includes/skins/style.js" type="text/javascript"></script>

</head>

<body>

<div id="geral">

<div id="pg">

<div id="conteudo">

<div id="topo-sair-sistema">

      <span class="texto-topo"><?php echo $row_Rs_Dados_Usuarios_Sair['usuario']; ?>, você tem certeza em sair do sistema ?</span>

</div> <!-- Fim da div "topo-sair-sistema" -->

<div id="area-botao-sim">

<input name="botao-sim" id="botao-sim" type="button" onclick="parent.location.href='<?php echo $logoutTransaction->getLogoutLink(); ?>'" title="Sim - Sair do Sistema" value="Sim">

</div> <!-- Fim da div "area-botao-sim" -->

<div id="area-botao-nao">

<input name="botao-nao" id="botao-nao" type="button" onclick="parent.location.href='../login/index_admin.php?pag=adicionar_filmes'" title="Não - Sair do Sistema" value="Não">

</div> <!-- Fim da div "area-botao-nao" -->

</div> <!-- Fim da div "conteudo" -->

</div> <!-- Fim da div "pg" -->

</div> <!-- Fim da div "geral" -->

</body>
</html>
<?php
mysql_free_result($Rs_Dados_Usuarios_Sair);
?>
