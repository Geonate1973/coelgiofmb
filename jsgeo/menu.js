// JavaScript Document
//cuando el documento este listo, vamos a ejecutar la funsion  main
$(document).ready(main);

var contador = 1 ;

function main () {
	$('.menu_bar').click(function(){
		//$('.menu_sup').toggle();
		
		if(contador==1){
			$('.menu_sup_cel').animate({
				left:'0'
				});
				contador=0;
			}else {
				contador=1;
				$('.menu_sup_cel').animate({
				left:'-100%'
				});
				}
		
			});
			// hasta aqui el codigo para mostrar el menu
			// ahora el codigo para mostrar el submenu
			
$('.submenu').click(function(){
$(this).children('.children').slideToggle();
	});
}