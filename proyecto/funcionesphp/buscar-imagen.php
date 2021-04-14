<?php
$resultado= shell_exec('docker search "'.$_POST['valor'].'"');
echo '<pre style="font-size: 16px">'.$resultado.'<pre>';
?>

