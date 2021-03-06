<?php require_once('../../../../Connections/Mundo_Download.php'); ?>
<?php
// Load the common classes
require_once('../../../../includes/common/KT_common.php');

// Load the tNG classes
require_once('../../../../includes/tng/tNG.inc.php');

// Load the required classes
require_once('../../../../includes/tfi/TFI.php');
require_once('../../../../includes/tso/TSO.php');
require_once('../../../../includes/nav/NAV.php');

// Make unified connection variable
$conn_Mundo_Download = new KT_connection($Mundo_Download, $database_Mundo_Download);

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_Mundo_Download, "../../../../");
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

// Filter
$tfi_listconteudo_seriados2 = new TFI_TableFilter($conn_Mundo_Download, "tfi_listconteudo_seriados2");
$tfi_listconteudo_seriados2->addColumn("conteudo_seriados.id", "NUMERIC_TYPE", "id", "=");
$tfi_listconteudo_seriados2->addColumn("conteudo_seriados.titulo", "STRING_TYPE", "titulo", "%");
$tfi_listconteudo_seriados2->addColumn("conteudo_seriados.imagem", "STRING_TYPE", "imagem", "%");
$tfi_listconteudo_seriados2->addColumn("conteudo_seriados.status", "STRING_TYPE", "status", "%");
$tfi_listconteudo_seriados2->Execute();

// Sorter
$tso_listconteudo_seriados2 = new TSO_TableSorter("rsconteudo_seriados1", "tso_listconteudo_seriados2");
$tso_listconteudo_seriados2->addColumn("conteudo_seriados.id");
$tso_listconteudo_seriados2->addColumn("conteudo_seriados.titulo");
$tso_listconteudo_seriados2->addColumn("conteudo_seriados.imagem");
$tso_listconteudo_seriados2->addColumn("conteudo_seriados.status");
$tso_listconteudo_seriados2->setDefault("conteudo_seriados.id");
$tso_listconteudo_seriados2->Execute();

// Navigation
$nav_listconteudo_seriados2 = new NAV_Regular("nav_listconteudo_seriados2", "rsconteudo_seriados1", "../../../../", $_SERVER['PHP_SELF'], 30);

//NeXTenesio3 Special List Recordset
$maxRows_rsconteudo_seriados1 = $_SESSION['max_rows_nav_listconteudo_seriados2'];
$pageNum_rsconteudo_seriados1 = 0;
if (isset($_GET['pageNum_rsconteudo_seriados1'])) {
  $pageNum_rsconteudo_seriados1 = $_GET['pageNum_rsconteudo_seriados1'];
}
$startRow_rsconteudo_seriados1 = $pageNum_rsconteudo_seriados1 * $maxRows_rsconteudo_seriados1;

