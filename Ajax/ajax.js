var BaseDir = "/demotron/";
var loader = '<img src="/demotron/Assets/img/loading.gif" alt="" class="responsive-img" style="display: block; margin: auto; max-height: 150px;">';
function getDataProveedor(id) {
    $.ajax({
        type: 'GET',
        contentType: 'application/json',
        url: BaseDir + "/proveedor/"+id+"/detalleOc",
        success: function(data){
            var obj = JSON.parse(data);
            $("#rut_prov").val(obj.rut);
            $("#rep_prov").val(obj.representante);
            $("#fono_prov").val(obj.fono);
            $("#dir_prov").val(obj.direccion);
        },
        error: function(jqXHR, textStatus, errorThrown){
            
        }
    });
}

function getEstadoFolio(folio){
    $.ajax({
        type: 'GET',
        contentType: 'application/json',
        url: BaseDir + "/ordenCompra/"+folio+"/estadoFolio",
        success: function(data){
            var obj = JSON.parse(data);
            if(obj.estado=='libre'){
                $("#folioOC").css("background", "#8BC34A");
            }
            else{
                $("#folioOC").css("background", "#E43D31");
            }
        },
        error: function(jqXHR, textStatus, errorThrown){
            
        }
    });
}

function cambiarEstadoOc(folio){
    var url= BaseDir+"cambioEstadoOc/impresion/"+folio;
    console.log(url);
    var datos=crearXMLHttpRequest();
    datos.onreadystatechange = function(){
        if(datos.readyState==1){
        }
        else if(datos.readyState==4){
            if(datos.status==200){
                location.href=BaseDir+"ordenCompra";
            }
        }  
    };
    datos.open("GET", url, true);
    datos.send(null);
}

function moverArchivos(inicial, final){
    var url= BaseDir+"moverOc/"+inicial+"/"+final;
    console.log(url);
    var datos=crearXMLHttpRequest();
    datos.onreadystatechange = function(){
        if(datos.readyState==1){
            $("#ocultar").slideUp(400);
            $("#loader").html(loader);
        }
        else if(datos.readyState==4){
            if(datos.status==200){
               location.href=BaseDir+"ordenCompra";
            }
        }  
    };
    datos.open("GET", url, true);
    datos.send(null);   
}

/****************************
FUNCION COMUN PARA TODOS LOS DEMAS
****************************/


function crearXMLHttpRequest(){
  var xmlHttp=null;
  if (window.ActiveXObject){
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  else{ 
    if (window.XMLHttpRequest){
      xmlHttp = new XMLHttpRequest();
    }
  }
  return xmlHttp;
}