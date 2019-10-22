/*
        Brennan Jackson
        Project 1
        ISTE-341
        October 2019
        Admin JS
    */

    var buildInput = function(type) {
        var output = $("<input>")
            .attr("type", "hidden")
            .attr("name", "action").val(type);
        return output;
    }

    /*Events*/
    /*Add event - Append the action value to the parameters and submit the form*/
    $("#add-event").on("click", function(){
        //client side validation
        if($("#eventName-add").val() && $("select[name='venue-add']").val() && $("#eventStartDate-add").val() && $("#eventEndDate-add").val() && $("#eventCapacity-add").val()) {
            var input = buildInput("add");
            $('#event-form').append(input);
            $("#event-form").submit();
        }
    });

    //update event
    $("#update-event").on("click", function(){
        var input = buildInput("update");
        $('#event-form').append(input);
        $("#event-form").submit();
    });

    //delete event
    $("#delete-event").on("click", function(){
        var input = buildInput("delete");
        $('#event-form').append(input);
        $("#event-form").submit();
    });

    //add user to event
    $("#add-event-user").on("click", function(){
        var input = buildInput("add-user");
        $('#event-form').append(input);
        $("#event-form").submit();
    });

    //remove user from event
    $("#remove-event-user").on("click", function(){
        var input = buildInput("remove-user");
        $('#event-form').append(input);
        $("#event-form").submit();
    });

    /*Sessions*/
    //add session
    $("#add-session").on("click", function(){
        var input = buildInput("add");
        $('#session-form').append(input);
        $("#session-form").submit();
    });

    //update session
    $("#update-session").on("click", function(){
        var input = buildInput("update");
        $('#session-form').append(input);
        $("#session-form").submit();
    });

    //delete session
    $("#delete-session").on("click", function(){
        var input = buildInput("delete");
        $('#session-form').append(input);
        $("#session-form").submit();
    });

    //add user to session
    $("#add-session-user").on("click", function(){
        var input = buildInput("add-user");
        $('#session-form').append(input);
        $("#session-form").submit();
    });
    $("#remove-session-user").on("click", function(){
        var input = buildInput("remove-user");
        $('#session-form').append(input);
        $("#session-form").submit();
    });



    