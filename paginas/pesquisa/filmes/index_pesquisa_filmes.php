<?php require_once('../../../Connections/Mundo_Download.php'); ?>
<?php
// Require the MXI classes
require_once ('../../../includes/mxi/MXI.php');

// Load the tNG classes
require_once('../../../includes/tng/tNG.inc.php');

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

// Include Multiple Static Pages
$mxiObj = new MXI_Includes("pag");
$mxiObj->IncludeStatic("pesquisar_filmes", "pesquisar_filmes.php", "Pesquisar Filmes", "", "");
// End Include Multiple Static Pages

mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Rs_P_Esquerda = "SELECT * FROM s_publicidade WHERE status = 'Ativado' AND s_publicidade.coluna = 'Esquerda' ORDER BY RAND() LIMIT 4";
$Rs_P_Esquerda = mysql_query($query_Rs_P_Esquerda, $Mundo_Download) or die(mysql_error());
$row_Rs_P_Esquerda = mysql_fetch_assoc($Rs_P_Esquerda);
$totalRows_Rs_P_Esquerda = mysql_num_rows($Rs_P_Esquerda);

mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Rs_P_Direita = "SELECT * FROM s_publicidade WHERE status = 'Ativado' AND s_publicidade.coluna = 'Direita' ORDER BY RAND() LIMIT 4";
$Rs_P_Direita = mysql_query($query_Rs_P_Direita, $Mundo_Download) or die(mysql_error());
$row_Rs_P_Direita = mysql_fetch_assoc($Rs_P_Direita);
$totalRows_Rs_P_Direita = mysql_num_rows($Rs_P_Direita);

