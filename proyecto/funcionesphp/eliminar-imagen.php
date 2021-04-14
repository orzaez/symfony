<?php
shell_exec('docker rmi "'.$_POST['valor2'].'"');
$resultado= shell_exec('docker images');
echo '<pre style="font-size: 20px">'.$resultado.'<pre>';
?>

