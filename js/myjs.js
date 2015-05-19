$(document).ready(function(){ 
    base_url = "http://localhost/blogger/";
    
    
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
});
