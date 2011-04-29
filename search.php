<html>
<body>

<?php
require($DOCUMENT_ROOT . "./menu_bar.html");
?>
<title>CS 143 Movie Database</title>


<link rel="stylesheet" type="text/css" media="all" href="searchsm.css">
<table align="center" width="650" class="searchtablesm" bgcolor="0038A8">
	<tbody id="tblBody">
	<tr bgcolor="0038A8">
		<td align="center"><font color="FFFFFF">
		<input type="radio" id="id" name="identity" value="Person" onClick="generateFields()">Person
		<input type="radio" id="id" name="identity" value="Movie" onClick="generateFields()">Movie<br/>
		</font></td>
	</tr>
	</tbody>
</table>

<script type="text/javascript">

function generateFields() {
	var id_element = document.getElementsByName('identity');
	var id_value;
	for(var i=0; i < id_element.length; i++) {
		if(id_element[i].checked) {
			id_value = id_element[i].value;
		}
	}
	var tbody = document.getElementById('tblBody');
	var ctr = tbody.getElementsByTagName('input').length + 1;
	var input;

	if(id_value == "Person") {
		addField(tbody, ctr, "first", "First Name: ", "textfield");
		addField(tbody, ctr, "last", "Last Name: ", "textfield");
	} else {
		<!-- Add Movie stuff here -->
	}
}

<!-- name is the element name, label is the displayed label, className is the type of element to add -->
function addField(tbody, ctr, name, label, className) {
	var input;
	input = document.createElement('input');
	input.name = name;
	input.id = input.name;
	input.value = "";
	input.className = className;
	var cell = document.createElement('td');
	cell.align = "center";
	cell.innerHTML = "<font color='FFFFFF'>"+label+"</font>";
	cell.appendChild(input);
	var row = document.createElement('tr');
	row.appendChild(cell);
	tbody.appendChild(row);
}

</script>


</body>
</html>
