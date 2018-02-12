<?php require_once('../../../Connections/Mundo_Download.php'); ?>
<?php
// Load the common classes
require_once('../../../includes/common/KT_common.php');

// Load the tNG classes
require_once('../../../includes/tng/tNG.inc.php');

// Load the required classes
require_once('../../../includes/tfi/TFI.php');
require_once('../../../includes/tso/TSO.php');
require_once('../../../includes/nav/NAV.php');

// Make unified connection variable
$conn_Mundo_Download = new KT_connection($Mundo_Download, $database_Mundo_Download);

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_Mundo_Download, "../../../");
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
$tfi_lists_publicidade1 = new TFI_TableFilter($conn_Mundo_Download, "tfi_lists_publicidade1");
$tfi_lists_publicidade1->addColumn("s_publicidade.id", "NUMERIC_TYPE", "id", "=");
$tfi_lists_publicidade1->addColumn("s_publicidade.nome", "STRING_TYPE", "nome", "%");
$tfi_lists_publicidade1->addColumn("s_publicidade.coluna", "STRING_TYPE", "coluna", "%");
$tfi_lists_publicidade1->addColumn("s_publicidade.status", "STRING_TYPE", "status", "%");
$tfi_lists_publicidade1->Execute();

// Sorter
$tso_lists_publicidade1 = new TSO_TableSorter("rss_publicidade1", "tso_lists_publicidade1");
$tso_lists_publicidade1->addColumn("s_publicidade.id");
$tso_lists_publicidade1->addColumn("s_publicidade.nome");
$tso_lists_publicidade1->addColumn("s_publicidade.coluna");
$tso_lists_publicidade1->addColumn("s_publicidade.status");
$tso_lists_publicidade1->setDefault("s_publicidade.id");
$tso_lists_publicidade1->Execute();

// Navigation
$nav_lists_publicidade1 = new NAV_Regular("nav_lists_publicidade1", "rss_publicidade1", "../../../", $_SERVER['PHP_SELF'], 30);

//NeXTenesio3 Special List Recordset
$maxRows_rss_publicidade1 = $_SESSION['max_rows_nav_lists_publicidade1'];
$pageNum_rss_publicidade1 = 0;
if (isset($_GET['pageNum_rss_publicidade1'])) {
  $pageNum_rss_publicidade1 = $_GET['pageNum_rss_publicidade1'];
}
$startRow_rss_publicidade1 = $pageNum_rss_publicidade1 * $maxRows_rss_publicidade1;

