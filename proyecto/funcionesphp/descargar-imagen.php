<?php
shell_exec('docker pull "'.$_POST['valor1'].'"');
$resultado= shell_exec('docker images');
echo '<pre style="font-size: 20px">'.$resultado.'<pre>';
?>

