<?php require_once('../../../../../Connections/Mundo_Download.php'); ?>
<?php
// Load the common classes
require_once('../../../../../includes/common/KT_common.php');

// Load the tNG classes
require_once('../../../../../includes/tng/tNG.inc.php');

// Load the required classes
require_once('../../../../../includes/tfi/TFI.php');
require_once('../../../../../includes/tso/TSO.php');
require_once('../../../../../includes/nav/NAV.php');

// Make unified connection variable
$conn_Mundo_Download = new KT_connection($Mundo_Download, $database_Mundo_Download);

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_Mundo_Download, "../../../../../");
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
$tfi_lists_comentarios_m_p4 = new TFI_TableFilter($conn_Mundo_Download, "tfi_lists_comentarios_m_p4");
$tfi_lists_comentarios_m_p4->addColumn("s_comentarios_m_p.id", "NUMERIC_TYPE", "id", "=");
$tfi_lists_comentarios_m_p4->addColumn("s_comentarios_m_p.nome", "STRING_TYPE", "nome", "%");
$tfi_lists_comentarios_m_p4->addColumn("s_comentarios_m_p.localizacao", "STRING_TYPE", "localizacao", "%");
$tfi_lists_comentarios_m_p4->addColumn("s_comentarios_m_p.status", "STRING_TYPE", "status", "%");
$tfi_lists_comentarios_m_p4->addColumn("s_comentarios_m_p.mensagem_m_p", "STRING_TYPE", "mensagem_m_p", "%");
$tfi_lists_comentarios_m_p4->Execute();

// Sorter
$tso_lists_comentarios_m_p4 = new TSO_TableSorter("rss_comentarios_m_p1", "tso_lists_comentarios_m_p4");
$tso_lists_comentarios_m_p4->addColumn("s_comentarios_m_p.id");
$tso_lists_comentarios_m_p4->addColumn("s_comentarios_m_p.nome");
$tso_lists_comentarios_m_p4->addColumn("s_comentarios_m_p.localizacao");
$tso_lists_comentarios_m_p4->addColumn("s_comentarios_m_p.status");
$tso_lists_comentarios_m_p4->addColumn("s_comentarios_m_p.mensagem_m_p");
$tso_lists_comentarios_m_p4->setDefault("s_comentarios_m_p.id");
$tso_lists_comentarios_m_p4->Execute();

// Navigation
$nav_lists_comentarios_m_p4 = new NAV_Regular("nav_lists_comentarios_m_p4", "rss_comentarios_m_p1", "../../../../../", $_SERVER['PHP_SELF'], 30);

//NeXTenesio3 Special List Recordset
$maxRows_rss_comentarios_m_p1 = $_SESSION['max_rows_nav_lists_comentarios_m_p4'];
$pageNum_rss_comentarios_m_p1 = 0;
if (isset($_GET['pageNum_rss_comentarios_m_p1'])) {
  $pageNum_rss_comentarios_m_p1 = $_GET['pageNum_rss_comentarios_m_p1'];
}
$startRow_rss_comentarios_m_p1 = $pageNum_rss_comentarios_m_p1 * $maxRows_rss_comentarios_m_p1;

