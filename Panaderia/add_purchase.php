<?php
include_once("init.php");
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Señor Pan</title>

        <!-- Stylesheets -->

        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="js/date_pic/date_input.css">
        <link rel="stylesheet" href="lib/auto/css/jquery.autocomplete.css">

        <!-- Optimize for mobile devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <!-- jQuery & JS files -->
        <?php include_once("tpl/common_js.php"); ?>
        <script src="js/script.js"></script>
        <script src="js/date_pic/jquery.date_input.js"></script>
        <script src="lib/auto/js/jquery.autocomplete.js "></script>
        <script src="js/add_puchase.js"></script>
    </head>
    <body>

        <!-- TOP BAR -->
        <?php include_once("tpl/top_bar.php"); ?>
        <!-- end top-bar -->


        <!-- HEADER -->
        <div id="header-with-tabs">

            <div class="page-full-width cf">

                <ul id="tabs" class="fl">
                    <li><a href="dashboard.php" class="dashboard-tab">Tablero</a></li>
                    <li><a href="view_sales.php" class="sales-tab">Ventas</a></li>
                    <li><a href="view_customers.php" class=" customers-tab">Clientes</a></li>
                    <li><a href="view_purchase.php" class="active-tab purchase-tab">Compras</a></li>
                    <li><a href="view_supplier.php" class=" supplier-tab">Proveedores</a></li>
                    <li><a href="view_product.php" class="stock-tab"> Stocks/Productos</a></li>
                    <li><a href="view_payments.php" class="payment-tab">Pagos</a></li>
                    <li><a href="view_report.php" class="report-tab">Reportes</a></li>
                </ul>
                <!-- end tabs -->

                <!-- Change this image to your own company's logo -->
                <!-- The logo will automatically be resized to 30px height. -->
                <a href="#" id="company-branding-small" class="fr"><img src="<?php
        if (isset($_SESSION['logo'])) {
            echo "upload/" . $_SESSION['logo'];
        } else {
            echo "upload/posnic.jpg";
        }
        ?>" alt="Logo"/></a>

            </div>
            <!-- end full-width -->

        </div>
        <!-- end header -->


        <!-- MAIN CONTENT -->
        <div id="content">

            <div class="page-full-width cf">

                <div class="side-menu fl">

                    <h3>Gestión de compras</h3>
                    <ul>
                        <li><a href="add_purchase.php">Agregar compra</a></li>
                        <li><a href="view_purchase.php">Ver compra</a></li>
                    </ul>

                </div>
                <!-- end side-menu -->

                <div class="side-content fr">

                    <div class="content-module">

                        <div class="content-module-heading cf">

                            <h3 class="fl">Agregar compra</h3>
                            <span class="fr expand-collapse-text">Click para ocultar</span>
                            <span class="fr expand-collapse-text initial-expand">Click para expandir</span>

                        </div>
                        <!-- end content-module-heading -->

                        <div class="content-module-main cf">


                            <?php
                            //Gump is libarary for Validatoin
                            if (isset($_GET['msg'])) {
                                echo $_GET['msg'];
                            }
                            if (isset($_POST['supplier']) and isset($_POST['stock_name'])) {
                                $_POST = $gump->sanitize($_POST);
                                $gump->validation_rules(array(
                                    'supplier' => 'required|max_len,100|min_len,3'
                                ));

                                $gump->filter_rules(array(
                                    'supplier' => 'trim|sanitize_string|mysqli_escape'
                                ));

                                $validated_data = $gump->run($_POST);
                                $supplier = "";
                                $purchaseid = "";
                                $stock_name = "";
                                $cost = "";
                                //$bill_no = "";


                                if ($validated_data === false) {
                                    echo $gump->get_readable_errors(true);
                                } else {
                                    $username = $_SESSION['username'];

                                    $purchaseid = mysqli_real_escape_string($db->connection, $_POST['purchaseid']);

                                    //$bill_no = mysqli_real_escape_string($db->connection, $_POST['bill_no']);
                                    $supplier = mysqli_real_escape_string($db->connection, $_POST['supplier']);
                                    $address = mysqli_real_escape_string($db->connection, $_POST['address']);
                                    $contact = mysqli_real_escape_string($db->connection, $_POST['contact']);
                                    $stock_name = $_POST['stock_name'];

                                    $count = $db->countOf("supplier_details", "supplier_name='$supplier'");
                                    if ($count == 0) {
                                        $db->query("insert into supplier_details(supplier_name,supplier_address,supplier_contact1) values('$supplier','$address','$contact')");
                                    }
                                    $quty = $_POST['quty'];
                                    $date = date("d M Y h:i A");
                                    $sell = $_POST['sell'];
                                    $cost = $_POST['cost'];
                                    $total = $_POST['total'];
                                    $subtotal = $_POST['subtotal'];
                                    $description = mysqli_real_escape_string($db->connection, $_POST['description']);
                                    //$due = mysqli_real_escape_string($db->connection, $_POST['duedate']);
                                    //$payment = mysqli_real_escape_string($db->connection, $_POST['payment']);
                                    //$balance = mysqli_real_escape_string($db->connection, $_POST['balance']);
                                    $mode = mysqli_real_escape_string($db->connection, $_POST['mode']);

                                    $autoid = $_POST['purchaseid'];
                                    $autoid1 = $autoid;
                                    $selected_date = $_POST['date'];
                                    $selected_date = strtotime($selected_date);
                                    $date = date('Y-m-d H:i:s', $selected_date);
                                    for ($i = 0; $i < count($stock_name); $i++) {
                                        $count = $db->countOf("stock_avail", "name='$stock_name[$i]'");
                                        if ($count == 0) {
                                            $db->query("insert into stock_avail(name,quantity) values('$stock_name[$i]',$quty[$i])");
                                            echo "<br><font color=green size=+1 >New Stock Entry Inserted !</font>";

                                            $db->query("insert into stock_details(stock_id,stock_name,stock_quatity,supplier_id,company_price,selling_price) values('$autoid','$stock_name[$i]',0,'$supplier','$cost[$i]','$sell[$i]')");


                                            $db->query("INSERT INTO stock_entries(stock_id,stock_name, stock_supplier_name, quantity, company_price, selling_price, opening_stock, closing_stock, date, username, type, total, payment, balance, mode, description, due, subtotal,count1) VALUES ( '$autoid1','$stock_name[$i]','$supplier','$quty[$i]','$cost[$i]','$sell[$i]',0,'$quty[$i]','$date','$username','entry','$total[$i]','$payment','$balance','$mode','$description','$due','$subtotal',$i+1')");
                                        } else if ($count == 1) {

                                            $amount = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$stock_name[$i]'");
                                            $amount1 = $amount + $quty[$i];
                                            $db->execute("UPDATE stock_avail SET quantity='$amount1' WHERE name='$stock_name[$i]'");
                                            $db->query("INSERT INTO stock_entries(stock_id,stock_name,stock_supplier_name,quantity,company_price,selling_price,opening_stock,closing_stock,date,username,type,total,mode,description,subtotal,count1) VALUES ('$autoid1','$stock_name[$i]','$supplier','$quty[$i]','$cost[$i]','$sell[$i]','$amount','$amount1','$date','$username','entry','$total[$i]','$mode','$description','$subtotal',$i+1)");
                                            //INSERT INTO `stock`.`stock_entries` (`id`, `stock_id`, `stock_name`, `stock_supplier_name`, `category`, `quantity`, `company_price`, `selling_price`, `opening_stock`, `closing_stock`, `date`, `username`, `type`, `salesid`, `total`, `payment`, `balance`, `mode`, `description`, `due`, `subtotal`, `count1`)
                                            //VALUES (NULL, '$autoid1', '$stock_name[$i]', '$supplier', '', '$quantity', '$brate', '$srate', '$amount', '$amount1', '$mysqldate', 'sdd', 'entry', 'Sa45', '432.90', '2342.90', '24.34', 'cash', 'sdflj', '2010-03-25 12:32:02', '45645', '1');
                                        }
                                    }
                                    $msg = "<br><font color=green size=6px >Parchase order Added successfully Ref: [" . $_POST['purchaseid'] . "] !</font>";
                                    echo "<script>window.location = 'add_purchase.php?msg=$msg';</script>";
                                }
                            }
                            ?>

                            <form name="form1" method="post" id="form1" action="">
                                <input type="hidden" id="posnic_total">

                                <p><strong>Agregar Stocks/Producto </strong> - Agregar Nueva ( Control +2)</p>
                                <table class="form" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                            <?php
                                $str = $db->maxOfAll("stock_id", "stock_entries"); 
                                $array = explode(' ', $str);                           
                                $autoid = ++$array[0];
                                if($str == ''){
                                  $autoid_new = "PR".$autoid;  
                                }
                                  ?>
                                        <?php if($str == ''){ ?>
                                        <td>ID Compra:</td>
                                        <td><input name="purchaseid" type="text" id="purchaseid" readonly="readonly" maxlength="200"
                                                   class="round default-width-input" style="width:130px "
                                                   value="<?php echo $autoid_new ?>"/></td>
                                        
                                        <?php } ?>
                                        <?php if($str != ''){ ?>
                                        <td>ID Compra:</td>
                                        <td><input name="purchaseid" type="text" id="purchaseid" readonly="readonly" maxlength="200"
                                                   class="round default-width-input" style="width:130px "
                                                   value="<?php echo $autoid ?>"/></td>
                                        <?php }?>
                                        <td>Fecha:</td>
                                        <td><input name="date" id="test1" placeholder=""  style="margin-left: 15px;" value="<?php date_default_timezone_set("America/Guatemala");
                                        echo date('Y-m-d H:i:s'); ?>"
                                                   type="text" id="name" maxlength="200" class="round default-width-input"/>
                                        </td>


                                    </tr>
                                    <tr>
                                        <td><span class="man">*</span>Proveedor:</td>
                                        <td><input name="supplier" placeholder="Añada Proveedor" type="text" id="supplier"
                                                   maxlength="200" class="round default-width-input" style="width:130px "/></td>

                                        <td>Dirección:</td>
                                        <td><input name="address" placeholder="Añada dirección" type="text" id="address"
                                                   maxlength="200" class="round default-width-input"/></td>

                                        <td>Contacto:</td>
                                        <td><input name="contact" placeholder="Añada contacto" type="text" id="contact1"
                                                   maxlength="200" class="round default-width-input"
                                                   onkeypress="return numbersonly(event)" style="width:120px "/></td>

                                    </tr>
                                </table>
                                <input type="hidden" id="guid">
                                <input type="hidden" id="edit_guid">
                                <table class="form">
                                    <tr>
                                        <td>Articulo</td>
                                        <td>Cantidad</td>
                                        <td>Costo</td>
                                        <td>En venta</td>
                                        <td>Stock disponible</td>
                                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total</td>
                                        <td> &nbsp;</td>
                                    </tr>
                                    <tr>

                                        <td><input name="" type="text" id="item" maxlength="200"
                                                   class="round default-width-input " style="width: 150px"/></td>

                                        <td><input name="" type="text" id="quty" maxlength="200"
                                                   class="round default-width-input my_with"
                                                   onKeyPress="quantity_chnage(event);return numbersonly(event);"
                                                   onkeyup="total_amount();unique_check()"/></td>

                                        <td><input name="" type="text" id="cost" readonly="readonly" maxlength="200"
                                                   class="round default-width-input my_with"/></td>


                                        <td><input name="" type="text" id="sell" readonly="readonly" maxlength="200"
                                                   class="round default-width-input my_with"/></td>


                                        <td><input name="" type="text" id="stock" readonly="readonly" maxlength="200"
                                                   class="round  my_with"/></td>


                                        <td><input name="" type="text" id="total" maxlength="200"
                                                   class="round default-width-input " style="width:120px;  margin-left: 20px"/>
                                        </td>

                                    </tr>
                                </table>
                                <div style="overflow:auto ;max-height:300px;  ">
                                    <table class="form" id="item_copy_final">

                                    </table>
                                </div>

                                <table class="form">
                                    <tr>
                                        <td>Metodo de pago &nbsp;</td>
                                        <td>
                                            <select name="mode">
                                                <option value="cash">Efectivo</option>
                                                <option value="cash">Tarjeta</option>
                                                <option value="cheque">Cheque</option>

                                                <option value="other">Otro</option>
                                            </select>
                                        </td>
                                        <td>Descripción</td>
                                        <td><textarea name="description"></textarea></td>
                                        <td>Cantidad total:<input type="hidden" readonly="readonly" id="grand_total"
                                                               name="subtotal">
                                            <input type="text" id="main_grand_total" class="round default-width-input"
                                                   onkeypress="return numbersonly(event)" readonly="readonly"
                                                   style="text-align:right;width: 120px">
                                        </td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                        <td> &nbsp;</td>
                                    </tr>
                                </table>
                                <table class="form">
                                    <tr>
                                        <td>
                                            <input class="button round blue image-right ic-add text-upper" type="submit"
                                                   name="Submit" value="Añadir" onclick="return checkValid(this);">
                                        </td>
                                        <td> (Control + S)
                                           </td>
                                        <td> &nbsp;</td>
                                        <td> <input class="button round red   text-upper" type="reset" id="Reset" name="Reset"
                                                   value="Borrar"> </td>
                                    </tr>
                                </table>
                            </form>


                        </div>
                        <!-- end content-module-main -->


                    </div>
                    <!-- end content-module -->


                </div>
            </div>
            <!-- end full-width -->

        </div>
        <!-- end content -->


        <!-- FOOTER -->
        <div id="footer">
        <p>Cualquier incoveniente comunicarse a: <a href="mailto:it_panaderia@gmail.com?subject=Stock%20Management%20System">it_panaderia@gmail.com</a>.
            </p>

        </div>
        <!-- end footer -->

    </body>
</html>