$colname_Re_painel_admin = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_Re_painel_admin = $_SESSION['kt_login_id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Re_painel_admin = sprintf("SELECT * FROM sistema_login WHERE id = %s AND sistema_login.status <> 'Desativado'", GetSQLValueString($colname_Re_painel_admin, "int"));
$Re_painel_admin = mysql_query($query_Re_painel_admin, $Mundo_Download) or die(mysql_error());
$row_Re_painel_admin = mysql_fetch_assoc($Re_painel_admin);
$totalRows_Re_painel_admin = mysql_num_rows($Re_painel_admin);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download</title>
<link rel="shortcut icon" type="image/x-icon" href="http://www.mundodownload.net/paginas/estrutura_img/Fivicon/favicon.ico" />

<link href="../../estrutura_css/index_pesquisa_filmes.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

<script type="text/javascript" src="../../codigos/Favoritos/adicionar_favoritos.js"></script>                   <!-- Adicionar aos Favoritos -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>     <!-- Biblioteca área de texto com jquery acão -->
<script type="text/javascript" src="../../codigos/jquery_area_texto/area_texto_jquery_acao.js"></script>              <!-- Área de texto com jquery acão -->

<meta name="keywords" content="<?php echo $mxiObj->getKeywords(); ?>" />
<meta name="description" content="<?php echo $mxiObj->getDescription(); ?>" />
<base href="<?php echo mxi_getBaseURL(); ?>" />
</head>

<body>

<div id="barra-topo">

<div id="geral-topo">

<div id="add-favoritos">

   <input type="button" name="botao-add-favoritos" id="botao-add-favoritos" title="Adicione aos seus Favoritos" onclick="parent.location.href='javascript:addFav()'" value="" />

</div> <!-- Fim da div "add-favoritos" -->

<div id="pesquisa-filmes">
<form action="index_pesquisa_filmes.php" method="get" id="form-pesquisa-filmes">

<label>

  <input name="buscafilmes" type="text" id="busca-filmes" value="Faça a sua busca por Filmes..." size="60" />
  </label>
  <label>
  <input type="submit" id="botao-buscar-filmes" value="" />
</label>

</form>
</div> <!-- Fim da div "pesquisa-filmes" -->

<div id="icone-filmes-series">

   <input type="button" name="botao-filmes" id="botao-filmes" title="Ver todos os posts arquivados em Filmes 2013" onclick="parent.location.href='../../../index.php?pag=lancamentos'" value="Filmes 2013" />

</div> <!-- Fim da div "icone-filmes-series" -->

<div id="icone-filmes-series">

   <input type="button" name="botao-series" id="botao-series" title="Ver todos os posts arquivados em Séries Online" onclick="parent.location.href='../../../index.php?pag=home_series'" value="Séries Online" />

</div> <!-- Fim da div "icone-filmes-series" -->

<div id="pesquisa-series">
<form action="../seriados/index_pesquisa_series.php" method="get" id="form-pesquisa-series">

<label>

  <input type="submit" id="botao-buscar-series" value="" />
  </label>
  <label>
  <input name="buscaseries" type="text" id="busca-series" value="Faça a sua busca por Séries Online..." size="60" />
</label>

</form>
</div> <!-- Fim da div "pesquisa-series" -->

<div id="curtir-facebook">

<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fexample.com%2Fpage%2Fto%2Flike&amp;send=false&amp;layout=standard&amp;width=60&amp;show_faces=false&amp;colorscheme=light&amp;action=like&amp;height=27" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:60px; height:27px;" allowTransparency="true"></iframe>

</div> <!-- Fim da div "curtir-facebook" -->

</div> <!-- Fim da div "geral-topo" -->

</div> <!-- Fim da div "barra-topo" -->

<div id="menu-topo-espaco">

</div> <!-- Fim da div "menu-topo-espaco" -->

<div id="geral">

<div id="topo">

</div> <!-- Fim da div "topo" -->

<div id="menu">

<div id="menu-superior-1">

<div id="menu-superior">

<span class="texto-menusuperior-esquerda"><a href="../../../">Página inicial</a></span>
<span class="texto-menusuperior-centro"><a href="../../../index.php?pag=lancamentos">Filmes - Lançamentos 2013</a></span>
<span class="texto-menusuperior-centro"><a href="../../../index.php?pag=home_series">Séries Online</a></span>
<span class="texto-menusuperior-centro"><a href="../../../index.php?pag=shows">Shows</a></span>
<span class="texto-menusuperior-centro"><a href="../../../index.php?pag=pedidos_filmes">Pedidos de Filmes e Shows</a></span>
<span class="texto-menusuperior-centro"><a href="../../../index.php?pag=pedidos_series">Pedidos de Séries</a></span>
<span class="texto-menusuperior-centro"><a href="../../../index.php?pag=elogios">Elogios</a></span>
<span class="texto-menusuperior-direita"><a href="../../../index.php?pag=contato">Contato</a></span>


</div> <!-- Fim da div "menu-superior" -->

</div> <!-- Fim da div "menu-superior-1" -->

</div> <!-- Fim da div "menu" -->

<script type="text/javascript" src="../../codigos/destaques_jquery/preloader.js"></script>  <!-- Preloader -->
<div id="destaques-filmes">

<iframe id="destaques-filmes" name="destaques-filmes" src="../../filmes/destaques/destaques.php" width="1018" height="162" scrolling="No" border="0" frameborder="0"></iframe>

</div> <!-- Fim da div "destaques-filmes" -->

<div id="pg">

<div id="menu-esquerdo">

<div id="menu-esquerdo-img">

<div id="posicao-texto-menu-filmes">

<span class="texto-menu-filmes">Filmes - Categorias</span>

</div> <!-- Fim da div "posicao-texto-menu-filmes" -->

</div> <!-- Fim da div "menu-esquerdo-img" -->

<div id="conteudo-menu-esquerdo">

<div class="lista-conteudo-menu-esquerdo">

<ul>    

     <li><a href="../../../index.php?pag=acao" title="Ver todos os posts arquivados em Ação">» Ação</a></li>    
     <li><a href="../../../index.php?pag=animacao" title="Ver todos os posts arquivados em Animação">» Animação</a></li> 
     <li><a href="../../../index.php?pag=aventura" title="Ver todos os posts arquivados em Aventura">» Aventura</a></li>
     <li><a href="../../../index.php?pag=comedia" title="Ver todos os posts arquivados em Comédia">» Comédia</a></li>
     <li><a href="../../../index.php?pag=corrida" title="Ver todos os posts arquivados em Corrida">» Corrida</a></li>
     <li><a href="../../../index.php?pag=documentario" title="Ver todos os posts arquivados em Documentario">» Documentario</a></li>
     <li><a href="../../../index.php?pag=drama" title="Ver todos os posts arquivados em Drama">» Drama</a></li>
     <li><a href="../../../index.php?pag=fantasia" title="Ver todos os posts arquivados em Fantasia">» Fantasia</a></li>
     <li><a href="../../../index.php?pag=faroeste" title="Ver todos os posts arquivados em Faroeste">» Faroeste</a></li>
     <li><a href="../../../index.php?pag=ficcao" title="Ver todos os posts arquivados em Ficção">» Ficção</a></li>
     <li><a href="../../../index.php?pag=ficcao_cientifica" title="Ver todos os posts arquivados em Ficção Científica">» Ficção Científica</a></li>
     <li><a href="../../../index.php?pag=filmes_dublados" title="Ver todos os posts arquivados em Filmes Dublados">» Filmes Dublados</a></li>
     <li><a href="../../../index.php?pag=filmes_legendados" title="Ver todos os posts arquivados em Filmes Legendados">» Filmes Legendados</a></li>
     <li><a href="../../../index.php?pag=guerra" title="Ver todos os posts arquivados em Guerra">» Guerra</a></li>
     <li><a href="../../../index.php?pag=lancamentos_2013" title="Ver todos os posts arquivados em Lançamentos 2013">» Lançamentos 2013</a></li>
     <li><a href="../../../index.php?pag=lancamentos_2012" title="Ver todos os posts arquivados em Lançamentos 2012">» Lançamentos 2012</a></li>
     <li><a href="../../../index.php?pag=lancamentos_2011" title="Ver todos os posts arquivados em Lançamentos 2011">» Lançamentos 2011</a></li>
     <li><a href="../../../index.php?pag=lancamentos_antigos" title="Ver todos os posts arquivados em Lançamentos Antigos">» Lançamentos Antigos</a></li>
     <li><a href="../../../index.php?pag=musical" title="Ver todos os posts arquivados em Musical">» Musical</a></li>
     <li><a href="../../../index.php?pag=nacionais" title="Ver todos os posts arquivados em Nacionais">» Nacionais</a></li>
     <li><a href="../../../index.php?pag=nostalgia" title="Ver todos os posts arquivados em Nostalgia">» Nostalgia</a></li>
     <li><a href="../../../index.php?pag=policial" title="Ver todos os posts arquivados em Policial">» Policial</a></li>
     <li><a href="../../../index.php?pag=religioso" title="Ver todos os posts arquivados em Religioso">» Religioso</a></li>
     <li><a href="../../../index.php?pag=romance" title="Ver todos os posts arquivados em Romance">» Romance</a></li>
     <li><a href="../../../index.php?pag=shows" title="Ver todos os posts arquivados em Shows">» Shows</a></li>
     <li><a href="../../../index.php?pag=suspense" title="Ver todos os posts arquivados em Suspense">» Suspense</a></li>
     <li><a href="../../../index.php?pag=terror" title="Ver todos os posts arquivados em Terror">» Terror</a></li>
     <li><a href="../../../index.php?pag=thriller" title="Ver todos os posts arquivados em Thriller">» Thriller</a></li>
     
</ul>

</div> <!-- Fim da div "lista-conteudo-menu-esquerdo" -->

</div> <!-- Fim da div "conteudo-menu-esquerdo" -->

<div id="menu-esquerdo-img">

<div id="posicao-texto-menu-filmes">

<span class="texto-menu-filmes">Filmes - Destaques</span>

</div> <!-- Fim da div "posicao-texto-menu-filmes" -->

</div> <!-- Fim da div "menu-esquerdo-img" -->

<div id="conteudo-menu-esquerdo">

<div class="lista-conteudo-menu-esquerdo">

<ul>    

     <li><a href="../../../index.php?pag=filmes&id=" title="Filme em Destaque - Texte">» Filme - Texte</a></li>
     <li><a href="../../../index.php?pag=filmes&id=" title="Filme em Destaque - Texte">» Filme - Texte</a></li>
     <li><a href="../../../index.php?pag=filmes&id=" title="Filme em Destaque - Texte">» Filme - Texte</a></li>
     <li><a href="../../../index.php?pag=filmes&id=" title="Filme em Destaque - Texte">» Filme - Texte</a></li>
     <li><a href="../../../index.php?pag=filmes&id=" title="Filme em Destaque - Texte">» Filme - Texte</a></li>
     <li><a href="../../../index.php?pag=filmes&id=" title="Filme em Destaque - Texte">» Filme - Texte</a></li>
     <li><a href="../../../index.php?pag=filmes&id=" title="Filme em Destaque - Texte">» Filme - Texte</a></li>
     <li><a href="../../../index.php?pag=filmes&id=" title="Filme em Destaque - Texte">» Filme - Texte</a></li>
     <li><a href="../../../index.php?pag=filmes&id=" title="Filme em Destaque - Texte">» Filme - Texte</a></li>
     <li><a href="../../../index.php?pag=filmes&id=" title="Filme em Destaque - Texte">» Filme - Texte</a></li>      

</ul>

</div> <!-- Fim da div "lista-conteudo-menu-esquerdo" -->

</div> <!-- Fim da div "conteudo-menu-esquerdo" -->

<?php if ($totalRows_Rs_P_Esquerda > 0) { // Não mostrar, Publicidade ?>
<div id="menu-esquerdo-img">

<div id="posicao-texto-menu-series-publicidade">

<span class="texto-menu-series-publicidade">Publicidade</span>

</div> <!-- Fim da div "posicao-texto-menu-series-publicidade" -->

</div> <!-- Fim da div "menu-esquerdo-img" -->

<div id="conteudo-menu-esquerdo">

<?php do { ?>
<div id="publicidade-esquerdo">

<?php echo $row_Rs_P_Esquerda['anuncio']; ?>

</div> <!-- Fim da div "publicidade-esquerdo" -->
<?php } while ($row_Rs_P_Esquerda = mysql_fetch_assoc($Rs_P_Esquerda)); ?>

<?php
mysql_free_result($Rs_P_Esquerda);
?>

</div> <!-- Fim da div "conteudo-menu-esquerdo" -->
<?php } // Não mostrar, Publicidade ?>

<div id="menu-esquerdo-img">

<div id="posicao-texto-menu-filmes-arquivos">

<span class="texto-menu-filmes">Filmes - Arquivos</span>

</div> <!-- Fim da div "posicao-texto-menu-filmes" -->

</div> <!-- Fim da div "menu-esquerdo-img" -->

<div id="conteudo-menu-esquerdo">

<form>
 
    <select onchange="top.location.href=this.form.filmes.options [this.form.filmes.selectedIndex].value" name="filmes" id="filmes">
    <option value="" selected/>Selecione o Ano
    <option value="../../../index.php?pag=lancamentos_2013"/>2013
    <option value="../../../index.php?pag=lancamentos_2012"/>2012
    <option value="../../../index.php?pag=lancamentos_2011"/>2011
    <option value="../../../index.php?pag=lancamentos_antigos"/>Antigos
    </select>
    
</form>

</div> <!-- Fim da div "conteudo-menu-esquerdo" -->

</div> <!-- Fim da div "menu-esquerdo" -->

<div id="conteudo">

<div id="home-pg">

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
  mxi_includes_start("pesquisar_filmes.php");
  require(basename("pesquisar_filmes.php"));
  mxi_includes_end();
?>

<?php }?>
  
