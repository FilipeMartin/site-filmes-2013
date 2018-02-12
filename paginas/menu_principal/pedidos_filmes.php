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
$query_Re_msg_p_filmes = "SELECT * FROM s_comentarios_m_p WHERE localizacao = 'Filmes' AND s_comentarios_m_p.status = 'Aprovado' ORDER BY id ASC";
$Re_msg_p_filmes = mysql_query($query_Re_msg_p_filmes, $Mundo_Download) or die(mysql_error());
$row_Re_msg_p_filmes = mysql_fetch_assoc($Re_msg_p_filmes);
$totalRows_Re_msg_p_filmes = mysql_num_rows($Re_msg_p_filmes);

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
$ins_s_comentarios_m_p->registerTrigger("END", "Trigger_Default_Redirect", 99, "paginas/menu_principal/comentarios_envio_sucesso/comentarios_envio_sucesso_pedidos_filmes.php");
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
<title>Mundo Download - Pedidos de Filmes e Shows</title>

<link href="../estrutura_css/pedidos_filmes.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

<script type="text/javascript" src="../codigos/limpar_area_texto/limpar_area_texto.js"></script>  <!-- Limpar area de texto -->

<link href="../../includes/skins/mxkollection_editar.css" rel="stylesheet" type="text/css" media="all" />
<script src="../../includes/common/js/base.js" type="text/javascript"></script>
<script src="../../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>

</head>

<body>

<div id="geral-pedidos-filmes">

<div id="pg-pedidos-filmes">

<div id="pedidos-filmes-pg-img">

<div id="titulo-pedidos-filmes-img">

      <a href="../../index.php?pag=pedidos_filmes" class="titulo-pedidos-filmes-img">Pedidos de Filmes e Shows</a>

</div> <!-- Fim da div "titulo-pedidos-filmes-img" -->

<div id="data-pedidos-filmes-img">

     <span class="texto-data-pedidos-filmes-img">Postado dia: </span>
     <span class="data-pedidos-filmes-img">25 de dez de 2012</span>

</div> <!-- Fim da div "data-pedidos-filmes-img" -->

</div> <!-- Fim da div "pedidos-filmes-pg-img" -->
<div class="clear"></div>

<div id="pedidos-filmes-conteudo">

<div id="pedidos-filmes-img">

     <img src="../../conteudo/menu_principal/pedidos_filmes/img/Pedido_Filmes.jpg" width="220" height="310" border="0" />

</div> <!-- Fim da div "pedidos-filmes-img" -->

<div id="texto-principal">

   <ul>
     <span class="texto-principal">
     
     <li><p>Quer fazer algum pedido de filmes ou shows?</p></li>
     <br />
     <li>Nesta área, você poderá fazer seus pedidos por filmes e shows,<br />a equipe Mundo Download fazerá o possível para encontrá-los.</li>
     <br />
     <p><li>E se preciso, mais algumas informações (opcional)</p>
     <span class="texto-principal-admin">Obs:</span> 6 Pedidos no máximo na lista.
     <p><span class="texto-principal-admin">Obs¹:</span> Pedido somente de filmes e shows.</p>
     <span class="texto-principal-admin">Obs²:</span> Pessoal… quanto mais informações do filme melhor…
     </li>
     <p></p>
     <br />
     <li>Se estiver de acordo com isso, faça seu pedido…</li>
     </span>
     <p></p>
     <br />
     <span class="texto-principal-admin">Administrador, Filipe</span>
   </ul>

</div> <!-- Fim da div "texto-principal" -->

<div id="pg-sistema-comentarios">

<div id="comentarios-pedidos-filmes">

<?php if ($totalRows_Re_msg_p_filmes == 0) { // Show if recordset not empti ?>
<div id="msg-sem-comentarios">

       <span class="texto-msg-sem-comentarios">Seja o primeiro a deixar seu Comentário !</span>

</div> <!-- Fim da div "msg-sem-comentarios" -->
<?php } // Show if recordset not empti ?>

