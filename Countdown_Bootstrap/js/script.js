$(function(){
	var stop = 0;
	$('.countdown').countdown({
		callback	: function(days, hours, minutes, seconds){
			
			while (days + hours + minutes + seconds + stop === 0) {
				alert("时间到！");
				stop++;
			};
			
		}
	});

});
