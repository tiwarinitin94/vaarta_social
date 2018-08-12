$(document).ready(function(){
    /*post message via ajax*/
    $("#reply").on("click", function(){
        var message = $.trim($("#post").val()),
            conversation_id = $.trim($("#conversation_id").val()),
            user_id = $.trim($("#user_id").val()),
            post_pic = $.trim($("#post_pic").val()),
            error = $("#error");
 
        if((message != "") && (conversation_id != "") && (user_id != "")){
            error.text("Sending...");
            $.post("post_message_ajax.php",{message:message,conversation_id:conversation_id,user_id:user_id,post_pic:post_pic}, function(data){
                error.text(data);
                //clear the message box
                $("#message").val("");
            });
        }
    });
 
 
    //get message
    c_id = $("#conversation_id").val();
    //get new message every 2 second
    setInterval(function(){
        $(".display-message").load("get_message_ajax.php?c_id="+c_id);
    }, 2000);
 
    $(".display-message").scrollTop($(".display-message")[0].scrollHeight);
});