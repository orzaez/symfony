function crear_maquina(){
    ({
    url: 'funcionesvm/crearmaquina.php',
    success: function(resultado_php){
    div_resultados.innerHTML=resultado_php;
    }});
}