<html>
<body>

<?php
require($DOCUMENT_ROOT . "./menu_bar.html");

	$id= $_POST["movie"];

	$db_connection = mysql_connect("localhost", "cs143", "");
	if(!$db_connection) {
		$err_msg = mysql_error($db_connection);
		print "Connection failed: $errmsg <br/>";
		exit(1);
	}

	mysql_select_db("CS143", $db_connection);

	$result = mysql_query("SELECT * FROM Movie WHERE id = " . $id, $db_connection);
	$actor_query = "SELECT aid FROM MovieActor WHERE mid = " . $id;
	$actor = mysql_query("SELECT * FROM MovieActor WHERE mid = $id ORDER BY aid", $db_connection);
	
	$actor_info = mysql_query("SELECT * FROM Actor WHERE id in ($actor_query) ORDER BY id", $db_connection);
	$dir_info = mysql_query("SELECT * FROM Director where id in (SELECT did FROM MovieDirector where mid = $id)");
	$comment = mysql_query("SELECT * FROM Review where mid = $id");
	

?>
<title>CS 143 Movie Database</title>

<link rel="stylesheet" type="text/css" media="all" href="searchsm.css">
<table align="center" width="650" class="searchtablesm" bgcolor="0038A8">
	<tr bgcolor="0038A8">
		<td align="center" colspan="5"><font color="FFFFFF">
		<?php
		$row = mysql_fetch_assoc($result);
		echo "Title: " . $row['title'] . "<br>";
		echo "Year: " . $row['year'] . "<br>";
		echo "MPAA Rating: " . $row['rating'] . "<br>";
		echo "Company: " . $row['company'] . "<br>";
		?> 
		</font>
		</td>
	</tr>
</table>
<br/>
<table align="center" width="650" class="searchtablesm" bgcolor="0038A8">
	<tr bgcolor="0038A8">
		<td align="center" colspan="3"><font color="FFFFFF">
		Director Information
		</td>
	</tr>
	<?php
		while($row_info = mysql_fetch_assoc($dir_info)) {
			print "<tr bgcolor='0038A8'>";
			print "<td align='center'><font color='FFFFFF'>";
			print "Name: " . $row_info['first'] . " " . $row_info['last'];
			print "</td><td align='center'><font color='FFFFFF'>";
			print "DOB: " . $row_info['dob'];
			print "</td><td align='center'><font color='FFFFFF'>";
			print "DOD: " . $row_info['dod'];
			print "</td></tr>";
		}
	?>
</table>
<br/>
<table align="center" width="650" class="searchtablesm" bgcolor="0038A8">
	<tr bgcolor="0038A8">
		<td align="center" colspan="5"><font color="FFFFFF">
		Actor Information
		</td>
	</tr>
	<?php
		while($row = mysql_fetch_assoc($actor)) {
			$row_info = mysql_fetch_assoc($actor_info);
			print "<tr bgcolor='0038A8'>";
			print "<td align='center'><font color='FFFFFF'>";
			print "Name: " . $row_info['first'] . " " . $row_info['last'];
			print "</td><td align='center'><font color='FFFFFF'>";
			print "Sex: " . $row_info['sex'];
			print "</td><td align='center'><font color='FFFFFF'>";
			print "DOB: " . $row_info['dob'];
			print "</td><td align='center'><font color='FFFFFF'>";
			print "DOD: " . $row_info['dod'];
			print "</td><td align='center'><font color='FFFFFF'>";
			print "Role: " . $row['role'];
			print "</td></tr>";
		}
	?>		
</table>
<br/>
<table align="center" width="650" class="searchtablesm" bgcolor="0038A8">
	<tr bgcolor="0038A8">
		<td align="center" colspan="5"><font color="FFFFFF">
		Reviews
		</td>
	</tr>
	<?php
		while($row = mysql_fetch_assoc($comment)) {
			$row_info = mysql_fetch_assoc($comment);
			print "<tr bgcolor='0038A8'>";
			print "<td align='center'><font color='FFFFFF'>";
			print "Reviewer: " . $row_info['name'];
			print "</td><td align='center'><font color='FFFFFF'>";
			print "Time: " . $row_info['time'];
			print "</td><td align='center'><font color='FFFFFF'>";
			print "Rating: " . $row_info['time'];
			print "</td></tr><br/>";
			print "<tr bgcolor='0038A8'>";
			print "<td align='center'><font color='FFFFFF'>";
			print "Review: ";
			print "</td><td align='center'><font color='FFFFFF'>";
			print $row_info['comment'];
			print "</td></tr>";
		}
	?>
</table>

</body>
</html>