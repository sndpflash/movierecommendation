$(document).ready(function(){

    $("#search").keypress(function(){

        
        $.ajax({
            
            type:'POST',
            url:'http://localhost/MVC/Pages/liveSearch',
            data:{
                name:$("#search").val(),
            },

            success:function(data){
                $("#livesearch").html(data);
            }

        });
    });

});