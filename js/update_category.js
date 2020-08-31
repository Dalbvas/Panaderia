
        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/
        $(document).ready(function () {

            // validate signup form on keyup and submit
            $("#form1").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 200
                    },
                    address: {
                        minlength: 3,
                        maxlength: 500
                    }
                },
                messages: {
                    name: {
                        required: "Ingrese Categoria",
                        minlength: "Categoria minimo 3 caracteres"
                    },
                    address: {
                        minlength: "Category Discription must be at least 3 characters long",
                        maxlength: "Category Discription must be at least 3 characters long"
                    }
                }
            });

        });

 


