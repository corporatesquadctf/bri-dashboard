$(window).load(function() {

	$("#globalRate").on("change", function() {
		var myArray = [
			"Fitch_A",
			"Fitch_BBB",
			"S&P_A",
			"S&P_BBB",
			"Moody`s_A1",
			"Moody`s_A2",
			"Moody`s_A3",
			"Moody`s_Ba1",
			"Moody`s_Ba2",
			"Moody`s_Ba3"
		];
		var globalRateId 	= $("#globalRate option:selected").text();
		// console.log(globalRateId);
		if ($.inArray(globalRateId, myArray) != -1) {
			$("#globalRateDesc").val("Investment Grade");
		} else {
			$("#globalRateDesc").val("Junk");
		}
	});

	// GROUP OVERVIEW
   
});