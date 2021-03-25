<?php
$resultado= shell_exec('VBoxManage createvm "'.$_POST['valor'].'"');
echo '<pre style="font-size: 16px">'.$resultado.'<pre>';
?>
