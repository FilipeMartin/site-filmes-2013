<?php require_once('Connections/Mundo_Download.php'); ?>
<?php
// Load the common classes
require_once('includes/common/KT_common.php');

// Load the tNG classes
require_once('includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("");

// Make unified connection variable
$conn_Mundo_Download = new KT_connection($Mundo_Download, $database_Mundo_Download);

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("kt_login_user", true, "text", "", "", "", "");
$formValidation->addField("kt_login_password", true, "text", "", "", "", "");
$tNGs->prepareValidation($formValidation);
// End trigger

// Make a login transaction instance
$loginTransaction = new tNG_login($conn_Mundo_Download);
$tNGs->addTransaction($loginTransaction);
// Register triggers
$loginTransaction->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "kt_login1");
$loginTransaction->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$loginTransaction->registerTrigger("END", "Trigger_Default_Redirect", 99, "{kt_login_redirect}");
// Add columns
$loginTransaction->addColumn("kt_login_user", "STRING_TYPE", "POST", "kt_login_user");
$loginTransaction->addColumn("kt_login_password", "STRING_TYPE", "POST", "kt_login_password");
$loginTransaction->addColumn("kt_login_rememberme", "CHECKBOX_1_0_TYPE", "POST", "kt_login_rememberme", "0");
// End of login transaction instance

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscustom = $tNGs->getRecordset("custom");
$row_rscustom = mysql_fetch_assoc($rscustom);
$totalRows_rscustom = mysql_num_rows($rscustom);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Admin</title>
<link rel="shortcut icon" type="image/x-icon" href="http://www.mundodownload.net/paginas/estrutura_img/Fivicon/favicon.ico" />

<link href="login/admin/estrutura_css/login/login.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

<link href="includes/skins/mxkollection_editar.css" rel="stylesheet" type="text/css" media="all" />
<script src="includes/common/js/base.js" type="text/javascript"></script>
<script src="includes/common/js/utility.js" type="text/javascript"></script>
<script src="includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>

</head>

<body>

<div id="geral">

<div id="pg">

<div id="conteudo">

<div id="titulo-login">

      <span class="texto-titulo-login">Login - Mundo Download</span>

</div> <!-- Fim da div "titulo-login" -->
 
  <form method="post" id="form1" class="KT_tngformerror" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">

<div class="KT_tngtable">

<div id="usuario">

      <span class="texto-usuario"><label for="kt_login_user">Nome de usuário</label></span>
      <br />
      
     <input type="text" name="kt_login_user" id="kt_login_user" value="<?php echo KT_escapeAttribute($row_rscustom['kt_login_user']); ?>" size="50" />
     <?php echo $tNGs->displayFieldHint("kt_login_user");?> <?php echo $tNGs->displayFieldError("custom", "kt_login_user"); ?>

</div> <!-- Fim da div "usuario" -->

<div id="senha">

      <span class="texto-senha"><label for="kt_login_password">Senha</label></span>
      <br />
      
      <input type="password" name="kt_login_password" id="kt_login_password" value="" size="50" />
      <?php echo $tNGs->displayFieldHint("kt_login_password");?> <?php echo $tNGs->displayFieldError("custom", "kt_login_password"); ?>

</div> <!-- Fim da div "senha" -->

<div id="lembrar">

      <input  <?php if (!(strcmp(KT_escapeAttribute($row_rscustom['kt_login_rememberme']),"1"))) {echo "checked";} ?> 
      type="checkbox" name="kt_login_rememberme" id="kt_login_rememberme" value="1" />
      <?php echo $tNGs->displayFieldError("custom", "kt_login_rememberme"); ?>
            
      <span class="texto-lembrar"><label for="kt_login_rememberme">Lembrar</label></span>

</div> <!-- Fim da div "lembrar" -->

</div> <!-- Fim da div "KT_tngtable" -->

      <input type="submit" name="kt_login1" id="kt_login1" title="Entrar no sistema" value="Entrar" />

  </form>
  
<div class="clear"></div> 
</div> <!-- Fim da div "conteudo" -->

<div id="esquecer-senha">

      <a href="forgot_password.php" class="texto-esquecer-senha" title="Recuperar senha">Esqueceu sua senha?</a>

</div> <!-- Fim da div "esquecer-senha" -->

<div id="voltar-site">

      <a href="http://www.mundodownload.net/" class="texto-voltar-site" title="Você está perdido?">&larr; Voltar para o site - Mundo Download</a>

</div> <!-- Fim da div "voltar-site" -->

</div> <!-- Fim da div "pg" -->
<div class="clear"></div>

</div> <!-- Fim da div "geral" -->

</body>
</html>
