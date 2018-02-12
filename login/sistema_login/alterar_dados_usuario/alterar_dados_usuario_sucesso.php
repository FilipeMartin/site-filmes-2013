<?php require_once('../../../Connections/Mundo_Download.php'); ?>
<?php
// Load the tNG classes
require_once('../../../includes/tng/tNG.inc.php');

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

$colname_Rs_Dados_Alterados_Usuarios = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_Rs_Dados_Alterados_Usuarios = $_SESSION['kt_login_id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Rs_Dados_Alterados_Usuarios = sprintf("SELECT * FROM sistema_login WHERE id = %s", GetSQLValueString($colname_Rs_Dados_Alterados_Usuarios, "int"));
$Rs_Dados_Alterados_Usuarios = mysql_query($query_Rs_Dados_Alterados_Usuarios, $Mundo_Download) or die(mysql_error());
$row_Rs_Dados_Alterados_Usuarios = mysql_fetch_assoc($Rs_Dados_Alterados_Usuarios);
$totalRows_Rs_Dados_Alterados_Usuarios = mysql_num_rows($Rs_Dados_Alterados_Usuarios);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Admin</title>

<link href="../../admin/estrutura_css/sistema_login/alterar_dados_usuario_sucesso.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

</head>

<body>

<div id="geral">

<div id="conteudo">

<div id="dados-alterados">

<div id="titulo-dados-alterados">

      <span class="texto-titulo-dados-alterados">Dados alterados com Sucesso !</span>

</div> <!-- Fim da div "titulo-dados-alterados" -->

<p></p>

<div id="dados-usuarios">

     <p>
     <span class="texto-dados-usuarios-1-1">Seus novos dados são »</span>
     </p>
     
 <ul>

    <li>
        <p>
        <span class="texto-dados-usuarios">Nome: </span>
        <span class="texto-dados-usuarios-1"><?php echo $row_Rs_Dados_Alterados_Usuarios['nome']; ?></span>
        </p>
    </li>
     
    <li>
        <p>
        <span class="texto-dados-usuarios">Usuário: </span>
        <span class="texto-dados-usuarios-1"><?php echo $row_Rs_Dados_Alterados_Usuarios['usuario']; ?></span>
        </p>
    </li>
     
    <li>
        <p>
        <span class="texto-dados-usuarios">Email: </span>
        <span class="texto-dados-usuarios-1"><?php echo $row_Rs_Dados_Alterados_Usuarios['email']; ?></span>
        </p>
    </li>

    <li>
       <p>
       <span class="texto-dados-usuarios">Senha: </span>
       <span class="texto-dados-usuarios-1">********</span>
       </p>
    </li>
    
    <li>
       <p>
       <span class="texto-dados-usuarios">Conta criada: </span>
       <span class="texto-dados-usuarios-1"><?php echo $row_Rs_Dados_Alterados_Usuarios['data']; ?></span>
       </p>
    </li>

 </ul>

</div> <!-- Fim da div "dados-usuarios" -->

<input type="submit" name="botao-continuar" id="botao-continuar" onclick="parent.location.href='../login/index_admin.php?pag=adicionar_filmes'" title="Clique aqui para Continuar" value="Continuar »" />
<div class="clear"></div>

</div> <!-- Fim da div "dados-alterados" -->

</div> <!-- Fim da div "conteudo" -->

</div> <!-- Fim da div "geral" -->

</body>
</html>
<?php
mysql_free_result($Rs_Dados_Alterados_Usuarios);
?>
