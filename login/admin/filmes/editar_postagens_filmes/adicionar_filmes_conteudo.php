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

//start Trigger_FileDelete trigger
//remove this line if you want to edit the code by hand 
function Trigger_FileDelete(&$tNG) {
  $deleteObj = new tNG_FileDelete($tNG);
  $deleteObj->setFolder("../../../../conteudo/filmes/img/");
  $deleteObj->setDbFieldName("imagem");
  return $deleteObj->Execute();
}
//end Trigger_FileDelete trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("imagem");
  $uploadObj->setDbFieldName("imagem");
  $uploadObj->setFolder("../../../../conteudo/filmes/img/");
  $uploadObj->setResize("false", 220, 310);
  $uploadObj->setMaxSize(1500);
  $uploadObj->setAllowedExtensions("gif, jpg, jpe, jpeg, png");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

// Make an insert transaction instance
$ins_conteudo_filmes = new tNG_multipleInsert($conn_Mundo_Download);
$tNGs->addTransaction($ins_conteudo_filmes);
// Register triggers
$ins_conteudo_filmes->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_conteudo_filmes->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_conteudo_filmes->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../../../includes/nxt/back.php");
$ins_conteudo_filmes->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$ins_conteudo_filmes->setTable("conteudo_filmes");
$ins_conteudo_filmes->addColumn("imagem", "FILE_TYPE", "FILES", "imagem");
$ins_conteudo_filmes->addColumn("titulo", "STRING_TYPE", "POST", "titulo");
$ins_conteudo_filmes->addColumn("ano", "STRING_TYPE", "POST", "ano");
$ins_conteudo_filmes->addColumn("data_da_postagem", "STRING_TYPE", "POST", "data_da_postagem");
$ins_conteudo_filmes->addColumn("genero", "STRING_TYPE", "POST", "genero");
$ins_conteudo_filmes->addColumn("idioma", "STRING_TYPE", "POST", "idioma");
$ins_conteudo_filmes->addColumn("sinopse", "STRING_TYPE", "POST", "sinopse");
$ins_conteudo_filmes->addColumn("trailer", "STRING_TYPE", "POST", "trailer");
$ins_conteudo_filmes->addColumn("dados_do_filme", "STRING_TYPE", "POST", "dados_do_filme");
$ins_conteudo_filmes->addColumn("links_filmes_online", "STRING_TYPE", "POST", "links_filmes_online");
$ins_conteudo_filmes->addColumn("download_rmvb", "STRING_TYPE", "POST", "download_rmvb");
$ins_conteudo_filmes->addColumn("download_avi", "STRING_TYPE", "POST", "download_avi");
$ins_conteudo_filmes->addColumn("status", "STRING_TYPE", "POST", "status");
$ins_conteudo_filmes->setPrimaryKey("id", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_conteudo_filmes = new tNG_multipleUpdate($conn_Mundo_Download);
$tNGs->addTransaction($upd_conteudo_filmes);
// Register triggers
$upd_conteudo_filmes->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_conteudo_filmes->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_conteudo_filmes->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../../../includes/nxt/back.php");
$upd_conteudo_filmes->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$upd_conteudo_filmes->setTable("conteudo_filmes");
$upd_conteudo_filmes->addColumn("imagem", "FILE_TYPE", "FILES", "imagem");
$upd_conteudo_filmes->addColumn("titulo", "STRING_TYPE", "POST", "titulo");
$upd_conteudo_filmes->addColumn("ano", "STRING_TYPE", "POST", "ano");
$upd_conteudo_filmes->addColumn("data_da_postagem", "STRING_TYPE", "POST", "data_da_postagem");
$upd_conteudo_filmes->addColumn("genero", "STRING_TYPE", "POST", "genero");
$upd_conteudo_filmes->addColumn("idioma", "STRING_TYPE", "POST", "idioma");
$upd_conteudo_filmes->addColumn("sinopse", "STRING_TYPE", "POST", "sinopse");
$upd_conteudo_filmes->addColumn("trailer", "STRING_TYPE", "POST", "trailer");
$upd_conteudo_filmes->addColumn("dados_do_filme", "STRING_TYPE", "POST", "dados_do_filme");
$upd_conteudo_filmes->addColumn("links_filmes_online", "STRING_TYPE", "POST", "links_filmes_online");
$upd_conteudo_filmes->addColumn("download_rmvb", "STRING_TYPE", "POST", "download_rmvb");
$upd_conteudo_filmes->addColumn("download_avi", "STRING_TYPE", "POST", "download_avi");
$upd_conteudo_filmes->addColumn("status", "STRING_TYPE", "POST", "status");
$upd_conteudo_filmes->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");

// Make an instance of the transaction object
$del_conteudo_filmes = new tNG_multipleDelete($conn_Mundo_Download);
$tNGs->addTransaction($del_conteudo_filmes);
// Register triggers
$del_conteudo_filmes->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_conteudo_filmes->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../../../includes/nxt/back.php");
$del_conteudo_filmes->registerTrigger("AFTER", "Trigger_FileDelete", 98);
// Add columns
$del_conteudo_filmes->setTable("conteudo_filmes");
$del_conteudo_filmes->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsconteudo_filmes = $tNGs->getRecordset("conteudo_filmes");
$row_rsconteudo_filmes = mysql_fetch_assoc($rsconteudo_filmes);
$totalRows_rsconteudo_filmes = mysql_num_rows($rsconteudo_filmes);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Admin</title>

<link href="../../estrutura_css/filmes/adicionar_filmes_conteudo.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

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
      Conteúdo - Filmes </h1>
    <div class="KT_tngform">
      <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
        <?php $cnt1 = 0; ?>
        <?php do { ?>
          <?php $cnt1++; ?>
          <?php 
// Show IF Conditional region1 
if (@$totalRows_rsconteudo_filmes > 1) {
?>
            <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
            <?php } 
// endif Conditional region1
?>
          <table cellpadding="2" cellspacing="0" class="KT_tngtable">
            <tr>
              <td colspan="2" class="KT_th">
              
              <div id="alinhar-botao">
              
              <input name="botao-visualizar-postagem" id="botao-visualizar-postagem"  type="button" onclick="window.open('../../../../index.php?pag=visualizar_filmes&amp;id=<?php echo $row_rsconteudo_filmes['id']; ?>')" title="Clique aqui, para visualizar a postagem" value="Visualizar postagem: <?php echo KT_escapeAttribute($row_rsconteudo_filmes['titulo']); ?>">
              
              </div> <!-- Fim da div "alinhar-botao" -->              
              </td>
              </tr>            <tr>
              <td colspan="2" class="KT_th">&nbsp;</td>
              </tr>
            <tr>
              <td class="KT_th"><label for="imagem_<?php echo $cnt1; ?>">Imagem:</label></td>
              <td><input type="file" name="imagem_<?php echo $cnt1; ?>" id="imagem_<?php echo $cnt1; ?>" size="50" />
                  <?php echo $tNGs->displayFieldError("conteudo_filmes", "imagem", $cnt1); ?> </td>
            </tr>
            <tr>
              <td class="KT_th"><label for="titulo_<?php echo $cnt1; ?>">Título:</label></td>
              <td><input type="text" name="titulo_<?php echo $cnt1; ?>" id="titulo_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsconteudo_filmes['titulo']); ?>" size="50" maxlength="50" />
                  <?php echo $tNGs->displayFieldHint("titulo");?> <?php echo $tNGs->displayFieldError("conteudo_filmes", "titulo", $cnt1); ?> </td>
            </tr>
            <tr>
              <td class="KT_th"><label for="ano_<?php echo $cnt1; ?>">Ano:</label></td>
              <td><select name="ano_<?php echo $cnt1; ?>" id="ano_<?php echo $cnt1; ?>">
                <option value="2020" <?php if (!(strcmp(2020, KT_escapeAttribute($row_rsconteudo_filmes['ano'])))) {echo "selected=\"selected\"";} ?>>2020</option>
                <option value="2019" <?php if (!(strcmp(2019, KT_escapeAttribute($row_rsconteudo_filmes['ano'])))) {echo "selected=\"selected\"";} ?>>2019</option>
                <option value="2018" <?php if (!(strcmp(2018, KT_escapeAttribute($row_rsconteudo_filmes['ano'])))) {echo "selected=\"selected\"";} ?>>2018</option>
                <option value="2017" <?php if (!(strcmp(2017, KT_escapeAttribute($row_rsconteudo_filmes['ano'])))) {echo "selected=\"selected\"";} ?>>2017</option>
                <option value="2016" <?php if (!(strcmp(2016, KT_escapeAttribute($row_rsconteudo_filmes['ano'])))) {echo "selected=\"selected\"";} ?>>2016</option>
                <option value="2015" <?php if (!(strcmp(2015, KT_escapeAttribute($row_rsconteudo_filmes['ano'])))) {echo "selected=\"selected\"";} ?>>2015</option>
                <option value="2014" <?php if (!(strcmp(2014, KT_escapeAttribute($row_rsconteudo_filmes['ano'])))) {echo "selected=\"selected\"";} ?>>2014</option>
                <option value="2013" <?php if (!(strcmp(2013, KT_escapeAttribute($row_rsconteudo_filmes['ano'])))) {echo "selected=\"selected\"";} ?>>2013</option>
                  <option value="2012" <?php if (!(strcmp(2012, KT_escapeAttribute($row_rsconteudo_filmes['ano'])))) {echo "selected=\"selected\"";} ?>>2012</option>
                  <option value="2011" <?php if (!(strcmp(2011, KT_escapeAttribute($row_rsconteudo_filmes['ano'])))) {echo "selected=\"selected\"";} ?>>2011</option>
                  <option value="antigo" <?php if (!(strcmp("antigo", KT_escapeAttribute($row_rsconteudo_filmes['ano'])))) {echo "selected=\"selected\"";} ?>>Antigo</option>
                </select>
                  <?php echo $tNGs->displayFieldError("conteudo_filmes", "ano", $cnt1); ?> </td>
            </tr>
            <tr>
              <td class="KT_th"><label for="data_da_postagem_<?php echo $cnt1; ?>">Data da Postagem:</label></td>
              <td><input type="text" name="data_da_postagem_<?php echo $cnt1; ?>" id="data_da_postagem_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsconteudo_filmes['data_da_postagem']); ?>" size="50" maxlength="50" />
                  <?php echo $tNGs->displayFieldHint("data_da_postagem");?> <?php echo $tNGs->displayFieldError("conteudo_filmes", "data_da_postagem", $cnt1); ?> </td>
            </tr>
            <tr>
              <td class="KT_th"><label for="genero_<?php echo $cnt1; ?>">Genero:</label></td>
              <td><select name="genero_<?php echo $cnt1; ?>" id="genero_<?php echo $cnt1; ?>">
                  <option value="acao" <?php if (!(strcmp("acao", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Ação</option>
                  <option value="animacao" <?php if (!(strcmp("animacao", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Animação</option>
                  <option value="aventura" <?php if (!(strcmp("aventura", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Aventura</option>
                  <option value="comedia" <?php if (!(strcmp("comedia", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Comédia</option>
                  <option value="corrida" <?php if (!(strcmp("corrida", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Corrida</option>
                  <option value="documentario" <?php if (!(strcmp("documentario", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Documentario</option>
                  <option value="drama" <?php if (!(strcmp("drama", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Drama</option>
                  <option value="fantasia" <?php if (!(strcmp("fantasia", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Fantasia</option>
                  <option value="faroeste" <?php if (!(strcmp("faroeste", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Faroeste</option>
                  <option value="ficcao" <?php if (!(strcmp("ficcao", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Ficção</option>
                  <option value="ficcao_cientifica" <?php if (!(strcmp("ficcao_cientifica", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Ficção Científica</option>
                  <option value="guerra" <?php if (!(strcmp("guerra", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Guerra</option>
                  <option value="musical" <?php if (!(strcmp("musical", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Musical</option>
                  <option value="nostalgia" <?php if (!(strcmp("nostalgia", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Nostalgia</option>
                  <option value="policial" <?php if (!(strcmp("policial", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Policial</option>
                  <option value="religioso" <?php if (!(strcmp("religioso", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Religioso</option>
                  <option value="romance" <?php if (!(strcmp("romance", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Romance</option>
                  <option value="shows" <?php if (!(strcmp("shows", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Shows</option>
                  <option value="suspense" <?php if (!(strcmp("suspense", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Suspense</option>
                  <option value="terror" <?php if (!(strcmp("terror", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Terror</option>
                  <option value="thriller" <?php if (!(strcmp("thriller", KT_escapeAttribute($row_rsconteudo_filmes['genero'])))) {echo "selected=\"selected\"";} ?>>Thriller</option>
                </select>
                  <?php echo $tNGs->displayFieldError("conteudo_filmes", "genero", $cnt1); ?> </td>
            </tr>
            <tr>
              <td class="KT_th"><label for="idioma_<?php echo $cnt1; ?>">Idioma:</label></td>
              <td><select name="idioma_<?php echo $cnt1; ?>" id="idioma_<?php echo $cnt1; ?>">
                  <option value="Dublado" <?php if (!(strcmp("Dublado", KT_escapeAttribute($row_rsconteudo_filmes['idioma'])))) {echo "selected=\"selected\"";} ?>>Dublado</option>
                  <option value="Legendado" <?php if (!(strcmp("Legendado", KT_escapeAttribute($row_rsconteudo_filmes['idioma'])))) {echo "selected=\"selected\"";} ?>>Legendado</option>
                  <option value="Nacional" <?php if (!(strcmp("Nacional", KT_escapeAttribute($row_rsconteudo_filmes['idioma'])))) {echo "selected=\"selected\"";} ?>>Nacional</option>
                </select>
                  <?php echo $tNGs->displayFieldError("conteudo_filmes", "idioma", $cnt1); ?> </td>
            </tr>
            <tr>
              <td colspan="2" class="KT_th">&nbsp;</td>
              </tr>
            <tr>
              <td class="KT_th"><label for="sinopse_<?php echo $cnt1; ?>">Sinopse:</label></td>
              <td><textarea name="sinopse_<?php echo $cnt1; ?>" id="sinopse_<?php echo $cnt1; ?>" cols="100" rows="12"><?php echo KT_escapeAttribute($row_rsconteudo_filmes['sinopse']); ?></textarea>
                  <?php echo $tNGs->displayFieldHint("sinopse");?> <?php echo $tNGs->displayFieldError("conteudo_filmes", "sinopse", $cnt1); ?> </td>
            </tr>
            <tr>
              <td colspan="2" class="KT_th">&nbsp;</td>
              </tr>
            <tr>
              <td class="KT_th"><label for="trailer_<?php echo $cnt1; ?>">Trailer:</label></td>
              <td><textarea name="trailer_<?php echo $cnt1; ?>" id="trailer_<?php echo $cnt1; ?>" cols="80" rows="5"><?php echo KT_escapeAttribute($row_rsconteudo_filmes['trailer']); ?></textarea>
                  <?php echo $tNGs->displayFieldHint("trailer");?> <?php echo $tNGs->displayFieldError("conteudo_filmes", "trailer", $cnt1); ?> </td>
            </tr>
            <tr>
              <td colspan="2" class="KT_th">&nbsp;</td>
            </tr>
            <tr>
              <td class="KT_th">D - F - CSS:</td>
              <td class="KT_th">
              <input name="Complemento - RMVB2" type="text" id="Complemento - RMVB2" value="&lt;span class=&quot;t-1-d-f&quot;&gt;Tamanho: &lt;/span&gt;422 MB&lt;br /&gt;" size="58" />              </td>
            </tr>
            <tr>
              <td class="KT_th"><label for="dados_do_filme_<?php echo $cnt1; ?>">Dados do Filme:</label></td>
              <td><textarea name="dados_do_filme_<?php echo $cnt1; ?>" id="dados_do_filme_<?php echo $cnt1; ?>" cols="150" rows="20"><?php echo KT_escapeAttribute($row_rsconteudo_filmes['dados_do_filme']); ?></textarea>
                  <?php echo $tNGs->displayFieldHint("dados_do_filme");?> <?php echo $tNGs->displayFieldError("conteudo_filmes", "dados_do_filme", $cnt1); ?> </td>
            </tr>
            <tr>
              <td colspan="2" class="KT_th">&nbsp;</td>
              </tr>
            <tr>
              <td class="KT_th"><label for="links_filmes_online_<?php echo $cnt1; ?>">Filmes - Online:</label></td>
              <td><textarea name="links_filmes_online_<?php echo $cnt1; ?>" id="links_filmes_online_<?php echo $cnt1; ?>" cols="155" rows="20"><?php echo KT_escapeAttribute($row_rsconteudo_filmes['links_filmes_online']); ?></textarea>
                  <?php echo $tNGs->displayFieldHint("links_filmes_online");?> <?php echo $tNGs->displayFieldError("conteudo_filmes", "links_filmes_online", $cnt1); ?> </td>
            </tr>
            <tr>
              <td class="KT_th">Visualizar - Online:</td>
              <td class="KT_th" align="center" valign="middle">
              
              <div id="alinhar-botao">  
                          
              <input name="botao-visualizar" id="botao-visualizar" type="button" onclick="visualizar_online.location.href='admin/filmes/editar_postagens_filmes/visualizar_links_download/links_filmes_online.php?id=<?php echo $row_rsconteudo_filmes['id']; ?>'" title="Clique aqui, para visualizar" value="Visualizar - Online">
           
              <input name="botao-voltar-visualizacao" id="botao-voltar-visualizacao" type="button" onclick="visualizar_online.location.href='admin/filmes/editar_postagens_filmes/visualizar_links_download/links_filmes_online.php'" title="Clique aqui, para voltar" value="Voltar - Online">
              </div> <!-- Fim da div "alinhar-botao" -->
              
              <div id="alinhar-iframe">
              
              <p></p>             
              <a href="visualizar_links_download/links_filmes_online.php?id=<?php echo $row_rsconteudo_filmes['id']; ?>">
              <iframe id="visualizar_rmvb" name="visualizar_online" src="visualizar_links_download/links_filmes_online.php" width="828" scrolling="no" onload='iframeAutoHeight(this)'border="0"frameborder="0"></iframe></a>             
              
             </div> <!-- Fim da div "alinhar-iframe" -->              
             </td>
            </tr>
            <tr>
              <td colspan="2" class="KT_th">&nbsp;</td>
              </tr>
            <tr>
              <td class="KT_th">Complemetos - Links:</td>
              <td class="KT_th">
              <label>
              
                <input name="Complemento - RMVB" type="text" id="Complemento - RMVB" value="» &lt;a class=&quot;t-b-f-l&quot; target=&quot;_blank&quot; " size="35" />
              </label>              </td>
            </tr>
            <tr>
              <td class="KT_th">Texto - Preto:</td>
              <td class="KT_th">
              <input name="Complemento - RMVB2" type="text" id="Complemento - RMVB2" value="&lt;p&gt;&lt;span class=&quot;t-f-1&quot;&gt;Parte 1&lt;/span&gt;&lt;/p&gt;" size="45" />              </td>
            </tr>
            <tr>
              <td class="KT_th">Texto - Azul:</td>
              <td class="KT_th">
              <input name="Complemento - RMVB2" type="text" id="Complemento - RMVB2" value="&lt;p&gt;&lt;span class=&quot;t-f-2&quot;&gt;Parte 1&lt;/span&gt;&lt;/p&gt;" size="45" />              </td>
            </tr>
            <tr>
              <td class="KT_th"><label for="download_rmvb_<?php echo $cnt1; ?>">Download - RMVB:</label></td>
              <td><textarea name="download_rmvb_<?php echo $cnt1; ?>" id="download_rmvb_<?php echo $cnt1; ?>" cols="155" rows="20"><?php echo KT_escapeAttribute($row_rsconteudo_filmes['download_rmvb']); ?></textarea>
                  <?php echo $tNGs->displayFieldHint("download_rmvb");?> <?php echo $tNGs->displayFieldError("conteudo_filmes", "download_rmvb", $cnt1); ?> </td>
            </tr>
            <tr>
              <td class="KT_th">Visualizar - RMVB:</td>
              <td class="KT_th" align="center" valign="middle">
              
              <div id="alinhar-botao">  
                          
              <input name="botao-visualizar" id="botao-visualizar" type="button" onclick="visualizar_rmvb.location.href='admin/filmes/editar_postagens_filmes/visualizar_links_download/links_rmvb.php?id=<?php echo $row_rsconteudo_filmes['id']; ?>'" title="Clique aqui, para visualizar" value="Visualizar - RMVB">
           
              <input name="botao-voltar-visualizacao" id="botao-voltar-visualizacao" type="button" onclick="visualizar_rmvb.location.href='admin/filmes/editar_postagens_filmes/visualizar_links_download/links_rmvb.php'" title="Clique aqui, para voltar" value="Voltar - RMVB">
              </div> <!-- Fim da div "alinhar-botao" -->
              
              <div id="alinhar-iframe">
              
              <p></p>             
              <a href="visualizar_links_download/links_rmvb.php?id=<?php echo $row_rsconteudo_filmes['id']; ?>">
              <iframe id="visualizar_rmvb" name="visualizar_rmvb" src="visualizar_links_download/links_rmvb.php" width="828" scrolling="no" onload='iframeAutoHeight(this)'border="0"frameborder="0"></iframe></a>              
              
              </div> <!-- Fim da div "alinhar-iframe" -->              
              </td>
            </tr>
            <tr>
              <td colspan="2" class="KT_th">&nbsp;</td>
              </tr>
            <tr>
              <td class="KT_th"><label for="download_avi_<?php echo $cnt1; ?>">Download - AVI:</label></td>
              <td><textarea name="download_avi_<?php echo $cnt1; ?>" id="download_avi_<?php echo $cnt1; ?>" cols="155" rows="20"><?php echo KT_escapeAttribute($row_rsconteudo_filmes['download_avi']); ?></textarea>
                  <?php echo $tNGs->displayFieldHint("download_avi");?> <?php echo $tNGs->displayFieldError("conteudo_filmes", "download_avi", $cnt1); ?> </td>
            </tr>
            <tr>
              <td class="KT_th">Visualizar - AVI:</td>
              <td class="KT_th" align="center" valign="middle">

              <div id="alinhar-botao">  
                          
              <input name="botao-visualizar" id="botao-visualizar" type="button" onclick="visualizar_avi.location.href='admin/filmes/editar_postagens_filmes/visualizar_links_download/links_avi.php?id=<?php echo $row_rsconteudo_filmes['id']; ?>'" title="Clique aqui, para visualizar" value="Visualizar - AVI">
           
              <input name="botao-voltar-visualizacao" id="botao-voltar-visualizacao" type="button" onclick="visualizar_avi.location.href='admin/filmes/editar_postagens_filmes/visualizar_links_download/links_avi.php'" title="Clique aqui, para voltar" value="Voltar - AVI">
              </div> <!-- Fim da div "alinhar-botao" -->
              
              <div id="alinhar-iframe">
              
              <p></p>             
              <a href="visualizar_links_download/links_avi.php?id=<?php echo $row_rsconteudo_filmes['id']; ?>">
              <iframe id="visualizar_avi" name="visualizar_avi" src="visualizar_links_download/links_avi.php" width="828" scrolling="no" onload='iframeAutoHeight(this)'border="0"frameborder="0"></iframe></a>              
              
              </div> <!-- Fim da div "alinhar-iframe" -->              
              </td>
            </tr>
            <tr>
              <td colspan="2" class="KT_th">&nbsp;</td>
            </tr>
            <tr>
              <td class="KT_th">Comentários:</td>
              <td class="KT_th" align="center" valign="middle">
              
              <div id="alinhar-botao">  
                          
              <input name="botao-visualizar-comentarios" id="botao-visualizar-comentarios" type="button" onclick="visualizar_comentarios.location.href='admin/filmes/editar_postagens_filmes/visualizar_comentarios/visualizar_comentarios.php?id=<?php echo $row_rsconteudo_filmes['id']; ?>'" title="Clique aqui, para visualizar" value="Visualizar - Comentários">
           
              <input name="botao-voltar-comentarios" id="botao-voltar-comentarios" type="button" onclick="visualizar_comentarios.location.href='admin/filmes/editar_postagens_filmes/visualizar_comentarios/voltar_comentarios.php'" title="Clique aqui, para voltar" value="Voltar - Comentários">
              
              </div> <!-- Fim da div "alinhar-botao" -->
              
              <div id="alinhar-iframe">
              
              <p></p>             
              <a href="visualizar_comentarios/visualizar_comentarios.php?id=<?php echo $row_rsconteudo_filmes['id']; ?>">
              <iframe id="visualizar_comentarios" name="visualizar_comentarios" src="visualizar_comentarios/voltar_comentarios.php" width="828" scrolling="no" onload='iframeAutoHeight(this)'border="0"frameborder="0"></iframe></a>              
              
              </div> <!-- Fim da div "alinhar-iframe" -->              
              
              </td>
            </tr>
            <tr>
              <td colspan="2" class="KT_th">&nbsp;</td>
              </tr>
            <tr>
              <td class="KT_th"><label for="status_<?php echo $cnt1; ?>">Status:</label></td>
              <td><select name="status_<?php echo $cnt1; ?>" id="status_<?php echo $cnt1; ?>">
                  <option value="Desativado" <?php if (!(strcmp("Desativado", KT_escapeAttribute($row_rsconteudo_filmes['status'])))) {echo "selected=\"selected\"";} ?>>Desativar</option>
                  <option value="Ativado" <?php if (!(strcmp("Ativado", KT_escapeAttribute($row_rsconteudo_filmes['status'])))) {echo "selected=\"selected\"";} ?>>Ativar</option>
                </select>
                  <?php echo $tNGs->displayFieldError("conteudo_filmes", "status", $cnt1); ?> </td>
            </tr>
              <tr>
                <td colspan="2" class="KT_th">&nbsp;</td>
              </tr>
              <tr>
              <td colspan="2" class="KT_th">
              
              <div id="alinhar-botao">
              
              <input name="botao-visualizar-postagem" id="botao-visualizar-postagem"  type="button" onclick="window.open('../../../../index.php?pag=visualizar_filmes&amp;id=<?php echo $row_rsconteudo_filmes['id']; ?>')" title="Clique aqui, para visualizar a postagem" value="Visualizar postagem: <?php echo KT_escapeAttribute($row_rsconteudo_filmes['titulo']); ?>">
              </div> <!-- Fim da div "alinhar-botao" -->              </td>
              </tr>
          </table>
          <input type="hidden" name="kt_pk_conteudo_filmes_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsconteudo_filmes['kt_pk_conteudo_filmes']); ?>" />
          <?php } while ($row_rsconteudo_filmes = mysql_fetch_assoc($rsconteudo_filmes)); ?>
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
