<?php
include 'GenFileParts.php';

GenerateTop();
?>

<form action="../InsertMoshgiach.php" method="post">
First Name: <input type="text" name="fname"><br>
Last Name: <input type="text" name="lname"><br>
Email: <input type="text" name="email"><br>
<input type="submit">
</form>

<?php
GenerateBottom();
?>
