/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/
         $(document).ready(function () {
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
                    cost: {
                        required: true,

                    },
                    sell: {
                        required: true,

                    }
                },
                messages: {
                    name: {
                        required: "Ingrese Cliente",
                        minlength: "Stock Name must consist of at least 3 characters"
                    },
                    stockid: {
                        required: "Please Enter Stock ID",
                        // minlength: "Category Name must consist of at least 3 characters"
                    },
                    sell: {
                        required: "Please Enter Selling Price",
                    },
                    cost: {
                        required: "Please Enter Cost Price",
                    }
                }
            });

        });
        function numbersonly(e) {
            var unicode = e.charCode ? e.charCode : e.keyCode
            if (unicode != 8 && unicode != 46 && unicode != 37 && unicode != 38 && unicode != 39 && unicode != 40 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
                if (unicode < 48 || unicode > 57)
                    return false
            }
        }
<<<<<<< HEAD
=======
    }
    discount_amount();
}
function total_amount() {
    balance_amount();
    
    if (document.getElementById('stock').value >= parseInt(document.getElementById('quty').value)) {

        document.getElementById('total').value = document.getElementById('sell').value * document.getElementById('quty').value
        document.getElementById('posnic_total').value = document.getElementById('total').value;
        //  document.getElementById('total').value = '$ ' + parseFloat(document.getElementById('total').value).toFixed(2);
        if (document.getElementById('item').value === "") {
            document.getElementById('item').focus();
        }
    }
}
function edit_stock_details(id) {
    document.getElementById('item').value = document.getElementById(id + 'st').value;
    document.getElementById('quty').value = document.getElementById(id + 'q').value;
    document.getElementById('sell').value = document.getElementById(id + 's').value;
    document.getElementById('stock').value = document.getElementById(id + 'p').value;
    document.getElementById('total').value = document.getElementById(id + 'to').value;

    document.getElementById('guid').value = id;
    document.getElementById('edit_guid').value = id;

}
function unique_check() {
    if (!document.getElementById(document.getElementById('guid').value) || document.getElementById('edit_guid').value == document.getElementById('guid').value) {
        return true;

    } else {

        alert("This Item is already added In This Purchase");
        document.getElementById('item').focus();
        document.getElementById('quty').value = "";
        document.getElementById('sell').value = "";
        document.getElementById('stock').value = "";
        document.getElementById('total').value = "";
        document.getElementById('item').value = "";
        document.getElementById('guid').value = "";
        document.getElementById('edit_guid').value = "";
        return false;
    }
}
function quantity_chnage(e) {
    var unicode = e.charCode ? e.charCode : e.keyCode
    if (unicode != 13 && unicode != 9) {
    } else {
        add_values();

        document.getElementById("item").focus();

    }
    if (unicode != 27) {
    } else {

        document.getElementById("item").focus();
    }
}
function formatCurrency(fieldObj) {
    if (isNaN(fieldObj.value)) {
        return false;
    }
    fieldObj.value = '$ ' + parseFloat(fieldObj.value).toFixed(2);
    return true;
}
function balance_amount() {
    if (document.getElementById('payable_amount').value != "" && document.getElementById('total').value != "") {
        data = parseFloat(document.getElementById('payable_amount').value);
        //document.getElementById('total').value = data - parseFloat(document.getElementById('payable_amount').value);
        if (parseFloat(document.getElementById('payable_amount').value) >= parseFloat(document.getElementById('total').value)) {

        } else {
            if (document.getElementById('payable_amount').value != "") {
                //document.getElementById('balance').value = '000.00';
                // document.getElementById('payment').value = parseFloat(document.getElementById('payable_amount').value);
            } else {
                //document.getElementById('balance').value = '000.00';
                // document.getElementById('payment').value = "";
            }
        }
    } else {
        //document.getElementById('balance').value = "";
    }


}
function stock_size() {
    if (parseFloat(document.getElementById('quty').value) > parseFloat(document.getElementById('stock').value)) {
        document.getElementById('quty').value = parseFloat(document.getElementById('stock').value);

        console.log();
    }
}
function discount_amount() {

    if (document.getElementById('grand_total').value != "") {
        document.getElementById('disacount_amount').value = parseFloat(document.getElementById('grand_total').value) *
                (parseFloat(document.getElementById('discount').value)) / 100;

    }
    if (document.getElementById('discount').value == "") {
        document.getElementById('disacount_amount').value = "";
    }
    discont = parseFloat(document.getElementById('disacount_amount').value);
    if (document.getElementById('disacount_amount').value == "") {
        discont = 0;
    }
    //--------------------*******************-----------------//
    if (document.getElementById('disacount_amount').value != "" && document.getElementById('tax').value != "") {
        document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) - discont + tax;

    }

    //-------------------------------***************------------------//
    if (document.getElementById('tax').value == "") {
        document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) - discont;
    }
    if (document.getElementById('tax').value != "" && document.getElementById('disacount_amount').value == "") {
        document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) - discont + tax;

    }
    if (parseFloat(document.getElementById('grand_total').value) > parseFloat(document.getElementById('payable_amount').value)) {
        // document.getElementById('payment').value = parseFloat(document.getElementById('payable_amount').value);

    }
    balance_amount();
}
function discount_as_amount() {
    if (parseFloat(document.getElementById('disacount_amount').value) > parseFloat(document.getElementById('grand_total').value))
        document.getElementById('disacount_amount').value = "";
    discont = parseFloat(document.getElementById('disacount_amount').value);
    /***********************************************/

    var result = isNaN(parseFloat(document.getElementById('disacount_amount').value));
    if (result == true)
    {
        document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) + tax;
        if (document.getElementById('tax').value == "") {
            document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value)
        }
    }


    /*************************************************/
    if (document.getElementById('grand_total').value != "") {
        if (parseFloat(document.getElementById('disacount_amount').value) < parseFloat(document.getElementById('grand_total').value)) {
            discont = parseFloat(document.getElementById('disacount_amount').value);
            //--------------------*******************-----------------//
            if (document.getElementById('disacount_amount').value != "" && document.getElementById('tax').value != "") {
                document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) - discont + tax;
            }
            //-------------------------------***************------------------//
            if (document.getElementById('tax').value == "" || parseFloat(document.getElementById('disacount_amount').value != "")) {
                document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) - discont;
            }

            if (parseFloat(document.getElementById('grand_total').value) > parseFloat(document.getElementById('payable_amount').value)) {
                //document.getElementById('payment').value = parseFloat(document.getElementById('payable_amount').value);

            }
        } else {
            // document.getElementById('disacount_amount').value=parseFloat(document.getElementById('grand_total').value)-1;
        }
    }

}


