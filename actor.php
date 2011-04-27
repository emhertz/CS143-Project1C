<html>
<body>

<?php
require($DOCUMENT_ROOT . "./menu_bar.html");

	$id= $_POST["actor"];

	$db_connection = mysql_connect("localhost", "cs143", "");
	if(!$db_connection) {
		$err_msg = mysql_error($db_connection);
		print "Connection failed: $errmsg <br/>";
		exit(1);
	}

	mysql_select_db("CS143", $db_connection);

	$result = mysql_query("SELECT * FROM Actor WHERE id = " . $id, $db_connection);
	if(!$result) {
		$message = "Invalid query: " . mysql_error() . "\n";
		die($message);
	}

?>
<title>CS 143 Movie Database</title>

<link rel="stylesheet" type="text/css" media="all" href="searchsm.css">
<table align="center" width="650" class="searchtablesm" bgcolor="0038A8">
	<tr bgcolor="0038A8">
		<td align="center"><font color="FFFFFF">
		<?php
		$row = mysql_fetch_assoc($result);
		echo "Name: " . $row['first'] . " " . $row['last'] . "<br>";
		?> 
		</font>
		</td>
	</tr>
</table>

</body>
</html>