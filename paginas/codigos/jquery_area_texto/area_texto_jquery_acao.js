$(document).ready(function() {					   
	$('#busca-filmes').focus(function() {
		if ($(this).val() == "Faça a sua busca por Filmes...") {
			$(this).val('');
		}
	}).blur(function() {
		if ($(this).val() == '') {
			$(this).val('Faça a sua busca por Filmes...');
		}
	});
	$('#busca-series').focus(function() {
		if ($(this).val() == "Faça a sua busca por Séries Online...") {
			$(this).val('');
		}
	}).blur(function() {
		if ($(this).val() == '') {
			$(this).val('Faça a sua busca por Séries Online...');
		}
	});
	$('#mensagem').focus(function() {
		if ($(this).val() == "Descreva os problemas contido nesta postagem.") {
			$(this).val('');
		}
	}).blur(function() {
		if ($(this).val() == '') {
			$(this).val('Descreva os problemas contido nesta postagem.');
		}
	});
	$('#site_blog').focus(function() {
		if ($(this).val() == " ") {
			$(this).val('');
		}
	}).blur(function() {
		if ($(this).val() == '') {
			$(this).val(' ');
		}
	});
});