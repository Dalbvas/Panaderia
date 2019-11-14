/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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
                        minlength: "Categoria debe contener minimo 3 caracteres"
                    },
                    address: {
                        minlength: "Description debe contener minimo 3 caracteres",
                        maxlength: "Description debe contener minimo 3 caracteres"
                    }
                }
            });

        });

   