</div> <!-- Fim da div "home-pg" -->

</div> <!-- Fim da div "conteudo" -->

<div id="menu-direito">

<?php if ($totalRows_Re_painel_admin > 0) { // Mostar Painel - ADMIN ?>
<div id="menu-direito-img">

<div id="posicao-texto-menu-admin">

<span class="texto-menu-series-destaques">Painel - Admin</span>

</div> <!-- Fim da div "posicao-texto-menu-admin -->

</div> <!-- Fim da div "menu-direito-img" -->

<div id="conteudo-menu-direito">

<div class="lista-conteudo-menu-direito">

<ul>    

     <li><a href="../../../login.php" title="Login" target="_blank">» Login</a></li> 
     <li><a href="../../../login/index_admin.php?pag=adicionar_filmes" title="Painel de Controle" target="_blank">» Painel de Controle</a></li>
     <li><a href="../../../login/index_admin.php?pag=adicionar_filmes" title="Adicionar Filmes" target="_blank">» Adicionar Filmes</a></li>
     <li><a href="../../../login/index_admin.php?pag=alterar_series_conteudo" title="Adicionar Séries" target="_blank">» Adicionar Séries</a></li>
     <li><a href="../../../login/index_admin.php?pag=sair_sistema" title="Sair do Sistema">» Sair</a></li>    
 
</ul>

</div> <!-- Fim da div "lista-conteudo-menu-direito" -->

<?php
mysql_free_result($Re_painel_admin);
?>

</div> <!-- Fim da div "conteudo-menu-direito" -->
<?php } // Mostar Painel - ADMIN ?>