// Defining List Recordset variable
$NXTFilter_rsconteudo_seriados1 = "1=1";
if (isset($_SESSION['filter_tfi_listconteudo_seriados2'])) {
  $NXTFilter_rsconteudo_seriados1 = $_SESSION['filter_tfi_listconteudo_seriados2'];
}
// Defining List Recordset variable
$NXTSort_rsconteudo_seriados1 = "conteudo_seriados.id";
if (isset($_SESSION['sorter_tso_listconteudo_seriados2'])) {
  $NXTSort_rsconteudo_seriados1 = $_SESSION['sorter_tso_listconteudo_seriados2'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);

$query_rsconteudo_seriados1 = "SELECT conteudo_seriados.id, conteudo_seriados.titulo, conteudo_seriados.imagem, conteudo_seriados.status FROM conteudo_seriados WHERE {$NXTFilter_rsconteudo_seriados1} ORDER BY {$NXTSort_rsconteudo_seriados1}";
$query_limit_rsconteudo_seriados1 = sprintf("%s LIMIT %d, %d", $query_rsconteudo_seriados1, $startRow_rsconteudo_seriados1, $maxRows_rsconteudo_seriados1);
$rsconteudo_seriados1 = mysql_query($query_limit_rsconteudo_seriados1, $Mundo_Download) or die(mysql_error());
$row_rsconteudo_seriados1 = mysql_fetch_assoc($rsconteudo_seriados1);

if (isset($_GET['totalRows_rsconteudo_seriados1'])) {
  $totalRows_rsconteudo_seriados1 = $_GET['totalRows_rsconteudo_seriados1'];
} else {
  $all_rsconteudo_seriados1 = mysql_query($query_rsconteudo_seriados1);
  $totalRows_rsconteudo_seriados1 = mysql_num_rows($all_rsconteudo_seriados1);
}
$totalPages_rsconteudo_seriados1 = ceil($totalRows_rsconteudo_seriados1/$maxRows_rsconteudo_seriados1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listconteudo_seriados2->checkBoundries();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Admin</title>

<link href="../../estrutura_css/seriados/painel_alterar_img_series.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

<link href="../../../../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../../../../includes/common/js/base.js" type="text/javascript"></script>
<script src="../../../../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../../../../includes/skins/style.js" type="text/javascript"></script>
<script src="../../../../includes/nxt/scripts/list.js" type="text/javascript"></script>
<script src="../../../../includes/nxt/scripts/list.js.php" type="text/javascript"></script>
<script type="text/javascript">
$NXT_LIST_SETTINGS = {
  duplicate_buttons: true,
  duplicate_navigation: true,
  row_effects: true,
  show_as_buttons: true,
  record_counter: true
}
</script>
<style type="text/css">
  /* Dynamic List row settings */
  .KT_col_id {width:140px; overflow:hidden;}
  .KT_col_titulo {width:140px; overflow:hidden;}
  .KT_col_imagem {width:140px; overflow:hidden;}
  .KT_col_status {width:140px; overflow:hidden;}
</style>
</head>

<body>

<div id="geral">

<div id="conteudo">
  <div class="KT_tng" id="listconteudo_seriados2">
    <h1> Painel - Alterar Imagens - S�ries
      <?php
  $nav_listconteudo_seriados2->Prepare();
  require("../../../../includes/nav/NAV_Text_Statistics.inc.php");
?>
    </h1>
    <div class="KT_tnglist">
      <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
        <div class="KT_options"> <a href="<?php echo $nav_listconteudo_seriados2->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
          <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listconteudo_seriados2'] == 1) {
?>
            <?php echo $_SESSION['default_max_rows_nav_listconteudo_seriados2']; ?>
            <?php 
  // else Conditional region1
  } else { ?>
            <?php echo NXT_getResource("all"); ?>
            <?php } 
  // endif Conditional region1
?>
              <?php echo NXT_getResource("records"); ?></a> &nbsp;
          &nbsp;
                <?php 
  // Show IF Conditional region2
  if (@$_SESSION['has_filter_tfi_listconteudo_seriados2'] == 1) {
?>
                  <a href="<?php echo $tfi_listconteudo_seriados2->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listconteudo_seriados2->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
        </div>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <thead>
            <tr class="KT_row_order">
              <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
              </th>
              <th id="id" class="KT_sorter KT_col_id <?php echo $tso_listconteudo_seriados2->getSortIcon('conteudo_seriados.id'); ?>"> <a href="<?php echo $tso_listconteudo_seriados2->getSortLink('conteudo_seriados.id'); ?>">Id</a> </th>
              <th id="titulo" class="KT_sorter KT_col_titulo <?php echo $tso_listconteudo_seriados2->getSortIcon('conteudo_seriados.titulo'); ?>"> <a href="<?php echo $tso_listconteudo_seriados2->getSortLink('conteudo_seriados.titulo'); ?>">Titulo</a> </th>
              <th id="imagem" class="KT_sorter KT_col_imagem <?php echo $tso_listconteudo_seriados2->getSortIcon('conteudo_seriados.imagem'); ?>"> <a href="<?php echo $tso_listconteudo_seriados2->getSortLink('conteudo_seriados.imagem'); ?>">Imagem</a> </th>
              <th id="status" class="KT_sorter KT_col_status <?php echo $tso_listconteudo_seriados2->getSortIcon('conteudo_seriados.status'); ?>"> <a href="<?php echo $tso_listconteudo_seriados2->getSortLink('conteudo_seriados.status'); ?>">Status</a> </th>
              <th>&nbsp;</th>
            </tr>
            <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listconteudo_seriados2'] == 1) {
?>
              <tr class="KT_row_filter">
                <td>&nbsp;</td>
                <td><input type="text" name="tfi_listconteudo_seriados2_id" id="tfi_listconteudo_seriados2_id" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listconteudo_seriados2_id']); ?>" size="20" maxlength="100" /></td>
                <td><input type="text" name="tfi_listconteudo_seriados2_titulo" id="tfi_listconteudo_seriados2_titulo" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listconteudo_seriados2_titulo']); ?>" size="20" maxlength="50" /></td>
                <td><input type="text" name="tfi_listconteudo_seriados2_imagem" id="tfi_listconteudo_seriados2_imagem" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listconteudo_seriados2_imagem']); ?>" size="20" maxlength="255" /></td>
                <td><select name="tfi_listconteudo_seriados2_status" id="tfi_listconteudo_seriados2_status">
                    <option value="Desativado" <?php if (!(strcmp("Desativado", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_seriados2_status'])))) {echo "selected=\"selected\"";} ?>>Desativado</option>
                    <option value="Ativado" <?php if (!(strcmp("Ativado", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_seriados2_status'])))) {echo "selected=\"selected\"";} ?>>Ativado</option>
                  </select>
                </td>
                <td><input type="submit" name="tfi_listconteudo_seriados2" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
              </tr>
              <?php } 
  // endif Conditional region3
?>
          </thead>
          <tbody>
            <?php if ($totalRows_rsconteudo_seriados1 == 0) { // Show if recordset empty ?>
              <tr>
                <td colspan="6"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
              </tr>
              <?php } // Show if recordset empty ?>
            <?php if ($totalRows_rsconteudo_seriados1 > 0) { // Show if recordset not empty ?>
              <?php do { ?>
                <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                  <td><input type="checkbox" name="kt_pk_conteudo_seriados" class="id_checkbox" value="<?php echo $row_rsconteudo_seriados1['id']; ?>" />
                      <input type="hidden" name="id" class="id_field" value="<?php echo $row_rsconteudo_seriados1['id']; ?>" />
                  </td>
                  <td><div class="KT_col_id"><?php echo KT_FormatForList($row_rsconteudo_seriados1['id'], 20); ?></div></td>
                  <td><div class="KT_col_titulo"><?php echo KT_FormatForList($row_rsconteudo_seriados1['titulo'], 20); ?></div></td>
                  <td><div class="KT_col_imagem"><?php echo KT_FormatForList($row_rsconteudo_seriados1['imagem'], 20); ?></div></td>
                  <td><div class="KT_col_status"><?php echo KT_FormatForList($row_rsconteudo_seriados1['status'], 20); ?></div></td>
                  <td><a class="KT_edit_link" href="../../../index_admin.php?pag=alterar_img_series&amp;id=<?php echo $row_rsconteudo_seriados1['id']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
                </tr>
                <?php } while ($row_rsconteudo_seriados1 = mysql_fetch_assoc($rsconteudo_seriados1)); ?>
              <?php } // Show if recordset not empty ?>
          </tbody>
        </table>
        <div class="KT_bottomnav">
          <div>
            <?php
            $nav_listconteudo_seriados2->Prepare();
            require("../../../../includes/nav/NAV_Text_Navigation.inc.php");
          ?>
          </div>
        </div>
        <div class="KT_bottombuttons">
          <div class="KT_operations"> <a class="KT_edit_op_link" href="#" onclick="nxt_list_edit_link_form(this); return false;"><?php echo NXT_getResource("edit_all"); ?></a> <a class="KT_delete_op_link" href="#" onclick="nxt_list_delete_link_form(this); return false;"><?php echo NXT_getResource("delete_all"); ?></a> </div>
<span>&nbsp;</span>
          <select name="no_new" id="no_new">
            <option value="1">1</option>
            <option value="3">3</option>
            <option value="6">6</option>
          </select>
          <a class="KT_additem_op_link" href="../../../index_admin.php?pag=alterar_img_series&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("Alterar Imagens - S�ries"); ?></a> </div>
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
mysql_free_result($rsconteudo_seriados1);
?>
