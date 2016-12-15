<?php
session_start();
//error_reporting(0);
ini_set('error_reporting', E_ALL);

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

// Configuramos la aplicación. http://docs.slimframework.com/#Configuration-Overview
// Se puede hacer en la línea anterior con:
// $app = new \Slim\Slim(array('templates.path' => 'vistas'));
// O bien con $app->config();

$app->config(array(
    'templates.path' => 'View',
));

// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
$app->contentType('text/html; charset=utf-8');

//variables
$GLOBALS['SystemUpload'] = "C:/wamp/www/demotron/uploads/";
$GLOBALS['Upload'] = "/demotron/uploads/";
$GLOBALS['HOY'] = date("Y-m-d");
$GLOBALS['AHORA'] = date('H:i');


//Helpers
require 'Helpers/view.php';
require 'Helpers/utils.php';
require 'Helpers/NumberToLetterConverter.php';



//rutas
require 'routes.php';

//Consultas Generalews
require 'Model/ConsultasGenerales.php';


// Modelos
require 'Model/AppObjeto.php';
require 'Model/Usuario.php';
require 'Model/Origen.php';
require 'Model/Producto.php';
require 'Model/TipoMaquina.php';
require 'Model/Maquina.php';
require 'Model/Proveedor.php';
require 'Model/Informes.php';

require 'Model/OrdenCompra/FormaPago.php';
require 'Model/OrdenCompra/OrdenCompra.php';
require 'Model/OrdenCompra/ProductoOC.php';
require 'Model/OrdenCompra/EstadoOc.php';
require 'Model/OrdenCompra/Unidad.php';
require 'Model/OrdenCompra/CentroCosto.php';
require 'Model/OrdenCompra/CentroGasto.php';
require 'Model/OrdenCompra/Cheque.php';
require 'Model/OrdenCompra/Movimiento.php';
require 'Model/OrdenCompra/Anulacion.php';







//controladores
require 'Controllers/Usuario.php';
require 'Controllers/Login.php';
require 'Controllers/Origen.php';
require 'Controllers/Producto.php';
require 'Controllers/TipoMaquina.php';
require 'Controllers/Proveedor.php';
require 'Controllers/Maquina.php';
require 'Controllers/Informes.php';

require 'Controllers/OrdenCompra/OrdenCompra.php';
require 'Controllers/OrdenCompra/FormaPago.php';
require 'Controllers/OrdenCompra/EstadoOc.php';
require 'Controllers/OrdenCompra/Unidad.php';
require 'Controllers/OrdenCompra/CentroCosto.php';
require 'Controllers/OrdenCompra/CentroGasto.php';
require 'Controllers/OrdenCompra/CambioEstadoOc.php';
require 'Controllers/OrdenCompra/Cheque.php';
require 'Controllers/OrdenCompra/Movimiento.php';

require 'Controllers/OrdenCompra/Anulacion.php';