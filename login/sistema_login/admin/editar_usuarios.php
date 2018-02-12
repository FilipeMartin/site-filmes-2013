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
$restrict->addLevel("ADMIN");
$restrict->Execute();
//End Restrict Access To Page

//start Trigger_CheckPasswords trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckPasswords(&$tNG) {
  $myThrowError = new tNG_ThrowError($tNG);
  $myThrowError->setErrorMsg("Could not create account.");
  $myThrowError->setField("senha");
  $myThrowError->setFieldErrorMsg("As senhas não são iguais.");
  return $myThrowError->Execute();
}
//end Trigger_CheckPasswords trigger

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("nome", true, "text", "", "2", "", "");
$formValidation->addField("usuario", true, "text", "", "2", "28", "");
$formValidation->addField("email", true, "text", "email", "", "", "");
$formValidation->addField("senha", true, "text", "", "6", "20", "");
$formValidation->addField("data", true, "text", "", "", "", "");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_CheckOldPassword trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckOldPassword(&$tNG) {
  return Trigger_UpdatePassword_CheckOldPassword($tNG);
}
//end Trigger_CheckOldPassword trigger

// Make an insert transaction instance
$ins_sistema_login = new tNG_multipleInsert($conn_Mundo_Download);
$tNGs->addTransaction($ins_sistema_login);
// Register triggers
$ins_sistema_login->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_sistema_login->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_sistema_login->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../../includes/nxt/back.php");
$ins_sistema_login->registerConditionalTrigger("{POST.senha} != {POST.re_senha}", "BEFORE", "Trigger_CheckPasswords", 50);
// Add columns
$ins_sistema_login->setTable("sistema_login");
$ins_sistema_login->addColumn("nome", "STRING_TYPE", "POST", "nome");
$ins_sistema_login->addColumn("usuario", "STRING_TYPE", "POST", "usuario");
$ins_sistema_login->addColumn("email", "STRING_TYPE", "POST", "email");
$ins_sistema_login->addColumn("senha", "STRING_TYPE", "POST", "senha");
$ins_sistema_login->addColumn("status", "STRING_TYPE", "POST", "status");
$ins_sistema_login->addColumn("active", "NUMERIC_TYPE", "POST", "active");
$ins_sistema_login->addColumn("data", "STRING_TYPE", "POST", "data");
$ins_sistema_login->setPrimaryKey("id", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_sistema_login = new tNG_multipleUpdate($conn_Mundo_Download);
$tNGs->addTransaction($upd_sistema_login);
// Register triggers
$upd_sistema_login->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_sistema_login->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_sistema_login->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../../includes/nxt/back.php");
$upd_sistema_login->registerConditionalTrigger("{POST.senha} != {POST.re_senha}", "BEFORE", "Trigger_CheckPasswords", 50);
$upd_sistema_login->registerTrigger("BEFORE", "Trigger_CheckOldPassword", 60);
// Add columns
$upd_sistema_login->setTable("sistema_login");
$upd_sistema_login->addColumn("nome", "STRING_TYPE", "POST", "nome");
$upd_sistema_login->addColumn("usuario", "STRING_TYPE", "POST", "usuario");
$upd_sistema_login->addColumn("email", "STRING_TYPE", "POST", "email");
$upd_sistema_login->addColumn("senha", "STRING_TYPE", "POST", "senha");
$upd_sistema_login->addColumn("status", "STRING_TYPE", "POST", "status");
$upd_sistema_login->addColumn("active", "NUMERIC_TYPE", "POST", "active");
$upd_sistema_login->addColumn("data", "STRING_TYPE", "POST", "data");
$upd_sistema_login->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");

// Make an instance of the transaction object
$del_sistema_login = new tNG_multipleDelete($conn_Mundo_Download);
$tNGs->addTransaction($del_sistema_login);
// Register triggers
$del_sistema_login->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_sistema_login->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../../includes/nxt/back.php");
// Add columns
$del_sistema_login->setTable("sistema_login");
$del_sistema_login->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rssistema_login = $tNGs->getRecordset("sistema_login");
$row_rssistema_login = mysql_fetch_assoc($rssistema_login);
$totalRows_rssistema_login = mysql_num_rows($rssistema_login);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Admin</title>

<link href="../../admin/estrutura_css/sistema_login/editar_usuarios.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

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
      Dados - Usuários </h1>
    <div class="KT_tngform">
      <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
        <?php $cnt1 = 0; ?>
        <?php do { ?>
          <?php $cnt1++; ?>
          <?php 
// Show IF Conditional region1 
if (@$totalRows_rssistema_login > 1) {
?>
            <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
            <?php } 
// endif Conditional region1
?>
          <table width="410" cellpadding="2" cellspacing="0" class="KT_tngtable">
            <tr>
              <td height="28" class="KT_th"><label for="nome_<?php echo $cnt1; ?>">Nome:</label></td>
              <td align="center" valign="middle"><input type="text" name="nome_<?php echo $cnt1; ?>" id="nome_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssistema_login['nome']); ?>" size="50" maxlength="50" />
                  <?php echo $tNGs->displayFieldHint("nome");?> <?php echo $tNGs->displayFieldError("sistema_login", "nome", $cnt1); ?> </td>
            </tr>
            <tr>
              <td height="28" class="KT_th"><label for="usuario_<?php echo $cnt1; ?>">Usuário:</label></td>
              <td align="center" valign="middle"><input type="text" name="usuario_<?php echo $cnt1; ?>" id="usuario_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssistema_login['usuario']); ?>" size="50" maxlength="50" />
                  <?php echo $tNGs->displayFieldHint("usuario");?> <?php echo $tNGs->displayFieldError("sistema_login", "usuario", $cnt1); ?> </td>
            </tr>
            <tr>
              <td height="28" class="KT_th"><label for="email_<?php echo $cnt1; ?>">Email:</label></td>
              <td align="center" valign="middle"><input type="text" name="email_<?php echo $cnt1; ?>" id="email_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssistema_login['email']); ?>" size="50" maxlength="50" />
                  <?php echo $tNGs->displayFieldError("sistema_login", "email", $cnt1); ?> </td>
            </tr>
            <?php 
// Show IF Conditional show_old_senha_on_update_only 
if (@$_GET['id'] != "") {
?>
              <tr>
                <td height="28" class="KT_th"><label for="old_senha_<?php echo $cnt1; ?>">Senha Antiga:</label></td>
                <td align="center" valign="middle"><input type="password" name="old_senha_<?php echo $cnt1; ?>" id="old_senha_<?php echo $cnt1; ?>" value="" size="50" maxlength="50" />
                    <?php echo $tNGs->displayFieldError("sistema_login", "old_senha", $cnt1); ?> </td>
              </tr>
              <?php } 
// endif Conditional show_old_senha_on_update_only
?>
            <tr>
              <td height="28" class="KT_th"><label for="senha_<?php echo $cnt1; ?>">Senha:</label></td>
              <td align="center" valign="middle"><input type="password" name="senha_<?php echo $cnt1; ?>" id="senha_<?php echo $cnt1; ?>" value="" size="50" maxlength="50" />
                  <?php echo $tNGs->displayFieldHint("senha");?> <?php echo $tNGs->displayFieldError("sistema_login", "senha", $cnt1); ?> </td>
            </tr>
            <tr>
              <td height="28" class="KT_th"><label for="re_senha_<?php echo $cnt1; ?>">Redigitar a senha:</label></td>
              <td align="center" valign="middle"><input type="password" name="re_senha_<?php echo $cnt1; ?>" id="re_senha_<?php echo $cnt1; ?>" value="" size="50" maxlength="50" />              </td>
            </tr>
            <tr>
              <td height="28" class="KT_th"><label for="status_<?php echo $cnt1; ?>">Status:</label></td>
              <td align="center" valign="middle"><select name="status_<?php echo $cnt1; ?>" id="status_<?php echo $cnt1; ?>">
                  <option value="Desativado" <?php if (!(strcmp("Desativado", KT_escapeAttribute($row_rssistema_login['status'])))) {echo "SELECTED";} ?>>Desativado</option>
                  <option value="GM" <?php if (!(strcmp("GM", KT_escapeAttribute($row_rssistema_login['status'])))) {echo "SELECTED";} ?>>GM</option>
                  <option value="ADMIN" <?php if (!(strcmp("ADMIN", KT_escapeAttribute($row_rssistema_login['status'])))) {echo "SELECTED";} ?>>ADMIN</option>
                </select>
                  <?php echo $tNGs->displayFieldError("sistema_login", "status", $cnt1); ?> </td>
            </tr>
            <tr>
              <td height="28" class="KT_th"><label for="active_<?php echo $cnt1; ?>">Conta de Email:</label></td>
              <td align="center" valign="middle"><select name="active_<?php echo $cnt1; ?>" id="active_<?php echo $cnt1; ?>">
                  <option value="0" <?php if (!(strcmp(0, KT_escapeAttribute($row_rssistema_login['active'])))) {echo "SELECTED";} ?>>Desativado</option>
                  <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute($row_rssistema_login['active'])))) {echo "SELECTED";} ?>>Ativado</option>
                </select>
                  <?php echo $tNGs->displayFieldError("sistema_login", "active", $cnt1); ?> </td>
            </tr>
            <tr>
              <td height="28" class="KT_th"><label for="data_<?php echo $cnt1; ?>">Data:</label></td>
              <td align="center" valign="middle"><input type="text" name="data_<?php echo $cnt1; ?>" id="data_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssistema_login['data']); ?>" size="32" maxlength="50" />
                  <?php echo $tNGs->displayFieldHint("data");?> <?php echo $tNGs->displayFieldError("sistema_login", "data", $cnt1); ?> </td>
            </tr>
          </table>
          <input type="hidden" name="kt_pk_sistema_login_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rssistema_login['kt_pk_sistema_login']); ?>" />
          <?php } while ($row_rssistema_login = mysql_fetch_assoc($rssistema_login)); ?>
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

</div> <!-- Fim da div "conteudo" -->

</div> <!-- Fim da div "geral" -->

</body>
</html>
