window.onload = initForms;
//Initial
function initForms() {
	for (var i=0; i< document.forms.length; i++) {
		document.forms[i].onsubmit = function() {
				return validForm();
				

		}
	}
}
//Validate text input
function validForm() {
	var allGood = true;
	var allTags = document.getElementsByTagName("*");
//Traverse entire array of input  fields
	for (var i=0; i<allTags.length; i++) {
		if (!validTag(allTags[i])) {
			allGood = false;
		}
	}
	return allGood;
	

	function validTag(thisTag) {
		var outClass = "";
		var allClasses = thisTag.className.split(" ");
	
		for (var j=0; j<allClasses.length; j++) {
			outClass += validBasedOnClass(allClasses[j]) + " ";
		}
	
		thisTag.className = outClass;
	
		if (outClass.indexOf("invalid") > -1) {
			thisTag.focus();
			if (thisTag.nodeName == "INPUT") {
			 thisTag.select();
			 alert("You have not filled in all required inputs");

			}
			return false;
		}
		return true;
		
		function validBasedOnClass(thisClass) {
			var classBack = "";
		
			switch(thisClass) {
				case "":
				case "invalid":
					break;
				case "reqd":
					if (allGood && thisTag.value == "") classBack = "invalid ";
					classBack += thisClass;
					break;
				default:
					classBack += thisClass;
			}
			return classBack;
		}
	}
}