// Defining List Recordset variable
$NXTFilter_rss_publicidade1 = "1=1";
if (isset($_SESSION['filter_tfi_lists_publicidade1'])) {
  $NXTFilter_rss_publicidade1 = $_SESSION['filter_tfi_lists_publicidade1'];
}
// Defining List Recordset variable
$NXTSort_rss_publicidade1 = "s_publicidade.id";
if (isset($_SESSION['sorter_tso_lists_publicidade1'])) {
  $NXTSort_rss_publicidade1 = $_SESSION['sorter_tso_lists_publicidade1'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);

$query_rss_publicidade1 = "SELECT s_publicidade.id, s_publicidade.nome, s_publicidade.coluna, s_publicidade.status FROM s_publicidade WHERE {$NXTFilter_rss_publicidade1} AND s_publicidade.status = 'Ativado' ORDER BY {$NXTSort_rss_publicidade1}";
$query_limit_rss_publicidade1 = sprintf("%s LIMIT %d, %d", $query_rss_publicidade1, $startRow_rss_publicidade1, $maxRows_rss_publicidade1);
$rss_publicidade1 = mysql_query($query_limit_rss_publicidade1, $Mundo_Download) or die(mysql_error());
$row_rss_publicidade1 = mysql_fetch_assoc($rss_publicidade1);

if (isset($_GET['totalRows_rss_publicidade1'])) {
  $totalRows_rss_publicidade1 = $_GET['totalRows_rss_publicidade1'];
} else {
  $all_rss_publicidade1 = mysql_query($query_rss_publicidade1);
  $totalRows_rss_publicidade1 = mysql_num_rows($all_rss_publicidade1);
}
$totalPages_rss_publicidade1 = ceil($totalRows_rss_publicidade1/$maxRows_rss_publicidade1)-1;
//End NeXTenesio3 Special List Recordset

$nav_lists_publicidade1->checkBoundries();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Admin</title>

<link href="../estrutura_css/publicidade/alterar_publicidade.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

<link href="../../../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../../../includes/common/js/base.js" type="text/javascript"></script>
<script src="../../../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../../../includes/skins/style.js" type="text/javascript"></script>
<script src="../../../includes/nxt/scripts/list.js" type="text/javascript"></script>
<script src="../../../includes/nxt/scripts/list.js.php" type="text/javascript"></script>
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
  .KT_col_nome {width:140px; overflow:hidden;}
  .KT_col_coluna {width:140px; overflow:hidden;}
  .KT_col_status {width:140px; overflow:hidden;}
</style>
</head>

<body>

<div id="geral">

<div id="conteudo">
  <div class="KT_tng" id="lists_publicidade1">
    <h1> Painel - Conteúdo Publicidade
      <?php
  $nav_lists_publicidade1->Prepare();
  require("../../../includes/nav/NAV_Text_Statistics.inc.php");
?>
    </h1>
    <div class="KT_tnglist">
      <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
        <div class="KT_options"> <a href="<?php echo $nav_lists_publicidade1->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
          <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_lists_publicidade1'] == 1) {
?>
            <?php echo $_SESSION['default_max_rows_nav_lists_publicidade1']; ?>
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
  if (@$_SESSION['has_filter_tfi_lists_publicidade1'] == 1) {
?>
                  <a href="<?php echo $tfi_lists_publicidade1->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_lists_publicidade1->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
        </div>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <thead>
            <tr class="KT_row_order">
              <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
              </th>
              <th id="id" class="KT_sorter KT_col_id <?php echo $tso_lists_publicidade1->getSortIcon('s_publicidade.id'); ?>"> <a href="<?php echo $tso_lists_publicidade1->getSortLink('s_publicidade.id'); ?>">Id</a> </th>
              <th id="nome" class="KT_sorter KT_col_nome <?php echo $tso_lists_publicidade1->getSortIcon('s_publicidade.nome'); ?>"> <a href="<?php echo $tso_lists_publicidade1->getSortLink('s_publicidade.nome'); ?>">Nome</a> </th>
              <th id="coluna" class="KT_sorter KT_col_coluna <?php echo $tso_lists_publicidade1->getSortIcon('s_publicidade.coluna'); ?>"> <a href="<?php echo $tso_lists_publicidade1->getSortLink('s_publicidade.coluna'); ?>">Coluna</a> </th>
              <th id="status" class="KT_sorter KT_col_status <?php echo $tso_lists_publicidade1->getSortIcon('s_publicidade.status'); ?>"> <a href="<?php echo $tso_lists_publicidade1->getSortLink('s_publicidade.status'); ?>">Status</a> </th>
              <th>&nbsp;</th>
            </tr>
            <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_lists_publicidade1'] == 1) {
?>
              <tr class="KT_row_filter">
                <td>&nbsp;</td>
                <td><input type="text" name="tfi_lists_publicidade1_id" id="tfi_lists_publicidade1_id" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_lists_publicidade1_id']); ?>" size="20" maxlength="100" /></td>
                <td><input type="text" name="tfi_lists_publicidade1_nome" id="tfi_lists_publicidade1_nome" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_lists_publicidade1_nome']); ?>" size="20" maxlength="50" /></td>
                <td><select name="tfi_lists_publicidade1_coluna" id="tfi_lists_publicidade1_coluna">
                    <option value="Esquerda" <?php if (!(strcmp("Esquerda", KT_escapeAttribute(@$_SESSION['tfi_lists_publicidade1_coluna'])))) {echo "SELECTED";} ?>>Esquerda</option>
                    <option value="Direita" <?php if (!(strcmp("Direita", KT_escapeAttribute(@$_SESSION['tfi_lists_publicidade1_coluna'])))) {echo "SELECTED";} ?>>Direita</option>
                  </select>
                </td>
                <td><select name="tfi_lists_publicidade1_status" id="tfi_lists_publicidade1_status">
                    <option value="Desativado" <?php if (!(strcmp("Desativado", KT_escapeAttribute(@$_SESSION['tfi_lists_publicidade1_status'])))) {echo "SELECTED";} ?>>Desativado</option>
                    <option value="Ativado" <?php if (!(strcmp("Ativado", KT_escapeAttribute(@$_SESSION['tfi_lists_publicidade1_status'])))) {echo "SELECTED";} ?>>Ativar</option>
                  </select>
                </td>
                <td><input type="submit" name="tfi_lists_publicidade1" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
              </tr>
              <?php } 
  // endif Conditional region3
?>
          </thead>
          <tbody>
            <?php if ($totalRows_rss_publicidade1 == 0) { // Show if recordset empty ?>
              <tr>
                <td colspan="6"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
              </tr>
              <?php } // Show if recordset empty ?>
            <?php if ($totalRows_rss_publicidade1 > 0) { // Show if recordset not empty ?>
              <?php do { ?>
                <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                  <td><input type="checkbox" name="kt_pk_s_publicidade" class="id_checkbox" value="<?php echo $row_rss_publicidade1['id']; ?>" />
                      <input type="hidden" name="id" class="id_field" value="<?php echo $row_rss_publicidade1['id']; ?>" />
                  </td>
                  <td><div class="KT_col_id"><?php echo KT_FormatForList($row_rss_publicidade1['id'], 20); ?></div></td>
                  <td><div class="KT_col_nome"><?php echo KT_FormatForList($row_rss_publicidade1['nome'], 20); ?></div></td>
                  <td><div class="KT_col_coluna"><?php echo KT_FormatForList($row_rss_publicidade1['coluna'], 20); ?></div></td>
                  <td><div class="KT_col_status"><?php echo KT_FormatForList($row_rss_publicidade1['status'], 20); ?></div></td>
                  <td><a class="KT_edit_link" href="../../index_admin.php?pag=adicionar_publicidade&amp;id=<?php echo $row_rss_publicidade1['id']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
                </tr>
                <?php } while ($row_rss_publicidade1 = mysql_fetch_assoc($rss_publicidade1)); ?>
              <?php } // Show if recordset not empty ?>
          </tbody>
        </table>
        <div class="KT_bottomnav">
          <div>
            <?php
            $nav_lists_publicidade1->Prepare();
            require("../../../includes/nav/NAV_Text_Navigation.inc.php");
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
          <a class="KT_additem_op_link" href="../../index_admin.php?pag=adicionar_publicidade&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("Adicionar Novo Anúncio"); ?></a> </div>
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
mysql_free_result($rss_publicidade1);
?>