<div id="menu-direito-img">

<div id="posicao-texto-menu-series">

<span class="texto-menu-series">Séries - Online</span>

</div> <!-- Fim da div "posicao-texto-menu-series" -->

</div> <!-- Fim da div "menu-direito-img" -->

<div id="conteudo-menu-direito">

<form>
 
    <select onchange="top.location.href=this.form.series.options [this.form.series.selectedIndex].value" name="series" id="series">
    <option value="" selected/>Selecione o Seriado
    <option value="../../../index.php?pag=series&id=36"/>2 Broke Girls
    <option value="../../../index.php?pag=series&id=85"/>24 Horas
    <option value="../../../index.php?pag=series&id=28"/>666 Park Avenue
    <option value="../../../index.php?pag=series&id=18"/>As Aventuras de Merlin
    <option value="../../../index.php?pag=series&id=54"/>Alcatraz
    <option value="../../../index.php?pag=series&id=43"/>Alphas
    <option value="../../../index.php?pag=series&id=9"/>American Horror Story
    <option value="../../../index.php?pag=series&id=72"/>Angel
    <option value="../../../index.php?pag=series&id=46"/>Anger Management
    <option value="../../../index.php?pag=series&id=45"/>Are You There, Chelsea
    <option value="../../../index.php?pag=series&id=53"/>Arquivo X
    <option value="../../../index.php?pag=series&id=23"/>Arrow
    <option value="../../../index.php?pag=series&id=52"/>Band of Brothers
    <option value="../../../index.php?pag=series&id=2"/>Beauty and the Beast 
    <option value="../../../index.php?pag=series&id=22"/>Bones
    <option value="../../../index.php?pag=series&id=39"/>Camelot
    <option value="../../../index.php?pag=series&id=63"/>Chuck
    <option value="../../../index.php?pag=series&id=50"/>Cold Case: Arquivo Morto
    <option value="../../../index.php?pag=series&id=44"/>Copper
    <option value="../../../index.php?pag=series&id=66"/>CSI Las Vegas
    <option value="../../../index.php?pag=series&id=67"/>CSI Miami
    <option value="../../../index.php?pag=series&id=68"/>CSI New York
    <option value="../../../index.php?pag=series&id=15"/>Dexter
    <option value="../../../index.php?pag=series&id=70"/>Doctor Who
    <option value="../../../index.php?pag=series&id=5"/>Dois Homens e Meio
    <option value="../../../index.php?pag=series&id=58"/>Drake & Josh
    <option value="../../../index.php?pag=series&id=86"/>Dr. House
    <option value="../../../index.php?pag=series&id=49"/>Falling Skies
    <option value="../../../index.php?pag=series&id=56"/>Friends
    <option value="../../../index.php?pag=series&id=16"/>Fringe
    <option value="../../../index.php?pag=series&id=65"/>Game of Thrones
    <option value="../../../index.php?pag=series&id=73"/>Ghost Whisperer
    <option value="../../../index.php?pag=series&id=84"/>Gilmore Girls
    <option value="../../../index.php?pag=series&id=38"/>Girls
    <option value="../../../index.php?pag=series&id=17"/>Glee
    <option value="../../../index.php?pag=series&id=24"/>Go on
    <option value="../../../index.php?pag=series&id=13"/>Gossip Girl
    <option value="../../../index.php?pag=series&id=3"/>Grey’s Anatomy
    <option value="../../../index.php?pag=series&id=35"/>Grimm
    <option value="../../../index.php?pag=series&id=81"/>Hannah Montana
    <option value="../../../index.php?pag=series&id=48"/>Hart of Dixie
    <option value="../../../index.php?pag=series&id=10"/>Hawaii Five-0
    <option value="../../../index.php?pag=series&id=47"/>Hell on Wheels
    <option value="../../../index.php?pag=series&id=62"/>Heroes
    <option value="../../../index.php?pag=series&id=14"/>Homeland
    <option value="../../../index.php?pag=series&id=11"/>How I Met Your Mother
    <option value="../../../index.php?pag=series&id=64"/>ICarly
    <option value="../../../index.php?pag=series&id=82"/>Kyle XY
    <option value="../../../index.php?pag=series&id=1"/>Law and Order: SVU
    <option value="../../../index.php?pag=series&id=69"/>Lost
    <option value="../../../index.php?pag=series&id=71"/>NCIS – Unidade de Elite
    <option value="../../../index.php?pag=series&id=7"/>New Girl
    <option value="../../../index.php?pag=series&id=19"/>Nikita
    <option value="../../../index.php?pag=series&id=29"/>Once Upon a Time
    <option value="../../../index.php?pag=series&id=83"/>One Tree Hill
    <option value="../../../index.php?pag=series&id=59"/>Os Feiticeiros de Waverly..
    <option value="../../../index.php?pag=series&id=4"/>Person of Interest
    <option value="../../../index.php?pag=series&id=42"/>Pretty Little Liars
    <option value="../../../index.php?pag=series&id=80"/>Prison Break
    <option value="../../../index.php?pag=series&id=8"/>Private Practice
    <option value="../../../index.php?pag=series&id=32"/>Pushing Daisies
    <option value="../../../index.php?pag=series&id=27"/>Revenge
    <option value="../../../index.php?pag=series&id=31"/>Revolution
    <option value="../../../index.php?pag=series&id=51"/>Sex And The City
    <option value="../../../index.php?pag=series&id=78"/>Smallville
    <option value="../../../index.php?pag=series&id=21"/>Sobrenatural
    <option value="../../../index.php?pag=series&id=25"/>Sons of Anarchy
    <option value="../../../index.php?pag=series&id=74"/>Spartacus: Blood and..
    <option value="../../../index.php?pag=series&id=75"/>Spartacus: Gods of The..
    <option value="../../../index.php?pag=series&id=76"/>Spartacus: Vengeance
    <option value="../../../index.php?pag=series&id=77"/>Spartacus: War of the D..
    <option value="../../../index.php?pag=series&id=37"/>Terra Nova
    <option value="../../../index.php?pag=series&id=30"/>The Big Bang Theory
    <option value="../../../index.php?pag=series&id=33"/>The Client List
    <option value="../../../index.php?pag=series&id=20"/>The Good Wife
    <option value="../../../index.php?pag=series&id=34"/>The Mentalist
    <option value="../../../index.php?pag=series&id=12"/>The Middle: Uma Família..
    <option value="../../../index.php?pag=series&id=60"/>The O.C.: Um Estranho..
    <option value="../../../index.php?pag=series&id=41"/>The Secret Circle
    <option value="../../../index.php?pag=series&id=6"/>The Vampire Diaries
    <option value="../../../index.php?pag=series&id=26"/>The WalKing Dead
    <option value="../../../index.php?pag=series&id=55"/>Todo Mundo Odeia o Chris
    <option value="../../../index.php?pag=series&id=79"/>Toma Lá, Dá Cá
    <option value="../../../index.php?pag=series&id=61"/>True Blood
    <option value="../../../index.php?pag=series&id=57"/>Um Maluco No Pedaço
    <option value="../../../index.php?pag=series&id=40"/>White Collar
    </select>
    
