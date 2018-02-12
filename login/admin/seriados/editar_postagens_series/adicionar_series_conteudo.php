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
  $deleteObj->setFolder("../../../../conteudo/seriados/img/");
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
  $uploadObj->setFolder("../../../../conteudo/seriados/img/");
  $uploadObj->setResize("false", 220, 310);
  $uploadObj->setMaxSize(1500);
  $uploadObj->setAllowedExtensions("gif, jpg, jpe, jpeg, png");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

// Make an insert transaction instance
$ins_conteudo_seriados = new tNG_multipleInsert($conn_Mundo_Download);
$tNGs->addTransaction($ins_conteudo_seriados);
// Register triggers
$ins_conteudo_seriados->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_conteudo_seriados->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_conteudo_seriados->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../../../includes/nxt/back.php");
$ins_conteudo_seriados->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$ins_conteudo_seriados->setTable("conteudo_seriados");
$ins_conteudo_seriados->addColumn("imagem", "FILE_TYPE", "FILES", "imagem");
$ins_conteudo_seriados->addColumn("titulo", "STRING_TYPE", "POST", "titulo");
$ins_conteudo_seriados->addColumn("data_da_postagem", "STRING_TYPE", "POST", "data_da_postagem");
$ins_conteudo_seriados->addColumn("sinopse", "STRING_TYPE", "POST", "sinopse");
$ins_conteudo_seriados->addColumn("trailer", "STRING_TYPE", "POST", "trailer");
$ins_conteudo_seriados->addColumn("dados_do_seriado", "STRING_TYPE", "POST", "dados_do_seriado");
$ins_conteudo_seriados->addColumn("temporadas", "STRING_TYPE", "POST", "temporadas");
$ins_conteudo_seriados->addColumn("status", "STRING_TYPE", "POST", "status");
$ins_conteudo_seriados->setPrimaryKey("id", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_conteudo_seriados = new tNG_multipleUpdate($conn_Mundo_Download);
$tNGs->addTransaction($upd_conteudo_seriados);
// Register triggers
$upd_conteudo_seriados->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_conteudo_seriados->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_conteudo_seriados->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../../../includes/nxt/back.php");
$upd_conteudo_seriados->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$upd_conteudo_seriados->setTable("conteudo_seriados");
$upd_conteudo_seriados->addColumn("imagem", "FILE_TYPE", "FILES", "imagem");
$upd_conteudo_seriados->addColumn("titulo", "STRING_TYPE", "POST", "titulo");
$upd_conteudo_seriados->addColumn("data_da_postagem", "STRING_TYPE", "POST", "data_da_postagem");
$upd_conteudo_seriados->addColumn("sinopse", "STRING_TYPE", "POST", "sinopse");
$upd_conteudo_seriados->addColumn("trailer", "STRING_TYPE", "POST", "trailer");
$upd_conteudo_seriados->addColumn("dados_do_seriado", "STRING_TYPE", "POST", "dados_do_seriado");
$upd_conteudo_seriados->addColumn("temporadas", "STRING_TYPE", "POST", "temporadas");
$upd_conteudo_seriados->addColumn("status", "STRING_TYPE", "POST", "status");
$upd_conteudo_seriados->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");

// Make an instance of the transaction object
$del_conteudo_seriados = new tNG_multipleDelete($conn_Mundo_Download);
$tNGs->addTransaction($del_conteudo_seriados);
// Register triggers
$del_conteudo_seriados->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_conteudo_seriados->registerTrigger("END", "Trigger_Default_Redirect", 99, "../../../../includes/nxt/back.php");
$del_conteudo_seriados->registerTrigger("AFTER", "Trigger_FileDelete", 98);
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

<link href="../../estrutura_css/seriados/adicionar_series_conteudo.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

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
      Conteúdo - Séries </h1>
    <div class="KT_tngform">
      <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
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
              <td colspan="2" class="KT_th">
              
              <div id="alinhar-botao-visualizar">
              
              <input name="botao-visualizar-postagem" id="botao-visualizar-postagem"  type="button" onclick="window.open('../../../../index.php?pag=visualizar_series&amp;id=<?php echo $row_rsconteudo_seriados['id']; ?>')" title="Clique aqui, para visualizar a postagem" value="Visualizar postagem: <?php echo KT_escapeAttribute($row_rsconteudo_seriados['titulo']); ?>">
              </div> <!-- Fim da div "alinhar-botao-visualizar" -->              </td>
              </tr>

            <tr>
              <td colspan="2" class="KT_th">&nbsp;</td>
              </tr>
            <tr>
              <td class="KT_th"><label for="imagem_<?php echo $cnt1; ?>">Imagem:</label></td>
              <td><input type="file" name="imagem_<?php echo $cnt1; ?>" id="imagem_<?php echo $cnt1; ?>" size="50" />
                  <?php echo $tNGs->displayFieldError("conteudo_seriados", "imagem", $cnt1); ?> </td>
            </tr>
            <tr>
              <td class="KT_th"><label for="titulo_<?php echo $cnt1; ?>">Título:</label></td>
              <td><input type="text" name="titulo_<?php echo $cnt1; ?>" id="titulo_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsconteudo_seriados['titulo']); ?>" size="50" maxlength="50" />
                  <?php echo $tNGs->displayFieldHint("titulo");?> <?php echo $tNGs->displayFieldError("conteudo_seriados", "titulo", $cnt1); ?> </td>
            </tr>
            <tr>
              <td class="KT_th"><label for="data_da_postagem_<?php echo $cnt1; ?>">Data da Postagem:</label></td>
              <td><input type="text" name="data_da_postagem_<?php echo $cnt1; ?>" id="data_da_postagem_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsconteudo_seriados['data_da_postagem']); ?>" size="50" maxlength="50" />
                  <?php echo $tNGs->displayFieldHint("data_da_postagem");?> <?php echo $tNGs->displayFieldError("conteudo_seriados", "data_da_postagem", $cnt1); ?> </td>
            </tr>
            <tr>
              <td colspan="2" class="KT_th">&nbsp;</td>
              </tr>
            <tr>
              <td class="KT_th"><label for="sinopse_<?php echo $cnt1; ?>">Sinopse:</label></td>
              <td><textarea name="sinopse_<?php echo $cnt1; ?>" id="sinopse_<?php echo $cnt1; ?>" cols="100" rows="12"><?php echo KT_escapeAttribute($row_rsconteudo_seriados['sinopse']); ?></textarea>
                  <?php echo $tNGs->displayFieldHint("sinopse");?> <?php echo $tNGs->displayFieldError("conteudo_seriados", "sinopse", $cnt1); ?> </td>
            </tr>
            <tr>
              <td colspan="2" class="KT_th">&nbsp;</td>
              </tr>
            <tr>
              <td class="KT_th"><label for="trailer_<?php echo $cnt1; ?>">Trailer:</label></td>
              <td><textarea name="trailer_<?php echo $cnt1; ?>" id="trailer_<?php echo $cnt1; ?>" cols="80" rows="5"><?php echo KT_escapeAttribute($row_rsconteudo_seriados['trailer']); ?></textarea>
                  <?php echo $tNGs->displayFieldHint("trailer");?> <?php echo $tNGs->displayFieldError("conteudo_seriados", "trailer", $cnt1); ?> </td>
            </tr>
            <tr>
              <td colspan="2" class="KT_th">&nbsp;</td>
            </tr>
            <tr>
              <td class="KT_th">D - S - CSS:</td>
              <td class="KT_th">
              <input name="Complemento - RMVB2" type="text" id="Complemento - RMVB2" value="&lt;span class=&quot;t-1-d-s&quot;&gt;Título: &lt;/span&gt;Título Original&lt;br /&gt;" size="60" />              </td>
            </tr>

            <tr>
              <td class="KT_th"><label for="dados_do_seriado_<?php echo $cnt1; ?>">Dados da Série:</label></td>
              <td><textarea name="dados_do_seriado_<?php echo $cnt1; ?>" id="dados_do_seriado_<?php echo $cnt1; ?>" cols="100" rows="12"><?php echo KT_escapeAttribute($row_rsconteudo_seriados['dados_do_seriado']); ?></textarea>
                  <?php echo $tNGs->displayFieldHint("dados_do_seriado");?> <?php echo $tNGs->displayFieldError("conteudo_seriados", "dados_do_seriado", $cnt1); ?> </td>
            </tr>
            <tr>
              <td colspan="2" class="KT_th">&nbsp;</td>
              </tr>
            <tr>
              <td class="KT_th">Temporadas:</td>
              <td class="KT_th" align="center" valign="middle">
              
              <div id="alinhar-botao">

              <input name="botao-adicionar" id="botao-adicionar" type="button" onclick="temporadas.location.href='admin/seriados/editar_postagens_series/temporadas/temporadas.php?id=<?php echo $row_rsconteudo_seriados['id']; ?>'" title="Clique aqui, para adicionar" value="Adicionar">
           
              <input name="botao-voltar" id="botao-voltar" type="button" onclick="temporadas.location.href='admin/seriados/editar_postagens_series/temporadas/temporadas.php'" title="Clique aqui, para voltar" value="Voltar">
              </div> <!-- Fim da div "alinhar-botao" -->
 
              <a href="temporadas/temporadas.php?id=<?php echo $row_rsconteudo_seriados['id']; ?>">
              <iframe id="temporadas" name="temporadas" src="temporadas/temporadas.php" width="575" scrolling="no" onload='iframeAutoHeight(this)'border="0"frameborder="0"></iframe>
              </a>              </td>
            </tr>
            <tr>
              <td class="KT_th"><label for="temporadas_<?php echo $cnt1; ?>">Editar Temporadas:</label></td>
              <td><textarea name="temporadas_<?php echo $cnt1; ?>" id="temporadas_<?php echo $cnt1; ?>" cols="100" rows="20"><?php echo KT_escapeAttribute($row_rsconteudo_seriados['temporadas']); ?></textarea>
                  <?php echo $tNGs->displayFieldHint("temporadas");?> <?php echo $tNGs->displayFieldError("conteudo_seriados", "temporadas", $cnt1); ?> </td>
            </tr>
            <tr>
              <td colspan="2" class="KT_th">&nbsp;</td>
            </tr>
            <tr>
              <td class="KT_th">Comentários:</td>
              <td class="KT_th" align="center" valign="middle">
              
              <div id="alinhar-botao">  
                          
              <input name="botao-visualizar-comentarios" id="botao-visualizar-comentarios" type="button" onclick="visualizar_comentarios.location.href='admin/seriados/editar_postagens_series/visualizar_comentarios/visualizar_comentarios.php?id=<?php echo $row_rsconteudo_seriados['id']; ?>'" title="Clique aqui, para visualizar" value="Visualizar - Comentários">
           
              <input name="botao-voltar-comentarios" id="botao-voltar-comentarios" type="button" onclick="visualizar_comentarios.location.href='admin/seriados/editar_postagens_series/visualizar_comentarios/voltar_comentarios.php'" title="Clique aqui, para voltar" value="Voltar - Comentários">
              
              </div> <!-- Fim da div "alinhar-botao" -->
              
              <div id="alinhar-iframe">
              
              <p></p>             
              <a href="visualizar_comentarios/visualizar_comentarios.php?id=<?php echo $row_rsconteudo_seriados['id']; ?>">
              <iframe id="visualizar_comentarios" name="visualizar_comentarios" src="visualizar_comentarios/voltar_comentarios.php" width="550" scrolling="no" onload='iframeAutoHeight(this)'border="0"frameborder="0"></iframe></a>              
              
              </div> <!-- Fim da div "alinhar-iframe" -->              
              
              </td>
            </tr>
            <tr>
              <td colspan="2" class="KT_th">&nbsp;</td>
              </tr>
            <tr>
              <td class="KT_th"><label for="status_<?php echo $cnt1; ?>">Status:</label></td>
              <td><select name="status_<?php echo $cnt1; ?>" id="status_<?php echo $cnt1; ?>">
                  <option value="Desativado" <?php if (!(strcmp("Desativado", KT_escapeAttribute($row_rsconteudo_seriados['status'])))) {echo "selected=\"selected\"";} ?>>Desativar</option>
                  <option value="Ativado" <?php if (!(strcmp("Ativado", KT_escapeAttribute($row_rsconteudo_seriados['status'])))) {echo "selected=\"selected\"";} ?>>Ativar</option>
                </select>
                  <?php echo $tNGs->displayFieldError("conteudo_seriados", "status", $cnt1); ?> </td>
            </tr>
              <tr>
                <td colspan="2" class="KT_th">&nbsp;</td>
              </tr>
              <tr>
              <td colspan="2" class="KT_th">
              
              <div id="alinhar-botao-visualizar">
              
              <input name="botao-visualizar-postagem" id="botao-visualizar-postagem"  type="button" onclick="window.open('../../../../index.php?pag=visualizar_series&amp;id=<?php echo $row_rsconteudo_seriados['id']; ?>')" title="Clique aqui, para visualizar a postagem" value="Visualizar postagem: <?php echo KT_escapeAttribute($row_rsconteudo_seriados['titulo']); ?>">
              </div> <!-- Fim da div "alinhar-botao-visualizar" -->              </td>
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
