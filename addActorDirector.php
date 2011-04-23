<html>
<body>

<?php
require($DOCUMENT_ROOT . "./menu_bar.html");
?>
<title>CS 143 Movie Database</title>

<link rel="stylesheet" type="text/css" media="all" href="searchsm.css">
<table align="center" width="650" class="searchtablesm" bgcolor="0038A8">
	<tr bgcolor="0038A8">
		<td align="center"><font color="FFFFFF">
			<form action="./addActorDirector.php" method="GET">
				Identity:
			<input type="radio" name="identity" value="Actor" checked="true">Actor
			<input type="radio" name="identity" value="Director">Director<br/>
			<hr/>
			First Name:
			<input type="text" name="first" maxlength="20"><br/>
			Last Name:
			<input type="text" name="last" maxlength="20"><br/>
			Gender:
			<input type="radio" name="sex" value="Male" checked="true">Male
			<input type="radio" name="sex" value="Female">Female<br/>
			Date of Birth:
			<input type="text" name="dob"><br/>
			Date of Death:
			<input type="text" name="dod"><br/>
			<input type="submit" value="Add Info"/>
			</form>
			<hr/></font>
		</td>
	</tr>
</table>
</body>
</html> 

</body>
</html>
