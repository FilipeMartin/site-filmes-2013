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
$restrict->addLevel("GM");
$restrict->addLevel("ADMIN");
$restrict->Execute();
//End Restrict Access To Page

//start Trigger_CheckPasswords trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckPasswords(&$tNG) {
  $myThrowError = new tNG_ThrowError($tNG);
  $myThrowError->setErrorMsg("Could not create account.");
  $myThrowError->setField("senha");
  $myThrowError->setFieldErrorMsg("As senhas não são iguais.");
  return $myThrowError->Execute();
}
//end Trigger_CheckPasswords trigger

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

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("nome", true, "text", "", "2", "", "");
$formValidation->addField("usuario", true, "text", "", "2", "28", "");
$formValidation->addField("email", true, "text", "email", "", "", "");
$formValidation->addField("senha", true, "text", "", "6", "20", "");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_CheckOldPassword trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckOldPassword(&$tNG) {
  return Trigger_UpdatePassword_CheckOldPassword($tNG);
}
//end Trigger_CheckOldPassword trigger

$colname_Rs_Alterar_Dados = "-1";
if (isset($_SESSION['kt_login_id'])) {
  $colname_Rs_Alterar_Dados = $_SESSION['kt_login_id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Rs_Alterar_Dados = sprintf("SELECT * FROM sistema_login WHERE id = %s", GetSQLValueString($colname_Rs_Alterar_Dados, "int"));
$Rs_Alterar_Dados = mysql_query($query_Rs_Alterar_Dados, $Mundo_Download) or die(mysql_error());
$row_Rs_Alterar_Dados = mysql_fetch_assoc($Rs_Alterar_Dados);
$totalRows_Rs_Alterar_Dados = mysql_num_rows($Rs_Alterar_Dados);

// Make an update transaction instance
$upd_sistema_login = new tNG_update($conn_Mundo_Download);
$tNGs->addTransaction($upd_sistema_login);
// Register triggers
$upd_sistema_login->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_sistema_login->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_sistema_login->registerTrigger("END", "Trigger_Default_Redirect", 99, "index_admin.php?pag=alterar_dados_usuario_sucesso");
$upd_sistema_login->registerConditionalTrigger("{POST.senha} != {POST.re_senha}", "BEFORE", "Trigger_CheckPasswords", 50);
$upd_sistema_login->registerTrigger("BEFORE", "Trigger_CheckOldPassword", 60);
// Add columns
$upd_sistema_login->setTable("sistema_login");
$upd_sistema_login->addColumn("nome", "STRING_TYPE", "POST", "nome");
$upd_sistema_login->addColumn("usuario", "STRING_TYPE", "POST", "usuario");
$upd_sistema_login->addColumn("email", "STRING_TYPE", "POST", "email");
$upd_sistema_login->addColumn("senha", "STRING_TYPE", "POST", "senha");
$upd_sistema_login->setPrimaryKey("id", "NUMERIC_TYPE", "GET", "id");

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

<link href="../../admin/estrutura_css/sistema_login/alterar_dados_usuario.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

<link href="../../../includes/skins/mxkollection_editar.css" rel="stylesheet" type="text/css" media="all" />
<script src="../../../includes/common/js/base.js" type="text/javascript"></script>
<script src="../../../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../../../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>

</head>

<body>

<div id="geral">

<div id="pg">

<div id="conteudo-alterar-dados">

<div id="titulo-alterar-dados">

      <span class="texto-titulo-alterar-dados">Alterar Dados do Usuário - <?php echo $row_Rs_Alterar_Dados['usuario']; ?></span>

</div> <!-- Fim da div "titulo-alterar-dados" -->
  
<div id="formulario-alterar-dados"> 
   
  <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
    <table width="396" border="0" cellpadding="0" cellspacing="0" class="KT_tngtable">
      <tr>
        
        <td width="279"><input type="text" name="nome" id="nome" value="<?php echo KT_escapeAttribute($row_rssistema_login['nome']); ?>" size="50" />
        <br />
            <?php echo $tNGs->displayFieldHint("nome");?> <?php echo $tNGs->displayFieldError("sistema_login", "nome"); ?> </td>
            
            <td width="117" height="40" class="KT_th"><div id="espaco"><label for="nome">Nome</label></div></td>
      </tr>
      <tr>
        
        <td><input type="text" name="usuario" id="usuario" value="<?php echo KT_escapeAttribute($row_rssistema_login['usuario']); ?>" size="28" />
        <br />
            <?php echo $tNGs->displayFieldHint("usuario");?> <?php echo $tNGs->displayFieldError("sistema_login", "usuario"); ?> </td>
            
            <td height="40" class="KT_th"><div id="espaco"><label for="usuario">Usuário</label></div></td>
      </tr>
      <tr>
       
        <td><input type="text" name="email" id="email" value="<?php echo KT_escapeAttribute($row_rssistema_login['email']); ?>" size="50" />
        <br />
            <?php echo $tNGs->displayFieldError("sistema_login", "email"); ?> </td>
            
             <td height="40" class="KT_th"><div id="espaco"><label for="email">Email</label></div></td>
      </tr>
      <tr>
        
        <td><input type="password" name="old_senha" id="old_senha" value="" size="50" />
        <br />
            <?php echo $tNGs->displayFieldError("sistema_login", "old_senha"); ?> </td>
            
            <td height="40" class="KT_th"><div id="espaco"><label for="old_senha">Senha Antiga</label> <span class="simbolo_obrigatorio">*</span></div></td>
      </tr>
      <tr>
       
        <td><input type="password" name="senha" id="senha" value="" size="50" />
        <br />
            <?php echo $tNGs->displayFieldHint("senha");?> <?php echo $tNGs->displayFieldError("sistema_login", "senha"); ?> </td>
            
             <td height="40" class="KT_th"><div id="espaco"><label for="senha">Senha</label></div></td>
      </tr>
      <tr>
        
        <td><input type="password" name="re_senha" id="re_senha" value="" size="50" />        </td>
        <td height="40" class="KT_th"><div id="espaco"><label for="re_senha">Redigitar a senha</label>  <span class="simbolo_obrigatorio">*</span></div></td>
      </tr>
    </table>
    <p>
    <input type="submit" name="KT_Update1" id="KT_Update1" title="Alterar Dados" value="Alterar »" />
    </p>
    
<div class="clear"></div> 
   
  </form>
  
</div> <!-- Fim da div "formulario-alterar-dados" --> 
<div class="clear"></div>

</div> <!-- Fim da div "conteudo-alterar-dados" -->

</div> <!-- Fim da div "pg" -->

</div> <!-- Fim da div "geral" -->

</body>
</html>
<?php
mysql_free_result($Rs_Alterar_Dados);
?>
