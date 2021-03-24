<html>
    <head><link rel="stylesheet" type="text/css" href="estilo.css">
    
    <head>
    <style>
        .dos:nth-child(2n-1){
            background: #99ffcc;
        }
        .tres:nth-child(3n+1){
            background: #99ff66;
        }
        .cuatro:nth-child(4n+1){
            background: #ff99ff;
        }
        .cinco:nth-child(5n+1){
            background: #ff9966;
        }

    </style>
    <body>
		<?php 
        $conexion=mysqli_connect('51.178.63.107','WooTestUser','7q1dvv8Sx2');
        $database = "wootaxidata";
        $db = mysqli_select_db($conexion, $database); 

        $tabla=$_POST["tabla"];
        $campos=$_POST["campos"];
        $filtro=$_POST["filtro"];
        $frecuencia=$_POST["frecuencia"]; 

		$sql="SELECT $campos from $tabla $filtro";
		$resultado=mysqli_query($conexion,$sql);

        
        //FUNCIONES IMPORTANTES
        if (empty($filtro)){
            echo "!Cuidado! No ha aplicado filtro";
        }
        echo "<h3>Esta consulta se ha realizado el: " . date("d/m/Y"). " a las: " .date ("H:i a"). "<br> </h3>";
        
        
        // $cliente = curl_init();
	    // curl_setopt($cliente, CURLOPT_URL, "https://www.google.com");
	    // curl_setopt($cliente, CURLOPT_HEADER, 0);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
	    // $web=curl_exec($cliente);
        // var_dump($web);
        // die;
	    // curl_close($cliente);



        $ncampos1= array ($_POST["campos"]);
        if (in_array('id' || 'provider_id',$ncampos1)){
            echo "<h4>Correcto!! El campo ID se encuentra en su busqueda.</h4>";
        }
        echo "<table border=1>";


        $ncampos = array (explode(',', trim($_POST["campos"])));
        echo "<tr>";//Cabecera de las columnas
                    foreach ($ncampos as $n) {
                        foreach ($n as $ncol) {
                            echo "<th style='background-color:#FF0000'>" . $ncol . "</th>";
                            
                        }
                    }
                    echo "</tr>";

        switch ($frecuencia){
                case "2":   
                    foreach($resultado as $key =>$r) {//muestra los registros de la consulta
                        echo "<tr class='dos'>";
                            foreach($r as $filas) {
                                echo "<td>";
                                echo "  " . $filas . "  ";
                                echo "</td>";
                            }
                        echo "</tr>";
                    } 
                break;
            
                case "3":
                    foreach($resultado as $key =>$r) {//muestra los registros de la consulta
                        echo "<tr class='tres'>";
                            foreach($r as $filas) {
                                echo "<td>";
                                echo "  " . $filas . "  ";
                                echo "</td>";
                            }
                        echo "</tr>";
                    } 
                break;
                
                case "4":
                    foreach($resultado as $key =>$r) {//muestra los registros de la consulta
                        echo "<tr class='cuatro'>";
                            foreach($r as $filas) {
                                echo "<td>";
                                echo "  " . $filas . "  ";
                                echo "</td>";
                            }
                        echo "</tr>";
                    }     
                break;

                case "5": 
                    foreach($resultado as $key =>$r) {//muestra los registros de la consulta
                        echo "<tr class='cinco'>";
                            foreach($r as $filas) {
                                echo "<td>";
                                echo "  " . $filas . "  ";
                                echo "</td>";
                            }
                        echo "</tr>";
                    } 
                break;
                          
            }
                
            // foreach($resultado as $r) {//muestra los registros de la consulta
            //     echo "<tr>";
            //         foreach($r as $filas) {
            //             echo "<td>";
            //             echo "  " . $filas . "  ";
            //             echo "</td>";
            //         }
            //     echo "</tr>";
            // }
                
        echo "</table>";     
        ?>
    </body>

</html>