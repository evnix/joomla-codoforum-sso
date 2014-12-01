jQuery(document).ready(function($) {

    //check if user is logged in codoforum
    if (codo_defs.logged_in === 'no') {
        //check if user is logged in master site
        // Using YQL and JSONP
        $.ajax({
            url: codo_defs.get('sso_get_user_path'),
            // the name of the callback parameter, as specified by the YQL service
            jsonp: "callback",
            // tell jQuery we're expecting JSONP
            dataType: "jsonp",
            // tell YQL what we want and that we want JSON
            data: {
                format: "json",
                client_id: codo_defs.get('sso_client_id'),
                timestamp: codo_defs.time,
                token: codo_defs.get('sso_token')
            },
            // work with the response
            success: function(response) {

                if (response.name) {
                    //$('#codo_login_link').append(" - " + response.name).click(function() {

                        CODOF.authenticator.login();

                        return false;
                    //});
                }

            }

        });

        if (codo_defs.get('sso_auto_login') === 'yes') {

            CODOF.authenticator.login();
        }

    }



    /*$('#codo_login').on('click', function() {
     
     //CODOF.authenticator.sso();
     window.location.href = codo_defs.get('sso_login_user_path');
     });*/

     $('#codo_login_with_sso').on('click', function() {
         
          window.location.href = codo_defs.get('sso_login_user_path');  
     });

});




CODOF.authenticator = {
    login: function() {

        $('.codo_login_loading').show();
        $.ajax({
            url: codo_defs.get('sso_get_user_path'),
            // the name of the callback parameter, as specified by the YQL service
            jsonp: "callback",
            // tell jQuery we're expecting JSONP
            dataType: "jsonp",
            // tell YQL what we want and that we want JSON
            data: {
                format: "json",
                client_id: codo_defs.get('sso_client_id'),
                timestamp: codo_defs.time,
                token: codo_defs.get('sso_token')
            },
            success: function(response) {

                if (response.name) {
                    jQuery.post(codo_defs.url + 'sso/authorize', {
                        name: response.name,
                        mail: response.mail,
                        token: codo_defs.token
                    }, function(response) {

                        if(response !== "error")
                        window.location.reload();
                    });
                } else {

                    //alert("user has been logged out in another window");
                    //window.location.reload();
                }
            }
        });

    },
    sso: function() {

        $.ajax({
            url: codo_defs.get('sso_login_user_path'),
            // the name of the callback parameter, as specified by the YQL service
            jsonp: "callback",
            // tell jQuery we're expecting JSONP
            dataType: "jsonp",
            // tell YQL what we want and that we want JSON
            data: {
                format: "json",
                username: $.trim($('#name').val()),
                password: $.trim($('#pass').val()),
                client_id: codo_defs.get('sso_client_id'),
                timestamp: codo_defs.time,
                token: codo_defs.get('sso_token')
            },
            success: function(response) {

                if (response.name) {
                    jQuery.post(codo_defs.url + 'sso/authorize', {
                        name: response.name,
                        mail: response.mail,
                        token: codo_defs.token
                    }, function() {

                        window.location.href = codo_defs.url + 'user/profile';
                    });
                } else {

                    alert(response); //response must include relevant error
                }
            }
        });


    }
};
