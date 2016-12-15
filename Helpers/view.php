<?php
/**
* Clase que contiene el metodo para llamar a una vista
*/
/**
* 
*/
class View {
	function __construct(){}
	public static function view($objeto, $template, $vars = array()){
	    extract($vars);
	    //Administro el título	    
	    $titulo=='' ? $titulo='Demotron' : $titulo = $titulo;
	    //cargo los assets y el menú
	    require "View/application/head.tpl.php";
	    if(isset($_SESSION['id'])){
	    	require "View/application/menu.tpl.php";
	    }
	    

	    //cargo la vista que necesito
	    require "View/$objeto/$template.tpl.php";

	    //si es un informe, cargo el footer
	   
	   	if(!is_array($objeto)){
	   		if(strpos($objeto, 'nformes/') and $template!='inicio'){
		    	require "View/application/footerInforme.tpl.php";
		    }	
	   	}
	    

	    //cargo las notificaciones
	    require "View/application/notif.tpl.php";

	    //cargo el JS al final
	    require "View/application/footer.tpl.php";
	}
	public static function view_noMenu($objeto, $template, $vars = array()){
	    extract($vars);
	    $titulo=='' ? $titulo='Demotron' : $titulo = $titulo;
	    //cargo los assets y el menú
	    require "View/application/head.tpl.php";
	  
	    //cargo la vista que necesito
	    require "View/$objeto/$template.tpl.php";

	    //cargo las notificaciones
	    require "View/application/notif.tpl.php";

	    //cargo el JS al final
	    require "View/application/footer.tpl.php";
	}

}