// Defining List Recordset variable
$NXTFilter_rss_comentarios_m_p1 = "1=1";
if (isset($_SESSION['filter_tfi_lists_comentarios_m_p4'])) {
  $NXTFilter_rss_comentarios_m_p1 = $_SESSION['filter_tfi_lists_comentarios_m_p4'];
}
// Defining List Recordset variable
$NXTSort_rss_comentarios_m_p1 = "s_comentarios_m_p.id";
if (isset($_SESSION['sorter_tso_lists_comentarios_m_p4'])) {
  $NXTSort_rss_comentarios_m_p1 = $_SESSION['sorter_tso_lists_comentarios_m_p4'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);

$query_rss_comentarios_m_p1 = "SELECT s_comentarios_m_p.id, s_comentarios_m_p.nome, s_comentarios_m_p.localizacao, s_comentarios_m_p.status, s_comentarios_m_p.mensagem_m_p FROM s_comentarios_m_p WHERE {$NXTFilter_rss_comentarios_m_p1} AND s_comentarios_m_p.localizacao = 'Elogios' AND s_comentarios_m_p.status = 'Aprovado' ORDER BY id DESC";
$query_limit_rss_comentarios_m_p1 = sprintf("%s LIMIT %d, %d", $query_rss_comentarios_m_p1, $startRow_rss_comentarios_m_p1, $maxRows_rss_comentarios_m_p1);
$rss_comentarios_m_p1 = mysql_query($query_limit_rss_comentarios_m_p1, $Mundo_Download) or die(mysql_error());
$row_rss_comentarios_m_p1 = mysql_fetch_assoc($rss_comentarios_m_p1);

if (isset($_GET['totalRows_rss_comentarios_m_p1'])) {
  $totalRows_rss_comentarios_m_p1 = $_GET['totalRows_rss_comentarios_m_p1'];
} else {
  $all_rss_comentarios_m_p1 = mysql_query($query_rss_comentarios_m_p1);
  $totalRows_rss_comentarios_m_p1 = mysql_num_rows($all_rss_comentarios_m_p1);
}
$totalPages_rss_comentarios_m_p1 = ceil($totalRows_rss_comentarios_m_p1/$maxRows_rss_comentarios_m_p1)-1;
//End NeXTenesio3 Special List Recordset

$nav_lists_comentarios_m_p4->checkBoundries();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Admin</title>

<link href="../../../estrutura_css/menu_principal/aprovado_comentarios_elogios.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

<link href="../../../../../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../../../../../includes/common/js/base.js" type="text/javascript"></script>
<script src="../../../../../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../../../../../includes/skins/style.js" type="text/javascript"></script>
<script src="../../../../../includes/nxt/scripts/list.js" type="text/javascript"></script>
<script src="../../../../../includes/nxt/scripts/list.js.php" type="text/javascript"></script>
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
  .KT_col_localizacao {width:140px; overflow:hidden;}
  .KT_col_status {width:140px; overflow:hidden;}
  .KT_col_mensagem_m_p {width:140px; overflow:hidden;}
</style>
</head>

<body>

<div id="geral">

<div id="conteudo">
  <div class="KT_tng" id="lists_comentarios_m_p4">
    <h1> Aprovados - Comentários - Menu Principal - Elogios
      <?php
  $nav_lists_comentarios_m_p4->Prepare();
  require("../../../../../includes/nav/NAV_Text_Statistics.inc.php");
?>
    </h1>
    <div class="KT_tnglist">
      <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
        <div class="KT_options"> <a href="<?php echo $nav_lists_comentarios_m_p4->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
          <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_lists_comentarios_m_p4'] == 1) {
?>
            <?php echo $_SESSION['default_max_rows_nav_lists_comentarios_m_p4']; ?>
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
  if (@$_SESSION['has_filter_tfi_lists_comentarios_m_p4'] == 1) {
?>
                  <a href="<?php echo $tfi_lists_comentarios_m_p4->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_lists_comentarios_m_p4->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
        </div>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <thead>
            <tr class="KT_row_order">
              <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
              </th>
              <th id="id" class="KT_sorter KT_col_id <?php echo $tso_lists_comentarios_m_p4->getSortIcon('s_comentarios_m_p.id'); ?>"> <a href="<?php echo $tso_lists_comentarios_m_p4->getSortLink('s_comentarios_m_p.id'); ?>">Id</a> </th>
              <th id="nome" class="KT_sorter KT_col_nome <?php echo $tso_lists_comentarios_m_p4->getSortIcon('s_comentarios_m_p.nome'); ?>"> <a href="<?php echo $tso_lists_comentarios_m_p4->getSortLink('s_comentarios_m_p.nome'); ?>">Nome</a> </th>
              <th id="localizacao" class="KT_sorter KT_col_localizacao <?php echo $tso_lists_comentarios_m_p4->getSortIcon('s_comentarios_m_p.localizacao'); ?>"> <a href="<?php echo $tso_lists_comentarios_m_p4->getSortLink('s_comentarios_m_p.localizacao'); ?>">Menu Principal</a> </th>
              <th id="status" class="KT_sorter KT_col_status <?php echo $tso_lists_comentarios_m_p4->getSortIcon('s_comentarios_m_p.status'); ?>"> <a href="<?php echo $tso_lists_comentarios_m_p4->getSortLink('s_comentarios_m_p.status'); ?>">Status</a> </th>
              <th id="mensagem_m_p" class="KT_sorter KT_col_mensagem_m_p <?php echo $tso_lists_comentarios_m_p4->getSortIcon('s_comentarios_m_p.mensagem_m_p'); ?>"> <a href="<?php echo $tso_lists_comentarios_m_p4->getSortLink('s_comentarios_m_p.mensagem_m_p'); ?>">Comentário</a> </th>
              <th><a href="../../../../index_admin.php?pag=aprovado_comentarios_elogios">Atualizar</a></th>
            </tr>
            <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_lists_comentarios_m_p4'] == 1) {
?>
              <tr class="KT_row_filter">
                <td>&nbsp;</td>
                <td><input type="text" name="tfi_lists_comentarios_m_p4_id" id="tfi_lists_comentarios_m_p4_id" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_lists_comentarios_m_p4_id']); ?>" size="20" maxlength="100" /></td>
                <td><input type="text" name="tfi_lists_comentarios_m_p4_nome" id="tfi_lists_comentarios_m_p4_nome" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_lists_comentarios_m_p4_nome']); ?>" size="20" maxlength="50" /></td>
                <td><input type="text" name="tfi_lists_comentarios_m_p4_localizacao" id="tfi_lists_comentarios_m_p4_localizacao" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_lists_comentarios_m_p4_localizacao']); ?>" size="20" maxlength="50" /></td>
                <td><select name="tfi_lists_comentarios_m_p4_status" id="tfi_lists_comentarios_m_p4_status">
                  <option value="Aprovado" <?php if (!(strcmp("Aprovado", KT_escapeAttribute(@$_SESSION['tfi_lists_comentarios_m_p4_status'])))) {echo "selected=\"selected\"";} ?>>Aprovado</option>
                  </select>
                </td>
                <td><input type="text" name="tfi_lists_comentarios_m_p4_mensagem_m_p" id="tfi_lists_comentarios_m_p4_mensagem_m_p" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_lists_comentarios_m_p4_mensagem_m_p']); ?>" size="20" maxlength="100" /></td>
                <td><input type="submit" name="tfi_lists_comentarios_m_p4" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
              </tr>
              <?php } 
  // endif Conditional region3
?>
          </thead>
          <tbody>
            <?php if ($totalRows_rss_comentarios_m_p1 == 0) { // Show if recordset empty ?>
              <tr>
                <td colspan="7"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
              </tr>
              <?php } // Show if recordset empty ?>
            <?php if ($totalRows_rss_comentarios_m_p1 > 0) { // Show if recordset not empty ?>
              <?php do { ?>
                <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                  <td><input type="checkbox" name="kt_pk_s_comentarios_m_p" class="id_checkbox" value="<?php echo $row_rss_comentarios_m_p1['id']; ?>" />
                      <input type="hidden" name="id" class="id_field" value="<?php echo $row_rss_comentarios_m_p1['id']; ?>" />
                  </td>
                  <td><div class="KT_col_id"><?php echo KT_FormatForList($row_rss_comentarios_m_p1['id'], 20); ?></div></td>
                  <td><div class="KT_col_nome"><?php echo KT_FormatForList($row_rss_comentarios_m_p1['nome'], 20); ?></div></td>
                  <td><div class="KT_col_localizacao"><?php echo KT_FormatForList($row_rss_comentarios_m_p1['localizacao'], 20); ?></div></td>
                  <td><div class="KT_col_status"><?php echo KT_FormatForList($row_rss_comentarios_m_p1['status'], 20); ?></div></td>
                  <td><div class="KT_col_mensagem_m_p"><?php echo KT_FormatForList($row_rss_comentarios_m_p1['mensagem_m_p'], 20); ?></div></td>
                  <td><a class="KT_edit_link" href="../../../../index_admin.php?pag=alterar_comentarios_menu_principal&amp;id=<?php echo $row_rss_comentarios_m_p1['id']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
                </tr>
                <?php } while ($row_rss_comentarios_m_p1 = mysql_fetch_assoc($rss_comentarios_m_p1)); ?>
              <?php } // Show if recordset not empty ?>
          </tbody>
        </table>
        <div class="KT_bottomnav">
          <div>
            <?php
            $nav_lists_comentarios_m_p4->Prepare();
            require("../../../../../includes/nav/NAV_Text_Navigation.inc.php");
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
          <a class="KT_additem_op_link" href="../../../../index_admin.php?pag=alterar_comentarios_menu_principal&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("Adicionar Novo Comentário"); ?></a> </div>
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
mysql_free_result($rss_comentarios_m_p1);
?>
