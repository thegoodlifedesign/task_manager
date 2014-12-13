$(function(){
    acceptTask();
    completeTask();
});

function completeTask()
{
    $('.complete-task').click(function(e){
        e.preventDefault();

        var id = $(this).attr("id");

        $.post( "http://localhost:8000/task/"+id, { "id": id})
            .done(function( data ) {
                console.log( "Data Loaded: " + data );
            });
    });
}

function acceptTask()
{
    $('.accept-task').click(function(e){

        e.preventDefault();

        var id = $(this).attr("id");

        $(this).parent().css({"display": "none"});

        $.post( "http://104.131.100.178/rodzzlessa/assigned-task", { "id": id})
            .done(function( data ) {
                console.log( "Data Loaded: " + data );
            });
        });
}

