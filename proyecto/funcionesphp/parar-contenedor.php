<?php
shell_exec('docker stop "'.$_POST['valor5'].'"');
$resultado= shell_exec('docker ps -a');
echo '<pre style="font-size: 15px">'.$resultado.'<pre>';
?>

