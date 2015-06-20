$(document).ready(function(){
	$("body").on("click", "#project_delete", function(event){
		event.preventDefault();
		var url = $(this).attr("href");
		var parentPanel = $(this).parent().parent();

		$.ajax({
			type : "GET",
			url : url,
			success: function(data){
					$(parentPanel).remove();
					$("#danger_div").html(data);
			},
			error : function(xhr,status,message){
					alert(xhr.responseText);
			}
		});
	});
});