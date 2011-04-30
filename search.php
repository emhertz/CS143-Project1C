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
		<input type="radio" id="id" name="identity" value="Person" onClick="generateFields();">Person
		<input type="radio" id="id" name="identity" value="Movie" onClick="generateFields()">Movie<br/>
		</font></td>
	</tr>
	<tr bgcolor="0038A8">
		<td align="center">
		</td>
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

	var trs = tbody.getElementsByTagName('tr');
	var trUsable = trs[1];
	

	var tds = trUsable.getElementsByTagName('td');
	td = tds[0];

	var inputs = td.getElementsByTagName('form');
	var i = 0;
	while(i < inputs.length) {
		td.removeChild(inputs[i]);
	}

	if(id_value == "Person") {
		addRadio(td, "mode", "AND ", "radio");
		addRadio(td, "mode", "OR ", "radio");
		addField(td, "first", "First Name: ", "textfield");
		addField(td, "last", "Last Name: ", "textfield");
		addRadio(td, "sex", "Male", "radio");
		addRadio(td, "sex", "Female", "radio");
		addField(td, "dob", "Date of Birth: ", "textfield");
		addField(td, "dod", "Date of Death: ", "textfield");
		addSubmit(td);
		var tdH = td.innerHTML;
		td.innerHTML = "<form action='./searchDriver.php' name='searchform' method='POST'><font color='FFFFFF'><input type='hidden' name='id' value='Person'>" + tdH;
	} else {
		addRadio(td, "mode", "AND ", "radio");
		addRadio(td, "mode", "OR ", "radio");
		addField(td, "title", "Title: ", "textfield");
		addField(td, "year", "Year: ", "textfield");
		addField(td, "rating", "Rating: ", "textfield");
		addField(td, "company", "Company: ", "textfield");
		addSubmit(td);	
		var tdH = td.innerHTML;
		td.innerHTML = "<form action='./searchDriver.php' name='searchform' method='POST'><font color='FFFFFF'><input type='hidden' name='id' value='Movie'>" + tdH;
	}
}

function modifyFields(form) {
	var inputs = form.getElementsByTagName('input');
	for(var i = 0; i < inputs.length; i++) {
		if(inputs[i].className = "textfield") {
			alert(inputs[i].value);
		}
	}	
}

function addSubmit(td) {
	var inH = td.innerHTML;
	td.innerHTML = inH + "<input type='submit' value='Search'/>";
}
		

function addField(td, name, label, className) {
	var input;
	input = document.createElement('input');
	input.name = name;
	input.id = input.name;
	input.value = "";
	input.className = className;

	td.appendChild(document.createTextNode(label));
	td.appendChild(input);
	h = td.innerHTML;
	td.innerHTML = h + "<br/>";	
}

function addRadio(td, name, label, className) {
	var input;
	input = document.createElement('input');
	input.name = name;
	input.id = input.name;
	input.value = label;
	input.type = className;

	td.appendChild(document.createTextNode(label));
	td.appendChild(input);
	h = td.innerHTML;
	td.innerHTML = h + "<br/>";
}

</script>


</body>
</html>
