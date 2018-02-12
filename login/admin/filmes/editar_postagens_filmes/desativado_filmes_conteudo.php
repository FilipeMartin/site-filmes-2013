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
$tfi_listconteudo_filmes5 = new TFI_TableFilter($conn_Mundo_Download, "tfi_listconteudo_filmes5");
$tfi_listconteudo_filmes5->addColumn("conteudo_filmes.id", "NUMERIC_TYPE", "id", "=");
$tfi_listconteudo_filmes5->addColumn("conteudo_filmes.titulo", "STRING_TYPE", "titulo", "%");
$tfi_listconteudo_filmes5->addColumn("conteudo_filmes.ano", "STRING_TYPE", "ano", "%");
$tfi_listconteudo_filmes5->addColumn("conteudo_filmes.genero", "STRING_TYPE", "genero", "%");
$tfi_listconteudo_filmes5->addColumn("conteudo_filmes.idioma", "STRING_TYPE", "idioma", "%");
$tfi_listconteudo_filmes5->addColumn("conteudo_filmes.status", "STRING_TYPE", "status", "%");
$tfi_listconteudo_filmes5->Execute();

// Sorter
$tso_listconteudo_filmes5 = new TSO_TableSorter("rsconteudo_filmes1", "tso_listconteudo_filmes5");
$tso_listconteudo_filmes5->addColumn("conteudo_filmes.id");
$tso_listconteudo_filmes5->addColumn("conteudo_filmes.titulo");
$tso_listconteudo_filmes5->addColumn("conteudo_filmes.ano");
$tso_listconteudo_filmes5->addColumn("conteudo_filmes.genero");
$tso_listconteudo_filmes5->addColumn("conteudo_filmes.idioma");
$tso_listconteudo_filmes5->addColumn("conteudo_filmes.status");
$tso_listconteudo_filmes5->setDefault("conteudo_filmes.id");
$tso_listconteudo_filmes5->Execute();

// Navigation
$nav_listconteudo_filmes5 = new NAV_Regular("nav_listconteudo_filmes5", "rsconteudo_filmes1", "../../../../", $_SERVER['PHP_SELF'], 30);

//NeXTenesio3 Special List Recordset
$maxRows_rsconteudo_filmes1 = $_SESSION['max_rows_nav_listconteudo_filmes5'];
$pageNum_rsconteudo_filmes1 = 0;
if (isset($_GET['pageNum_rsconteudo_filmes1'])) {
  $pageNum_rsconteudo_filmes1 = $_GET['pageNum_rsconteudo_filmes1'];
}
$startRow_rsconteudo_filmes1 = $pageNum_rsconteudo_filmes1 * $maxRows_rsconteudo_filmes1;

