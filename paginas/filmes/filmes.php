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
$formValidation->addField("filme_problemas", true, "text", "", "2", "", "");
$formValidation->addField("mensagem", true, "text", "", "5", "", "");
$tNGs->prepareValidation($formValidation);
// End trigger

//start CheckCaptcha trigger
//remove this line if you want to edit the code by hand
function CheckCaptcha(&$tNG) {
	$captcha = new tNG_Captcha("captcha_id_id", $tNG);
	$captcha->setFormField("POST", "captcha_id");
	$captcha->setErrorMsg("Insira os caracteres exibidos");
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

$colname_Re_Filmes = "-1";
if (isset($_GET['id'])) {
  $colname_Re_Filmes = $_GET['id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Re_Filmes = sprintf("SELECT * FROM conteudo_filmes WHERE id = %s AND conteudo_filmes.status = 'Ativado'", GetSQLValueString($colname_Re_Filmes, "int"));
$Re_Filmes = mysql_query($query_Re_Filmes, $Mundo_Download) or die(mysql_error());
$row_Re_Filmes = mysql_fetch_assoc($Re_Filmes);
$totalRows_Re_Filmes = mysql_num_rows($Re_Filmes);

$colname_Re_comentarios = "-1";
if (isset($_GET['id'])) {
  $colname_Re_comentarios = $_GET['id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Re_comentarios = sprintf("SELECT * FROM s_comentarios_filmes WHERE localizacao = %s AND s_comentarios_filmes.status = 'Aprovado' ORDER BY id ASC", GetSQLValueString($colname_Re_comentarios, "text"));
$Re_comentarios = mysql_query($query_Re_comentarios, $Mundo_Download) or die(mysql_error());
$row_Re_comentarios = mysql_fetch_assoc($Re_comentarios);
$totalRows_Re_comentarios = mysql_num_rows($Re_comentarios);

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
$ins_s_t_m_comentarios_f_p = new tNG_insert($conn_Mundo_Download);
$tNGs->addTransaction($ins_s_t_m_comentarios_f_p);
// Register triggers
$ins_s_t_m_comentarios_f_p->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_s_t_m_comentarios_f_p->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_s_t_m_comentarios_f_p->registerTrigger("END", "Trigger_Default_Redirect", 99, "paginas/filmes/sistema_filmes_problemas/ms_sucesso_filmes_problemas.php?id={Re_Filmes.id}");
$ins_s_t_m_comentarios_f_p->registerTrigger("BEFORE", "CheckCaptcha", 10);
// Add columns
$ins_s_t_m_comentarios_f_p->setTable("s_t_m_comentarios_f_p");
$ins_s_t_m_comentarios_f_p->addColumn("nome", "STRING_TYPE", "POST", "nome");
$ins_s_t_m_comentarios_f_p->addColumn("email", "STRING_TYPE", "POST", "email");
$ins_s_t_m_comentarios_f_p->addColumn("filme_problemas", "STRING_TYPE", "POST", "filme_problemas");
$ins_s_t_m_comentarios_f_p->addColumn("nome_filmes", "STRING_TYPE", "POST", "nome_filmes");
$ins_s_t_m_comentarios_f_p->addColumn("mensagem", "STRING_TYPE", "POST", "mensagem");
$ins_s_t_m_comentarios_f_p->setPrimaryKey("id", "NUMERIC_TYPE");

// Make an insert transaction instance
$ins_s_comentarios_filmes = new tNG_insert($conn_Mundo_Download);
$tNGs->addTransaction($ins_s_comentarios_filmes);
// Register triggers
$ins_s_comentarios_filmes->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert2");
$ins_s_comentarios_filmes->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation1);
$ins_s_comentarios_filmes->registerTrigger("END", "Trigger_Default_Redirect", 99, "paginas/filmes/comentarios_envio_sucesso/comentarios_envio_sucesso.php?id={Re_Filmes.id}");
// Add columns
$ins_s_comentarios_filmes->setTable("s_comentarios_filmes");
$ins_s_comentarios_filmes->addColumn("nome", "STRING_TYPE", "POST", "nome");
$ins_s_comentarios_filmes->addColumn("email", "STRING_TYPE", "POST", "email");
$ins_s_comentarios_filmes->addColumn("site_blog", "STRING_TYPE", "POST", "site_blog");
$ins_s_comentarios_filmes->addColumn("filmes", "STRING_TYPE", "POST", "filmes");
$ins_s_comentarios_filmes->addColumn("localizacao", "STRING_TYPE", "POST", "localizacao");
$ins_s_comentarios_filmes->addColumn("mensagem", "STRING_TYPE", "POST", "mensagem");
$ins_s_comentarios_filmes->addColumn("data", "STRING_TYPE", "POST", "data");
$ins_s_comentarios_filmes->setPrimaryKey("id", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rss_t_m_comentarios_f_p = $tNGs->getRecordset("s_t_m_comentarios_f_p");
$row_rss_t_m_comentarios_f_p = mysql_fetch_assoc($rss_t_m_comentarios_f_p);
$totalRows_rss_t_m_comentarios_f_p = mysql_num_rows($rss_t_m_comentarios_f_p);

// Get the transaction recordset
$rss_comentarios_filmes = $tNGs->getRecordset("s_comentarios_filmes");
$row_rss_comentarios_filmes = mysql_fetch_assoc($rss_comentarios_filmes);
$totalRows_rss_comentarios_filmes = mysql_num_rows($rss_comentarios_filmes);

// Captcha Image
$captcha_id_obj = new KT_CaptchaImage("captcha_id_id");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Filmes</title>

<link href="../estrutura_css/filmes.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

<link href="../codigos/shadowbox/shadowbox.css" rel="stylesheet" type="text/css" />  <!-- Shadowbox -->

<script type="text/javascript" src="../codigos/limpar_area_texto/limpar_area_texto.js"></script>  <!-- Limpar area de texto -->

<link href="../../includes/skins/mxkollection_editar.css" rel="stylesheet" type="text/css" media="all" />
<script src="../../includes/common/js/base.js" type="text/javascript"></script>
<script src="../../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?></head>

<body>

<div id="geral-filmes">

<?php if ($totalRows_Re_Filmes > 0) { // Show if recordset not empt ?>
<div id="pg-filmes">

<div id="filmes-pg-img">

<div id="titulo-filmes-img">

     <a href="../../index.php?pag=filmes&amp;id=<?php echo $row_Re_Filmes['id']; ?>" class="titulo-filmes-img">
     <span class="titulo-filmes-img">Baixar Filme </span>
     <span class="titulo-filmes-img"><?php echo $row_Re_Filmes['titulo']; ?></span>
     <span class="titulo-filmes-img"> – </span>
     <span class="titulo-filmes-img"><?php echo $row_Re_Filmes['idioma']; ?></span>
     </a> 

</div> <!-- Fim da div "titulo-filmes-img" -->

<div id="data-filmes-img">

     <span class="texto-data-filmes-img">Postado dia: </span>
     <span class="data-filmes-img"><?php echo $row_Re_Filmes['data_da_postagem']; ?></span>

</div> <!-- Fim da div "data-filmes-img" -->

</div> <!-- Fim da div "filmes-pg-img" -->
<div class="clear"></div>

<div id="filmes-conteudo">

<div id="editar-postagem">
<?php if ($totalRows_Re_editar_admin > 0) { // Mostrar Botao Editar Postagem ?>

      <input type="submit" name="botao-editar-postagem" id="botao-editar-postagem" onclick="window.open('../../login/index_admin.php?pag=editar_filmes&amp;id=<?php echo $row_Re_Filmes['id']; ?>')" title="Clique aqui, para editar a postagem" value="Editar postagem »" />
      
<?php } // Mostrar Botao Editar Postagem ?>        
</div> <!-- Fim da div "editar-postagem" -->

<div class="clear"></div>
<div id="filmes-img">

     <img src="../../conteudo/filmes/img/<?php echo $row_Re_Filmes['imagem']; ?>" width="220" height="310" border="0" />

</div> <!-- Fim da div "filmes-img" -->

<div id="filmes-sinopse">

     <span class="sinopse">Sinopse: </span>
     <span class="texto-sinopse"><?php echo $row_Re_Filmes['sinopse']; ?></span>

<div class="clear"></div>
</div> <!-- Fim da div "filmes-sinopse" -->

<div id="filmes-trailer">

     <span class="texto-trailer">Trailer do Filme: </span>
     <span class="titulo-trailer"><?php echo $row_Re_Filmes['titulo']; ?></span>
     <p>
     <iframe width="430" height="300" src="<?php echo $row_Re_Filmes['trailer']; ?>?rel=0" frameborder="0" allowfullscreen></iframe>

</div> <!-- Fim da div "filmes-trailer" -->

<div id="dados-do-filme">

     <span class="dados-do-filme">Dados do Filme:</span>
     <p>
     <span class="texto2-dados-do-filme"><?php echo $row_Re_Filmes['dados_do_filme']; ?></span>

</div> <!-- Fim da div "dados-do-filme" -->

<div id="video-aula-filmes-online">

     <a title="Vídeo Aula - Como Assistir Filmes Online" class="texto-video-aulas" href="http://www.youtube.com/embed/MadVcyIaZg0?rel=0" rel="shadowbox;width=640;height=360">« Clique aqui, Vídeo Aulas - Como Assistir Filmes Online »</a>

</div> <!-- Fim da div "video-aula-filmes-online" -->

<p>

<div id="filmes-online">

     <span class="t-f-2">Assitir Filme Online Grátis - </span>
     <span class="t-f-2"><?php echo $row_Re_Filmes['idioma']; ?></span>
     <p>
     <?php echo $row_Re_Filmes['links_filmes_online']; ?>

</div> <!-- Fim da div "filmes-online" -->

<div id="video-aula">

     <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
     <script type="text/javascript" src="../codigos/shadowbox/shadowbox.js"></script>
     <script type="text/javascript" src="../codigos/shadowbox/acao.js"></script>

     <a title="Vídeo Aula - Como Baixar Filmes" class="texto-video-aulas" href="http://www.youtube.com/embed/MadVcyIaZg0?rel=0" rel="shadowbox[vocation];width=640;height=360">« Clique aqui, Vídeo Aulas - Como Baixar Filmes »</a>
     <a title="Vídeo Aula de como Baixar Filmes" href="http://www.youtube.com/embed/w52YN8QZgsk?rel=0" rel="shadowbox[vocation];width=640;height=360"></a>

</div> <!-- Fim da div "video-aula" -->

<p>

<div id="filmes-download-rmvb">

     <span class="t-f-2">Baixar Filme com o Formato - RMVB - </span>
     <span class="t-f-2"><?php echo $row_Re_Filmes['idioma']; ?></span>
     <p>
     <?php echo $row_Re_Filmes['download_rmvb']; ?>

</div> <!-- Fim da div "filmes-download-rmvb" -->

<div id="filmes-download-avi">

     <span class="t-f-2">Baixar Filme com o Formato - AVI - </span>
     <span class="t-f-2"><?php echo $row_Re_Filmes['idioma']; ?></span>
     <p>
     <?php echo $row_Re_Filmes['download_avi']; ?>

</div> <!-- Fim da div "filmes-download-avi" -->

<div id="problemas-com-filmes">

<div id="texto1-problemas-com-filmes">

     <span class="texto-problemas-com-filmes">Problemas com o Filme ou Links removidos ?</span>

</div> <!-- Fim da div "texto1-problemas-com-filmes" -->
<br />
<div id="texto2-problemas-com-filmes">

     <span class="texto1-problemas-com-filmes">Envie sua mensagem para nossa equipe.</span><br />
     <span class="texto1-problemas-com-filmes">Caso o Filme ou sua Página tenha problemas como:</span>
     <p>
     <span class="texto2-problemas-com-filmes">Links removidos.</span><br />
     <span class="texto2-problemas-com-filmes">Filme Online removido.</span><br />
     <span class="texto2-problemas-com-filmes">Trailer removido.</span><br />
     <span class="texto2-problemas-com-filmes">Problemas com o vídeo.</span><br />
     <span class="texto2-problemas-com-filmes">Problemas com o som.</span><br />
     <span class="texto2-problemas-com-filmes">Outros.</span>
     <p>
     <span class="texto1-problemas-com-filmes">Obrigado pela sua colaboração.</span>

</div> <!-- Fim da div "texto2-problemas-com-filmes" -->

<div id="sistema-comentarios-problemas-com-filmes">
 
  <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
    <table width="440" class="KT_tngtable">
      <tr>
        
        <td width="257" height="30"><input type="text" name="nome" id="nome" value="<?php echo KT_escapeAttribute($row_rss_t_m_comentarios_f_p['nome']); ?>" size="45" />
        <br />
              <?php echo $tNGs->displayFieldHint("nome");?> <?php echo $tNGs->displayFieldError("s_t_m_comentarios_f_p", "nome"); ?> </td>
            
                    <td><div id="espaco"><label for="nome"><span class="texto-nome">Nome</span></label></div></td>
      </tr>
      <tr>
        
        <td height="30"><input type="text" name="email" id="email" value="<?php echo KT_escapeAttribute($row_rss_t_m_comentarios_f_p['email']); ?>" size="45" />
        <br />
             <?php echo $tNGs->displayFieldError("s_t_m_comentarios_f_p", "email"); ?> </td>
            
                   <td><div id="espaco"><label for="email"><span class="texto-nome">Email (Não será publicado)</span></label></div></td>
      </tr>
      <tr>
        
        <td height="15"><input type="text" name="filme_problemas" id="filme_problemas" value="<?php echo $row_Re_Filmes['titulo']; ?>" size="45" />
        <br />
            <?php echo $tNGs->displayFieldHint("filme_problemas");?> <?php echo $tNGs->displayFieldError("s_t_m_comentarios_f_p", "filme_problemas"); ?> </td>
            
                <td><div id="espaco"><label for="filme_problemas"><span class="texto-nome">Nome do Filme com Problemas</span></label></div></td>
      </tr>
      <tr>
        <td colspan="2" class="KT_th">
        <p>
          <textarea name="mensagem" id="mensagem" wrap="hard" cols="50" rows="11">Descreva os problemas contido nesta postagem.</textarea>
          </p>
          <p><?php echo $tNGs->displayFieldHint("mensagem");?> <?php echo $tNGs->displayFieldError("s_t_m_comentarios_f_p", "mensagem"); ?> </p>
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
        
        <input name="captcha_id" type="text" id="captcha_id" value="" size="40" />
        <span class="simbolo_obrigatorio">*</span> 
        
        </div> <!-- Fim da div "texto_area_caracteres" -->
        
        <div id="captcha">
        
        <p></p>
        <img src="<?php echo $captcha_id_obj->getImageURL("../../");?>" border="1" /></div>

        <!-- Fim da div "captcha" -->
        
        </div> <!-- Fim da div "caracteres" -->
        
        
       </td>
      </tr>
      <tr>
        <td colspan="2" align="center" valign="middle"><input type="submit" name="KT_Insert1" id="KT_Insert1" value="« Enviar Mensagem »" />        </td>
      </tr>
    </table>
    <input type="hidden" name="nome_filmes" id="nome_filmes" value="<?php echo $row_Re_Filmes['id']; ?> - <?php echo $row_Re_Filmes['titulo']; ?>" />
  </form>
  <p>&nbsp;</p>
  
</div> <!-- Fim da div "sistema-comentarios-problemas-com-filmes" -->

</div> <!-- Fim da div "problemas-com-filmes" -->

</div> <!-- Fim da div "filmes-conteudo" -->

<div id="pg-comentarios">

<div id="comentarios-filmes"> 

<?php if ($totalRows_Re_comentarios == 0) { // Show if recordset not empti ?>
<div id="msg-sem-comentarios">

       <span class="texto-msg-sem-comentarios">Seja o primeiro a deixar seu Comentário !</span>

</div> <!-- Fim da div "msg-sem-comentarios" -->
<?php } // Show if recordset not empti ?>

<?php if ($totalRows_Re_comentarios > 0) { // Show if recordset not empt ?>
<div id="comentarios-total">

       <span class="texto-comentarios-total">Total de Comentários: <?php echo $totalRows_Re_comentarios ?></span>

</div> <!-- Fim da div "comentarios-total" -->

<?php do { ?>
<div id="box-comentarios-filmes">

<div id="barra-img">

<div id="nome-usuario">

       <span class="texto-nome-usuario"><?php echo $row_Re_comentarios['nome']; ?>  Diz:</span>

</div> <!-- Fim da div "nome-usuario" -->

<div id="data-comentario">

       <span class="texto-data-comentario"><?php echo $row_Re_comentarios['data']; ?></span>

</div> <!-- Fim da div "data-comentario" -->

</div> <!-- Fim da div "barra-img" -->

<div id="editar-comentario">
<?php if ($totalRows_Re_editar_admin > 0) { // Mostrar Botao Editar Comentario ?>

      <input name="botao-editar-comentario" id="botao-editar-comentario"  type="button" onclick="window.open('login/index_admin.php?pag=alterar_comentarios_filmes&amp;id=<?php echo $row_Re_comentarios['id']; ?>')" title="Clique aqui, para editar o comentário" value="Editar Comentário »">

<?php } // Mostrar Botao Editar Comentario ?>           
</div> <!-- Fim da div "editar-comentario" -->

<div id="mensagem-comentario">

       <span class="texto-mensagem-comentario"><?php echo $row_Re_comentarios['mensagem']; ?></span>

</div> <!-- Fim da div "mensagem-comentario" -->

<div class="clear"></div>
</div> <!-- Fim da div "box-comentarios-filmes" -->
<?php } while ($row_Re_comentarios = mysql_fetch_assoc($Re_comentarios)); ?>
<?php } // Show if recordset not empt ?>
<hr>

</div> <!-- Fim da div "comentarios-filmes" --> 

<div id="texto-comentarios-filmes">   

      <span class="texto1-comentarios-filmes">Deixe Seu Comentário</span>
      <p></p>
      <div id="espaco-texto3-comentarios-filmes">
      <span class="texto2-comentarios-filmes">Regras:</span>
      <br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-filmes" -->
      
      <div id="espaco-texto3-comentarios-filmes">
      <span class="texto3-comentarios-filmes">Não use palavras de baixo calão.</span><br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-filmes" -->
      
      <div id="espaco-texto3-comentarios-filmes">
      <span class="texto3-comentarios-filmes">Não tenha vergonha, pode perguntar a vontade.</span><br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-filmes" -->
      
      <div id="espaco-texto3-comentarios-filmes">
      <span class="texto3-comentarios-filmes">Comente! Diga o que achou da postagem!</span><br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-filmes" -->
      
      <div id="espaco-texto3-comentarios-filmes">
      <span class="texto3-comentarios-filmes">Se gostou, agradeça :D</span><br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-filmes" -->
      
      <div id="espaco-texto3-comentarios-filmes">
      <span class="texto3-comentarios-filmes"></span>
      </div> <!-- Fim da div "espaco-texto3-comentarios-filmes" -->

</div> <!-- Fim da div "texto-comentarios-filmes" --> 

<div id="formulario-comentarios-filmes">
  <form method="post" id="form2" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
    <table width="430" border="0" cellpadding="0" cellspacing="0" class="KT_tngtable">
      <tr>
        
        <td width="254" height="35"><input type="text" name="nome" id="nome" value="<?php echo KT_escapeAttribute($row_rss_comentarios_filmes['nome']); ?>" size="45" />
        <br />
            <?php echo $tNGs->displayFieldHint("nome");?> <?php echo $tNGs->displayFieldError("s_comentarios_filmes", "nome"); ?> </td>
            
            <td width="176"><div id="espaco"><label for="nome"><span class="texto-nome">Nome</span></label></div></td>
      </tr>
      <tr>
        
        <td height="35"><input type="text" name="email" id="email" value="<?php echo KT_escapeAttribute($row_rss_comentarios_filmes['email']); ?>" size="45" />
        <br />
        <?php echo $tNGs->displayFieldError("s_comentarios_filmes", "email"); ?> </td>
            
            <td><div id="espaco"><label for="email"><span class="texto-nome">Email (Não será publicado)</span></label></div></td>
      </tr>
      <tr>
        
        <td height="20"><input name="site_blog" type="text" id="site_blog" value=" " size="45" />
        <br />
            <?php echo $tNGs->displayFieldHint("site_blog");?> <?php echo $tNGs->displayFieldError("s_comentarios_filmes", "site_blog"); ?> </td>
            
            <td><div id="espaco"><label for="site_blog"><span class="texto-nome">Site/Blog</span></label></div></td>
      </tr>
      <tr>
        <td colspan="2" class="KT_th">
        <p>
          <textarea name="mensagem" id="mensagem" wrap="hard" cols="50" rows="12"></textarea>
          </p>
          <p><?php echo $tNGs->displayFieldHint("mensagem");?> <?php echo $tNGs->displayFieldError("s_comentarios_filmes", "mensagem"); ?> </p>
          <label for="mensagem"></label></td>
        </tr>
      <tr>
        <td colspan="2" align="center" valign="middle"><input type="submit" name="KT_Insert2" id="KT_Insert2" value="« Enviar Comentário »" />        </td>
      </tr>
    </table>
    <input type="hidden" name="filmes" id="filmes" value="<?php echo $row_Re_Filmes['titulo']; ?>" />
    <input type="hidden" name="localizacao" id="localizacao" value="<?php echo $row_Re_Filmes['id']; ?>" />
    <input type="hidden" name="data" id="data" value="<?php echo date('d/m/Y',time()-0);?> às <?php echo date('H:i',time()-0);?>" />
  </form>

</div> <!-- Fim da div "formulario-comentarios-filmes" -->
      
</div> <!-- Fim da div "pg-comentarios" -->

</div> <!-- Fim da div "pg-filmes" -->
<?php } // Show if recordset not empt ?>

<?php if ($totalRows_Re_Filmes == 0) { // Show if recordset not empti ?>
<div id="sem-postagem">

      <span class="texto-sem-postagem">Não há postagem.</span>

</div> <!-- Fim da div "sem-postagem" -->
<?php } // Show if recordset not empti ?>

</div> <!-- Fim da div "geral-filmes" -->

</body>
</html>
<?php
mysql_free_result($Re_Filmes);

mysql_free_result($Re_comentarios);

mysql_free_result($Re_editar_admin);
?>