function add_tax() {
    var grand_tot = parseFloat(document.getElementById('grand_total').value);
    if (parseFloat(document.getElementById('tax').value) > parseFloat(document.getElementById('grand_total').value))
        document.getElementById('tax').value = "";
    var result = isNaN(parseFloat(document.getElementById('tax').value));
    if (result == true)
    {
        document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) - discont;
    }
    if (document.getElementById('grand_total').value != "") {
        if (parseFloat(document.getElementById('tax').value) < parseFloat(document.getElementById('grand_total').value)) {
            tax = parseFloat(document.getElementById('tax').value);
            document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) - discont + tax;
            if (parseFloat(document.getElementById('grand_total').value) > parseFloat(document.getElementById('payable_amount').value)) {
                // document.getElementById('payment').value = parseFloat(document.getElementById('payable_amount').value);
            }
        }
    }
    balance_amount();
}

function reduce_balance(id) {
    var minus = parseFloat(document.getElementById(id + "my_tot").value);
    document.getElementById('grand_total').value = parseFloat(document.getElementById('grand_total').value) - minus;
    document.getElementById('main_grand_total').value = parseFloat(document.getElementById('grand_total').value);
    discount_amount();
    //console.log(id);
}
function discount_type() {
    if (document.getElementById('round').checked) {
        document.getElementById("discount").readOnly = true;
        document.getElementById("disacount_amount").readOnly = false;
        if (parseFloat(document.getElementById('grand_total')) != "") {
            document.getElementById('disacount_amount').value = "";
            document.getElementById('discount').value = "";
            discount_amount();
        }
    } else {
        document.getElementById("discount").readOnly = false;
        document.getElementById("disacount_amount").readOnly = true;
    }
    if (document.getElementById('round').checked != true && document.getElementById("disacount_amount").value != "") {
        document.getElementById('disacount_amount').value = "";
        document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value);
        if (document.getElementById('tax').value != "") {
            document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value) + tax;
        } else {
            document.getElementById('payable_amount').value = parseFloat(document.getElementById('grand_total').value);
        }
    }
}

>>>>>>> 8ce9652fa96248f9c91db5d57151b04a4c8033b5

