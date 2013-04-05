<!DOCTYPE html>
<html>
<body>

<?php
$con = mysql_connect("localhost","","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

echo ('Seems that i got in! yay!');
?> 

</body>
</html>