function inicio_imagenes(){
    div_menu=document.getElementById('menu');
    document.getElementById('menu').style.borderRight="0px";
    document.getElementById('adicional-uno').style.borderRight="0px";
    document.getElementById('adicional-uno').innerHTML="";
    document.getElementById('adicional-dos').innerHTML="";
    div_menu.innerHTML="\
        <table>\n\
            <tr><td><button class='boton-menu' onclick='actualizar_imagenes();'><i style='font-size:14px' class='fas'>Actualizar lista &#xf021;</i></button></td></tr>\n\
                <form method='post'>\n\
                    <tr><td><button class='boton-menu' onclick='buscar_imagen();'><i style='font-size:14px' class='fas'>Buscar imagen &#xf002;</i></button></td>\n\
                    <td><input type='text' id='valor' placeholder='Nombre de la imagen'></td></tr>\n\
                </form>\n\
                <form method='post'>\n\
                    <tr><td><button class='boton-menu' onclick='descargar_imagen();'><i style='font-size:12px' class='fas'>Descargar imagen &#xf019;</i></button></td>\n\
                    <td><input type='text' id='valor1' placeholder='Nombre de la imagen:version'></td></tr>\n\
                </form>\n\
                <form method='post'>\n\
                    <tr><td><button class='boton-menu' onclick='eliminar_imagen();'><i style='font-size:13px' class='fas'>Eliminar imagen &#xf1f8;</i></button></td>\n\
                    <td><input type='text' id='valor2' placeholder='Nombre de la imagen'></td></tr>\n\
                </form>\n\
                <tr><td colspan='2'><a href='https://hub.docker.com/' target='_blank'><button class='boton-menu'>Ir a Dockerhub</button></a><td></tr>\n\
        </table>";
    div_resultados=document.getElementById('resultados');
    div_resultados.style.overflowY='scroll';
    div_resultados.style.overflowX='hidden';
    div_resultados.style.borderBottom='2px solid #384951';
    $.ajax({
        url: 'funcionesphp/ver-imagenes.php',
        success: function(resultado_php){
        div_resultados.innerHTML=resultado_php;
    }});
}
function inicio_contenedores(){
    div_adicional_uno=document.getElementById('menu');
    div_adicional_uno.innerHTML="\
        <table>\n\
                <form method='post'>\n\
                    <tr><td><button class='boton-menu' onclick='iniciar_contenedor();'><i style='font-size:12px' class='fas'>Iniciar contenedor &#xf04b;</i></button></td>\n\
                    <td><input type='text' id='valor3' placeholder='Nombre/ID del contenedor'></td></tr>\n\
                </form>\n\
                <form method='post'>\n\
                    <tr><td><button class='boton-menu'onclick='reiniciar_contenedor();'><i style='font-size:11px' class='fas'>Reiniciar contenedor &#xf021;</i></button></td>\n\
                    <td><input type='text' id='valor4' placeholder='Nombre/ID del contenedor'></td></tr>\n\
                </form>\n\
                <form method='post'>\n\
                    <tr><td><button class='boton-menu' onclick='parar_contenedor();'><i style='font-size:12px' class='fas'>Parar contenedor &#xf04d;</i></button></td>\n\
                    <td><input type='text' id='valor5' placeholder='Nombre/ID del contenedor'></td></tr>\n\
                </form>\n\
                <form method='post'>\n\
                    <tr><td><button class='boton-menu' onclick='pausar_contenedor();'><i style='font-size:12px' class='fas'>Pausar contenedor &#xf04c;</i></button></td>\n\
                    <td><input type='text' id='valor6' placeholder='Nombre/ID del contenedor'></td></tr>\n\
                </form>\n\
                <form method='post'>\n\
                    <tr><td><button class='boton-menu' onclick='reanudar_contenedor();'><i style='font-size:11px' class='fa'>Reanudar contenedor &#xf35a;</i></button></td>\n\
                    <td><input type='text' id='valor7' placeholder='Nombre/ID del contenedor'></td></tr>\n\
                </form>\n\
                <form method='post'>\n\
                    <tr><td><button class='boton-menu' onclick='eliminar_contenedor();'><i style='font-size:11px' class='fas'>Eliminar contenedor &#xf1f8;</i></button></td>\n\
                    <td><input type='text' id='valor8' placeholder='Nombre/ID del contenedor'></td></tr>\n\
                </form>\n\
        </table>";
    div_menu=document.getElementById('adicional-uno');
    div_menu.innerHTML="\
        <table>\n\
            <tr><td><button class='boton-menu' onclick='actualizar_contenedores();'><i style='font-size:14px' class='fas'>Actualizar lista &#xf021;</i></button></td></tr>\n\
            <tr><td><input type='button' class='largo' value='Nuevo contenedor con puertos aleatorios' onclick='nuevo_contenedor_uno_formulario();'></td></tr>\n\
            <tr><td><input type='button' class='largo' value='Nuevo contenedor con puertos específicos' onclick='nuevo_contenedor_dos_formulario();'></td></tr>\n\
        </table>";
    div_resultados=document.getElementById('resultados');
    div_resultados.style.overflow='scroll';
    div_resultados.style.borderBottom='0px';
    document.getElementById('menu').style.borderRight="2px solid #384951";
    document.getElementById('adicional-uno').style.borderRight="2px solid #384951";
    $.ajax({
        url: 'funcionesphp/ver-contenedores.php',
        success: function(resultado_php){
        div_resultados.innerHTML=resultado_php;
    }});
}
function actualizar_imagenes(){
    $.ajax({
    url: 'funcionesphp/ver-imagenes.php',
    success: function(resultado_php){
    div_resultados.innerHTML=resultado_php;
    }});
}
function buscar_imagen(){
    div_resultados=document.getElementById('resultados');
    nombre=document.getElementById('valor').value;
    document.getElementById('valor').value="";
    $.ajax({
        type: 'POST',
        url: 'funcionesphp/buscar-imagen.php',
        data:{valor:nombre},
        success: function(resultado_php){
        div_resultados.innerHTML=resultado_php;
    }});
}
function descargar_imagen(){
    div_resultados=document.getElementById('resultados');
    nombre=document.getElementById('valor1').value;
    document.getElementById('valor1').value="";
    div_resultados.innerHTML="Descargando imagen <b>"+nombre+"</b>...";
    $.ajax({
        type: 'POST',
        url: 'funcionesphp/descargar-imagen.php',
        data:{valor1:nombre},
        success: function(resultado_php){
        div_resultados.innerHTML=resultado_php;
    }});
}
function eliminar_imagen(){
    div_resultados=document.getElementById('resultados');
    nombre=document.getElementById('valor2').value;
    document.getElementById('valor2').value="";
    $.ajax({
        type: 'POST',
        url: 'funcionesphp/eliminar-imagen.php',
        data:{valor2:nombre},
        success: function(resultado_php){
        div_resultados.innerHTML=resultado_php;
    }});
}
function iniciar_contenedor(){
    div_resultados=document.getElementById('resultados');
    nombre=document.getElementById('valor3').value;
    document.getElementById('valor3').value="";
    $.ajax({
        type: 'POST',
        url: 'funcionesphp/iniciar-contenedor.php',
        data:{valor3:nombre},
        success: function(resultado_php){
        div_resultados.innerHTML=resultado_php;
    }});
}
function reiniciar_contenedor(){
    div_resultados=document.getElementById('resultados');
    nombre=document.getElementById('valor4').value;
    document.getElementById('valor4').value="";
    $.ajax({
        type: 'POST',
        url: 'funcionesphp/reiniciar-contenedor.php',
        data:{valor4:nombre},
        success: function(resultado_php){
        div_resultados.innerHTML=resultado_php;
    }});
}
function parar_contenedor(){
    div_resultados=document.getElementById('resultados');
    nombre=document.getElementById('valor5').value;
    document.getElementById('valor5').value="";
    $.ajax({
        type: 'POST',
        url: 'funcionesphp/parar-contenedor.php',
        data:{valor5:nombre},
        success: function(resultado_php){
        div_resultados.innerHTML=resultado_php;
    }});
}
function pausar_contenedor(){
    div_resultados=document.getElementById('resultados');
    nombre=document.getElementById('valor6').value;
    document.getElementById('valor6').value="";
    $.ajax({
        type: 'POST',
        url: 'funcionesphp/pausar-contenedor.php',
        data:{valor6:nombre},
        success: function(resultado_php){
        div_resultados.innerHTML=resultado_php;
    }});
}
function reanudar_contenedor(){
    div_resultados=document.getElementById('resultados');
    nombre=document.getElementById('valor7').value;
    document.getElementById('valor7').value="";
    $.ajax({
        type: 'POST',
        url: 'funcionesphp/reanudar-contenedor.php',
        data:{valor6:nombre},
        success: function(resultado_php){
        div_resultados.innerHTML=resultado_php;
    }});
}
function eliminar_contenedor(){
    div_resultados=document.getElementById('resultados');
    nombre=document.getElementById('valor8').value;
    document.getElementById('valor8').value="";
    $.ajax({
        type: 'POST',
        url: 'funcionesphp/eliminar-contenedor.php',
        data:{valor8:nombre},
        success: function(resultado_php){
        div_resultados.innerHTML=resultado_php;
    }});
}
function actualizar_contenedores(){
    $.ajax({
    url: 'funcionesphp/ver-contenedores.php',
    success: function(resultado_php){
    div_resultados.innerHTML=resultado_php;
    }});
}
function nuevo_contenedor_uno_formulario(){
    div_adicional_dos=document.getElementById('adicional-dos');
    div_adicional_dos.innerHTML="\
        <form method='post'>\n\
            <table>\n\
                <tr><td class='td-adicional-dos'>Introduce el Nombre del contenedor</td>\n\
                <td class='td-adicional-dos'><input type='text' id='valor9' placeholder='Nombre del contenedor'></td></tr>\n\
                <tr><td class='td-adicional-dos'>Introduce el Nombre/ID de la imagen</td>\n\
                <td class='td-adicional-dos'><input type='text' id='valor10' placeholder='Nombre/ID de la imagen'></td></tr>\n\
                <tr><td class='td-adicional-dos'><input type='button' class='boton-menu' value='Crear contenedor' onclick='nuevo_contenedor_uno();'></td></tr>\n\
           </table>\n\
        </form>";        
}
function nuevo_contenedor_uno(){
    nombre=document.getElementById('valor9').value;
    imagen=document.getElementById('valor10').value;
    document.getElementById('valor9').value="";
    document.getElementById('valor10').value="";
    div_resultados=document.getElementById('resultados');
    $.ajax({
        type: 'POST',
        url: 'funcionesphp/nuevo-contenedor-uno.php',
        data:{valor9:nombre,valor10:imagen},
        success: function(resultado_php){
        div_resultados.innerHTML=resultado_php;
    }});
}
function nuevo_contenedor_dos_formulario(){
    div_adicional_dos=document.getElementById('adicional-dos');
    div_adicional_dos.innerHTML="\
        <form method='post'>\n\
            <table>\n\
                <tr><td>Introduce el Nombre del contenedor</td>\n\
                <td class='td-adicional-dos'><input type='text' id='valor9' placeholder='Nombre del contenedor'></td></tr>\n\
                <tr><td class='td-adicional-dos'>Introduce el Nombre/ID de la imagen</td>\n\
                <td class='td-adicional-dos'><input type='text' id='valor10' placeholder='Nombre/ID de la imagen'></td></tr>\n\
                <tr><td class='td-adicional-dos'>Introduce el número de puertos</td><td class='td-adicional-dos'><input type='number' max='3' min='0' id='numero-puertos' onchange='numero_puertos();'></td></tr>\n\
                <tr><td class='td-adicional-dos'><div id='div-adicionales'></div><td></tr>\n\
                <tr><td class='td-adicional-dos'><input type='button' class='boton-menu' value='Crear contenedor' onclick='nuevo_contenedor_dos();'></td></tr>\n\
           </table>\n\
        </form>";        
}
function numero_puertos(){
    puertos=parseInt(document.getElementById('numero-puertos').value);
    numero_div=document.getElementById('div-adicionales');
    codigo="<table>";
    for (i=1;i<=puertos;i++){
        codigo=codigo+"<tr><td class='td-adicional-dos'>"+i+"º Pareja de puertos <input type='text' id='puerto"+i+"' placeholder='Anfitrion:Contenedor'></td></tr>";
    }
    numero_div.innerHTML=codigo+"</table>";
}
function nuevo_contenedor_dos(){
    nombre=document.getElementById('valor9').value;
    imagen=document.getElementById('valor10').value;
    document.getElementById('valor9').value="";
    document.getElementById('valor10').value="";
    div_resultados=document.getElementById('resultados');
    puertos=parseInt(document.getElementById('numero-puertos').value);
    document.getElementById('numero-puertos').value=0;
    if (puertos === 1){
        p1=document.getElementById('puerto1').value;
        $.ajax({
        type: 'POST',
        url: 'funcionesphp/nuevo-contenedor-dos-1p.php',
        data:{valor9:nombre,valor10:imagen,puerto1:p1},
        success: function(resultado_php){
        div_resultados.innerHTML=resultado_php;
        }});
    }
    else if (puertos ===2){
        p1=document.getElementById('puerto1').value;
        p2=document.getElementById('puerto2').value;;
        $.ajax({
        type: 'POST',
        url: 'funcionesphp/nuevo-contenedor-dos-2p.php',
        data:{valor9:nombre,valor10:imagen,puerto1:p1,puerto2:p2},
        success: function(resultado_php){
        div_resultados.innerHTML=resultado_php;
    }});
    }
    else{
        p1=document.getElementById('puerto1').value;
        p2=document.getElementById('puerto2').value;
        p3=document.getElementById('puerto3').value;
        $.ajax({
        type: 'POST',
        url: 'funcionesphp/nuevo-contenedor-dos-3p.php',
        data:{valor9:nombre,valor10:imagen,puerto1:p1,puerto2:p2,puerto3:p3},
        success: function(resultado_php){
        div_resultados.innerHTML=resultado_php;
    }});
    }
}