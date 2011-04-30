<html>
<body link="FFFFFF" alink="FFFFFF" vlink="FFFFFF">

<?php
require($DOCUMENT_ROOT . "./menu_bar.html");

	$id= $_REQUEST["actor"];

	$db_connection = mysql_connect("localhost", "cs143", "");
	if(!$db_connection) {
		$err_msg = mysql_error($db_connection);
		print "Connection failed: $errmsg <br/>";
		exit(1);
	}

	mysql_select_db("CS143", $db_connection);

	$result = @mysql_query("SELECT * FROM Actor WHERE id = " . $id, $db_connection);
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
			
			$row = @mysql_fetch_assoc($result);
			echo "Name: " . $row['first'] . " " . $row['last'] . "<br>";
			echo "Sex: " . $row['sex'] . "<br>";
			echo "DOB: " . $row['dob'] . "<br>";
			echo "DOD: " . $row['dod'] . "<br>";
			
			$roles = @mysql_query("SELECT role, title, id FROM Movie, MovieActor where aid = ". $id . " and mid = id", $db_connection);
			if (!$roles) {
				$message = "Invalid query: " . mysql_error() . "\n";
				die($message);
			}

			echo "<br/><br/>";
			echo "<table align='center' class='searchtablesm' width='500'>";
			
			$i = 0;
			print "<tr align='center'><td><font color='FFFFFF'><u>Role</u></font></td><td><font color='FFFFFF'><u>Movie</u></font></td></tr>";
				
			while ($movie_row = @mysql_fetch_row($roles)) {
				print "<tr align='center'>";
				$curr_id = $movie_row[2];
				$form_name = "movieForm" . $curr_id; 
				print "<form name='$form_name' method='POST' action='./movie.php'>";
	
				$i = 0;
				while ($i < @mysql_num_fields($roles)) {
					if ($movie_row[$i] == "") {
						print "<td>N/A</td>";
					} else if( $i == 1 ){
						print "<td><font color='FFFFFF'><a href='#' onclick='document.$form_name.submit();return false;'>" . $movie_row[$i] . "</a></font></td>";
					} else {
						if( $i == 2 ) {
							print "<input type='hidden' name='movie' value='".$movie_row[$i]."'/>";
						} else {
							print "<td><font color='FFFFFF'>" . $movie_row[$i] . "</a></font></td>";
						}
					}
					$i++;
				}
				print "</form></tr>\n";
			}
		?> 
		</font>
		</td>
	</tr>
</table>

</body>
</html>