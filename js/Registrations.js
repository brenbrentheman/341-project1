/*
        Brennan Jackson
        Project 1
        ISTE-341
        October 2019
        Registrations Event Handler
    */

    /*Add event listeners for the different buttons*/
    $("#unregister-event").on("click", function(){
        let event = $("#userEvents").val();
        if(event !== null && event !== ""){
            let dataPHP = {"unregister-event":[{"action":"remove", "eventID":event}]};
            $.ajax({url:"./form_handlers/Registration_Form_Handler.php", type: "POST", data: dataPHP, success: 
                function(data){
                    if(data > 0) {

                        /*Since the user is no longer going to the event unregister all sessions for that event*/
                        $("option[data-eventForSession='"+event+"']").each(function(){
                            unregisterSession($(this).val(), event);
                        });
                        $("#userSessions").prop("selectedIndex", 0);

                        /*Let the user know it was successful*/
                        $("#userEvents option[value="+event+"]").remove();
                        $("#userEvents").prop("selectedIndex", 0);
                        $("#unregister-event").after("<span class='success-alert'>Event unregistered successfully!</span>");
                    } else {
                        $("#unregister-event").after("<span class='error'>Something went wrong removing your registration!</span>");
                    }
                }
            });
        } else {
            $("#unregister-event").after("<span class='error'>No Event Selected!</span>");
        }
    });

    $("#add-event").on("click", function(){
        
    });

    $("#unregister-session").on("click", function(){
        
    });

    $("#add-session").on("click", function(){
        
    });

    /*This function is used since 2 of the action listeners unregister sessions*/
    function unregisterSession(sessionID, eventID){
        /*WE ARE REMOVING SESSIONS */
    }