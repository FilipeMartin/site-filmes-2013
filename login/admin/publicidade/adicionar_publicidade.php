<?php require_once('../../../Connections/Mundo_Download.php'); ?>
<?php
// Load the common classes
require_once('../../../includes/common/KT_common.php');

// Load the tNG classes
require_once('../../../includes/tng/tNG.inc.php');

// Load the KT_back class
require_once('../../../includes/nxt/KT_back.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../../../");

// Make unified connection variable
$conn_Mundo_Download = new KT_connection($Mundo_Download, $database_Mundo_Download);

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_Mundo_Download, "../../../");
//Grand Levels: Level
$restrict->addLevel("GM");
$restrict->addLevel("ADMIN");
$restrict->Execute();
//End Restrict Access To Page

// Start trigger
$formValidation = new tNG_FormValidation();
$tNGs->prepareValidation($formValidation);
// End trigger

// Make an insert transaction instance
$ins_s_publicidade = new tNG_multipleInsert($conn_Mundo_Download);
$tNGs->addTransaction($ins_s_publicidade);
// Register triggers
$ins_s_publicidade->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_s_publicidade->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_s_publicidade->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../../includes/nxt/back.php");
// Add columns
$ins_s_publicidade->setTable("s_publicidade");
$ins_s_publicidade->addColumn("nome", "STRING_TYPE", "POST", "nome");
$ins_s_publicidade->addColumn("coluna", "STRING_TYPE", "POST", "coluna");
$ins_s_publicidade->addColumn("anuncio", "STRING_TYPE", "POST", "anuncio");
$ins_s_publicidade->addColumn("status", "STRING_TYPE", "POST", "status");
$ins_s_publicidade->setPrimaryKey("id", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_s_publicidade = new tNG_multipleUpdate($conn_Mundo_Download);
$tNGs->addTransaction($upd_s_publicidade);
// Register triggers
$upd_s_publicidade->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_s_publicidade->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_s_publicidade->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../../includes/nxt/back.php");
// Add columns
$upd_s_publicidade->setTable("s_publicidade");
$upd_s_publicidade->addColumn("nome", "STRING_TYPE", "POST", "nome");
$upd_s_publicidade->addColumn("coluna", "STRING_TYPE", "POST", "coluna");
$upd_s_publicidade->addColumn("anuncio", "STRING_TYPE", "POST", "anuncio");
$upd_s_publicidade->addColumn("status", "STRING_TYPE", "POST", "status");
$upd_s_publicidade->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");

// Make an instance of the transaction object
$del_s_publicidade = new tNG_multipleDelete($conn_Mundo_Download);
$tNGs->addTransaction($del_s_publicidade);
// Register triggers
$del_s_publicidade->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_s_publicidade->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../../includes/nxt/back.php");
// Add columns
$del_s_publicidade->setTable("s_publicidade");
$del_s_publicidade->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rss_publicidade = $tNGs->getRecordset("s_publicidade");
$row_rss_publicidade = mysql_fetch_assoc($rss_publicidade);
$totalRows_rss_publicidade = mysql_num_rows($rss_publicidade);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Admin</title>

<link href="../estrutura_css/publicidade/adicionar_publicidade.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

<link href="../../../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../../../includes/common/js/base.js" type="text/javascript"></script>
<script src="../../../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../../../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>
<script src="../../../includes/nxt/scripts/form.js" type="text/javascript"></script>
<script src="../../../includes/nxt/scripts/form.js.php" type="text/javascript"></script>
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
      Conteúdo - Publicidade </h1>
    <div class="KT_tngform">
      <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
        <?php $cnt1 = 0; ?>
        <?php do { ?>
          <?php $cnt1++; ?>
          <?php 
// Show IF Conditional region1 
if (@$totalRows_rss_publicidade > 1) {
?>
            <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
            <?php } 
// endif Conditional region1
?>
          <table cellpadding="2" cellspacing="0" class="KT_tngtable">
            <tr>
              <td class="KT_th"><label for="nome_<?php echo $cnt1; ?>">Nome:</label></td>
              <td><input type="text" name="nome_<?php echo $cnt1; ?>" id="nome_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rss_publicidade['nome']); ?>" size="50" maxlength="50" />
                  <?php echo $tNGs->displayFieldHint("nome");?> <?php echo $tNGs->displayFieldError("s_publicidade", "nome", $cnt1); ?> </td>
            </tr>
            <tr>
              <td class="KT_th"><label for="coluna_<?php echo $cnt1; ?>">Coluna:</label></td>
              <td><select name="coluna_<?php echo $cnt1; ?>" id="coluna_<?php echo $cnt1; ?>">
                  <option value="Esquerda" <?php if (!(strcmp("Esquerda", KT_escapeAttribute($row_rss_publicidade['coluna'])))) {echo "SELECTED";} ?>>Esquerda</option>
                  <option value="Direita" <?php if (!(strcmp("Direita", KT_escapeAttribute($row_rss_publicidade['coluna'])))) {echo "SELECTED";} ?>>Direita</option>
                </select>
                  <?php echo $tNGs->displayFieldError("s_publicidade", "coluna", $cnt1); ?> </td>
            </tr>
            <tr>
              <td class="KT_th">Código - IMG:</td>
              <td class="KT_th">
              
                <label>
              
                <input name="Complemento - RMVB" type="text" id="Complemento - RMVB" value="&lt;img src=&quot;#&quot; width=&quot;#&quot; height=&quot;#&quot; border=&quot;0&quot; title=&quot;#&quot; /&gt;" size="70" />
              </label>              </td>
            </tr>
            <tr>
              <td class="KT_th">Código - Link:</td>
              <td class="KT_th">
              
                <label>
              
                <input name="Complemento - RMVB" type="text" id="Complemento - RMVB" value="&lt;a href=&quot;#&quot; title=&quot;#&quot; target=&quot;_blank   _parent   _self   _top&quot; &gt;IMG&lt;/a&gt;" size="70" />
              </label>              </td>
            </tr>
            <tr>
              <td colspan="2" class="KT_th">&nbsp;</td>
              </tr>
            <tr>
              <td class="KT_th"><label for="anuncio_<?php echo $cnt1; ?>">Anúncio:</label></td>
              <td><textarea name="anuncio_<?php echo $cnt1; ?>" id="anuncio_<?php echo $cnt1; ?>" cols="110" rows="12"><?php echo KT_escapeAttribute($row_rss_publicidade['anuncio']); ?></textarea>
                  <?php echo $tNGs->displayFieldHint("anuncio");?> <?php echo $tNGs->displayFieldError("s_publicidade", "anuncio", $cnt1); ?> </td>
            </tr>
            <tr>
              <td colspan="2" class="KT_th">&nbsp;</td>
              </tr>
            <tr>
              <td class="KT_th"><label for="status_<?php echo $cnt1; ?>">Status:</label></td>
              <td><select name="status_<?php echo $cnt1; ?>" id="status_<?php echo $cnt1; ?>">
                  <option value="Desativado" <?php if (!(strcmp("Desativado", KT_escapeAttribute($row_rss_publicidade['status'])))) {echo "SELECTED";} ?>>Desativado</option>
                  <option value="Ativado" <?php if (!(strcmp("Ativado", KT_escapeAttribute($row_rss_publicidade['status'])))) {echo "SELECTED";} ?>>Ativar</option>
                </select>
                  <?php echo $tNGs->displayFieldError("s_publicidade", "status", $cnt1); ?> </td>
            </tr>
          </table>
          <input type="hidden" name="kt_pk_s_publicidade_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rss_publicidade['kt_pk_s_publicidade']); ?>" />
          <?php } while ($row_rss_publicidade = mysql_fetch_assoc($rss_publicidade)); ?>
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
            <input type="button" name="KT_Cancel1" value="<?php echo NXT_getResource("Cancel_FB"); ?>" onclick="return UNI_navigateCancel(event, '../../../includes/nxt/back.php')" />
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
