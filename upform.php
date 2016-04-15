<?php 
include 'connection.php';
?>
<form method="post" enctype="multipart/form-data" action ="upload.php">
<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
<tr>
<td width="246">
<input type="hidden" name="MAX_FILE_SIZE" value="20000000">
<input name="ufile" type="file" id="ufile">
</td>
<td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
</tr>
</table>
</form>


