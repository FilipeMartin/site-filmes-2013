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
$formValidation->addField("mensagem_m_p", true, "text", "", "5", "500", "");
$tNGs->prepareValidation($formValidation);
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

mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Re_msg_elogios = "SELECT * FROM s_comentarios_m_p WHERE localizacao = 'Elogios' AND s_comentarios_m_p.status = 'Aprovado' ORDER BY id ASC";
$Re_msg_elogios = mysql_query($query_Re_msg_elogios, $Mundo_Download) or die(mysql_error());
$row_Re_msg_elogios = mysql_fetch_assoc($Re_msg_elogios);
$totalRows_Re_msg_elogios = mysql_num_rows($Re_msg_elogios);

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
$ins_s_comentarios_m_p = new tNG_insert($conn_Mundo_Download);
$tNGs->addTransaction($ins_s_comentarios_m_p);
// Register triggers
$ins_s_comentarios_m_p->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_s_comentarios_m_p->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_s_comentarios_m_p->registerTrigger("END", "Trigger_Default_Redirect", 99, "paginas/menu_principal/comentarios_envio_sucesso/comentarios_envio_sucesso_elogios.php");
// Add columns
$ins_s_comentarios_m_p->setTable("s_comentarios_m_p");
$ins_s_comentarios_m_p->addColumn("nome", "STRING_TYPE", "POST", "nome");
$ins_s_comentarios_m_p->addColumn("email", "STRING_TYPE", "POST", "email");
$ins_s_comentarios_m_p->addColumn("site_blog", "STRING_TYPE", "POST", "site_blog");
$ins_s_comentarios_m_p->addColumn("localizacao", "STRING_TYPE", "POST", "localizacao");
$ins_s_comentarios_m_p->addColumn("mensagem_m_p", "STRING_TYPE", "POST", "mensagem_m_p");
$ins_s_comentarios_m_p->addColumn("data", "STRING_TYPE", "POST", "data");
$ins_s_comentarios_m_p->setPrimaryKey("id", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rss_comentarios_m_p = $tNGs->getRecordset("s_comentarios_m_p");
$row_rss_comentarios_m_p = mysql_fetch_assoc($rss_comentarios_m_p);
$totalRows_rss_comentarios_m_p = mysql_num_rows($rss_comentarios_m_p);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Elogios</title>

<link href="../estrutura_css/elogios.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

<script type="text/javascript" src="../codigos/limpar_area_texto/limpar_area_texto.js"></script>  <!-- Limpar area de texto -->

<link href="../../includes/skins/mxkollection_editar.css" rel="stylesheet" type="text/css" media="all" />
<script src="../../includes/common/js/base.js" type="text/javascript"></script>
<script src="../../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>

</head>

<body>

<div id="geral-elogios">

<div id="pg-elogios">

<div id="elogios-pg-img">

<div id="titulo-elogios-img">

      <a href="../../index.php?pag=elogios" class="titulo-elogios-img">Elogios e Indicações de Filmes</a>

</div> <!-- Fim da div "titulo-elogios-img" -->

<div id="data-elogios-img">

     <span class="texto-data-elogios-img">Postado dia: </span>
     <span class="data-elogios-img">25 de dez de 2012</span>

</div> <!-- Fim da div "data-elogios-img" -->

</div> <!-- Fim da div "elogios-pg-img" -->
<div class="clear"></div>

<div id="elogios-conteudo">

<div id="elogios-img">

     <img src="../../conteudo/menu_principal/elogios/img/elogios.gif" width="220" height="310" border="0" />

</div> <!-- Fim da div "elogios-img" -->

<div id="texto-principal">

   <ul>
     <span class="texto-principal">
     
     <li>Área exclusiva, para que todos os usuários possam elogiar o site,<br />Mundo Download.<br />
     Para que não fique bagunçado, elogiem aqui.. xD</li>
     <p></p>
     <br />
     <li>Nesta área, você poderá indicar filmes para outros usuários, para<br />que possam ter idéia, se o filme é bom ou não.
     <p>Ex: Vou indicar um bom filme para vocês…</p>
        O Vingador do Futuro (Ação) Muito Bom…
     </li>
     <p></p>
     <br />
     <li>Agora indiquem seus preferidos… E elogiem o site…<p>Obrigado pela sua colaboração.</p></li>
     </span>
     <p></p>
     <br />
     <span class="texto-principal-admin">Administrador, Filipe</span>
   </ul>

</div> <!-- Fim da div "texto-principal" -->

<div id="pg-sistema-comentarios">

<div id="comentarios-elogios">

<?php if ($totalRows_Re_msg_elogios == 0) { // Show if recordset not empti ?>
<div id="msg-sem-comentarios">

       <span class="texto-msg-sem-comentarios">Seja o primeiro a deixar seu Comentário !</span>

</div> <!-- Fim da div "msg-sem-comentarios" -->
<?php } // Show if recordset not empti ?>

<?php if ($totalRows_Re_msg_elogios > 0) { // Show if recordset not empt ?>
<div id="comentarios-total">

       <span class="texto-comentarios-total">Total de Comentários: <?php echo $totalRows_Re_msg_elogios ?></span>

</div> <!-- Fim da div "comentarios-total" -->

<?php do { ?>
<div id="box-comentarios-elogios">

<div id="barra-img">

<div id="nome-usuario">

       <span class="texto-nome-usuario"><?php echo $row_Re_msg_elogios['nome']; ?>  Diz:</span>

</div> <!-- Fim da div "nome-usuario" -->

<div id="data-comentario">

       <span class="texto-data-comentario"><?php echo $row_Re_msg_elogios['data']; ?></span>

</div> <!-- Fim da div "data-comentario" -->

</div> <!-- Fim da div "barra-img" -->

<div id="editar-comentario">
<?php if ($totalRows_Re_editar_admin > 0) { // Mostrar Botao Editar Comentario ?>

      <input name="botao-editar-comentario" id="botao-editar-comentario"  type="button" onclick="window.open('../../login/index_admin.php?pag=alterar_comentarios_menu_principal&amp;id=<?php echo $row_Re_msg_elogios['id']; ?>')" title="Clique aqui, para editar o comentário" value="Editar Comentário »">

<?php } // Mostrar Botao Editar Comentario ?>           
</div> <!-- Fim da div "editar-comentario" -->

<div id="mensagem-comentario">

       <span class="texto-mensagem-comentario"><?php echo $row_Re_msg_elogios['mensagem_m_p']; ?></span>

</div> <!-- Fim da div "mensagem-comentario" -->

<div class="clear"></div>
</div> <!-- Fim da div "box-comentarios-elogios" -->
<?php } while ($row_Re_msg_elogios = mysql_fetch_assoc($Re_msg_elogios)); ?>
<?php } // Show if recordset not empt ?>
<hr>

</div> <!-- Fim da div "comentarios-elogios" -->

<div id="texto-comentarios-elogios">

<span class="texto1-comentarios-elogios">Deixe Seu Comentário</span>
      <p></p>
      <div id="espaco-texto3-comentarios-elogios">
      <span class="texto2-comentarios-elogios">Regras:</span>
      <br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-elogios" -->
      
      <div id="espaco-texto3-comentarios-elogios">
      <span class="texto3-comentarios-elogios">Não use palavras de baixo calão.</span><br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-elogios" -->
      
      <div id="espaco-texto3-comentarios-elogios">
      <span class="texto3-comentarios-elogios">Não tenha vergonha, pode perguntar a vontade.</span><br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-elogios" -->
      
      <div id="espaco-texto3-comentarios-elogios">
      <span class="texto3-comentarios-elogios">Comente! Diga o que achou da postagem!</span><br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-elogios" -->
      
      <div id="espaco-texto3-comentarios-elogios">
      <span class="texto3-comentarios-elogios">Se gostou, agradeça :D</span><br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-elogios" -->
      
      <div id="espaco-texto3-comentarios-elogios">
      <span class="texto3-comentarios-elogios"></span>
      </div> <!-- Fim da div "espaco-texto3-comentarios-elogios" -->

</div> <!-- Fim da div "texto-comentarios-elogios" --> 

<div id="formulario-comentarios-elogios">
 
  <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
    <table width="430" border="0" cellpadding="0" cellspacing="0" class="KT_tngtable">
      <tr>
        
        <td width="254" height="35"><input type="text" name="nome" id="nome" value="<?php echo KT_escapeAttribute($row_rss_comentarios_m_p['nome']); ?>" size="45" />
        <br />
            <?php echo $tNGs->displayFieldHint("nome");?> <?php echo $tNGs->displayFieldError("s_comentarios_m_p", "nome"); ?> </td>
            
            <td width="176"><div id="espaco"><label for="nome"><span class="texto-nome">Nome</span></label></div></td>
      </tr>
      <tr>
        
        <td height="35"><input type="text" name="email" id="email" value="<?php echo KT_escapeAttribute($row_rss_comentarios_m_p['email']); ?>" size="45" />
        <br />
            <?php echo $tNGs->displayFieldError("s_comentarios_m_p", "email"); ?> </td>
            
            <td><div id="espaco"><label for="email"><span class="texto-nome">Email (Não será publicado)</span></label></div></td>
      </tr>
      <tr>
        
        <td height="20"><input type="text" name="site_blog" id="site_blog" value=" " size="45" />
        <br />
            <?php echo $tNGs->displayFieldHint("site_blog");?> <?php echo $tNGs->displayFieldError("s_comentarios_m_p", "site_blog"); ?> </td>
            
            <td><div id="espaco"><label for="site_blog"><span class="texto-nome">Site/Blog</span></label></div></td>
      </tr>
      <tr>
        <td colspan="2" class="KT_th">
        <p>
          <textarea name="mensagem_m_p" id="mensagem_m_p" wrap="hard" cols="50" rows="12"></textarea>
          </p>
          <p><?php echo $tNGs->displayFieldHint("mensagem_m_p");?> <?php echo $tNGs->displayFieldError("s_comentarios_m_p", "mensagem_m_p"); ?> </p>
          <label for="mensagem_m_p"></label></td>
        </tr>
      <tr>
        <td colspan="2" align="center" valign="middle"><input type="submit" name="KT_Insert1" id="KT_Insert1" value="« Enviar Comentário »" /> </td>
      </tr>
    </table>
    <input type="hidden" name="localizacao" id="localizacao" value="Elogios" />
    <input type="hidden" name="data" id="data" value="<?php echo date('d/m/Y',time()-0);?> às <?php echo date('H:i',time()-0);?>" />
  </form>

</div> <!-- Fim da div "formulario-comentarios-elogios" -->

</div> <!-- Fim da div "pg-sistema-comentarios" -->

</div> <!-- Fim da div "elogios-conteudo" -->

</div> <!-- Fim da div "pg-elogios" -->

</div> <!-- Fim da div "geral-elogios" -->

</body>
</html>
<?php
mysql_free_result($Re_msg_elogios);

mysql_free_result($Re_editar_admin);
?>
