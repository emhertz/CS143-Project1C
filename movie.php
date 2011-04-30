<html>
<body link="FFFFFF" alink="FFFFFF" vlink="FFFFFF">

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

	$result = @mysql_query("SELECT * FROM Movie WHERE id = " . $id, $db_connection);
	$actor_query = "SELECT aid FROM MovieActor WHERE mid = " . $id;
	$actor = @mysql_query("SELECT * FROM MovieActor WHERE mid = $id ORDER BY aid", $db_connection);
	
	$actor_info = @mysql_query("SELECT * FROM Actor WHERE id in ($actor_query) ORDER BY id", $db_connection);
	$dir_info = @mysql_query("SELECT * FROM Director where id in (SELECT did FROM MovieDirector where mid = $id)");
	$comment = @mysql_query("SELECT * FROM Review where mid = $id");
	
	$average_rank = @mysql_query("SELECT AVG(rating) AS rating from Review where mid = " . $id);
	$rank_result = @mysql_fetch_assoc($average_rank);
	$avg = $rank_result['rating'];
	if(!$avg) {
		$avg = 0;
	}
?>

<script type='text/javascript'>

function sendForm1(form, id) {
	form.addChild(document.createTextNode("<input type='hidden' name='actor' value='id'>"));
	alert(id);
	form.submit();
	return false;
}

</script>

<title>CS 143 Movie Database</title>

<link rel="stylesheet" type="text/css" media="all" href="searchsm.css">

<table align="center" width="650" class="searchtablesm" bgcolor="0038A8">
	<tr bgcolor="0038A8">
		<td align="center" colspan="5"><font color="FFFFFF">
		<?php
		$row = @mysql_fetch_assoc($result);
		echo "Title: " . $row['title'] . "<br>";
		echo "Year: " . $row['year'] . "<br>";
		echo "MPAA Rating: " . $row['rating'] . "<br>";
		echo "Company: " . $row['company'] . "<br>";
		echo "Average Rank: " . $avg . "<br>";
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
	<tr bgcolor="0038A8">
		<td align='center'><font color='FFFFF'>
		Name
		</td>
		<td align='center'><font color='FFFFF'>
		DOB
		</td>
		<td align='center'><font color='FFFFF'>
		DOD
		</td>
	</tr>
	<?php
		while($row_info = @mysql_fetch_assoc($dir_info)) {
			print "<tr bgcolor='0038A8'>";
			print "<td align='center'><font color='FFFFFF'>";
			print $row_info['first'] . " " . $row_info['last'];
			print "</td><td align='center'><font color='FFFFFF'>";
			print $row_info['dob'];
			print "</td><td align='center'><font color='FFFFFF'>";
			print $row_info['dod'];
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
	<tr bgcolor="0038A8">
		<td align='center'><font color='FFFFF'>
		Name
		</td>
		<td align='center'><font color='FFFFF'>
		Sex
		</td>
		<td align='center'><font color='FFFFF'>
		DOB
		</td>
		<td align='center'><font color='FFFFF'>
		DOD
		</td>
		<td align='center'><font color='FFFFF'>
		Role
		</td>
	</tr>
	<?php
		while($row = @mysql_fetch_assoc($actor)) {
			$row_info = @mysql_fetch_assoc($actor_info);
			$id = $row_info['id'];
			$form_name = "actorForm" . $id;
			print "<tr bgcolor='0038A8'>";
			print "<form name='$form_name' method='POST' action='./actor.php'>";
			print "<input type='hidden' name='actor' value='$id'>";
			print "<td align='center'><font color='FFFFFF'>";
			print "<a href='#' onclick='document.$form_name.submit();return false;'>".$row_info['first'] . " " . $row_info['last'];
			print "</a></td><td align='center'><font color='FFFFFF'>";
			print $row_info['sex'];
			print "</td><td align='center'><font color='FFFFFF'>";
			print $row_info['dob'];
			print "</td><td align='center'><font color='FFFFFF'>";
			print $row_info['dod'];
			print "</td><td align='center'><font color='FFFFFF'>";
			print $row['role'];
			print "</td></form></tr>";
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
	<form name="reviewForm" method="POST" action="./addComment.php">
	<?php
		print "<input type='hidden' name='movie' value='$id'/>";
		while($row_info = @mysql_fetch_assoc($comment)) {
			print "<tr bgcolor='0038A8'>";
			print "<td align='center'><font color='FFFFFF'>";
			print "Reviewer: " . $row_info['name'];
			print "</td><td align='center'><font color='FFFFFF'>";
			print "Time: " . $row_info['time'];
			print "</td><td align='center'><font color='FFFFFF'>";
			print "Rating: " . $row_info['rating'];
			print "</td></tr><br/>";
			print "<tr bgcolor='0038A8'>";
			print "<td align='center'><font color='FFFFFF'>";
			print "Review: ";
			print "</td><td align='center'><font color='FFFFFF'>";
			print $row_info['comment'];
			print "</td></tr>";
		}
	?>
	<tr bgcolor="0038A8">
		<td align="right" colspan="3"><font color="FFFFFF">
		<input type="submit" value="Add a comment!"/>
		</td>
	</tr>
	</form>
</table>

</body>
</html>