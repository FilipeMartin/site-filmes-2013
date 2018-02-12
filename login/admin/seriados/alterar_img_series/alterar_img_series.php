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

$colname_Rs = "-1";
if (isset($_GET['id'])) {
  $colname_Rs = $_GET['id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Rs = sprintf("SELECT * FROM conteudo_seriados WHERE id = %s", GetSQLValueString($colname_Rs, "int"));
$Rs = mysql_query($query_Rs, $Mundo_Download) or die(mysql_error());
$row_Rs = mysql_fetch_assoc($Rs);
$totalRows_Rs = mysql_num_rows($Rs);

// Make an insert transaction instance
$ins_conteudo_seriados = new tNG_multipleInsert($conn_Mundo_Download);
$tNGs->addTransaction($ins_conteudo_seriados);
// Register triggers
$ins_conteudo_seriados->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_conteudo_seriados->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_conteudo_seriados->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../../../includes/nxt/back.php");
// Add columns
$ins_conteudo_seriados->setTable("conteudo_seriados");
$ins_conteudo_seriados->addColumn("imagem", "STRING_TYPE", "POST", "imagem");
$ins_conteudo_seriados->setPrimaryKey("id", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_conteudo_seriados = new tNG_multipleUpdate($conn_Mundo_Download);
$tNGs->addTransaction($upd_conteudo_seriados);
// Register triggers
$upd_conteudo_seriados->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_conteudo_seriados->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_conteudo_seriados->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../../../includes/nxt/back.php");
// Add columns
$upd_conteudo_seriados->setTable("conteudo_seriados");
$upd_conteudo_seriados->addColumn("imagem", "STRING_TYPE", "POST", "imagem");
$upd_conteudo_seriados->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");

// Make an instance of the transaction object
$del_conteudo_seriados = new tNG_multipleDelete($conn_Mundo_Download);
$tNGs->addTransaction($del_conteudo_seriados);
// Register triggers
$del_conteudo_seriados->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_conteudo_seriados->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../../../includes/nxt/back.php");
// Add columns
$del_conteudo_seriados->setTable("conteudo_seriados");
$del_conteudo_seriados->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsconteudo_seriados = $tNGs->getRecordset("conteudo_seriados");
$row_rsconteudo_seriados = mysql_fetch_assoc($rsconteudo_seriados);
$totalRows_rsconteudo_seriados = mysql_num_rows($rsconteudo_seriados);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Admin</title>

<link href="../../estrutura_css/seriados/alterar_img_series.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

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
      Imagem - Séries </h1>
    <div class="KT_tngform">
      <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
        <?php $cnt1 = 0; ?>
        <?php do { ?>
          <?php $cnt1++; ?>
          <?php 
// Show IF Conditional region1 
if (@$totalRows_rsconteudo_seriados > 1) {
?>
            <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
            <?php } 
// endif Conditional region1
?>
          <table cellpadding="2" cellspacing="0" class="KT_tngtable">
           <tr>
              <td height="32" colspan="2" class="KT_th">
			  <div id="alinhar">
              
			  <?php echo $row_Rs['titulo']; ?>  
                         
              </div> <!-- Fim da div "alinhar" -->              
              </td>
              </tr>
             <tr>
              <td class="KT_th">ID:</td>
              <td class="KT_th">
			  <div id="alinhar-id">
              
			  <?php echo $row_Rs['id']; ?>
              
              </div> <!-- Fim da div "alinhar-id" --> 
              
              </td>
            </tr>
            <tr>
              <td class="KT_th"><label for="imagem_<?php echo $cnt1; ?>">Imagem:</label></td>
              <td><input type="text" name="imagem_<?php echo $cnt1; ?>" id="imagem_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsconteudo_seriados['imagem']); ?>" size="50" maxlength="255" />
                  <?php echo $tNGs->displayFieldHint("imagem");?> <?php echo $tNGs->displayFieldError("conteudo_seriados", "imagem", $cnt1); ?> </td>
            </tr>
          </table>
          <input type="hidden" name="kt_pk_conteudo_seriados_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsconteudo_seriados['kt_pk_conteudo_seriados']); ?>" />
          <?php } while ($row_rsconteudo_seriados = mysql_fetch_assoc($rsconteudo_seriados)); ?>
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
<?php
mysql_free_result($Rs);
?>
