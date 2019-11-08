
  
        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/

        $(document).ready(function () {

            // validate signup form on keyup and submit
            $("#login-form").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 3
                    },
                    password: {
                        required: true,
                        minlength: 3
                    }
                },
                messages: {
                    username: {
                        required: "Ingrese Usuario",
                        minlength: "Debe constar de minimo 3 caracteres"
                    },
                    password: {
                        required: "Ingrese Contraseña",
                        minlength: "Your password must be at least 3 characters long"
                    }
                }
            });

        });

