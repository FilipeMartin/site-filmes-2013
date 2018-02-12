<?php
// Array definitions
  $tNG_login_config = array();
  $tNG_login_config_session = array();
  $tNG_login_config_redirect_success  = array();
  $tNG_login_config_redirect_failed  = array();
  $tNG_login_config_redirect_success = array();
  $tNG_login_config_redirect_failed = array();

// Start Variable definitions
  $tNG_debug_mode = "DEVELOPMENT";
  $tNG_debug_log_type = "";
  $tNG_debug_email_to = "you@yoursite.com";
  $tNG_debug_email_subject = "[BUG] The site went down";
  $tNG_debug_email_from = "webserver@yoursite.com";
  $tNG_email_host = "mail.mundodownload.net";
  $tNG_email_user = "admin@mundodownload.net";
  $tNG_email_port = "25";
  $tNG_email_password = "Fi24426004";
  $tNG_email_defaultFrom = "admin@mundodownload.net";
  $tNG_login_config["connection"] = "Mundo_Download";
  $tNG_login_config["table"] = "sistema_login";
  $tNG_login_config["pk_field"] = "id";
  $tNG_login_config["pk_type"] = "NUMERIC_TYPE";
  $tNG_login_config["email_field"] = "email";
  $tNG_login_config["user_field"] = "usuario";
  $tNG_login_config["password_field"] = "senha";
  $tNG_login_config["level_field"] = "status";
  $tNG_login_config["level_type"] = "STRING_TYPE";
  $tNG_login_config["randomkey_field"] = "randomkey";
  $tNG_login_config["activation_field"] = "active";
  $tNG_login_config["password_encrypt"] = "false";
  $tNG_login_config["autologin_expires"] = "3000";
  $tNG_login_config["redirect_failed"] = "login.php";
  $tNG_login_config["redirect_success"] = "login/index_admin.php?pag=adicionar_filmes";
  $tNG_login_config["login_page"] = "login.php";
  $tNG_login_config["max_tries"] = "";
  $tNG_login_config["max_tries_field"] = "";
  $tNG_login_config["max_tries_disableinterval"] = "";
  $tNG_login_config["max_tries_disabledate_field"] = "";
  $tNG_login_config["registration_date_field"] = "";
  $tNG_login_config["expiration_interval_field"] = "";
  $tNG_login_config["expiration_interval_default"] = "";
  $tNG_login_config["logger_pk"] = "";
  $tNG_login_config["logger_table"] = "";
  $tNG_login_config["logger_user_id"] = "";
  $tNG_login_config["logger_ip"] = "";
  $tNG_login_config["logger_datein"] = "";
  $tNG_login_config["logger_datelastactivity"] = "";
  $tNG_login_config["logger_session"] = "";
  $tNG_login_config_redirect_success["Desativado"] = "login/sistema_login/usuario_desativado/usuario_desativado.php";
  $tNG_login_config_redirect_failed["Desativado"] = "login.php";
  $tNG_login_config_redirect_success["GM"] = "login/index_admin.php?pag=adicionar_filmes";
  $tNG_login_config_redirect_failed["GM"] = "login.php";
  $tNG_login_config_redirect_success["ADMIN"] = "login/index_admin.php?pag=adicionar_filmes";
  $tNG_login_config_redirect_failed["ADMIN"] = "login.php";
  $tNG_login_config_session["kt_login_id"] = "id";
  $tNG_login_config_session["kt_login_user"] = "usuario";
  $tNG_login_config_session["kt_login_level"] = "status";
  $tNG_login_config_session["kt_nome"] = "nome";
  $tNG_login_config_session["kt_email"] = "email";
  $tNG_login_config_session["kt_data"] = "data";
// End Variable definitions
?>