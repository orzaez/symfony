<?php
$resultado= shell_exec('VBoxManage list vms -l');
echo '<pre style="font-size: 16px">'.$resultado.'<pre>';
?>