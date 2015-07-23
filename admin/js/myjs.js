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

        $('body').on('click', '#for_page_list_element', function(event){
            event.preventDefault();
            
            var forPage = $(this).text();
            var coverImage = $(this).next().val();
            var coverHeading = $(this).next().next().val();
            var coverSubHeading = $(this).next().next().next().val();
            $('#for_page_input').val(forPage);
            $('#cover_image_input').val(coverImage);
            $('#cover_heading_input').val(coverHeading);
            $('#cover_subheading_input').val(coverSubHeading);
        });
        
        $('body').on('click','#delete_layout_link', function(event){
            event.preventDefault();
            var url = $(this).attr('href');
            var row = $(this).parent().parent(); 
            
            $.ajax({
                url: url,
                type: "GET",
                success: function(response){
                    if(response==true){
                        row.remove();
                    }
                },
                error: function(xhr,status,msg){
                    console.log(xhr.responseText);
                }
            })
        })

	// $("#blog_compose_form").submit(function(event){
	// 	event.preventDefault();

	// 	var url = $(this).attr("action");
	// 	var data = $(this).serialize();

	// 	$.ajax({
	// 		url : url,
	// 		type : "POST",
	// 		data : data,
	// 		success : function(data){
	// 			console.log(data);
	// 		},
	// 		error : function(xhr,status,msg){
	// 			console.log(xhr.responseText);
	// 		}
	// 	});
	// });
CKEDITOR.replace('content');
});

function previewText(){
    var text = $("#about").val();
    console.log(text);
//    text = $.parseHTML(text);
//        console.log(text[0].data);
    $("#preview_pane").html("<p>"+text+"</p>");
}
