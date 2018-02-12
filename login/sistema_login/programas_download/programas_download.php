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

$colname_Rs_Acesso_Admin = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_Rs_Acesso_Admin = $_SESSION['kt_login_id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Rs_Acesso_Admin = sprintf("SELECT * FROM sistema_login WHERE id = %s AND sistema_login.status = 'ADMIN'", GetSQLValueString($colname_Rs_Acesso_Admin, "int"));
$Rs_Acesso_Admin = mysql_query($query_Rs_Acesso_Admin, $Mundo_Download) or die(mysql_error());
$row_Rs_Acesso_Admin = mysql_fetch_assoc($Rs_Acesso_Admin);
$totalRows_Rs_Acesso_Admin = mysql_num_rows($Rs_Acesso_Admin);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Admin</title>

<link href="../../admin/estrutura_css/sistema_login/programas_download.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

</head>

<body>

<div id="geral">

<div id="pg">

<div id="conteudo">

<div id="topo-download-programas">

      <span class="texto-topo">Programas para Download</span>

</div> <!-- Fim da div "topo-download-programas" -->

<div id="area-programas">

<div id="img-programas">

      <img src="../../admin/estrutura_img/Programas - Download/Programas - Dreanweaver.png" title="Baixar - Dreamweaver CS3" width="111" height="108" border="0" />

</div> <!-- Fim da div "img-programas" -->

<div id="titulo-programas">

       <span class="texto-titulo-programas">Dreamweaver CS3</span>   

</div> <!-- Fim da div "titulo-programas" -->

<div id="dados-programas">

     <span class="texto-dados-programas-1">Dados do Programa:</span>
     <br />
     <span class="texto-dados-programas-2">Tamanho: </span>
     <span class="texto-dados-programas-3">291 MB</span>
     <br />
     <span class="texto-dados-programas-2">Formato: </span>
     <span class="texto-dados-programas-3">WinRAR - Rar</span>
     <br />
     <span class="texto-dados-programas-2">Nome: </span>
     <span class="texto-dados-programas-3">Adobe - Dreamweaver CS3</span>
     <br />
     <span class="texto-dados-programas-2">Ano de Lançamento: </span>
     <span class="texto-dados-programas-3">2007</span>
     <br />
     <?php if ($totalRows_Rs_Acesso_Admin > 0) { // Mostrar senha ADMIN ?>
     <span class="texto-dados-programas-2">Senha: </span>
     <span class="texto-dados-programas-3">244260041993</span>
     <?php } // Mostrar senha ADMIN ?>

</div> <!-- Fim da div "dados-programa" -->

<div id="area-botao-download">

     <input type="submit" name="botao-download" id="botao-download" onclick="window.open('https://dl.dropbox.com/s/l0h0h8q7awgkskj/Adobe%20Dreamweaver%20CS3.rar?token_hash=AAFh47YHAQYxiIcfNR0yiDVxvsIOJGSOw968GkZ8-jRbVQ&dl=1')" title="Clique aqui, para fazer o Download" value="Download »" />

</div> <!-- Fim da div "area-botao-download" -->

</div> <!-- Fim da div "area-programas" -->

<div class="clear"></div>

<div id="area-programas">

<div id="img-programas">

      <img src="../../admin/estrutura_img/Programas - Download/Programas - Fireworks.png" title="Baixar - Fireworks CS3" width="111" height="108" border="0" />

</div> <!-- Fim da div "img-programas" -->

<div id="titulo-programas">

       <span class="texto-titulo-programas">Fireworks CS3</span>   

</div> <!-- Fim da div "titulo-programas" -->

<div id="dados-programas">

     <span class="texto-dados-programas-1">Dados do Programa:</span>
     <br />
     <span class="texto-dados-programas-2">Tamanho: </span>
     <span class="texto-dados-programas-3">229 MB</span>
     <br />
     <span class="texto-dados-programas-2">Formato: </span>
     <span class="texto-dados-programas-3">WinRAR - Rar</span>
     <br />
     <span class="texto-dados-programas-2">Nome: </span>
     <span class="texto-dados-programas-3">Adobe - Fireworks CS3</span>
     <br />
     <span class="texto-dados-programas-2">Ano de Lançamento: </span>
     <span class="texto-dados-programas-3">2007</span>
     <br />
     <?php if ($totalRows_Rs_Acesso_Admin > 0) { // Mostrar senha ADMIN ?>
     <span class="texto-dados-programas-2">Senha: </span>
     <span class="texto-dados-programas-3">244260041993</span>
     <?php } // Mostrar senha ADMIN ?>

</div> <!-- Fim da div "dados-programa" -->

<div id="area-botao-download">

     <input type="submit" name="botao-download" id="botao-download" onclick="window.open('https://dl.dropbox.com/s/vw3v70jquhn98ha/Adobe%20Fireworks%20CS3.rar?token_hash=AAGY4hW_ynuJ1mKkAQp4hmyVh3Nn6M5g0bUgx62N4au5tA&dl=1')" title="Clique aqui, para fazer o Download" value="Download »" />

</div> <!-- Fim da div "area-botao-download" -->

</div> <!-- Fim da div "area-programas" -->

<div class="clear"></div>

<div id="area-programas">

<div id="img-programas">

      <img src="../../admin/estrutura_img/Programas - Download/Programas - Flash.png" title="Baixar - Flash CS3 - Professional" width="111" height="108" border="0" />

</div> <!-- Fim da div "img-programas" -->

<div id="titulo-programas">

       <span class="texto-titulo-programas">Flash CS3 - Professional</span>   

</div> <!-- Fim da div "titulo-programas" -->

<div id="dados-programas">

     <span class="texto-dados-programas-1">Dados do Programa:</span>
     <br />
     <span class="texto-dados-programas-2">Tamanho: </span>
     <span class="texto-dados-programas-3">410 MB</span>
     <br />
     <span class="texto-dados-programas-2">Formato: </span>
     <span class="texto-dados-programas-3">WinRAR - Rar</span>
     <br />
     <span class="texto-dados-programas-2">Nome: </span>
     <span class="texto-dados-programas-3">Adobe - Flash CS3 - Professional</span>
     <br />
     <span class="texto-dados-programas-2">Ano de Lançamento: </span>
     <span class="texto-dados-programas-3">2007</span>
     <br />
     <?php if ($totalRows_Rs_Acesso_Admin > 0) { // Mostrar senha ADMIN ?>
     <span class="texto-dados-programas-2">Senha: </span>
     <span class="texto-dados-programas-3">244260041993</span>
     <?php } // Mostrar senha ADMIN ?>

</div> <!-- Fim da div "dados-programa" -->

<div id="area-botao-download">

     <input type="submit" name="botao-download" id="botao-download" onclick="window.open('https://dl.dropbox.com/s/ykx8awo52oghptn/Adobe%20Flash%20CS3.rar?token_hash=AAF_EMOyE3r5pUVHttYVHt7eK31nwBDEpapzcgOIlZ0CRg&dl=1')" title="Clique aqui, para fazer o Download" value="Download »" />

</div> <!-- Fim da div "area-botao-download" -->

</div> <!-- Fim da div "area-programas" -->

<div class="clear"></div>

<div id="area-programas">

<div id="img-programas">

      <img src="../../admin/estrutura_img/Programas - Download/Programas - Photoshop.png" title="Baixar - Photoshop CS3" width="111" height="108" border="0" />

</div> <!-- Fim da div "img-programas" -->

<div id="titulo-programas">

       <span class="texto-titulo-programas">Photoshop CS3</span>   

</div> <!-- Fim da div "titulo-programas" -->

<div id="dados-programas">

     <span class="texto-dados-programas-1">Dados do Programa:</span>
     <br />
     <span class="texto-dados-programas-2">Tamanho: </span>
     <span class="texto-dados-programas-3">49,2 MB</span>
     <br />
     <span class="texto-dados-programas-2">Formato: </span>
     <span class="texto-dados-programas-3">WinRAR - Rar</span>
     <br />
     <span class="texto-dados-programas-2">Nome: </span>
     <span class="texto-dados-programas-3">Adobe - Photoshop CS3</span>
     <br />
     <span class="texto-dados-programas-2">Ano de Lançamento: </span>
     <span class="texto-dados-programas-3">2007</span>
     <br />
     <?php if ($totalRows_Rs_Acesso_Admin > 0) { // Mostrar senha ADMIN ?>
     <span class="texto-dados-programas-2">Senha: </span>
     <span class="texto-dados-programas-3">244260041993</span>
     <?php } // Mostrar senha ADMIN ?>

</div> <!-- Fim da div "dados-programa" -->

<div id="area-botao-download">

     <input type="submit" name="botao-download" id="botao-download" onclick="window.open('https://dl.dropbox.com/s/tjksgwlq67nq0e9/Photoshop%20CS3.rar?token_hash=AAHgA8C95KwL_bVxuu6mb86ig0LK8OhMO-azMBoAaNUKwg&dl=1')" title="Clique aqui, para fazer o Download" value="Download »" />

</div> <!-- Fim da div "area-botao-download" -->

</div> <!-- Fim da div "area-programas" -->

<div class="clear"></div>

<div id="area-programas">

<div id="img-programas">

      <img src="../../admin/estrutura_img/Programas - Download/Programas - FileZilla.png" title="Baixar - FileZilla" width="111" height="108" border="0" />

</div> <!-- Fim da div "img-programas" -->

<div id="titulo-programas">

       <span class="texto-titulo-programas">FileZilla</span>   

</div> <!-- Fim da div "titulo-programas" -->

<div id="dados-programas">

     <span class="texto-dados-programas-1">Dados do Programa:</span>
     <br />
     <span class="texto-dados-programas-2">Tamanho: </span>
     <span class="texto-dados-programas-3">3,9 MB</span>
     <br />
     <span class="texto-dados-programas-2">Formato: </span>
     <span class="texto-dados-programas-3">WinRAR - Rar</span>
     <br />
     <span class="texto-dados-programas-2">Nome: </span>
     <span class="texto-dados-programas-3">FileZilla</span>
     <br />
     <span class="texto-dados-programas-2">Ano de Lançamento: </span>
     <span class="texto-dados-programas-3">2007</span>
     <br />
     <?php if ($totalRows_Rs_Acesso_Admin > 0) { // Mostrar senha ADMIN ?>
     <span class="texto-dados-programas-2">Senha: </span>
     <span class="texto-dados-programas-3">244260041993</span>
     <?php } // Mostrar senha ADMIN ?>

</div> <!-- Fim da div "dados-programa" -->

<div id="area-botao-download">

     <input type="submit" name="botao-download" id="botao-download" onclick="window.open('https://dl.dropbox.com/s/rkbqlzja85lxsh0/FileZilla.rar?token_hash=AAGfwnIuUpTpI3huBupa2cUTwHcfGB6dyjvYwshmYRTGkg&dl=1')" title="Clique aqui, para fazer o Download" value="Download »" />

</div> <!-- Fim da div "area-botao-download" -->

</div> <!-- Fim da div "area-programas" -->

<div class="clear"></div>

<div id="area-programas">

<div id="img-programas">

      <img src="../../admin/estrutura_img/Programas - Download/Programas - WampServer.png" title="Baixar - WampServer" width="111" height="108" border="0" />

</div> <!-- Fim da div "img-programas" -->

<div id="titulo-programas">

       <span class="texto-titulo-programas">WampServer</span>   

</div> <!-- Fim da div "titulo-programas" -->

<div id="dados-programas">

     <span class="texto-dados-programas-1">Dados do Programa:</span>
     <br />
     <span class="texto-dados-programas-2">Tamanho: </span>
     <span class="texto-dados-programas-3">31,4 MB</span>
     <br />
     <span class="texto-dados-programas-2">Formato: </span>
     <span class="texto-dados-programas-3">WinRAR - Rar</span>
     <br />
     <span class="texto-dados-programas-2">Nome: </span>
     <span class="texto-dados-programas-3">WampServer</span>
     <br />
     <span class="texto-dados-programas-2">Ano de Lançamento: </span>
     <span class="texto-dados-programas-3">2011</span>
     <br />
     <?php if ($totalRows_Rs_Acesso_Admin > 0) { // Mostrar senha ADMIN ?>
     <span class="texto-dados-programas-2">Senha: </span>
     <span class="texto-dados-programas-3">244260041993</span>
     <?php } // Mostrar senha ADMIN ?>

</div> <!-- Fim da div "dados-programa" -->

<div id="area-botao-download">

     <input type="submit" name="botao-download" id="botao-download" onclick="window.open('https://dl.dropbox.com/s/0hvfrxm3c744vgt/WampServer.rar?token_hash=AAHarzy6kxYle4HCya8YkD4LqeLpYyGl3rfI6LTPb0tYow&dl=1')" title="Clique aqui, para fazer o Download" value="Download »" />

</div> <!-- Fim da div "area-botao-download" -->

</div> <!-- Fim da div "area-programas" -->

<div class="clear"></div>

<div id="area-programas-1">

<div id="img-programas">

      <img src="../../admin/estrutura_img/Programas - Download/Programas - VirtualDJ PRO - 7.png" title="Baixar - VirtualDJ PRO - 7" width="111" height="108" border="0" />

</div> <!-- Fim da div "img-programas" -->

<div id="titulo-programas">

       <span class="texto-titulo-programas">VirtualDJ PRO - 7</span>   

</div> <!-- Fim da div "titulo-programas" -->

<div id="dados-programas">

     <span class="texto-dados-programas-1">Dados do Programa:</span>
     <br />
     <span class="texto-dados-programas-2">Tamanho: </span>
     <span class="texto-dados-programas-3">33,9 MB</span>
     <br />
     <span class="texto-dados-programas-2">Formato: </span>
     <span class="texto-dados-programas-3">WinRAR - Rar</span>
     <br />
     <span class="texto-dados-programas-2">Nome: </span>
     <span class="texto-dados-programas-3">VirtualDJ PRO - 7</span>
     <br />
     <span class="texto-dados-programas-2">Ano de Lançamento: </span>
     <span class="texto-dados-programas-3">2010</span>
     <br />
     <?php if ($totalRows_Rs_Acesso_Admin > 0) { // Mostrar senha ADMIN ?>
     <span class="texto-dados-programas-2">Senha: </span>
     <span class="texto-dados-programas-3">244260041993</span>
     <?php } // Mostrar senha ADMIN ?>

</div> <!-- Fim da div "dados-programa" -->

<div id="area-botao-download">

     <input type="submit" name="botao-download" id="botao-download" onclick="window.open('https://dl.dropbox.com/s/193vuq8wj58qu6w/Virtual%20DJ%20PRO.rar?token_hash=AAFsNnuApvkOrX4SA0XQhsyrzKYbgVMyzsO9d3Tt32TFYA&dl=1')" title="Clique aqui, para fazer o Download" value="Download »" />

</div> <!-- Fim da div "area-botao-download" -->

</div> <!-- Fim da div "area-programas-1" -->

</div> <!-- Fim da div "conteudo" -->

<div class="clear"></div>
</div> <!-- Fim da div "pg" -->

</div> <!-- Fim da div "geral" -->

</body>
</html>
<?php
mysql_free_result($Rs_Acesso_Admin);
?>