// Defining List Recordset variable
$NXTFilter_rsconteudo_filmes1 = "1=1";
if (isset($_SESSION['filter_tfi_listconteudo_filmes5'])) {
  $NXTFilter_rsconteudo_filmes1 = $_SESSION['filter_tfi_listconteudo_filmes5'];
}
// Defining List Recordset variable
$NXTSort_rsconteudo_filmes1 = "conteudo_filmes.id";
if (isset($_SESSION['sorter_tso_listconteudo_filmes5'])) {
  $NXTSort_rsconteudo_filmes1 = $_SESSION['sorter_tso_listconteudo_filmes5'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);

$query_rsconteudo_filmes1 = "SELECT conteudo_filmes.id, conteudo_filmes.titulo, conteudo_filmes.ano, conteudo_filmes.genero, conteudo_filmes.idioma, conteudo_filmes.status FROM conteudo_filmes WHERE {$NXTFilter_rsconteudo_filmes1} AND conteudo_filmes.status = 'Desativado' ORDER BY {$NXTSort_rsconteudo_filmes1}";
$query_limit_rsconteudo_filmes1 = sprintf("%s LIMIT %d, %d", $query_rsconteudo_filmes1, $startRow_rsconteudo_filmes1, $maxRows_rsconteudo_filmes1);
$rsconteudo_filmes1 = mysql_query($query_limit_rsconteudo_filmes1, $Mundo_Download) or die(mysql_error());
$row_rsconteudo_filmes1 = mysql_fetch_assoc($rsconteudo_filmes1);

if (isset($_GET['totalRows_rsconteudo_filmes1'])) {
  $totalRows_rsconteudo_filmes1 = $_GET['totalRows_rsconteudo_filmes1'];
} else {
  $all_rsconteudo_filmes1 = mysql_query($query_rsconteudo_filmes1);
  $totalRows_rsconteudo_filmes1 = mysql_num_rows($all_rsconteudo_filmes1);
}
$totalPages_rsconteudo_filmes1 = ceil($totalRows_rsconteudo_filmes1/$maxRows_rsconteudo_filmes1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listconteudo_filmes5->checkBoundries();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Admin</title>

<link href="../../estrutura_css/filmes/desativado_filmes_conteudo.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

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
  .KT_col_ano {width:140px; overflow:hidden;}
  .KT_col_genero {width:140px; overflow:hidden;}
  .KT_col_idioma {width:140px; overflow:hidden;}
  .KT_col_status {width:140px; overflow:hidden;}
</style>
</head>

<body>

<div id="geral">

<div id="conteudo">
  <div class="KT_tng" id="listconteudo_filmes5">
    <h1> Painel - Conteúdo Filmes - Desativado
      <?php
  $nav_listconteudo_filmes5->Prepare();
  require("../../../../includes/nav/NAV_Text_Statistics.inc.php");
?>
    </h1>
    <div class="KT_tnglist">
      <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
        <div class="KT_options"> <a href="<?php echo $nav_listconteudo_filmes5->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
          <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listconteudo_filmes5'] == 1) {
?>
            <?php echo $_SESSION['default_max_rows_nav_listconteudo_filmes5']; ?>
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
  if (@$_SESSION['has_filter_tfi_listconteudo_filmes5'] == 1) {
?>
                  <a href="<?php echo $tfi_listconteudo_filmes5->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listconteudo_filmes5->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
        </div>
        <table cellpadding="2" cellspacing="0" class="KT_tngtable">
          <thead>
            <tr class="KT_row_order">
              <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
              </th>
              <th id="id" class="KT_sorter KT_col_id <?php echo $tso_listconteudo_filmes5->getSortIcon('conteudo_filmes.id'); ?>"> <a href="<?php echo $tso_listconteudo_filmes5->getSortLink('conteudo_filmes.id'); ?>">Id</a> </th>
              <th id="titulo" class="KT_sorter KT_col_titulo <?php echo $tso_listconteudo_filmes5->getSortIcon('conteudo_filmes.titulo'); ?>"> <a href="<?php echo $tso_listconteudo_filmes5->getSortLink('conteudo_filmes.titulo'); ?>">Titulo</a> </th>
              <th id="ano" class="KT_sorter KT_col_ano <?php echo $tso_listconteudo_filmes5->getSortIcon('conteudo_filmes.ano'); ?>"> <a href="<?php echo $tso_listconteudo_filmes5->getSortLink('conteudo_filmes.ano'); ?>">Ano</a> </th>
              <th id="genero" class="KT_sorter KT_col_genero <?php echo $tso_listconteudo_filmes5->getSortIcon('conteudo_filmes.genero'); ?>"> <a href="<?php echo $tso_listconteudo_filmes5->getSortLink('conteudo_filmes.genero'); ?>">Genero</a> </th>
              <th id="idioma" class="KT_sorter KT_col_idioma <?php echo $tso_listconteudo_filmes5->getSortIcon('conteudo_filmes.idioma'); ?>"> <a href="<?php echo $tso_listconteudo_filmes5->getSortLink('conteudo_filmes.idioma'); ?>">Idioma</a> </th>
              <th id="status" class="KT_sorter KT_col_status <?php echo $tso_listconteudo_filmes5->getSortIcon('conteudo_filmes.status'); ?>"> <a href="<?php echo $tso_listconteudo_filmes5->getSortLink('conteudo_filmes.status'); ?>">Status</a> </th>
              <th>&nbsp;</th>
            </tr>
            <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listconteudo_filmes5'] == 1) {
?>
              <tr class="KT_row_filter">
                <td>&nbsp;</td>
                <td><input type="text" name="tfi_listconteudo_filmes5_id" id="tfi_listconteudo_filmes5_id" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_id']); ?>" size="20" maxlength="100" /></td>
                <td><input type="text" name="tfi_listconteudo_filmes5_titulo" id="tfi_listconteudo_filmes5_titulo" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_titulo']); ?>" size="20" maxlength="50" /></td>
                <td><select name="tfi_listconteudo_filmes5_ano" id="tfi_listconteudo_filmes5_ano">
                  <option value="2020" <?php if (!(strcmp(2020, KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_ano'])))) {echo "selected=\"selected\"";} ?>>2020</option>
                  <option value="2019" <?php if (!(strcmp(2019, KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_ano'])))) {echo "selected=\"selected\"";} ?>>2019</option>
                  <option value="2018" <?php if (!(strcmp(2018, KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_ano'])))) {echo "selected=\"selected\"";} ?>>2018</option>
                  <option value="2017" <?php if (!(strcmp(2017, KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_ano'])))) {echo "selected=\"selected\"";} ?>>2017</option>
                  <option value="2016" <?php if (!(strcmp(2016, KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_ano'])))) {echo "selected=\"selected\"";} ?>>2016</option>
                  <option value="2015" <?php if (!(strcmp(2015, KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_ano'])))) {echo "selected=\"selected\"";} ?>>2015</option>
                  <option value="2014" <?php if (!(strcmp(2014, KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_ano'])))) {echo "selected=\"selected\"";} ?>>2014</option>
                  <option value="2013" <?php if (!(strcmp(2013, KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_ano'])))) {echo "selected=\"selected\"";} ?>>2013</option>
                    <option value="2012" <?php if (!(strcmp(2012, KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_ano'])))) {echo "selected=\"selected\"";} ?>>2012</option>
                    <option value="2011" <?php if (!(strcmp(2011, KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_ano'])))) {echo "selected=\"selected\"";} ?>>2011</option>
                    <option value="antigo" <?php if (!(strcmp("antigo", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_ano'])))) {echo "selected=\"selected\"";} ?>>Antigo</option>
                  </select>
                </td>
                <td><select name="tfi_listconteudo_filmes5_genero" id="tfi_listconteudo_filmes5_genero">
                    <option value="acao" <?php if (!(strcmp("acao", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Ação</option>
                    <option value="animacao" <?php if (!(strcmp("animacao", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Animação</option>
                    <option value="aventura" <?php if (!(strcmp("aventura", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Aventura</option>
                    <option value="comedia" <?php if (!(strcmp("comedia", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Comédia</option>
                    <option value="corrida" <?php if (!(strcmp("corrida", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Corrida</option>
                    <option value="documentario" <?php if (!(strcmp("documentario", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Documentario</option>
                    <option value="drama" <?php if (!(strcmp("drama", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Drama</option>
                    <option value="fantasia" <?php if (!(strcmp("fantasia", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Fantasia</option>
                    <option value="faroeste" <?php if (!(strcmp("faroeste", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Faroeste</option>
                    <option value="ficcao" <?php if (!(strcmp("ficcao", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Ficção</option>
                    <option value="ficcao_cientifica" <?php if (!(strcmp("ficcao_cientifica", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Ficção Científica</option>
                    <option value="guerra" <?php if (!(strcmp("guerra", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Guerra</option>
                    <option value="musical" <?php if (!(strcmp("musical", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Musical</option>
                    <option value="nostalgia" <?php if (!(strcmp("nostalgia", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Nostalgia</option>
                    <option value="policial" <?php if (!(strcmp("policial", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Policial</option>
                    <option value="religioso" <?php if (!(strcmp("religioso", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Religioso</option>
                    <option value="romance" <?php if (!(strcmp("romance", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Romance</option>
                    <option value="shows" <?php if (!(strcmp("shows", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Shows</option>
                    <option value="suspense" <?php if (!(strcmp("suspense", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Suspense</option>
                    <option value="terror" <?php if (!(strcmp("terror", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Terror</option>
                    <option value="thriller" <?php if (!(strcmp("thriller", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_genero'])))) {echo "selected=\"selected\"";} ?>>Thriller</option>
                  </select>
                </td>
                <td><select name="tfi_listconteudo_filmes5_idioma" id="tfi_listconteudo_filmes5_idioma">
                    <option value="Dublado" <?php if (!(strcmp("Dublado", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_idioma'])))) {echo "selected=\"selected\"";} ?>>Dublado</option>
                    <option value="Legendado" <?php if (!(strcmp("Legendado", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_idioma'])))) {echo "selected=\"selected\"";} ?>>Legendado</option>
                    <option value="Nacional" <?php if (!(strcmp("Nacional", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_idioma'])))) {echo "selected=\"selected\"";} ?>>Nacional</option>
                  </select>
                </td>
                <td><select name="tfi_listconteudo_filmes5_status" id="tfi_listconteudo_filmes5_status">
                  <option value="Desativado" <?php if (!(strcmp("Desativado", KT_escapeAttribute(@$_SESSION['tfi_listconteudo_filmes5_status'])))) {echo "selected=\"selected\"";} ?>>Desativado</option>
                  </select>
                </td>
                <td><input type="submit" name="tfi_listconteudo_filmes5" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
              </tr>
              <?php } 
  // endif Conditional region3
?>
          </thead>
          <tbody>
            <?php if ($totalRows_rsconteudo_filmes1 == 0) { // Show if recordset empty ?>
              <tr>
                <td colspan="8"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
              </tr>
              <?php } // Show if recordset empty ?>
            <?php if ($totalRows_rsconteudo_filmes1 > 0) { // Show if recordset not empty ?>
              <?php do { ?>
                <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                  <td><input type="checkbox" name="kt_pk_conteudo_filmes" class="id_checkbox" value="<?php echo $row_rsconteudo_filmes1['id']; ?>" />
                      <input type="hidden" name="id" class="id_field" value="<?php echo $row_rsconteudo_filmes1['id']; ?>" />
                  </td>
                  <td><div class="KT_col_id"><?php echo KT_FormatForList($row_rsconteudo_filmes1['id'], 20); ?></div></td>
                  <td><div class="KT_col_titulo"><?php echo KT_FormatForList($row_rsconteudo_filmes1['titulo'], 20); ?></div></td>
                  <td><div class="KT_col_ano"><?php echo KT_FormatForList($row_rsconteudo_filmes1['ano'], 20); ?></div></td>
                  <td><div class="KT_col_genero"><?php echo KT_FormatForList($row_rsconteudo_filmes1['genero'], 20); ?></div></td>
                  <td><div class="KT_col_idioma"><?php echo KT_FormatForList($row_rsconteudo_filmes1['idioma'], 20); ?></div></td>
                  <td><div class="KT_col_status"><?php echo KT_FormatForList($row_rsconteudo_filmes1['status'], 20); ?></div></td>
                  <td><a class="KT_edit_link" href="../../../index_admin.php?pag=editar_filmes&amp;id=<?php echo $row_rsconteudo_filmes1['id']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a> </td>
                </tr>
                <?php } while ($row_rsconteudo_filmes1 = mysql_fetch_assoc($rsconteudo_filmes1)); ?>
              <?php } // Show if recordset not empty ?>
          </tbody>
        </table>
        <div class="KT_bottomnav">
          <div>
            <?php
            $nav_listconteudo_filmes5->Prepare();
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
          <a class="KT_additem_op_link" href="../../../index_admin.php?pag=editar_filmes&amp;KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("Adicionar Nova Postagem"); ?></a> </div>
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
mysql_free_result($rsconteudo_filmes1);
?>