</form>

</div> <!-- Fim da div "conteudo-menu-direito" -->

<div id="menu-direito-img">

<div id="posicao-texto-menu-series-destaques">

<span class="texto-menu-series-destaques">Séries - Destaques</span>

</div> <!-- Fim da div "posicao-texto-menu-series-destaques" -->

</div> <!-- Fim da div "menu-direito-img" -->

<div id="conteudo-menu-direito">

<div class="lista-conteudo-menu-direito">

<ul>    

     <li><a href="../../../index.php?pag=series&id=26" title="Série em Destaque - The Walking Dead">» The Walking Dead</a></li>
     <li><a href="../../../index.php?pag=series&id=21" title="Série em Destaque - Sobrenatural">» Sobrenatural</a></li>
     <li><a href="../../../index.php?pag=series&id=78" title="Série em Destaque - Smallville">» Smallville</a></li>
     <li><a href="../../../index.php?pag=series&id=80" title="Série em Destaque - Prison Break">» Prison Break</a></li>
     <li><a href="../../../index.php?pag=series&id=86" title="Série em Destaque - Dr. House">» Dr. House</a></li>
     <li><a href="../../../index.php?pag=series&id=62" title="Série em Destaque - Heroes">» Heroes</a></li>
     <li><a href="../../../index.php?pag=series&id=23" title="Série em Destaque - Arrow">» Arrow</a></li>
     <li><a href="../../../index.php?pag=series&id=85" title="Série em Destaque - 24 Horas">» 24 Horas</a></li>
     <li><a href="../../../index.php?pag=series&id=69" title="Série em Destaque - Lost">» Lost</a></li>
     <li><a href="../seriados/index_pesquisa_series.php?buscaseries=CSI" title="Série em Destaque - CSI">» CSI</a></li>    
 
