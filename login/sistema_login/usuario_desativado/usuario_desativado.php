<?php require_once('../../../Connections/Mundo_Download.php'); ?>
<?php
// Load the tNG classes
require_once('../../../includes/tng/tNG.inc.php');

// Make unified connection variable
$conn_Mundo_Download = new KT_connection($Mundo_Download, $database_Mundo_Download);

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_Mundo_Download, "../../../");
//Grand Levels: Level
$restrict->addLevel("Desativado");
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

$colname_Rs_Usuario_Desativado = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_Rs_Usuario_Desativado = $_SESSION['kt_login_id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Rs_Usuario_Desativado = sprintf("SELECT * FROM sistema_login WHERE id = %s", GetSQLValueString($colname_Rs_Usuario_Desativado, "int"));
$Rs_Usuario_Desativado = mysql_query($query_Rs_Usuario_Desativado, $Mundo_Download) or die(mysql_error());
$row_Rs_Usuario_Desativado = mysql_fetch_assoc($Rs_Usuario_Desativado);
$totalRows_Rs_Usuario_Desativado = mysql_num_rows($Rs_Usuario_Desativado);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Admin</title>
<link rel="shortcut icon" type="image/x-icon" href="http://www.mundodownload.net/paginas/estrutura_img/Fivicon/favicon.ico" />

<link href="../../admin/estrutura_css/sistema_login/usuario_desativado.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

</head>

<body>

<div id="geral">

<div id="pg">

<div id="conteudo">

<div id="titulo-usuario-desativado">

      <span class="texto-titulo-usuario-desativado">Usuário Desativado !</span>

</div> <!-- Fim da div "titulo-usuario-desativado" -->

<div id="texto-principal">

     <span class="texto-principal-1">OBS :</span>
     <p></p> 
          
     <span class="texto-principal-2"><?php echo $row_Rs_Usuario_Desativado['nome']; ?></span>
     
     <span class="texto-principal-3">, você é um usuário desativado e não pode acessar esta página, entre em contato com o administrador do site:</span>    

     <p>
     <input type="text" name="email" id="email" title="Copiar o email - mundo-download@hotmail.com" value="mundo-download@hotmail.com" size="50" />
     </p>

</div> <!-- Fim da div "texto-principa" -->

<div id="img-principal">

</div> <!-- Fim da div "img-principa" -->

<input type="submit" name="botao-voltar" id="botao-voltar" onclick="parent.location.href='http://www.mundodownload.net/login.php'" title="Clique aqui para Voltar" value="« Voltar" />

<div class="clear"></div>
</div> <!-- Fim da div "conteudo" -->

</div> <!-- Fim da div "pg" -->

</div> <!-- Fim da div "geral" -->

</body>
</html>
<?php
mysql_free_result($Rs_Usuario_Desativado);
?>
