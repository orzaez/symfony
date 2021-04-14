<html>
<body>
<?php 
$myfile = fopen("estilo.html", "r");
echo fread($myfile,filesize("estilo.html"));
fclose($myfile);
echo include ("footer.php");
?>
</body>
</html>