<?php if ($totalRows_Re_msg_p_filmes > 0) { // Show if recordset not empt ?>
<div id="comentarios-total">

       <span class="texto-comentarios-total">Total de Comentários: <?php echo $totalRows_Re_msg_p_filmes ?></span>

</div> <!-- Fim da div "comentarios-total" -->

<?php do { ?>
<div id="box-comentarios-pedidos-filmes">

<div id="barra-img">

<div id="nome-usuario">

       <span class="texto-nome-usuario"><?php echo $row_Re_msg_p_filmes['nome']; ?>  Diz:</span>

</div> <!-- Fim da div "nome-usuario" -->

<div id="data-comentario">

       <span class="texto-data-comentario"><?php echo $row_Re_msg_p_filmes['data']; ?></span>

</div> <!-- Fim da div "data-comentario" -->

</div> <!-- Fim da div "barra-img" -->

<div id="editar-comentario">
<?php if ($totalRows_Re_editar_admin > 0) { // Mostrar Botao Editar Comentario ?>

      <input name="botao-editar-comentario" id="botao-editar-comentario"  type="button" onclick="window.open('../../login/index_admin.php?pag=alterar_comentarios_menu_principal&amp;id=<?php echo $row_Re_msg_p_filmes['id']; ?>')" title="Clique aqui, para editar o comentário" value="Editar Comentário »">

<?php } // Mostrar Botao Editar Comentario ?>           
</div> <!-- Fim da div "editar-comentario" -->

<div id="mensagem-comentario">

       <span class="texto-mensagem-comentario"><?php echo $row_Re_msg_p_filmes['mensagem_m_p']; ?></span>

</div> <!-- Fim da div "mensagem-comentario" -->

<div class="clear"></div>
</div> <!-- Fim da div "box-comentarios-pedidos-filmes" -->
<?php } while ($row_Re_msg_p_filmes = mysql_fetch_assoc($Re_msg_p_filmes)); ?>
<?php } // Show if recordset not empt ?>
<hr>

</div> <!-- Fim da div "comentarios-pedidos-filmes" -->

<div id="texto-comentarios-pedidos-filmes">

<span class="texto1-comentarios-pedidos-filmes">Deixe Seu Comentário</span>
      <p></p>
      <div id="espaco-texto3-comentarios-pedidos-filmes">
      <span class="texto2-comentarios-pedidos-filmes">Regras:</span>
      <br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-pedidos-filmes" -->
      
      <div id="espaco-texto3-comentarios-pedidos-filmes">
      <span class="texto3-comentarios-pedidos-filmes">Não use palavras de baixo calão.</span><br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-pedidos-filmes" -->
      
      <div id="espaco-texto3-comentarios-pedidos-filmes">
      <span class="texto3-comentarios-pedidos-filmes">Não tenha vergonha, pode perguntar a vontade.</span><br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-pedidos-filmes" -->
      
      <div id="espaco-texto3-comentarios-pedidos-filmes">
      <span class="texto3-comentarios-pedidos-filmes">Comente! Diga o que achou da postagem!</span><br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-pedidos-filmes" -->
      
      <div id="espaco-texto3-comentarios-pedidos-filmes">
      <span class="texto3-comentarios-pedidos-filmes">Se gostou, agradeça :D</span><br />
      </div> <!-- Fim da div "espaco-texto3-comentarios-pedidos-filmes" -->
      
      <div id="espaco-texto3-comentarios-pedidos-filmes">
      <span class="texto3-comentarios-pedidos-filmes"></span>
      </div> <!-- Fim da div "espaco-texto3-comentarios-pedidos-filmes" -->

</div> <!-- Fim da div "texto-comentarios-pedidos-filmes" --> 

<div id="formulario-comentarios-pedidos-filmes">
 
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
    <input type="hidden" name="localizacao" id="localizacao" value="Filmes" />
    <input type="hidden" name="data" id="data" value="<?php echo date('d/m/Y',time()-0);?> às <?php echo date('H:i',time()-0);?>" />
  </form>

</div> <!-- Fim da div "formulario-comentarios-pedidos-filmes" -->

</div> <!-- Fim da div "pg-sistema-comentarios" -->

</div> <!-- Fim da div "pedidos-filmes-conteudo" -->

</div> <!-- Fim da div "pg-pedidos-filmes" -->

</div> <!-- Fim da div "geral-pedidos-filmes" -->

</body>
</html>
<?php
mysql_free_result($Re_msg_p_filmes);

mysql_free_result($Re_editar_admin);
?>
