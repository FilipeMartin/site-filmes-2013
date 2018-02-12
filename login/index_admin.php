<?php require_once('../Connections/Mundo_Download.php'); ?>
<?php
// Require the MXI classes
require_once ('../includes/mxi/MXI.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make unified connection variable
$conn_Mundo_Download = new KT_connection($Mundo_Download, $database_Mundo_Download);

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_Mundo_Download, "../");
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

// Require the MXI classes
require_once ('../includes/mxi/MXI.php');

// Require the MXI classes
require_once ('../includes/mxi/MXI.php');

// Include Multiple Static Pages
$mxiObj = new MXI_Includes("pag");
$mxiObj->IncludeStatic("adicionar_filmes", "admin/filmes/editar_postagens_filmes/alterar_filmes_conteudo.php", "Adicionar Filmes", "", "");
$mxiObj->IncludeStatic("editar_filmes", "admin/filmes/editar_postagens_filmes/adicionar_filmes_conteudo.php", "Editar Filmes", "", "");
$mxiObj->IncludeStatic("filmes_devativados", "admin/filmes/editar_postagens_filmes/desativado_filmes_conteudo.php", "Filmes Devativados", "", "");
$mxiObj->IncludeStatic("antigo_filmes_conteudo", "admin/filmes/editar_postagens_filmes/antigo_filmes_conteudo.php", "Filmes Conteudo Antigos", "", "");
$mxiObj->IncludeStatic("painel_imagens_filmes", "admin/filmes/alterar_img_filmes/painel_alterar_img_filmes.php", "Painel Imagens - Filmes", "", "");
$mxiObj->IncludeStatic("alterar_imagens_filmes", "admin/filmes/alterar_img_filmes/alterar_img_filmes.php", "Alterar Imagens - Filmes", "", "");
$mxiObj->IncludeStatic("aguardando_problemas_filmes", "admin/filmes/ms_problemas_filmes/aguardando_problemas_filmes.php", "Aguardando Problemas Filmes", "", "");
$mxiObj->IncludeStatic("aprovado_problemas_filmes", "admin/filmes/ms_problemas_filmes/aprovado_problemas_filmes.php", "Aprovado Problemas Filmes", "", "");
$mxiObj->IncludeStatic("alterar_problemas_filmes", "admin/filmes/ms_problemas_filmes/alterar_problemas_filmes.php", "Alterar Problemas Filmes", "", "");
$mxiObj->IncludeStatic("aguardando_comentarios_filmes", "admin/filmes/sistema_comentarios/aguardando_comentarios.php", "Aguardando Comentarios Filmes", "", "");
$mxiObj->IncludeStatic("aprovado_comentarios_filmes", "admin/filmes/sistema_comentarios/aprovado_comentarios.php", "Aprovado Comentarios Filmes", "", "");
$mxiObj->IncludeStatic("alterar_comentarios_filmes", "admin/filmes/sistema_comentarios/alterar_comentarios.php", "Alterar Comentarios Filmes", "", "");
$mxiObj->IncludeStatic("adicionar_series_conteudo", "admin/seriados/editar_postagens_series/adicionar_series_conteudo.php", "Adicionar Series Conteudo", "", "");
$mxiObj->IncludeStatic("alterar_series_conteudo", "admin/seriados/editar_postagens_series/alterar_series_conteudo.php", "Alterar Series Conteudo", "", "");
$mxiObj->IncludeStatic("desativado_series_conteudo", "admin/seriados/editar_postagens_series/desativado_series_conteudo.php", "Desativado Series Conteudo", "", "");
$mxiObj->IncludeStatic("antigo_series_conteudo", "admin/seriados/editar_postagens_series/antigo_series_conteudo.php", "Series Conteudo Antigos", "", "");
$mxiObj->IncludeStatic("alterar_img_series", "admin/seriados/alterar_img_series/alterar_img_series.php", "Alterar Img Series", "", "");
$mxiObj->IncludeStatic("painel_alterar_img_series", "admin/seriados/alterar_img_series/painel_alterar_img_series.php", "Painel Alterar Img Series", "", "");
$mxiObj->IncludeStatic("aguardando_problemas_series", "admin/seriados/ms_problemas_series/aguardando_problemas_series.php", "Aguardando Problemas Series", "", "");
$mxiObj->IncludeStatic("aprovado_problemas_series", "admin/seriados/ms_problemas_series/aprovado_problemas_series.php", "Aprovado Problemas Series", "", "");
$mxiObj->IncludeStatic("alterar_problemas_series", "admin/seriados/ms_problemas_series/alterar_problemas_series.php", "Alterar Problemas Series", "", "");
$mxiObj->IncludeStatic("aguardando_comentarios_series", "admin/seriados/sistema_comentarios_series/aguardando_comentarios_series.php", "Aguardando Comentarios Series", "", "");
$mxiObj->IncludeStatic("aprovado_comentarios_series", "admin/seriados/sistema_comentarios_series/aprovado_comentarios_series.php", "Aprovado Comentarios Series", "", "");
$mxiObj->IncludeStatic("alterar_comentarios_series", "admin/seriados/sistema_comentarios_series/alterar_comentarios_series.php", "Alterar Comentarios Series", "", "");
$mxiObj->IncludeStatic("alterar_comentarios_menu_principal", "admin/menu_principal/sistema_comentarios_menu_principal/alterar_comentarios_menu_principal.php", "Alterar Comentarios Menu Principal", "", "");
$mxiObj->IncludeStatic("aguardando_comentarios_elogios", "admin/menu_principal/sistema_comentarios_menu_principal/painel_elogios/aguardando_comentarios_elogios.php", "Aguardando Comentarios Elogios", "", "");
$mxiObj->IncludeStatic("aprovado_comentarios_elogios", "admin/menu_principal/sistema_comentarios_menu_principal/painel_elogios/aprovado_comentarios_elogios.php", "Aprovado Comentarios Elogios", "", "");
$mxiObj->IncludeStatic("aguardando_comentarios_filmes_series", "admin/menu_principal/sistema_comentarios_menu_principal/painel_filmes_series/aguardando_comentarios_filmes_series.php", "Aguardando Comentarios Filmes Series", "", "");
$mxiObj->IncludeStatic("aprovado_comentarios_filmes_series", "admin/menu_principal/sistema_comentarios_menu_principal/painel_filmes_series/aprovado_comentarios_filmes_series.php", "Aprovado Comentarios Filmes Series", "", "");
$mxiObj->IncludeStatic("adicionar_publicidade", "admin/publicidade/adicionar_publicidade.php", "Adicionar Publicidade", "", "");
$mxiObj->IncludeStatic("publicidade_dasativado", "admin/publicidade/publicidade_dasativado.php", "Publicidade Dasativado", "", "");
$mxiObj->IncludeStatic("alterar_publicidade", "admin/publicidade/alterar_publicidade.php", "Alterar Publicidade", "", "");
$mxiObj->IncludeStatic("publicidade_coluna_esquerda", "admin/publicidade/publicidade_coluna_esquerda.php", "Publicidade Coluna Esquerda", "", "");
$mxiObj->IncludeStatic("publicidade_coluna_direita", "admin/publicidade/publicidade_coluna_direita.php", "Publicidade Coluna Direita", "", "");
$mxiObj->IncludeStatic("painel_usuarios", "sistema_login/admin/painel_usuarios.php", "Painel de usuarios", "", "");
$mxiObj->IncludeStatic("editar_usuarios", "sistema_login/admin/editar_usuarios.php", "Editar usuarios", "", "");
$mxiObj->IncludeStatic("cadastro_usuarios", "sistema_login/admin/cadastro_usuarios.php", "Cadastrar usuarios", "", "");
$mxiObj->IncludeStatic("alterar_dados_usuario", "sistema_login/alterar_dados_usuario/alterar_dados_usuario.php", "Alterar dados do usuario", "", "");
$mxiObj->IncludeStatic("alterar_dados_usuario_sucesso", "sistema_login/alterar_dados_usuario/alterar_dados_usuario_sucesso.php", "Alterar dados do usuario com sucesso", "", "");
$mxiObj->IncludeStatic("sair_sistema", "sistema_login/sair_sistema/sair_sistema.php", "Sair do sistema", "", "");
$mxiObj->IncludeStatic("programas_download", "sistema_login/programas_download/programas_download.php", "Programas para Download", "", "");
// End Include Multiple Static Pages

