<?php
shell_exec('docker pause "'.$_POST['valor6'].'"');
$resultado= shell_exec('docker ps -a');
echo '<pre style="font-size: 15px">'.$resultado.'<pre>';
?>

