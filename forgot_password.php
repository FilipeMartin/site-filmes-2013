<?php require_once('Connections/Mundo_Download.php'); ?>
<?php
// Load the common classes
require_once('includes/common/KT_common.php');
?>
<?php
// Load the tNG classes
require_once('includes/tng/tNG.inc.php');
?>

<?php
error_reporting(0);
?>

<?php
// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("");
?>
<?php
// Make unified connection variable
$conn_Mundo_Download = new KT_connection($Mundo_Download, $database_Mundo_Download);
?>

<?php
// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("email", true, "text", "email", "", "", "");
$tNGs->prepareValidation($formValidation);
// End trigger
?>
<?php
//start Trigger_ForgotPasswordCheckEmail trigger
//remove this line if you want to edit the code by hand
function Trigger_ForgotPasswordCheckEmail(&$tNG) {
  return Trigger_ForgotPassword_CheckEmail($tNG);
}
//end Trigger_ForgotPasswordCheckEmail trigger
?>
<?php
//start Trigger_ForgotPassword_Email trigger
//remove this line if you want to edit the code by hand
function Trigger_ForgotPassword_Email(&$tNG) {
  $emailObj = new tNG_Email($tNG);
  $emailObj->setFrom("{KT_defaultSender}");
  $emailObj->setTo("{email}");
  $emailObj->setCC("");
  $emailObj->setBCC("");
  $emailObj->setSubject("Esqueceu sua senha ?");
  //FromFile method
  $emailObj->setContentFile("includes/mailtemplates/forgot.html");
  $emailObj->setEncoding("ISO-8859-1");
  $emailObj->setFormat("HTML/Text");
  $emailObj->setImportance("Normal");
  return $emailObj->Execute();
}
//end Trigger_ForgotPassword_Email trigger
?>
<?php
// Make an update transaction instance
$forgotpass_transaction = new tNG_update($conn_Mundo_Download);
$tNGs->addTransaction($forgotpass_transaction);
// Register triggers
$forgotpass_transaction->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$forgotpass_transaction->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$forgotpass_transaction->registerTrigger("BEFORE", "Trigger_ForgotPasswordCheckEmail", 20);
$forgotpass_transaction->registerTrigger("AFTER", "Trigger_ForgotPassword_Email", 1);
$forgotpass_transaction->registerTrigger("END", "Trigger_Default_Redirect", 99, "{kt_login_redirect}");
// Add columns
$forgotpass_transaction->setTable("sistema_login");
$forgotpass_transaction->addColumn("email", "STRING_TYPE", "POST", "email");
$forgotpass_transaction->setPrimaryKey("email", "STRING_TYPE", "POST", "email");
?>
<?php
// Execute all the registered transactions
$tNGs->executeTransactions();
?>
<?php
// Get the transaction recordset
$rssistema_login = $tNGs->getRecordset("sistema_login");
$row_rssistema_login = mysql_fetch_assoc($rssistema_login);
$totalRows_rssistema_login = mysql_num_rows($rssistema_login);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Admin</title>
<link rel="shortcut icon" type="image/x-icon" href="http://www.mundodownload.net/paginas/estrutura_img/Fivicon/favicon.ico" />

<link href="login/admin/estrutura_css/login/forgot_password.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

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

<div id="titulo-recuperar-senha">

      <span class="texto-titulo-recuperar-senha">Mundo Download - Esqueceu sua senha ? </span>

</div> <!-- Fim da div "titulo-recuperar-senha" -->

	<form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">

<div class="KT_tngtable">

<div id="area-email">

      <span class="texto-email"><label for="email">Email do usuário</label></span>
      <br />
      
      <input type="text" name="email" id="email" value="<?php echo KT_escapeAttribute($row_rssistema_login['email']); ?>" size="50" />
	  <?php echo $tNGs->displayFieldError("sistema_login", "email"); ?>

</div> <!-- Fim da div "area-email" -->

<div id="texto-principal">

     <ul>    
      <span class="texto-principal">
      
      <li>Digite seu endereço de email.</li>
      <br/>
      <li>Você receberá um email com a sua senha.</li>
      
      </span>      
     </ul> 
      
</div> <!-- Fim da div "texto-principal" -->

</div> <!-- Fim da div "KT_tngtable" -->

      <input type="submit" name="KT_Update1" id="KT_Update1" title="Enviar para o Email" value="Enviar" />
       
   </form> 
      
<div class="clear"></div> 
</div> <!-- Fim da div "conteudo" -->

<div id="voltar-login">

      <a href="login.php" class="texto-voltar-login" title="Efetuar Login">Efetuar Login</a>

</div> <!-- Fim da div "voltar-login" -->

<div id="voltar-site">

      <a href="http://www.mundodownload.net/" class="texto-voltar-site" title="Você está perdido?">&larr; Voltar para o site - Mundo Download</a>

</div> <!-- Fim da div "voltar-site" -->

</div> <!-- Fim da div "pg" -->
<div class="clear"></div>

</div> <!-- Fim da div "geral" -->

</body>
</html>
