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

$(document).ready(function(){

    $("#chooseMovie").keypress(function(){


        $.ajax({
            
            type:'POST',
            url:'http://localhost/MVC/dashboard/liveSearchForChooseMovie',
            data:{
                name:$("#chooseMovie").val(),
            },

            success:function(data){
                $("#liveSearchForChooseMovie").html(data);
            }

        });
    });

});









function liveSearchTitle(title){
    
  //  $("#search").val(title);
    $("#search").val(title);    
    $("#mainSearch").submit();
    
}

function loadMovies(){

  

    
    var e = document.getElementById("selectLiveSearch");
    var movieTitle = e.options[e.selectedIndex].value
    
    var x = document.getElementById("selectedMovies");

    var option = document.createElement("option");
    option.value = movieTitle;
    option.innerHTML=movieTitle;
    option.id=movieTitle;
    x.add(option);
    option.innerHTML = movieTitle;
   
    $.ajax({
   
        type: "GET",
        url:'http://localhost/MVC/dashboard/getTags?movie=' + movieTitle,
        contentType: "application/json",
        dataType: 'json',
        
        
        
        success:function(response){
                // for(var i=0; i<response.length; i++){
                //     $("#returnedtags").append("<option>"+response[i].tags +"</option>");
                // }

                // for(var i=0; i<response.length; i++){
                //     $("#returnedtags").append("<li class='list-group-item'  value='"+response[i].tags +"'>" +response[i].tags +"<input type='hidden' name = 'tagshiddenfield'  value='"+response[i].tags +"'> <i class='fas fa-trash pl-4' id = 'removeButton'></i></li>");
                // }
                var idforDiv = movieTitle.split(" ");
                idforDiv = idforDiv[0];
                $("#returnedtags").append("<div id = '"+idforDiv+"tags'> </div>");
                // if(response == undefined){
                //     $("#returnedtags").append("<div id = 'warning'>No Tags found select more movies </div>");

                // }
                for(var i=0; i<response.length; i++){

                    $("#"+idforDiv+"tags").append("<input class='form-check-input' type = 'checkbox' name = 'moviesTag[]' value='"+response[i].tags +"'>" +response[i].tags+ "<br>"); 
                }
    

    
         
             
        }

    });
   
}

function removeSelectedMovieItem(){
    
    var x = document.getElementById("selectedMovies");
    var id = x[x.selectedIndex].id;
    var element = document.getElementById("returnedtags"); //parent element
    x.remove(x.selectedIndex);


    var idforDiv = id.split(" ");
    idforDiv = idforDiv[0]+"tags";
    document.getElementById(idforDiv).remove();

      



}

