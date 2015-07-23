$(document).ready(function(){ 
    base_url = "http://varunshrivastava.azurewebsites.net/";
    
    
    $("#comment_form").submit(function(event){
        event.preventDefault();
        var url = base_url + "postAjax.php";
        var data = $(this).serialize();
        var commentSection = $("#comment_section");
        var commentBox = $("#comment_box");
        var commentValue = $(commentBox).val();
        $(commentBox).val('');
        console.log(url);
        $.ajax({
            url : url,
            type : "POST",
            data : data,
            success : function(data){
                var data = $.parseJSON(data);
                console.log(data[0].username);
                $(commentSection).append('<div class="form-group comment-group"><div class="container">'+
                '<div class="row">'+
                    '<div class="col-md-2 username-text"><u>'+ data[data.length-1].username +'</u></div>'+
                    '<div class="col-md-10 help-block"><span class="time">created at: '+ data[data.length - 1]['created_at'] +'</span></div>'+
               ' </div>'+
                '<div class="row">'+
                    '<div class="col-md-6 comment-text">'+ data[data.length - 1]['comment'] +'</div>'+
                '</div>'+
            '</div>'+
        '</div>');
            },
            error : function(xhr,status,msg){
                $(commentBox).val(commentValue);
            }
        });
    });
    
    $("body").on("click","#deleteComment",function(event){
        event.preventDefault();
        var url=$(this).attr("href");
        var deleteComment = $(this).parent().parent().parent().parent();
        $(deleteComment).html('<img src="http://www.srisangworn.go.th/loading.gif" class="img img-responsive img-rounded" style="height: 100px;"/>');
        
        $.ajax({
            url : url,
            type : 'GET',
            success : function(data){
                $(deleteComment).remove();
            },
            error : function(xhr,status,message){
                console.log(xhr.responseText);
                alert("ERROR: ");
            }
            
        });
    });
    
    $('#contactForm').submit(function(event){
        event.preventDefault();
        
        var url = $(this).attr('action');
        var data = $(this).serialize();
        var new_div = $('<div></div>');
        var contact_div = $('#contact_div');
        
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            success: function(response){
                if(response==true){
                    contact_div.append(new_div);
                    new_div.html('<span class="alert alert-success" style="font-family: tahoma, sans-serif; font-weight: bolder; color: green;">Mail has been sent successfully.');
                }else{
                    contact_div.append(new_div);
                    new_div.html('<span class="alert alert-danger" style="font-family: tahoma, sans-serif; font-weight: bolder; color: red;">Mail has been sent successfully.</span>');
                }
            },
            error: function(xhr, status, msg){
                console.log(xhr.responseText);
            }
        })
    })
});
