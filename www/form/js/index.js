$("#tabs").on("click", "a", function(){
	var me = $(this);

	$(".active").removeClass("active");
	me.addClass("active");
	var currentDivID = me.attr("id").replace("tab", "container");
	$("#" + currentDivID).addClass("active");
	if (currentDivID == "containerLogin") {
		$("#" + currentDivID).css({
			height: "263px"
		});
	} else if (currentDivID == "containerRegister") {
		$("#" + currentDivID).css({
			height: "360px"
		});
	}
	return false;
});