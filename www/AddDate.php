<?php
include 'GenFileParts.php';

GenerateTop();
?>

<form action="../InsertDate.php" method="post">
New Date (ccyy-mm-dd): <input type="text" name="date"><br>
Meal: <input type="text" name="meal"><br>
Moshgiach First Name (or blank): <input type="text" name="fname"><br>
Moshgiach Last Name (or blank): <input type="text" name="lname"><br>
<input type="submit">
</form>

<?php
GenerateBottom();
?>
