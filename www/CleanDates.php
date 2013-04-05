<?php
include 'GenFileParts.php';

GenerateTop();
?>

<form action="../DeleteDate.php" method="post">
Delete all the dates from before:<br>
Date (ccyy-mm-dd): <input type="text" name="date"><br>
<input type="submit">
</form>

<?php
GenerateBottom();
?>
