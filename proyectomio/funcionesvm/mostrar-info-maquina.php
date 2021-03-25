<?php
$resultado= shell_exec('VBoxManage showvminfo "'.$_POST['valor'].'"');
echo '<pre style="font-size: 16px">'.$resultado.'<pre>';
?>
