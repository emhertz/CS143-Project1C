<html>
<body>

<?php
require($DOCUMENT_ROOT . "./menu_bar.html");
?>
<title>CS 143 Movie Database</title>

<?php
	$identity = $_POST["identity"];
	$first = $_POST["first"];
	$last = $_POST["last"];
	$sex = $_POST["sex"];
	$dob = $_POST["dob"];
	$dod = $_POST["dod"];

	$db_connection = mysql_connect("localhost", "cs143", "");
	if(!$db_connection) {
		$err_msg = mysql_error($db_connection);
		print "Connection failed: $errmsg <br/>";
		exit(1);
	}

	mysql_select_db("CS143", $db_connection);

	# Sanitize input
	$identity = mysql_real_escape_string($identity, $db_connection);
	$first = mysql_real_escape_string($first, $db_connection);
	$last = mysql_real_escape_string($last, $db_connection);
	$sex = mysql_real_escape_string($sex, $db_connection);
	$dob = mysql_real_escape_string($dob, $db_connection);
	$dod = mysql_real_escape_string($dod, $db_connection);

	if($identity == "Actor") {
		$resID = mysql_query("SELECT id FROM MaxPersonID");
		$row = mysql_fetch_assoc($resID);
		$id = $row['id'];
		$id = $id + 1;
		$result = mysql_query("INSERT INTO Actor VALUES($id, '$last', '$first', '$sex', '$dob', '$dod')");
		if($result) {

		} else {

		}
		mysql_query("UPDATE MaxPersonID SET id=$id");
	} else if($identity == "Director") {
		$resID = mysql_query("SELECT id from MaxPersonID");
		$row = mysql_fetch_assoc($resID);
		$id = $row['id'];
		$id = $id + 1;
		$result = mysql_query("INSERT INTO Director VALUES($id, '$last', '$first', '$dob', '$dod')");
		if($result) {
		} else {
		}
		mysql_query("UPDATE MaxPersonID SET id=$id");
	} else if($identity == "Both") {
		$resID = mysql_query("SELECT id FROM MaxPersonID");
		$row = mysql_fetch_assoc($resID);
		$id = $row['id'];
		$id = $id + 1;
		$result = mysql_query("INSERT INTO Actor VALUES($id, '$last', '$first', '$sex', '$dob', '$dod')");
		if($result) {

		} else {

		}
		$result = mysql_query("INSERT INTO Director VALUES($id, '$last', '$first', '$dob', '$dod')");
		if($result) {

		} else {

		}
		mysql_query("UPDATE MaxPersonID SET id=$id");
	} else {

	}	

		

?>

<link rel="stylesheet" type="text/css" media="all" href="searchsm.css">
<table align="center" width="650" class="searchtablesm" bgcolor="0038A8">
	<tr bgcolor="0038A8">
		<td align="center"><font color="FFFFFF">
			<form action="./addActorDirector.php" method="POST">
				Identity:
			<input type="radio" name="identity" value="Actor" checked="true">Actor
			<input type="radio" name="identity" value="Director">Director<br/>
			<input type="radio" name="identity" value="Both">Both<br/>
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
			<input type="button" value="Clear Form" onClick="this.form.reset()"/>
			</form>
			<hr/></font>
		</td>
	</tr>
</table>
</body>
</html> 

</body>
</html>