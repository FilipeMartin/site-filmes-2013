<?php require_once('../../../Connections/Mundo_Download.php'); ?>
<?php
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

$colname_Rs = "-1";
if (isset($_GET['id'])) {
  $colname_Rs = $_GET['id'];
}
mysql_select_db($database_Mundo_Download, $Mundo_Download);
$query_Rs = sprintf("SELECT * FROM conteudo_seriados WHERE id = %s AND conteudo_seriados.status = 'Ativado'", GetSQLValueString($colname_Rs, "int"));
$Rs = mysql_query($query_Rs, $Mundo_Download) or die(mysql_error());
$row_Rs = mysql_fetch_assoc($Rs);
$totalRows_Rs = mysql_num_rows($Rs);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Mundo Download - Mensagem enviada com sucesso</title>
<link rel="shortcut icon" type="image/x-icon" href="http://www.mundodownload.net/paginas/estrutura_img/Fivicon/favicon.ico" />

<link href="../../estrutura_css/ms_sucesso_series_problemas.css" rel="stylesheet" type="text/css" />  <!-- Estrutura CSS -->

</head>

<body>

<div id="geral">
    
<div id="topo">
      
     <span class="texto-topo">www.MUNDODOWNLOAD.net</span><br />
     <span class="texto2-topo">Sua mensagem foi enviada com sucesso.</span>    

</div> <!-- Fim da div "topo -->
 
<?php if ($totalRows_Rs > 0) { // Show if recordset not empt ?>    
<div id="pg">
      
<div id="conteudo">
        
<div id="img">

     <a href="../../../index.php?pag=series&amp;id=<?php echo $row_Rs['id']; ?>" class="titulo"><?php echo $row_Rs['titulo']; ?></a>

<p align="center"><a href="../../../index.php?pag=series&amp;id=<?php echo $row_Rs['id']; ?>" class="link-0-borda"><img src="../../../conteudo/seriados/img/<?php echo $row_Rs['imagem']; ?>" width="100" height="135" border="0" /></a></p>
          
<div id="dados-da-serie">
            
<div id="texto-dados-da-serie">
              
     <span class="texto-dados-da-serie">Dados da Série:</span>            

</div> <!-- Fim da div "texto-dados-da-serie" -->
            
     <span class="texto2-dados-da-serie"><?php echo $row_Rs['dados_do_seriado']; ?></span> 
       
</div> <!-- Fim da div "dados-da-serie" -->

</div> <!-- Fim da div "img" -->
        
<div id="dados-confirmacao">
          
<div id="texto-dados-da-mensagem">
            
     <span class="texto-dados-da-mensagem">Obrigado pela sua Colaboração</span>          

</div> <!-- Fim da div "texto-dados-da-mensagem" -->
          
<div id="texto-dados">
            
     <span class="texto-dados">
     Estaremos analizando sua mensagem, e resolvendo quaisquer problemas contido na Série, <?php echo $row_Rs['titulo']; ?>.
     <p>
     <span class="texto2-problemas-com-series">Episódios Online removidos - (Séries).</span><br />
     <span class="texto2-problemas-com-series">Trailer removido.</span><br />
     <span class="texto2-problemas-com-series">Problemas com o vídeo.</span><br />
     <span class="texto2-problemas-com-series">Problemas com o som.</span><br />
     <span class="texto2-problemas-com-series">Outros.</span>
     <p>
     Sua ajuda é fundamental para que toda nossa equipe, possa sempre estar mantendo todas as páginas do site MUNDO DOWNLOAD, em perfeito funcionamento para os seus usuários.            
     </span>          

</div> <!-- Fim da div "texto-dados" -->
          
<div id="img-voltar">
            
      <a href="../../../index.php?pag=series&amp;id=<?php echo $row_Rs['id']; ?>" class="link-0-borda"><img src="../../estrutura_img/GIF - Voltar.gif" border="0" /></a>          

</div> <!-- Fim da div "img-voltar" -->

</div> <!-- Fim da div "dados-confirmacao" -->
        
<div class="clear"></div>
</div> <!-- Fim da div "conteudo" -->

<div id="contador-regressivo">
      
      <script language="JavaScript" type="text/javascript">
      var contador = 20;
      function conta() {
      document.getElementById('tempo').innerHTML=contador;
      if(contador == 0) {
      top.location.href='../../../index.php?pag=series&id=<?php echo $row_Rs['id']; ?>';
      }
      if (contador != 0){
      contador = contador-1;
      setTimeout("conta()", 1000);
      }
      }conta();
      </script>

     <span class="texto-contador-regressivo">Você será redirecionado em</span>
     <br />
     <div id="contador-regressivo-segundos">
     
     <span class="tempo"><span id="tempo">0</span></span>
     <br />
     <span class="texto-contador-regressivo">Segundos</span>
     </div>
     <script>
     conta();</script>
     
</div> <!-- Fim da div "contador-regressivo-segundos" -->

</div> <!-- Fim da div "contador-regressivo" -->

</div> <!-- Fim da div "pg" -->

<?php } // Show if recordset not empt ?>

<?php if ($totalRows_Rs == 0) { // Show if recordset not empti ?>
<div id="contador-regressivo">
      
  <script language="JavaScript" type="text/javascript">
      var contador = 5;
      function conta() {
      document.getElementById('tempo').innerHTML=contador;
      if(contador == 0) {
      top.location.href='http://www.mundodownload.net/';
      }

      if (contador != 0){
      contador = contador-1;
      setTimeout("conta()", 1000);
      }
      }conta();
      </script>

     <span class="texto-contador-regressivo">Você será redirecionado em</span>
     <br />
     <div id="contador-regressivo-segundos">
     
     <span class="tempo"><span id="tempo">0</span></span>
     <br />
     <span class="texto-contador-regressivo">Segundos</span>
     </div>
  <script>
     conta();</script>
     
</div> <!-- Fim da div "contador-regressivo-segundos" -->

</div> <!-- Fim da div "contador-regressivo" -->
<?php } // Show if recordset not empti ?>

</div> <!-- Fim da div "geral" -->

<div id="rodape">

     <span class="texto-rodape">Copyright 2013 &copy; Mundo Download</span>

</div> <!-- Fim da div "rodape" -->

</body>
</html>
<?php
mysql_free_result($Rs);
?>
