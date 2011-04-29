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
			$submit = $_POST["submit"];
			
			$row = mysql_fetch_assoc($result);
			echo "Name: " . $row['first'] . " " . $row['last'] . "<br>";
			
			$roles = mysql_query("SELECT role, title FROM MovieActor MA, Movie M WHERE aid = " . $id . " AND mid = id", $db_connection);
			if (!$roles) {
				$message = "Invalid query: " . mysql_error() . "\n";
				die($message);
			}

			echo "<br/><br/>";
			echo "<table align='center' class='searchtablesm' width='500'>";
			
			$i = 0;
			print "<tr align='center'><td><font color='FFFFFF'><u>Role</u></font></td><td><font color='FFFFFF'><u>Movie</u></font></td></tr>";
				
			while ($movie_row = mysql_fetch_row($roles)) {
				print "<tr align='center'>";
				$i = 0;
				while ($i < mysql_num_fields($roles)) {
					if ($movie_row[$i] == "")
						print "<td>N/A</td>";
					else
						print "<td><font color='FFFFFF'>" . $movie_row[$i] . "</font></td>";
					$i++;
				}
				print "</tr>\n";
			}
		?> 
		</font>
		</td>
	</tr>
</table>

</body>
</html>