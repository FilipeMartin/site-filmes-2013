<?php require_once('../../../Connections/Mundo_Download.php'); ?>
<?php
// Load the common classes
require_once('../../../includes/common/KT_common.php');

// Load the tNG classes
require_once('../../../includes/tng/tNG.inc.php');

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
  $myThrowError->setErrorMsg("Passwords do not match.");
  $myThrowError->setField("senha");
  $myThrowError->setFieldErrorMsg("As senhas não são iguais.");
  return $myThrowError->Execute();
}
//end Trigger_CheckPasswords trigger

//start Trigger_WelcomeEmail trigger
//remove this line if you want to edit the code by hand
function Trigger_WelcomeEmail(&$tNG) {
  $emailObj = new tNG_Email($tNG);
  $emailObj->setFrom("{KT_defaultSender}");
  $emailObj->setTo("{email}");
  $emailObj->setCC("");
  $emailObj->setBCC("");
  $emailObj->setSubject("Bem-vindo");
  //FromFile method
  $emailObj->setContentFile("../../../includes/mailtemplates/welcome.html");
  $emailObj->setEncoding("ISO-8859-1");
  $emailObj->setFormat("HTML/Text");
  $emailObj->setImportance("Normal");
  return $emailObj->Execute();
}
//end Trigger_WelcomeEmail trigger

//start Trigger_ActivationEmail trigger
//remove this line if you want to edit the code by hand
function Trigger_ActivationEmail(&$tNG) {
  $emailObj = new tNG_Email($tNG);
  $emailObj->setFrom("{KT_defaultSender}");
  $emailObj->setTo("{email}");
  $emailObj->setCC("");
  $emailObj->setBCC("");
  $emailObj->setSubject("Ativar Conta");
  //FromFile method
  $emailObj->setContentFile("../../../includes/mailtemplates/activate.html");
  $emailObj->setEncoding("ISO-8859-1");
  $emailObj->setFormat("HTML/Text");
  $emailObj->setImportance("Normal");
  return $emailObj->Execute();
}
//end Trigger_ActivationEmail trigger

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("nome", true, "text", "", "2", "", "");
$formValidation->addField("usuario", true, "text", "", "2", "28", "");
$formValidation->addField("email", true, "text", "email", "", "", "");
$formValidation->addField("senha", true, "text", "", "6", "20", "");
$formValidation->addField("data", true, "text", "", "", "", "");
$tNGs->prepareValidation($formValidation);
// End trigger

// Make an insert transaction instance
$userRegistration = new tNG_insert($conn_Mundo_Download);
$tNGs->addTransaction($userRegistration);
// Register triggers
$userRegistration->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$userRegistration->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$userRegistration->registerTrigger("END", "Trigger_Default_Redirect", 99, "index_admin.php?pag=painel_usuarios");
$userRegistration->registerConditionalTrigger("{POST.senha} != {POST.re_senha}", "BEFORE", "Trigger_CheckPasswords", 50);
$userRegistration->registerTrigger("AFTER", "Trigger_WelcomeEmail", 40);
$userRegistration->registerTrigger("AFTER", "Trigger_ActivationEmail", 40);
// Add columns
$userRegistration->setTable("sistema_login");
$userRegistration->addColumn("nome", "STRING_TYPE", "POST", "nome");
$userRegistration->addColumn("usuario", "STRING_TYPE", "POST", "usuario");
$userRegistration->addColumn("email", "STRING_TYPE", "POST", "email");
$userRegistration->addColumn("senha", "STRING_TYPE", "POST", "senha");
$userRegistration->addColumn("status", "STRING_TYPE", "POST", "status");
$userRegistration->addColumn("data", "STRING_TYPE", "POST", "data");
$userRegistration->setPrimaryKey("id", "NUMERIC_TYPE");

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

<link href="../../admin/estrutura_css/sistema_login/cadastro_usuarios.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

<link href="../../../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../../../includes/common/js/base.js" type="text/javascript"></script>
<script src="../../../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../../../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>

</head>

<body>

<div id="geral">

<div id="titulo">

      <span class="texto-titulo">Cadastro de Usuários</span>

</div> <!-- Fim da div "titulo" -->

<div id="conteudo">

  <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
    <table width="450" cellpadding="2" cellspacing="0" class="KT_tngtable">
      <tr>
        <td height="28" class="KT_th"><label for="nome">Nome:</label></td>
        <td><input type="text" name="nome" id="nome" value="<?php echo KT_escapeAttribute($row_rssistema_login['nome']); ?>" size="50" />
            <?php echo $tNGs->displayFieldHint("nome");?> <?php echo $tNGs->displayFieldError("sistema_login", "nome"); ?> </td>
      </tr>
      <tr>
        <td height="28" class="KT_th"><label for="usuario">Usuário:</label></td>
        <td><input type="text" name="usuario" id="usuario" value="<?php echo KT_escapeAttribute($row_rssistema_login['usuario']); ?>" size="50" />
            <?php echo $tNGs->displayFieldHint("usuario");?> <?php echo $tNGs->displayFieldError("sistema_login", "usuario"); ?> </td>
      </tr>
      <tr>
        <td height="28" class="KT_th"><label for="email">Email:</label></td>
        <td><input type="text" name="email" id="email" value="<?php echo KT_escapeAttribute($row_rssistema_login['email']); ?>" size="50" />
            <?php echo $tNGs->displayFieldError("sistema_login", "email"); ?> </td>
      </tr>
      <tr>
        <td height="28" class="KT_th"><label for="senha">Senha:</label></td>
        <td><input type="password" name="senha" id="senha" value="" size="50" />
            <?php echo $tNGs->displayFieldHint("senha");?> <?php echo $tNGs->displayFieldError("sistema_login", "senha"); ?> </td>
      </tr>
      <tr>
        <td height="28" class="KT_th"><label for="re_senha">Redigitar a senha:</label></td>
        <td><input type="password" name="re_senha" id="re_senha" value="" size="50" />
        </td>
      </tr>
      <tr>
        <td height="28" class="KT_th"><label for="status">Status:</label></td>
        <td><select name="status" id="status">
            <option value="Desativado" <?php if (!(strcmp("Desativado", KT_escapeAttribute($row_rssistema_login['status'])))) {echo "SELECTED";} ?>>Desativado</option>
            <option value="GM" <?php if (!(strcmp("GM", KT_escapeAttribute($row_rssistema_login['status'])))) {echo "SELECTED";} ?>>GM</option>
            <option value="ADMIN" <?php if (!(strcmp("ADMIN", KT_escapeAttribute($row_rssistema_login['status'])))) {echo "SELECTED";} ?>>ADMIN</option>
          </select>
            <?php echo $tNGs->displayFieldError("sistema_login", "status"); ?> </td>
      </tr>
      <tr class="KT_buttons">
        <td colspan="2"><input type="submit" name="KT_Insert1" id="KT_Insert1" value="Cadastrar" />
        </td>
      </tr>
    </table>
    <input type="hidden" name="data" id="data" value="<?php echo date('d/m/Y',time()-0);?> às <?php echo date('H:i',time()-0);?>" />
  </form>

</div> <!-- Fim da div "conteudo" -->

</div> <!-- Fim da div "geral" -->

</body>
</html>
