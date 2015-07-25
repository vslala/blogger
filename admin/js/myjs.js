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
        });
        
        $('#layout_form').submit(function(event){
            event.preventDefault();
            
            var url = $(this).attr('action');
            var data = $(this).serialize();
            var dataArray = $(this).serializeArray();
            var type = "POST";
            var new_div = $('<div></div>');
            var layout_form_div = $('#layout_form_div');
            var available_layouts_list = $('#available_layouts_list');
            layout_form_div.prepend(new_div);
            
            $.ajax({
                url: url,
                data: data,
                type: type,
                success: function(response){
                    if(response == true){        
                        var html_string = '<span style="font-family: tahoma, sans-serif; font-weight: bolder; color: green;" class="alert alert-success">'+
                                'Layout Set Successful'+
                                '</span>';
                        new_div.html(html_string);
                        console.log(dataArray);
                        var html_string = '<li>' +
                        '<span class="pull-right"><a href="php/delete.php?for=' +dataArray[0].value+'" id="delete_layout_link">delete</a></span>' +
                        '<a href="#" id="for_page_list_element">'+dataArray[0].value+'</a>' +
                        '<input type="hidden" value="'+dataArray[1].value+'">' +
                        '<input type="hidden" value="'+dataArray[2].value+'">' +
                        '<input type="hidden" value="'+dataArray[3].value+'">' +
                        '</li>';
                        available_layouts_list.append(html_string);
                    }else{
                        var html_string = '<span style="font-family: tahoma, sans-serif; font-weight: bolder; color: crimson;" class="alert alert-danger">'+
                                'There was some error setting the layout'+
                                '</span>';
                        new_div.html(html_string);
                    }
                },
                error: function(xhr, status, message){
                    console.log("Error: "+xhr.responseText);
                }
            });
        });

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
