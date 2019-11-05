        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/
         $(document).ready(function () {
             
            $("#item").blur(function () 
            {
                document.getElementById('total').value = document.getElementById('cost').value * document.getElementById('quty').value
            
            $("#item").blur(function () 
            {


                $.post('check_item_details.php', {stock_name1: $(this).val()},
                    function (data) {
                        //$("#cost").val(data.cost);
                        $("#sell").val(data.sell);
                        $("#stock").val(data.stock);
                        //$('#guid').val(data.guid);
                        if (data.cost != undefined)
                            $("#0").focus();


                    }, 'json');


            });
           $("#quty").blur(function () {
                if (document.getElementById('item').value == "") {
                    document.getElementById('item').focus();
                }
            });
            $("#supplier").blur(function () {


                $.post('check_customer_details.php', {stock_name1: $(this).val()},
                    function (data) {

                        $("#address").val(data.address);
                        $("#contact1").val(data.contact1);

                        if (data.address != undefined)
                            $("#0").focus();

                    }, 'json');


            });   





            $("#supplier").autocomplete("customer1.php", {
                width: 160,
                autoFill: true,
                selectFirst: true
            });
            $("#item").autocomplete("stock.php", {
                width: 160,
                autoFill: true,
                selectFirst: true
            });
            // validate signup form on keyup and submit
            $("#form1").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 200
                    },
                    stockid: {
                        required: true,
                        minlength: 3,
                        maxlength: 200
                    },
                    /*cost: {
                        required: true,

                    },
                    sell: {
                        required: true,

                    } */
                },
                messages: {
                    name: {
                        required: "Ingrese Cliente",
                        minlength: "El nombre del stock debe constar de al menos 3 caracteres" 
                    },
                    stockid: {
                        required: "Por favor introduzca el ID del Stock",
                        // minlength: "Category Name must consist of at least 3 characters"
                    },
                    sell: {
                        required: "Ingrese el precio de venta",
                    },
                    cost: {
                        required: "Ingrese el precio del costo",
                    }
                }
            });

        });

        function numbersonly(e) 
        {
            var unicode = e.charCode ? e.charCode : e.keyCode
            if (unicode != 8 && unicode != 46 && unicode != 37 && unicode != 38 && unicode != 39 && unicode != 40 && unicode != 9) 
            { 
                if (unicode < 48 || unicode > 57)
                    return false
            }
        }
    });