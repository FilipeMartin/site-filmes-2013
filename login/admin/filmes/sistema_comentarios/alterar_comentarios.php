<?php require_once('../../../../Connections/Mundo_Download.php'); ?>
<?php
// Load the common classes
require_once('../../../../includes/common/KT_common.php');

// Load the tNG classes
require_once('../../../../includes/tng/tNG.inc.php');

// Load the KT_back class
require_once('../../../../includes/nxt/KT_back.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../../../../");

// Make unified connection variable
$conn_Mundo_Download = new KT_connection($Mundo_Download, $database_Mundo_Download);

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_Mundo_Download, "../../../../");
//Grand Levels: Level
$restrict->addLevel("GM");
$restrict->addLevel("ADMIN");
$restrict->Execute();
//End Restrict Access To Page

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("email", true, "text", "email", "", "", "");
$formValidation->addField("mensagem", false, "text", "", "", "", "");
$tNGs->prepareValidation($formValidation);
// End trigger

// Make an insert transaction instance
$ins_s_comentarios_filmes = new tNG_multipleInsert($conn_Mundo_Download);
$tNGs->addTransaction($ins_s_comentarios_filmes);
// Register triggers
$ins_s_comentarios_filmes->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_s_comentarios_filmes->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_s_comentarios_filmes->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../../../includes/nxt/back.php");
// Add columns
$ins_s_comentarios_filmes->setTable("s_comentarios_filmes");
$ins_s_comentarios_filmes->addColumn("nome", "STRING_TYPE", "POST", "nome");
$ins_s_comentarios_filmes->addColumn("email", "STRING_TYPE", "POST", "email");
$ins_s_comentarios_filmes->addColumn("site_blog", "STRING_TYPE", "POST", "site_blog");
$ins_s_comentarios_filmes->addColumn("filmes", "STRING_TYPE", "POST", "filmes");
$ins_s_comentarios_filmes->addColumn("localizacao", "STRING_TYPE", "POST", "localizacao");
$ins_s_comentarios_filmes->addColumn("mensagem", "STRING_TYPE", "POST", "mensagem");
$ins_s_comentarios_filmes->addColumn("data", "STRING_TYPE", "POST", "data");
$ins_s_comentarios_filmes->addColumn("status", "STRING_TYPE", "POST", "status");
$ins_s_comentarios_filmes->setPrimaryKey("id", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_s_comentarios_filmes = new tNG_multipleUpdate($conn_Mundo_Download);
$tNGs->addTransaction($upd_s_comentarios_filmes);
// Register triggers
$upd_s_comentarios_filmes->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_s_comentarios_filmes->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_s_comentarios_filmes->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../../../includes/nxt/back.php");
// Add columns
$upd_s_comentarios_filmes->setTable("s_comentarios_filmes");
$upd_s_comentarios_filmes->addColumn("nome", "STRING_TYPE", "POST", "nome");
$upd_s_comentarios_filmes->addColumn("email", "STRING_TYPE", "POST", "email");
$upd_s_comentarios_filmes->addColumn("site_blog", "STRING_TYPE", "POST", "site_blog");
$upd_s_comentarios_filmes->addColumn("filmes", "STRING_TYPE", "POST", "filmes");
$upd_s_comentarios_filmes->addColumn("localizacao", "STRING_TYPE", "POST", "localizacao");
$upd_s_comentarios_filmes->addColumn("mensagem", "STRING_TYPE", "POST", "mensagem");
$upd_s_comentarios_filmes->addColumn("data", "STRING_TYPE", "POST", "data");
$upd_s_comentarios_filmes->addColumn("status", "STRING_TYPE", "POST", "status");
$upd_s_comentarios_filmes->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");

// Make an instance of the transaction object
$del_s_comentarios_filmes = new tNG_multipleDelete($conn_Mundo_Download);
$tNGs->addTransaction($del_s_comentarios_filmes);
// Register triggers
$del_s_comentarios_filmes->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_s_comentarios_filmes->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../../../includes/nxt/back.php");
// Add columns
$del_s_comentarios_filmes->setTable("s_comentarios_filmes");
$del_s_comentarios_filmes->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rss_comentarios_filmes = $tNGs->getRecordset("s_comentarios_filmes");
$row_rss_comentarios_filmes = mysql_fetch_assoc($rss_comentarios_filmes);
$totalRows_rss_comentarios_filmes = mysql_num_rows($rss_comentarios_filmes);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Admin</title>

<link href="../../estrutura_css/filmes/alterar_comentarios.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

<script type="text/javascript" src="../../../../paginas/codigos/iframe/iframe_auto_height.js"></script>   <!-- Iframe Auto Height -->

<link href="../../../../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../../../../includes/common/js/base.js" type="text/javascript"></script>
<script src="../../../../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../../../../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>
<script src="../../../../includes/nxt/scripts/form.js" type="text/javascript"></script>
<script src="../../../../includes/nxt/scripts/form.js.php" type="text/javascript"></script>
<script type="text/javascript">
$NXT_FORM_SETTINGS = {
  duplicate_buttons: true,
  show_as_grid: true,
  merge_down_value: true
}
</script>

</head>

<body>

<div id="geral">

<div id="conteudo">
  <?php
	echo $tNGs->getErrorMsg();
?>
  <div class="KT_tng">
    <h1>
      <?php 
// Show IF Conditional region1 
if (@$_GET['id'] == "") {
?>
        <?php echo NXT_getResource("Insert_FH"); ?>
        <?php 
// else Conditional region1
} else { ?>
        <?php echo NXT_getResource("Update_FH"); ?>
        <?php } 
// endif Conditional region1
?>
      - Comentários - Filmes </h1>
    <div class="KT_tngform">
      <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
        <?php $cnt1 = 0; ?>
        <?php do { ?>
          <?php $cnt1++; ?>
          <?php 
// Show IF Conditional region1 
if (@$totalRows_rss_comentarios_filmes > 1) {
?>
            <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
            <?php } 
// endif Conditional region1
?>
          <table width="479" cellpadding="2" cellspacing="0" class="KT_tngtable">
            <tr>
              <td width="73" class="KT_th"><label for="nome_<?php echo $cnt1; ?>">Nome:</label></td>
              <td width="409"><input type="text" name="nome_<?php echo $cnt1; ?>" id="nome_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rss_comentarios_filmes['nome']); ?>" size="50" maxlength="100" />
                  <?php echo $tNGs->displayFieldHint("nome");?> <?php echo $tNGs->displayFieldError("s_comentarios_filmes", "nome", $cnt1); ?> </td>
            </tr>
            <tr>
              <td class="KT_th"><label for="email_<?php echo $cnt1; ?>">Email:</label></td>
              <td><input type="text" name="email_<?php echo $cnt1; ?>" id="email_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rss_comentarios_filmes['email']); ?>" size="50" maxlength="100" />
                  <?php echo $tNGs->displayFieldHint("email");?> <?php echo $tNGs->displayFieldError("s_comentarios_filmes", "email", $cnt1); ?> </td>
            </tr>
            <tr>
              <td class="KT_th"><label for="site_blog_<?php echo $cnt1; ?>">Site / Blog:</label></td>
              <td><input type="text" name="site_blog_<?php echo $cnt1; ?>" id="site_blog_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rss_comentarios_filmes['site_blog']); ?>" size="50" maxlength="255" />
                  <?php echo $tNGs->displayFieldHint("site_blog");?> <?php echo $tNGs->displayFieldError("s_comentarios_filmes", "site_blog", $cnt1); ?> </td>
            </tr>
            <tr>
              <td class="KT_th"><label for="filmes_<?php echo $cnt1; ?>">Filmes:</label></td>
              <td><input type="text" name="filmes_<?php echo $cnt1; ?>" id="filmes_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rss_comentarios_filmes['filmes']); ?>" size="50" maxlength="50" />
                  <?php echo $tNGs->displayFieldHint("filmes");?> <?php echo $tNGs->displayFieldError("s_comentarios_filmes", "filmes", $cnt1); ?> </td>
            </tr>
            <tr>
              <td class="KT_th"><label for="localizacao_<?php echo $cnt1; ?>">Localização:</label></td>
              <td><input type="text" name="localizacao_<?php echo $cnt1; ?>" id="localizacao_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rss_comentarios_filmes['localizacao']); ?>" size="50" maxlength="50" />
                  <?php echo $tNGs->displayFieldHint("localizacao");?> <?php echo $tNGs->displayFieldError("s_comentarios_filmes", "localizacao", $cnt1); ?> </td>
            </tr>
            <tr>
              <td class="KT_th"><label for="mensagem_<?php echo $cnt1; ?>">Comentário:</label></td>
              <td><textarea name="mensagem_<?php echo $cnt1; ?>" id="mensagem_<?php echo $cnt1; ?>" wrap="hard" cols="70" rows="12"><?php echo KT_escapeAttribute($row_rss_comentarios_filmes['mensagem']); ?></textarea>
              <br />
                  <?php echo $tNGs->displayFieldHint("mensagem");?> <?php echo $tNGs->displayFieldError("s_comentarios_filmes", "mensagem", $cnt1); ?> </td>
            </tr>
            <tr>
              <td class="KT_th">Responder:</td>
              <td class="KT_th" align="center" valign="middle">
              
              <div id="centro-texto">
              <p><a href="iframe_resposta/iframe_resposta.php?id=<?php echo $row_rss_comentarios_filmes['id']; ?>" class="centro-texto-br-resposta" target="resposta">« Responder</a>  / <a href="iframe_resposta/iframe_resposta.php" class="centro-texto-br-resposta" target="resposta"> Voltar »</a></p>
              </div> <!-- Fim da div "centro-texto" -->
              
              <p><a href="iframe_br/iframe_br.php?id=<?php echo $row_rss_comentarios_filmes['id']; ?>">
              <iframe id="comentarios-filmes2" name="resposta" src="iframe_resposta/iframe_resposta.php" width="395" scrolling="no" onload='iframeAutoHeight(this)'border="0"frameborder="0"></iframe></a></p>
              </td>
            </tr>
            <tr>
              <td class="KT_th">Add - BR:</td>
              <td class="KT_th" align="center" valign="middle">
              
              <div id="centro-texto">
              <p><a href="iframe_br/iframe_br.php?id=<?php echo $row_rss_comentarios_filmes['id']; ?>" class="centro-texto-br-resposta" target="add_br">« Adicionar </a> / <a href="iframe_br/iframe_br.php" class="centro-texto-br-resposta" target="add_br"> Voltar »</a></p>
              </div> <!-- Fim da div "centro-texto" -->
              
              <p><a href="iframe_br/iframe_br.php?id=<?php echo $row_rss_comentarios_filmes['id']; ?>">
                  <iframe id="comentarios-filmes" name="add_br" src="iframe_br/iframe_br.php" width="395" scrolling="no" onload='iframeAutoHeight(this)'border="0"frameborder="0"></iframe>
                </a></p>
                </td>
            </tr>
            <tr>
              <td class="KT_th"><label for="data_<?php echo $cnt1; ?>">Data:</label></td>
              <td><input type="text" name="data_<?php echo $cnt1; ?>" id="data_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rss_comentarios_filmes['data']); ?>" size="32" maxlength="50" />
                  <?php echo $tNGs->displayFieldHint("data");?> <?php echo $tNGs->displayFieldError("s_comentarios_filmes", "data", $cnt1); ?> </td>
            </tr>
            <tr>
              <td class="KT_th"><label for="status_<?php echo $cnt1; ?>">Status:</label></td>
              <td><select name="status_<?php echo $cnt1; ?>" id="status_<?php echo $cnt1; ?>">
                  <option value="Aguardando" <?php if (!(strcmp("Aguardando", KT_escapeAttribute($row_rss_comentarios_filmes['status'])))) {echo "SELECTED";} ?>>Aguardando</option>
                  <option value="Aprovado" <?php if (!(strcmp("Aprovado", KT_escapeAttribute($row_rss_comentarios_filmes['status'])))) {echo "SELECTED";} ?>>Aprovar</option>
                </select>
                  <?php echo $tNGs->displayFieldError("s_comentarios_filmes", "status", $cnt1); ?> </td>
            </tr>
          </table>
          <input type="hidden" name="kt_pk_s_comentarios_filmes_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rss_comentarios_filmes['kt_pk_s_comentarios_filmes']); ?>" />
          <?php } while ($row_rss_comentarios_filmes = mysql_fetch_assoc($rss_comentarios_filmes)); ?>
        <div class="KT_bottombuttons">
          <div>
            <?php 
      // Show IF Conditional region1
      if (@$_GET['id'] == "") {
      ?>
              <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
              <?php 
      // else Conditional region1
      } else { ?>
              <div class="KT_operations">
                <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'id')" />
              </div>
              <input type="submit" name="KT_Update1" value="<?php echo NXT_getResource("Update_FB"); ?>" />
              <input type="submit" name="KT_Delete1" value="<?php echo NXT_getResource("Delete_FB"); ?>" onclick="return confirm('<?php echo NXT_getResource("Are you sure?"); ?>');" />
              <?php }
      // endif Conditional region1
      ?>
            <input type="button" name="KT_Cancel1" value="<?php echo NXT_getResource("Cancel_FB"); ?>" onclick="return UNI_navigateCancel(event, '../../../../includes/nxt/back.php')" />
          </div>
        </div>
      </form>
    </div>
    <br class="clearfixplain" />
  </div>
  <p>&nbsp;</p>
</div> <!-- Fim da div "conteudo" -->

</div> <!-- Fim da div "geral" -->

</body>
</html>
