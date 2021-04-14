<?php
shell_exec('docker rm -f "'.$_POST['valor8'].'"');
$resultado= shell_exec('docker ps -a');
echo '<pre style="font-size: 15px">'.$resultado.'<pre>';
?>