</ul>

</div> <!-- Fim da div "lista-conteudo-menu-direito" -->

</div> <!-- Fim da div "conteudo-menu-direito" -->

<?php if ($totalRows_Rs_P_Direita > 0) { // Não mostrar, Publicidade ?>
<div id="menu-direito-img">

<div id="posicao-texto-menu-series-publicidade">

<span class="texto-menu-series-publicidade">Publicidade</span>

</div> <!-- Fim da div "posicao-texto-menu-series-publicidade" -->

</div> <!-- Fim da div "menu-direito-img" -->

<div id="conteudo-menu-direito">

<?php do { ?>
<div id="publicidade-direita">

<?php echo $row_Rs_P_Direita['anuncio']; ?>

</div> <!-- Fim da div "publicidade-direita" -->
<?php } while ($row_Rs_P_Direita = mysql_fetch_assoc($Rs_P_Direita)); ?>

  <?php
mysql_free_result($Rs_P_Direita);
?>

</div> <!-- Fim da div "conteudo-menu-direito" -->
<?php } // Não mostrar, Publicidade ?>

</div> <!-- Fim da div "menu-direito" -->

<div class="clear"></div>
</div> <!-- Fim da div "pg" -->

</div> <!-- Fim da div "geral" -->

<div id="background-rodape">

<div id="rodape">

</div> <!-- Fim da div "rodape" -->

</div> <!-- Fim da div "background-rodape" -->

</body>
</html>