$colname_Rs_Dados_Admin = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_Rs_Dados_Admin = $_SESSION['kt_login_id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Rs_Dados_Admin = sprintf("SELECT * FROM sistema_login WHERE id = %s AND sistema_login.status = 'ADMIN'", GetSQLValueString($colname_Rs_Dados_Admin, "int"));
$Rs_Dados_Admin = mysql_query($query_Rs_Dados_Admin, $Mundo_Download) or die(mysql_error());
$row_Rs_Dados_Admin = mysql_fetch_assoc($Rs_Dados_Admin);
$totalRows_Rs_Dados_Admin = mysql_num_rows($Rs_Dados_Admin);

$colname_Rs_Dados_Usuarios = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_Rs_Dados_Usuarios = $_SESSION['kt_login_id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Rs_Dados_Usuarios = sprintf("SELECT * FROM sistema_login WHERE id = %s", GetSQLValueString($colname_Rs_Dados_Usuarios, "int"));
$Rs_Dados_Usuarios = mysql_query($query_Rs_Dados_Usuarios, $Mundo_Download) or die(mysql_error());
$row_Rs_Dados_Usuarios = mysql_fetch_assoc($Rs_Dados_Usuarios);
$totalRows_Rs_Dados_Usuarios = mysql_num_rows($Rs_Dados_Usuarios);

mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Comentarios_E = "SELECT * FROM s_comentarios_m_p WHERE status = 'Aguardando' AND s_comentarios_m_p.localizacao = 'Elogios'";
$Comentarios_E = mysql_query($query_Comentarios_E, $Mundo_Download) or die(mysql_error());
$row_Comentarios_E = mysql_fetch_assoc($Comentarios_E);
$total_Comentarios_E = mysql_num_rows($Comentarios_E);

mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Comentarios_Pedidos_F = "SELECT * FROM s_comentarios_m_p WHERE status = 'Aguardando' AND s_comentarios_m_p.localizacao = 'Filmes'";
$Comentarios_Pedidos_F = mysql_query($query_Comentarios_Pedidos_F, $Mundo_Download) or die(mysql_error());
$row_Comentarios_Pedidos_F = mysql_fetch_assoc($Comentarios_Pedidos_F);
$total_Comentarios_Pedidos_F = mysql_num_rows($Comentarios_Pedidos_F);

mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Comentarios_Pedidos_S = "SELECT * FROM s_comentarios_m_p WHERE status = 'Aguardando' AND s_comentarios_m_p.localizacao = 'Series'";
$Comentarios_Pedidos_S = mysql_query($query_Comentarios_Pedidos_S, $Mundo_Download) or die(mysql_error());
$row_Comentarios_Pedidos_S = mysql_fetch_assoc($Comentarios_Pedidos_S);
$total_Comentarios_Pedidos_S = mysql_num_rows($Comentarios_Pedidos_S);

mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_P_Comentarios_F = "SELECT * FROM s_t_m_comentarios_f_p WHERE status = 'Aguardando'";
$P_Comentarios_F = mysql_query($query_P_Comentarios_F, $Mundo_Download) or die(mysql_error());
$row_P_Comentarios_F = mysql_fetch_assoc($P_Comentarios_F);
$total_P_Comentarios_F = mysql_num_rows($P_Comentarios_F);

mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_P_Comentarios_S = "SELECT * FROM s_t_m_comentarios_s_p WHERE status = 'Aguardando'";
$P_Comentarios_S = mysql_query($query_P_Comentarios_S, $Mundo_Download) or die(mysql_error());
$row_P_Comentarios_S = mysql_fetch_assoc($P_Comentarios_S);
$total_P_Comentarios_S = mysql_num_rows($P_Comentarios_S);

mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Comentarios_F = "SELECT * FROM s_comentarios_filmes WHERE status = 'Aguardando'";
$Comentarios_F = mysql_query($query_Comentarios_F, $Mundo_Download) or die(mysql_error());
$row_Comentarios_F = mysql_fetch_assoc($Comentarios_F);
$total_Comentarios_F = mysql_num_rows($Comentarios_F);

mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Comentarios_S = "SELECT * FROM s_comentarios_series WHERE status = 'Aguardando'";
$Comentarios_S = mysql_query($query_Comentarios_S, $Mundo_Download) or die(mysql_error());
$row_Comentarios_S = mysql_fetch_assoc($Comentarios_S);
$total_Comentarios_S = mysql_num_rows($Comentarios_S);

mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_S_A = "SELECT * FROM conteudo_seriados WHERE status = 'Ativado'";
$S_A = mysql_query($query_S_A, $Mundo_Download) or die(mysql_error());
$row_S_A = mysql_fetch_assoc($S_A);
$total_S_A = mysql_num_rows($S_A);

mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_S_D = "SELECT * FROM conteudo_seriados WHERE status = 'Desativado'";
$S_D = mysql_query($query_S_D, $Mundo_Download) or die(mysql_error());
$row_S_D = mysql_fetch_assoc($S_D);
$total_S_D = mysql_num_rows($S_D);

mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_F_A = "SELECT * FROM conteudo_filmes WHERE status = 'Ativado'";
$F_A = mysql_query($query_F_A, $Mundo_Download) or die(mysql_error());
$row_F_A = mysql_fetch_assoc($F_A);
$total_F_A = mysql_num_rows($F_A);

mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_F_D = "SELECT * FROM conteudo_filmes WHERE status = 'Desativado'";
$F_D = mysql_query($query_F_D, $Mundo_Download) or die(mysql_error());
$row_F_D = mysql_fetch_assoc($F_D);
$total_F_D = mysql_num_rows($F_D);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download</title>
<link rel="shortcut icon" type="image/x-icon" href="http://www.mundodownload.net/paginas/estrutura_img/Fivicon/favicon.ico" />

<link href="admin/estrutura_css/index_admin/index_admin.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

<script type="text/javascript" src="admin/codigos/carregamento_total/carregamento_total.js"></script>      <!-- Carregamento Total da Página -->

<script type="text/javascript" src="admin/codigos/jquery_conteudo_admin/jquery.js"></script>                  <!-- Jquery - Menu Conteúdo -->

<script type="text/javascript" src="admin/codigos/jquery_conteudo_admin/jquery_acao.js"></script>                 <!-- Jquery - Menu Conteúdo Ação -->

<meta name="keywords" content="<?php echo $mxiObj->getKeywords(); ?>" />
<meta name="description" content="<?php echo $mxiObj->getDescription(); ?>" />
<base href="<?php echo mxi_getBaseURL(); ?>" />
</head>

<body>

<div id="geral-admin">

<div id="topo">

<div id="topo-1">

<div id="sair-sistema">

      <a href="index_admin.php?pag=sair_sistema" class="texto-sair-sistema" title="Sair do Sistema" >Sair</a>

</div> <!-- Fim da div "sair-sistema" -->

<div id="data">

       <span class="data">Data: <?php echo date('d/m/Y - H:i',time()-0);?></span>

</div> <!-- Fim da div "data" -->

<div id="email-seja-bem-vindo">

      <span class="texto-email-seja-bem-vindo">Seja bem-vindo, ao painel de controle: <?php echo $row_Rs_Dados_Usuarios['email']; ?></span>

</div> <!-- Fim da div "email-seja-bem-vindo" -->

</div> <!-- Fim da div "topo-1" -->
<div class="clear"></div>

<div id="topo-2">

<div id="texto-comentarios-aguardando">

      <span class="texto-comentarios-aguardando">Comentários - Aguardando</span>
      
</div> <!-- Fim da div "texto-comentarios-aguardando" -->  

<div id="comentarios-aguardando-espaco">

      <a href="index_admin.php?pag=aguardando_comentarios_filmes" class="texto-comentarios-aguardando-conteudo" >» <?php echo $total_Comentarios_F ?> - Filmes</a>
      
</div> <!-- Fim da div "comentarios-aguardando-espaco" --> 

<div id="comentarios-aguardando-espaco">

      <a href="index_admin.php?pag=aguardando_comentarios_series" class="texto-comentarios-aguardando-conteudo" >» <?php echo $total_Comentarios_S ?> - Séries</a>
      
</div> <!-- Fim da div "comentarios-aguardando-espaco" --> 

<div id="comentarios-aguardando-espaco">

      <a href="index_admin.php?pag=aguardando_problemas_filmes" class="texto-comentarios-aguardando-conteudo" >» <?php echo $total_P_Comentarios_F ?> - Problemas - Filmes</a>
      
</div> <!-- Fim da div "comentarios-aguardando-espaco" --> 

<div id="comentarios-aguardando-espaco">

      <a href="index_admin.php?pag=aguardando_problemas_series" class="texto-comentarios-aguardando-conteudo" >» <?php echo $total_P_Comentarios_S ?> - Problemas - Séries</a>
      
</div> <!-- Fim da div "comentarios-aguardando-espaco" --> 

<div id="comentarios-aguardando-espaco">

      <a href="index_admin.php?pag=aguardando_comentarios_elogios" class="texto-comentarios-aguardando-conteudo" >» <?php echo $total_Comentarios_E ?> - Elogios</a>
      
</div> <!-- Fim da div "comentarios-aguardando-espaco" --> 

<div id="comentarios-aguardando-espaco">

      <a href="index_admin.php?pag=aguardando_comentarios_filmes_series" class="texto-comentarios-aguardando-conteudo" >» <?php echo $total_Comentarios_Pedidos_F ?> - Pedidos de Filmes</a>
      
</div> <!-- Fim da div "comentarios-aguardando-espaco" --> 

<div id="comentarios-aguardando-espaco">

      <a href="index_admin.php?pag=aguardando_comentarios_filmes_series" class="texto-comentarios-aguardando-conteudo" >» <?php echo $total_Comentarios_Pedidos_S ?> - Pedidos de Séries</a>
      
</div> <!-- Fim da div "comentarios-aguardando-espaco" -->    

</div> <!-- Fim da div "topo-2" -->

<div id="topo-3">

<div id="botao-home">

       <a href="javascript:;" class="texto-botoes" onclick="menu_conteudo_home()" >Home</a>

</div> <!-- Fim da div "botao-home" -->

<div id="botao-filmes">

       <a href="javascript:;" class="texto-botoes" onclick="menu_conteudo_filmes()" >Filmes</a>

</div> <!-- Fim da div "botao-filmes" -->

<div id="botao-series">

       <a href="javascript:;" class="texto-botoes" onclick="menu_conteudo_series()" >Séries</a>

</div> <!-- Fim da div "botao-series" -->

<div id="botao-menu-principal">

       <a href="javascript:;" class="texto-botoes" onclick="menu_conteudo_menu_principal()" >Menu Principal</a>

</div> <!-- Fim da div "botao-menu-principal" -->

<div id="botao-publicidade">

       <a href="javascript:;" class="texto-botoes" onclick="menu_conteudo_publicidade()" >Publicidade</a>

</div> <!-- Fim da div "botao-publicidade" -->

</div> <!-- Fim da div "topo-3" -->

<div id="topo-4">

<div id="menu_conteudo_home">
 
<div id="menu-titulo-home">
       
       <span class="texto-menu-titulo">Home »</span>
       
</div> <!-- Fim da div "menu-titulo-home" -->       
       
<div id="menu-conteudo-esquerda">

<div class="lista-conteudo-menu">

<ul>    

     <li><a href="../index.php" title="Mundo Download" target="_blank" >» Mundo Download</a></li>
     <li><a href="index_admin.php?pag=adicionar_filmes" title="Adicionar Filmes" >» Adicionar Filmes</a></li>     
     <li><a href="index_admin.php?pag=alterar_series_conteudo" title="Adicionar Séries" >» Adicionar Séries</a></li>  
     <li><a href="index_admin.php?pag=programas_download" title="Programas - Download" >» Programas - Download</a></li>
     
</ul>

</div> <!-- Fim da div "lista-conteudo-menu" -->

</div> <!-- Fim da div "menu-conteudo-esquerda" -->

<div id="menu-conteudo-direita">

<div class="lista-conteudo-menu">

<ul>    

     <li><a href="index_admin.php?pag=alterar_dados_usuario&amp;id=<?php echo $_SESSION['kt_login_id']; ?>" title="Alterar dados" >» Alterar dados</a></li>   
     
     <?php if ($totalRows_Rs_Dados_Admin > 0) { // Show if recordset not empt ?>  
     <li><a href="index_admin.php?pag=painel_usuarios" title="Painel de Usuários" >» Painel de Usuários</a></li> 
     <li><a href="index_admin.php?pag=cadastro_usuarios" title="Cadastro de Usuários" >» Cadastro de Usuários</a></li> 
     <?php } // Show if recordset not empt ?>
     
</ul>

</div> <!-- Fim da div "lista-conteudo-menu" -->

</div> <!-- Fim da div "menu-conteudo-direita" -->
<div class="clear"></div>     

</div> <!-- Fim da div "menu_conteudo_home" -->

<div id="menu_conteudo_filmes">
 
<div id="menu-titulo-filmes">
       
       <span class="texto-menu-titulo">Filmes »</span>
       
</div> <!-- Fim da div "menu-titulo-filmes" -->       
       
<div id="menu-conteudo-esquerda">

<div class="lista-conteudo-menu">

<ul>    

     <li><a href="index_admin.php?pag=adicionar_filmes" title="Adicionar Filmes" >» Adicionar Filmes</a></li> 
     <li><a href="index_admin.php?pag=filmes_devativados" title="Filmes Desativados" >» Filmes Desativados</a></li>
     <li><a href="index_admin.php?pag=aguardando_comentarios_filmes" title="Comentários - Aguardando" >» Comentários - Aguardando</a></li>
     <li><a href="index_admin.php?pag=aprovado_comentarios_filmes" title="Comentários - Aprovados" >» Comentários - Aprovados</a></li>   
     
</ul>

</div> <!-- Fim da div "lista-conteudo-menu" -->

</div> <!-- Fim da div "menu-conteudo-esquerda" -->

<div id="menu-conteudo-direita">

<div class="lista-conteudo-menu">

<ul> 
   
     <li><a href="index_admin.php?pag=painel_imagens_filmes" title="Filmes - Alterar Imagens" >» Filmes - Alterar Imagens</a></li>
     <li><a href="index_admin.php?pag=antigo_filmes_conteudo" title="Filmes - Antigos" >» Filmes - Antigos</a></li>
     <li><a href="index_admin.php?pag=aguardando_problemas_filmes" title="Problemas - Aguardando" >» Problemas - Aguardando</a></li>    
     <li><a href="index_admin.php?pag=aprovado_problemas_filmes" title="Problemas - Aprovados" >» Problemas - Aprovados</a></li> 
     
</ul>

</div> <!-- Fim da div "lista-conteudo-menu" -->

</div> <!-- Fim da div "menu-conteudo-direita" -->
<div class="clear"></div>     

</div> <!-- Fim da div "menu_conteudo_filmes" -->

<div id="menu_conteudo_series">
 
<div id="menu-titulo-series">
       
       <span class="texto-menu-titulo">Séries »</span>
       
</div> <!-- Fim da div "menu-titulo-series" -->       
       
<div id="menu-conteudo-esquerda">

<div class="lista-conteudo-menu">

<ul>    

     <li><a href="index_admin.php?pag=alterar_series_conteudo" title="Adicionar Séries" >» Adicionar Séries</a></li> 
     <li><a href="index_admin.php?pag=desativado_series_conteudo" title="Séries Desativadas" >» Séries Desativadas</a></li>
     <li><a href="index_admin.php?pag=aguardando_comentarios_series" title="Comentários - Aguardando" >» Comentários - Aguardando</a></li>
     <li><a href="index_admin.php?pag=aprovado_comentarios_series" title="Comentários - Aprovados" >» Comentários - Aprovados</a></li>   
     
</ul>

</div> <!-- Fim da div "lista-conteudo-menu" -->

</div> <!-- Fim da div "menu-conteudo-esquerda" -->

<div id="menu-conteudo-direita">

<div class="lista-conteudo-menu">

<ul> 
   
     <li><a href="index_admin.php?pag=painel_alterar_img_series" title="Séries - Alterar Imagens" >» Séries - Alterar Imagens</a></li>
     <li><a href="index_admin.php?pag=antigo_series_conteudo" title="Séries - Antigas" >» Séries - Antigas</a></li>
     <li><a href="index_admin.php?pag=aguardando_problemas_series" title="Problemas - Aguardando" >» Problemas - Aguardando</a></li>    
     <li><a href="index_admin.php?pag=aprovado_problemas_series" title="Problemas - Aprovados" >» Problemas - Aprovados</a></li> 
     
</ul>

</div> <!-- Fim da div "lista-conteudo-menu" -->

</div> <!-- Fim da div "menu-conteudo-direita" -->
<div class="clear"></div>     

</div> <!-- Fim da div "menu_conteudo_series" -->

<div id="menu_conteudo_menu_principal">
 
<div id="menu-titulo-menu-principal">
       
       <span class="texto-menu-titulo">Menu Principal »</span>
       
</div> <!-- Fim da div "menu-titulo-menu-principal" -->       
       
<div id="menu-conteudo-esquerda">

<div class="lista-conteudo-menu">

<ul>    

     <li><a href="index_admin.php?pag=aguardando_comentarios_filmes_series" title="Pedidos de Filmes e Séries - Aguardando" >» Pedidos - Aguardando</a></li> 
     <li><a href="index_admin.php?pag=aprovado_comentarios_filmes_series" title="Pedidos de Filmes e Séries - Aprovados" >» Pedidos - Aprovados</a></li>   
     
</ul>

</div> <!-- Fim da div "lista-conteudo-menu" -->

</div> <!-- Fim da div "menu-conteudo-esquerda" -->

<div id="menu-conteudo-direita">

<div class="lista-conteudo-menu">

<ul>    

     <li><a href="index_admin.php?pag=aguardando_comentarios_elogios" title="Elogios - Aguardando" >» Elogios - Aguardando</a></li> 
     <li><a href="index_admin.php?pag=aprovado_comentarios_elogios" title="Elogios - Aprovado" >» Elogios - Aprovado</a></li>
     
</ul>

</div> <!-- Fim da div "lista-conteudo-menu" -->

</div> <!-- Fim da div "menu-conteudo-direita" -->
<div class="clear"></div>     

</div> <!-- Fim da div "menu_conteudo_menu_principal" -->

<div id="menu_conteudo_publicidade">
 
<div id="menu-titulo-publicidade">
       
       <span class="texto-menu-titulo">Publicidade »</span>
       
</div> <!-- Fim da div "menu-titulo-publicidade" -->       
       
<div id="menu-conteudo-esquerda">

<div class="lista-conteudo-menu">

<ul>    

     <li><a href="index_admin.php?pag=alterar_publicidade" title="Adicionar Anúncios" >» Adicionar Anúncios</a></li> 
     <li><a href="index_admin.php?pag=publicidade_coluna_esquerda" title="Anúncios da Coluna Esquerda" >» Coluna Esquerda</a></li>  
     
</ul>

</div> <!-- Fim da div "lista-conteudo-menu" -->

</div> <!-- Fim da div "menu-conteudo-esquerda" -->

<div id="menu-conteudo-direita">

<div class="lista-conteudo-menu">

<ul>    

     <li><a href="index_admin.php?pag=publicidade_dasativado" title="Anúncios Desativados" >» Anúncios Desativados</a></li>
     <li><a href="index_admin.php?pag=publicidade_coluna_direita" title="Anúncios da Coluna Direita" >» Coluna Direita</a></li>  
     
</ul>

</div> <!-- Fim da div "lista-conteudo-menu" -->

</div> <!-- Fim da div "menu-conteudo-direita" -->
<div class="clear"></div>     

</div> <!-- Fim da div "menu_conteudo_publicidade" -->

</div> <!-- Fim da div "topo-4" -->

<div id="topo-5">

<div id="titulo-total-postagens">

       <span class="texto-titulo-total-postagens">Total de Postagens</span>

</div> <!-- Fim da div "titulo-total-postagens" -->

<div id="total-espaco">
 
       <a href="index_admin.php?pag=adicionar_filmes" class="texto-total-postagens-conteudo">» <?php echo $total_F_A ?> - Filmes - Ativos</a>
       
</div> <!-- Fim da div "total-espaco" -->

<div id="total-espaco-2">
 
       <a href="index_admin.php?pag=alterar_series_conteudo" class="texto-total-postagens-conteudo">» <?php echo $total_S_A ?> - Séries - Ativos</a>

</div> <!-- Fim da div "total-espaco-2" -->
<div class="clear"></div>

<div id="total-hr">

<hr>

</div> <!-- Fim da div "total-hr" -->

<div id="total-espaco-1">
 
       <a href="index_admin.php?pag=filmes_devativados" class="texto-total-postagens-conteudo">» <?php echo $total_F_D ?> - Filmes - OFF</a>
       
</div> <!-- Fim da div "total-espaco-1" -->

<div id="total-espaco-2-3">
 
       <a href="index_admin.php?pag=desativado_series_conteudo" class="texto-total-postagens-conteudo">» <?php echo $total_S_D ?> - Séries - OFF</a>

</div> <!-- Fim da div "total-espaco-2-3" -->

</div> <!-- Fim da div "topo-5" -->
<div class="clear"></div>

</div> <!-- Fim da div "topo" -->

<div id="conteudo-admin">

<?php if(isset($_GET['pag'])){?>
  <?php
  $incFileName = $mxiObj->getCurrentInclude();
  if ($incFileName !== null)  {
    mxi_includes_start($incFileName);
    require(basename($incFileName)); // require the page content
    mxi_includes_end();
}



?>
<?php }else {?>

<?php
  mxi_includes_start("admin/filmes/editar_postagens_filmes/alterar_filmes_conteudo.php");
  require(basename("admin/filmes/editar_postagens_filmes/alterar_filmes_conteudo.php"));
  mxi_includes_end();
?>

<?php }?>

</div> <!-- Fim da div "conteudo-admin" -->

</div> <!-- Fim da div "geral-admin" -->
<div class="clear"></div>

<div id="rodape">

      <span class="texto-rodape">Copyright 2013 &copy; Mundo Download</span>

</div> <!-- Fim da div "rodape" -->

</body>
</html>
<?php
mysql_free_result($Rs_Dados_Admin);

mysql_free_result($Rs_Dados_Usuarios);

mysql_free_result($Comentarios_E);

mysql_free_result($Comentarios_Pedidos_F);

mysql_free_result($Comentarios_Pedidos_S);

mysql_free_result($P_Comentarios_F);

mysql_free_result($P_Comentarios_S);

mysql_free_result($Comentarios_F);

mysql_free_result($Comentarios_S);

mysql_free_result($S_A);

mysql_free_result($S_D);

mysql_free_result($F_A);

mysql_free_result($F_D);
?>
