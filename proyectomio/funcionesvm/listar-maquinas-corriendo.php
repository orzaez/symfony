<?php
$resultado= shell_exec('VBoxManage list runningvms');
echo '<pre style="font-size: 16px">'.$resultado.'<pre>';
?>
