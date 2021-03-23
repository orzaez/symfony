<html>
<body>

		<?php 
        $conexion=mysqli_connect('51.178.63.107','WooTestUser','7q1dvv8Sx2');
        $database = "wootaxidata";
        $db = mysqli_select_db($conexion, $database); 

        $tabla=$_POST["tabla"];
        $campos=$_POST["campos"];
		$sql="SELECT $campos from $tabla";
		$resultado=mysqli_query($conexion,$sql);
        echo "<table border=1>";

        $ncampos = array (explode(',', trim($_POST["campos"])));
        echo "<tr>";
        foreach ($ncampos as $n) {
            foreach ($n as $ncol) {
                echo "<th>" . $ncol . "</th>";
            }
        }
        echo "</tr>";

        foreach($resultado as $r) {

            echo "<tr>";
            
            foreach($r as $filas) {
                echo "<td>";
                echo "  " . $filas . "  ";
                echo "</td>";
            }
            echo "</tr>";
            
        }
        echo "</table>";     
        ?>
    </body>

</html>