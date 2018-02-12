       $(document).ready(function()
	   {
	      $("#menu_conteudo_filmes").css("display","none");
		  $("#menu_conteudo_series").css("display","none");
		  $("#menu_conteudo_menu_principal").css("display","none");
		  $("#menu_conteudo_publicidade").css("display","none");
		  
       });
	   
	   function menu_conteudo_home()
	   {
	       $("#menu_conteudo_filmes").hide("fast");
	       $("#menu_conteudo_series").hide("fast");
		   $("#menu_conteudo_menu_principal").hide("fast");
	       $("#menu_conteudo_publicidade").hide("fast");
		   $("#menu_conteudo_home").show("slow");
	   }
	   
	   function menu_conteudo_filmes()
	   {
	       $("#menu_conteudo_home").hide("fast");
	       $("#menu_conteudo_series").hide("fast");
		   $("#menu_conteudo_menu_principal").hide("fast");
	       $("#menu_conteudo_publicidade").hide("fast");
		   $("#menu_conteudo_filmes").show("slow");
	   }
	   
	   function menu_conteudo_series()
	   {
	       $("#menu_conteudo_home").hide("fast");
	       $("#menu_conteudo_filmes").hide("fast");
		   $("#menu_conteudo_menu_principal").hide("fast");
	       $("#menu_conteudo_publicidade").hide("fast");
		   $("#menu_conteudo_series").show("slow");
	   }
	   
	   function menu_conteudo_menu_principal()
	   {
	       $("#menu_conteudo_home").hide("fast");
	       $("#menu_conteudo_filmes").hide("fast");
		   $("#menu_conteudo_series").hide("fast");
	       $("#menu_conteudo_publicidade").hide("fast");
		   $("#menu_conteudo_menu_principal").show("slow");
	   }
	   
	   function menu_conteudo_publicidade()
	   {
	       $("#menu_conteudo_home").hide("fast");
	       $("#menu_conteudo_filmes").hide("fast");
		   $("#menu_conteudo_series").hide("fast");
	       $("#menu_conteudo_menu_principal").hide("fast");
		   $("#menu_conteudo_publicidade").show("slow");
	   }