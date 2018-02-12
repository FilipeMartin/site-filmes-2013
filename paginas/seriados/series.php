<?php require_once('../../Connections/Mundo_Download.php'); ?>
<?php
// Load the common classes
require_once('../../includes/common/KT_common.php');

// Load the tNG classes
require_once('../../includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../../");

// Make unified connection variable
$conn_Mundo_Download = new KT_connection($Mundo_Download, $database_Mundo_Download);

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("nome", true, "text", "", "2", "", "");
$formValidation->addField("email", true, "text", "email", "", "", "");
$formValidation->addField("serie_problemas", true, "text", "", "2", "", "");
$formValidation->addField("mensagem", true, "text", "", "5", "500", "");
$tNGs->prepareValidation($formValidation);
// End trigger

//start CheckCaptcha trigger
//remove this line if you want to edit the code by hand
function CheckCaptcha(&$tNG) {
	$captcha = new tNG_Captcha("captcha_id_id", $tNG);
	$captcha->setFormField("POST", "captcha_id");
	$captcha->setErrorMsg("Insira os caracteres exibidos abaixo.");
	return $captcha->Execute();
}
//end CheckCaptcha trigger

// Start trigger
$formValidation1 = new tNG_FormValidation();
$formValidation1->addField("nome", true, "text", "", "2", "", "");
$formValidation1->addField("email", true, "text", "email", "", "", "");
$formValidation1->addField("mensagem", true, "text", "", "5", "500", "");
$tNGs->prepareValidation($formValidation1);
// End trigger

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

$colname_Re_Series = "-1";
if (isset($_GET['id'])) {
  $colname_Re_Series = $_GET['id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Re_Series = sprintf("SELECT * FROM conteudo_seriados WHERE id = %s AND conteudo_seriados.status = 'Ativado'", GetSQLValueString($colname_Re_Series, "int"));
$Re_Series = mysql_query($query_Re_Series, $Mundo_Download) or die(mysql_error());
$row_Re_Series = mysql_fetch_assoc($Re_Series);
$totalRows_Re_Series = mysql_num_rows($Re_Series);

$colname_Re_comentarios_s = "-1";
if (isset($_GET['id'])) {
  $colname_Re_comentarios_s = $_GET['id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Re_comentarios_s = sprintf("SELECT * FROM s_comentarios_series WHERE localizacao = %s AND s_comentarios_series.status = 'Aprovado' ORDER BY id ASC", GetSQLValueString($colname_Re_comentarios_s, "text"));
$Re_comentarios_s = mysql_query($query_Re_comentarios_s, $Mundo_Download) or die(mysql_error());
$row_Re_comentarios_s = mysql_fetch_assoc($Re_comentarios_s);
$totalRows_Re_comentarios_s = mysql_num_rows($Re_comentarios_s);

$colname_Re_editar_admin = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_Re_editar_admin = $_SESSION['kt_login_id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Re_editar_admin = sprintf("SELECT * FROM sistema_login WHERE id = %s AND sistema_login.status <> 'Desativado'", GetSQLValueString($colname_Re_editar_admin, "int"));
$Re_editar_admin = mysql_query($query_Re_editar_admin, $Mundo_Download) or die(mysql_error());
$row_Re_editar_admin = mysql_fetch_assoc($Re_editar_admin);
$totalRows_Re_editar_admin = mysql_num_rows($Re_editar_admin);

// Make an insert transaction instance
$ins_s_t_m_comentarios_s_p = new tNG_insert($conn_Mundo_Download);
$tNGs->addTransaction($ins_s_t_m_comentarios_s_p);
// Register triggers
$ins_s_t_m_comentarios_s_p->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_s_t_m_comentarios_s_p->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_s_t_m_comentarios_s_p->registerTrigger("END", "Trigger_Default_Redirect", 99, "paginas/seriados/sistema_seriados_problemas/ms_sucesso_series_problemas.php?id={Re_Series.id}");
$ins_s_t_m_comentarios_s_p->registerTrigger("BEFORE", "CheckCaptcha", 10);
// Add columns
$ins_s_t_m_comentarios_s_p->setTable("s_t_m_comentarios_s_p");
$ins_s_t_m_comentarios_s_p->addColumn("nome", "STRING_TYPE", "POST", "nome");
$ins_s_t_m_comentarios_s_p->addColumn("email", "STRING_TYPE", "POST", "email");
$ins_s_t_m_comentarios_s_p->addColumn("serie_problemas", "STRING_TYPE", "POST", "serie_problemas");
$ins_s_t_m_comentarios_s_p->addColumn("nome_series", "STRING_TYPE", "POST", "nome_series");
$ins_s_t_m_comentarios_s_p->addColumn("mensagem", "STRING_TYPE", "POST", "mensagem");
$ins_s_t_m_comentarios_s_p->setPrimaryKey("id", "NUMERIC_TYPE");

// Make an insert transaction instance
$ins_s_comentarios_series = new tNG_insert($conn_Mundo_Download);
$tNGs->addTransaction($ins_s_comentarios_series);
// Register triggers
$ins_s_comentarios_series->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert2");
$ins_s_comentarios_series->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation1);
$ins_s_comentarios_series->registerTrigger("END", "Trigger_Default_Redirect", 99, "paginas/seriados/comentarios_envio_sucesso/comentarios_envio_sucesso_series.php?id={Re_Series.id}");
// Add columns
$ins_s_comentarios_series->setTable("s_comentarios_series");
$ins_s_comentarios_series->addColumn("nome", "STRING_TYPE", "POST", "nome");
$ins_s_comentarios_series->addColumn("email", "STRING_TYPE", "POST", "email");
$ins_s_comentarios_series->addColumn("site_blog", "STRING_TYPE", "POST", "site_blog");
$ins_s_comentarios_series->addColumn("series", "STRING_TYPE", "POST", "series");
$ins_s_comentarios_series->addColumn("localizacao", "STRING_TYPE", "POST", "localizacao");
$ins_s_comentarios_series->addColumn("mensagem", "STRING_TYPE", "POST", "mensagem");
$ins_s_comentarios_series->addColumn("data", "STRING_TYPE", "POST", "data");
$ins_s_comentarios_series->setPrimaryKey("id", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rss_t_m_comentarios_s_p = $tNGs->getRecordset("s_t_m_comentarios_s_p");
$row_rss_t_m_comentarios_s_p = mysql_fetch_assoc($rss_t_m_comentarios_s_p);
$totalRows_rss_t_m_comentarios_s_p = mysql_num_rows($rss_t_m_comentarios_s_p);

// Get the transaction recordset
$rss_comentarios_series = $tNGs->getRecordset("s_comentarios_series");
$row_rss_comentarios_series = mysql_fetch_assoc($rss_comentarios_series);
$totalRows_rss_comentarios_series = mysql_num_rows($rss_comentarios_series);

// Captcha Image
$captcha_id_obj = new KT_CaptchaImage("captcha_id_id");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Séries</title>

<link href="../estrutura_css/series.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

<link href="../codigos/shadowbox/shadowbox.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../codigos/iframe/iframe_auto_height.js"></script>   <!-- Iframe Auto Height -->
<script type="text/javascript" src="../codigos/limpar_area_texto/limpar_area_texto.js"></script>  <!-- Limpar area de texto -->

<link href="../../includes/skins/mxkollection_editar.css" rel="stylesheet" type="text/css" media="all" />
<script src="../../includes/common/js/base.js" type="text/javascript"></script>
<script src="../../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>

</head>

<body>

<div id="geral-series">

<?php if ($totalRows_Re_Series > 0) { // Show if recordset not empt ?>
<div id="pg-series">

<div id="series-pg-img">

<div id="titulo-series-img">

     <a href="../../index.php?pag=series&amp;id=<?php echo $row_Re_Series['id']; ?>" class="titulo-series-img">
     <span class="texto-home-img"><?php echo $row_Re_Series['titulo']; ?></span></a>

</div> <!-- Fim da div "titulo-series-img" -->
<br />

<div class="clear"></div>
<div id="titulo-series-img-1">

     <a href="../../index.php?pag=series&amp;id=<?php echo $row_Re_Series['id']; ?>" class="titulo-series-img-1">
     <span class="texto-home-img">Todas as Temporadas – Dublado / Legendado</span></a>

</div> <!-- Fim da div "titulo-series-img-1" -->

<div id="data-series-img">

     <span class="texto-data-series-img">Postado dia: </span>
     <span class="data-series-img"><?php echo $row_Re_Series['data_da_postagem']; ?></span>

</div> <!-- Fim da div "data-series-img" -->

</div> <!-- Fim da div "series-pg-img" -->
<div class="clear"></div>

<div id="series-conteudo">

<div id="editar-postagem">
<?php if ($totalRows_Re_editar_admin > 0) { // Mostrar Botao Editar Postagem ?>

      <input type="submit" name="botao-editar-postagem" id="botao-editar-postagem" onclick="window.open('../../login/index_admin.php?pag=adicionar_series_conteudo&amp;id=<?php echo $row_Re_Series['id']; ?>')" title="Clique aqui, para editar a postagem" value="Editar postagem »" />
      
<?php } // Mostrar Botao Editar Postagem ?>        
</div> <!-- Fim da div "editar-postagem" -->

<div class="clear"></div>
<div id="series-img">

     <img src="../../conteudo/seriados/img/<?php echo $row_Re_Series['imagem']; ?>" width="220" height="310" border="0" />

</div> <!-- Fim da div "series-img" -->

<div id="series-sinopse">

     <span class="sinopse">Sinopse: </span>
     <span class="texto-sinopse"><?php echo $row_Re_Series['sinopse']; ?></span>

<div class="clear"></div>
</div> <!-- Fim da div "series-sinopse" -->

<div id="series-trailer">

     <span class="texto-trailer">Trailer da Série: </span>
     <span class="titulo-trailer"><?php echo $row_Re_Series['titulo']; ?></span>
     <p>
     <iframe width="430" height="300" src="<?php echo $row_Re_Series['trailer']; ?>?rel=0" frameborder="0" allowfullscreen></iframe>

</div> <!-- Fim da div "series-trailer" -->

<div id="dados-da-serie">

     <span class="dados-da-serie">Dados da Série:</span>
     <p>
     <span class="texto2-dados-da-serie"><?php echo $row_Re_Series['dados_do_seriado']; ?></span>

</div> <!-- Fim da div "dados-da-serie" -->

<div id="video-aula-series-online">

     <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
     <script type="text/javascript" src="../codigos/shadowbox/shadowbox.js"></script>
     <script type="text/javascript" src="../codigos/shadowbox/acao.js"></script>

     <a title="Vídeo Aula - Como Assistir Séries Online" class="texto-video-aulas" href="http://www.youtube.com/embed/MadVcyIaZg0?rel=0" rel="shadowbox;width=640;height=360">« Clique aqui, Vídeo Aulas - Como Assistir Séries Online »</a>

</div> <!-- Fim da div "video-aula-series-online" -->

<p></p>

<div id="temporadas-series-online">

     <span class="texto-temporadas">Assitir Série Online Grátis - Todas as Temporadas</span>

<p></p>  
<br />   

<div id="temporadas-assistir">  

      <iframe id="temporadas-series" name="t" src="t/<?php echo $row_Re_Series['id']; ?>/1.php" width="205" scrolling="no" onload='iframeAutoHeight(this)'border="0"frameborder="0"></iframe>

</div> <!-- Fim da div "temporadas-assistir" --> 

<div id="temporadas-img"> 

     <span class="texto-temporadas-img"><?php echo $row_Re_Series['titulo']; ?></span>
     <br />
     <span class="texto-temporadas-img-1">Todas as Temporadas</span>

</div> <!-- Fim da div "temporadas-img" --> 

<div id="temporadas">  

      <?php echo $row_Re_Series['temporadas']; ?>
      
<p></p>      
<div id="obs-temporadas">      
      <hr>
      <span class="texto-obs-temporadas">OBS:</span>
      <br />
      <span class="texto-obs-temporadas-1">Ao clicar na temporada desejada,<br /> aguarde o seu carregamento ao lado.</span>
      
</div> <!-- Fim da div "obs-temporadas" -->

</div> <!-- Fim da div "temporadas" --> 
<div class="clear"></div> 

</div> <!-- Fim da div "temporadas-series-online" -->

<div id="problemas-com-series">

<div id="texto1-problemas-com-series">

     <span class="texto-problemas-com-series">Problemas com a Série Online ?</span>

</div> <!-- Fim da div "texto1-problemas-com-series" -->
<br />
<div id="texto2-problemas-com-series">

     <span class="texto1-problemas-com-series">Envie sua mensagem para nossa equipe.</span><br />
     <span class="texto1-problemas-com-series">Caso a Série ou sua Página tenha problemas como:</span>
     <p>
     <span class="texto2-problemas-com-series">Episódios Online removidos - (Séries).</span><br />
     <span class="texto2-problemas-com-series">Trailer removido.</span><br />
     <span class="texto2-problemas-com-series">Problemas com o vídeo.</span><br />
     <span class="texto2-problemas-com-series">Problemas com o som.</span><br />
     <span class="texto2-problemas-com-series">Outros.</span>
     <p>
     <span class="texto1-problemas-com-series">Obrigado pela sua colaboração.</span>

</div> <!-- Fim da div "texto2-problemas-com-series" -->

<div id="sistema-comentarios-problemas-com-series">
  
  <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
    <table width="440" class="KT_tngtable">
      <tr>
        
        <td width="257" height="30"><input type="text" name="nome" id="nome" value="<?php echo KT_escapeAttribute($row_rss_t_m_comentarios_s_p['nome']); ?>" size="45" />
        <br />
             <?php echo $tNGs->displayFieldHint("nome");?> <?php echo $tNGs->displayFieldError("s_t_m_comentarios_s_p", "nome"); ?> </td>
            
                  <td><div id="espaco"><label for="nome"><span class="texto-nome">Nome</span></label></div></td>
      </tr>
      <tr>
       
        <td height="30"><input type="text" name="email" id="email" value="<?php echo KT_escapeAttribute($row_rss_t_m_comentarios_s_p['email']); ?>" size="45" />
        <br />
             <?php echo $tNGs->displayFieldError("s_t_m_comentarios_s_p", "email"); ?> </td>
            
                  <td><div id="espaco"><label for="email"><span class="texto-nome">Email (Não será publicado)</span></label></div></td>
      </tr>
      <tr>
        
        <td height="15"><input type="text" name="serie_problemas" id="serie_problemas" value="<?php echo $row_Re_Series['titulo']; ?>" size="45" /> 
        <br />
             <?php echo $tNGs->displayFieldHint("serie_problemas");?> <?php echo $tNGs->displayFieldError("s_t_m_comentarios_s_p", "serie_problemas"); ?> </td>
             
                  <td><div id="espaco"><label for="serie_problemas"><span class="texto-nome">Nome da Série com Problemas</span></label></div></td>
      </tr>
      <tr>
        <td colspan="2" class="KT_th">
        <p>
          <textarea name="mensagem" id="mensagem" wrap="hard" cols="50" rows="11">Descreva os problemas contido nesta postagem.</textarea>
          </p>
          <p><?php echo $tNGs->displayFieldHint("mensagem");?> <?php echo $tNGs->displayFieldError("s_t_m_comentarios_s_p", "mensagem"); ?> </p>
          <label for="mensagem"></label> </td>
        </tr>
      <tr>
        <td height="54" colspan="2" align="left" valign="middle">
        
        <div id="erro_caracteres">
        
        <?php
	    echo $tNGs->getErrorMsg();
        ?>
        
        </div> <!-- Fim da div "erro_caracteres" -->
        
        <div id="caracteres">
        
        <div id="texto_caracteres">
        
        <span class="texto1_caracteres">Ajude-nos a verificar se você não é um robô</span>
        <p>
        <span class="texto2_caracteres">Insira os caracteres exibidos abaixo.</span></p>
        
        </div> <!-- Fim da div "texto_caracteres" -->
        
        <div id="texto_area_caracteres">
        
        <input type="text" name="captcha_id" id="captcha_id" value="" />
        <span class="simbolo_obrigatorio">*</span> 
        
        </div> <!-- Fim da div "texto_area_caracteres" -->
        
        <div id="captcha">
        
        <p></p>
        <img src="<?php echo $captcha_id_obj->getImageURL("../../");?>" border="1" /></div>

        <!-- Fim da div "captcha" -->
        
        </div> <!-- Fim da div "caracteres" -->
        
        </tr>
      <tr>
        <td colspan="2" align="center" valign="middle"><input type="submit" name="KT_Insert1" id="KT_Insert1" value="« Enviar Mensagem »" />        </td>
      </tr>
    </table>
    <input type="hidden" name="nome_series" id="nome_series" value="<?php echo $row_Re_Series['id']; ?> - <?php echo $row_Re_Series['titulo']; ?>" />
  </form>
  <p>&nbsp;</p>
</div> <!-- Fim da div "sistema-comentarios-problemas-com-series" -->

</div> <!-- Fim da div "problemas-com-series" -->

</div> <!-- Fim da div "series-conteudo" -->

<div id="pg-comentarios">

<div id="comentarios-series">

<?php if ($totalRows_Re_comentarios_s == 0) { // Show if recordset not empti ?>
<div id="msg-sem-comentarios">

       <span class="texto-msg-sem-comentarios">Seja o primeiro a deixar seu Comentário !</span>

</div> <!-- Fim da div "msg-sem-comentarios" -->
<?php } // Show if recordset not empti ?>

<?php if ($totalRows_Re_comentarios_s > 0) { // Show if recordset not empt ?>
<div id="comentarios-total">

       <span class="texto-comentarios-total">Total de Comentários: <?php echo $totalRows_Re_comentarios_s ?></span>

</div> <!-- Fim da div "comentarios-total" -->

<?php do { ?>
<div id="box-comentarios-series">

<div id="barra-img">

<div id="nome-usuario">

       <span class="texto-nome-usuario"><?php echo $row_Re_comentarios_s['nome']; ?>  Diz:</span>

</div> <!-- Fim da div "nome-usuario" -->

<div id="data-comentario">

       <span class="texto-data-comentario"><?php echo $row_Re_comentarios_s['data']; ?></span>

</div> <!-- Fim da div "data-comentario" -->

</div> <!-- Fim da div "barra-img" -->

<div id="editar-comentario">
<?php if ($totalRows_Re_editar_admin > 0) { // Mostrar Botao Editar Comentario ?>

      <input name="botao-editar-comentario" id="botao-editar-comentario"  type="button" onclick="window.open('login/index_admin.php?pag=alterar_comentarios_series&amp;id=<?php echo $row_Re_comentarios_s['id']; ?>')" title="Clique aqui, para editar o comentário" value="Editar Comentário »">

<?php } // Mostrar Botao Editar Comentario ?>           
</div> <!-- Fim da div "editar-comentario" -->

<div id="mensagem-comentario">

       <span class="texto-mensagem-comentario"><?php echo $row_Re_comentarios_s['mensagem']; ?></span>

</div> <!-- Fim da div "mensagem-comentario" -->

<div class="clear"></div>
</div> <!-- Fim da div "box-comentarios-series" -->
<?php } while ($row_Re_comentarios_s = mysql_fetch_assoc($Re_comentarios_s)); ?>
<?php } // Show if recordset not empt ?>
<hr>

</div> <!-- Fim da div "comentarios-series" -->

<div id="texto-comentarios-series"> 

<span class="texto1-comentarios-series">Deixe Seu Comentário</span>
      <p></p>
      <div id="espaco-texto3-comentarios-series">
      <span class="texto2-comentarios-series">Regras:</span>
      <br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-series" -->
      
      <div id="espaco-texto3-comentarios-series">
      <span class="texto3-comentarios-series">Não use palavras de baixo calão.</span><br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-series" -->
      
      <div id="espaco-texto3-comentarios-series">
      <span class="texto3-comentarios-series">Não tenha vergonha, pode perguntar a vontade.</span><br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-series" -->
      
      <div id="espaco-texto3-comentarios-series">
      <span class="texto3-comentarios-series">Comente! Diga o que achou da postagem!</span><br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-series" -->
      
      <div id="espaco-texto3-comentarios-series">
      <span class="texto3-comentarios-series">Se gostou, agradeça :D</span><br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-series" -->
      
      <div id="espaco-texto3-comentarios-series">
      <span class="texto3-comentarios-series"></span>
      </div> <!-- Fim da div "espaco-texto3-comentarios-series" -->

</div> <!-- Fim da div "texto-comentarios-series" -->

<div id="formulario-comentarios-series">
  <form method="post" id="form2" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
    <table width="430" border="0" cellpadding="0" cellspacing="0" class="KT_tngtable">
      <tr>
        
        <td width="254" height="35"><input type="text" name="nome" id="nome" value="<?php echo KT_escapeAttribute($row_rss_comentarios_series['nome']); ?>" size="45" />
        <br />
             <?php echo $tNGs->displayFieldHint("nome");?> <?php echo $tNGs->displayFieldError("s_comentarios_series", "nome"); ?> </td>
            
            <td width="176"><div id="espaco"><label for="nome"><span class="texto-nome">Nome</span></label></div></td>
      </tr>
      <tr>
        
        <td height="35"><input type="text" name="email" id="email" value="<?php echo KT_escapeAttribute($row_rss_comentarios_series['email']); ?>" size="45" />
        <br />
             <?php echo $tNGs->displayFieldError("s_comentarios_series", "email"); ?> </td>
            
            <td><div id="espaco"><label for="email"><span class="texto-nome">Email (Não será publicado)</span></label></div></td>
      </tr>
      <tr>
        
        <td height="20"><input type="text" name="site_blog" id="site_blog" value=" " size="45" />
        <br />
             <?php echo $tNGs->displayFieldHint("site_blog");?> <?php echo $tNGs->displayFieldError("s_comentarios_series", "site_blog"); ?> </td>
            
            <td><div id="espaco"><label for="site_blog"><span class="texto-nome">Site/Blog</span></label></div></td>
      </tr>
      <tr>
        <td colspan="2" class="KT_th">
        <p>
          <textarea name="mensagem" id="mensagem" wrap="hard" cols="50" rows="12"></textarea>
          </p>
          <p><?php echo $tNGs->displayFieldHint("mensagem");?> <?php echo $tNGs->displayFieldError("s_comentarios_series", "mensagem"); ?> </p>
          <label for="mensagem"></label></td>
        </tr>
      <tr>
        <td colspan="2" align="center" valign="middle"><input type="submit" name="KT_Insert2" id="KT_Insert2" value="« Enviar Comentário »" />        </td>
      </tr>
    </table>
    <input type="hidden" name="series" id="series" value="<?php echo $row_Re_Series['titulo']; ?>" />
    <input type="hidden" name="localizacao" id="localizacao" value="<?php echo $row_Re_Series['id']; ?>" />
    <input type="hidden" name="data" id="data" value="<?php echo date('d/m/Y',time()-0);?> às <?php echo date('H:i',time()-0);?>" />
  </form>

</div> <!-- Fim da div "formulario-comentarios-series" -->

</div> <!-- Fim da div "pg-comentarios" -->

</div> <!-- Fim da div "pg-series" -->
<?php } // Show if recordset not empt ?>

<?php if ($totalRows_Re_Series == 0) { // Show if recordset not empti ?>
<div id="sem-postagem">

      <span class="texto-sem-postagem">Não há postagem.</span>
      
</div> <!-- Fim da div "sem-postagem" -->
<?php } // Show if recordset not empti ?>      

</div> <!-- Fim da div "geral-series" -->

</body>
</html>
<?php
mysql_free_result($Re_Series);

mysql_free_result($Re_comentarios_s);

mysql_free_result($Re_editar_admin);
?>
