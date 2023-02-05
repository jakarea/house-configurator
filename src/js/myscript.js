window.addEventListener("load", function() {

	// store tabs variables
	var tabs = document.querySelectorAll("ul.nav-tabs > li");

	for (var i = 0; i < tabs.length; i++) {
		tabs[i].addEventListener("click", switchTab);
	}

	function switchTab(event) {
		event.preventDefault();

		document.querySelector("ul.nav-tabs li.active").classList.remove("active");
		document.querySelector(".tab-pane.active").classList.remove("active");

		var clickedTab = event.currentTarget;
		var anchor = event.target;
		var activePaneID = anchor.getAttribute("href");

		clickedTab.classList.add("active");
		document.querySelector(activePaneID).classList.add("active");

	}

	// If form on change then alert value
	document.getElementById("calculate_01").onchange = function() {
		// get value of square_meters
		var square_meters = document.getElementById("square_meters").value;
		// if square_meters is empty and less then 20 then add error class with next input field and show error message also if square_meters is not empty and greater then 20 then remove error class with next input field and hide error message
		if (square_meters == "" || square_meters < 20) {
			alert("Please enter a value greater than 20");
		}
		else {
			alert("Thank you for entering a value greater than 20");
		}
		// get value of square_feet
	};

});