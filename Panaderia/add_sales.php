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
    <script src="js/add_sales.js"></script>
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
            <li><a href="view_sales.php" class="active-tab sales-tab">Ventas</a></li>
            <li><a href="view_customers.php" class=" customers-tab">Clientes</a></li>
            <li><a href="view_purchase.php" class="purchase-tab">Compras</a></li>
            <li><a href="view_supplier.php" class=" supplier-tab">Proveedores</a></li>
            <li><a href="view_product.php" class="stock-tab">Stocks / Productos</a></li>
            <li><a href="view_payments.php" class="payment-tab">Pagos</a></li>
            <li><a href="view_report.php" class="report-tab">Reportes</a></li>
        </ul>
        <!-- end tabs -->

        <!-- Change this image to your own company's logo -->
        <!-- The logo will automatically be resized to 30px height. -->
        <a href="#" id="company-branding-small" class="fr"><img src="<?php if (isset($_SESSION['logo'])) {
                echo "upload/" . $_SESSION['logo'];
            } else {
                echo "upload/posnic.png";
            } ?>" alt="Point of Sale"/></a>

    </div>
    <!-- end full-width -->

</div>
<!-- end header -->


<!-- MAIN CONTENT -->
<div id="content">

    <div class="page-full-width cf">

        <div class="side-menu fl">

            <h3>Adminsitración de Ventas</h3>
            <ul>
                <li><a href="add_sales.php">Agregar Ventas</a></li>
                <li><a href="view_sales.php">Visualizar Ventas</a></li>
            </ul>

        </div>
        <!-- end side-menu -->

        <div class="side-content fr">

            <div class="content-module">

                <div class="content-module-heading cf">

                    <h3 class="fl">Agregar Stock </h3>
                    <span class="fr expand-collapse-text">Click para cerrar</span>
                    <span class="fr expand-collapse-text initial-expand">Click para expandir</span>

                </div>
                <!-- end content-module-heading -->

                <div class="content-module-main cf">


                    <?php
                    //Gump is libarary for Validatoin

                    if (isset($_POST['name'])) {
                        $_POST = $gump->sanitize($_POST);
                        $gump->validation_rules(array(
                            'name' => 'required|max_len,100|min_len,3',
                            'stockid' => 'required|max_len,200',
                            'sell' => 'required|max_len,200',
                            'cost' => 'required|max_len,200',
                            'supplier' => 'max_len,200',
                            'category' => 'max_len,200',
                            'quantity' => 'max_len,200',
                            'date' => 'max_len,200',
                            'seller' => 'max_len,200',
                            'item' => 'max_len,200'
                             

                        ));

                        $gump->filter_rules(array(
                            'name' => 'trim|sanitize_string|mysqli_escape',
                            'stockid' => 'trim|sanitize_string|mysqli_escape',
                            'sell' => 'trim|sanitize_string|mysqli_escape',
                            'cost' => 'trim|sanitize_string|mysqli_escape',
                            'category' => 'trim|sanitize_string|mysqli_escape',
                            'supplier' => 'trim|sanitize_string|mysqli_escape',
                            'quantity' => 'trim|sanitize_string|mysqli_escape',
                            'date' => 'trim|sanitize_string|mysqli_escape',
                            'seller' => 'trim|sanitize_string|mysqli_escape',
                            'item' => 'trim|sanitize_string|mysqli_escape'
                            

                        ));

                        $validated_data = $gump->run($_POST);
                        $name = "";
                        $stockid = "";
                        $sell = "";
                        $cost = "";
                        $supplier = "";
                        $category = "";
                        $quantity = "";
                        $item = "";
                        $date = "";
                        $seller = "";
                        


                        if ($validated_data === false) {
                            echo $gump->get_readable_errors(true);
                        } else {


                            $name = mysqli_real_escape_string($db->connection, $_POST['name']);
                            $stockid = mysqli_real_escape_string($db->connection, $_POST['stockid']);
                            $sell = mysqli_real_escape_string($db->connection, $_POST['sell']);
                            $cost = mysqli_real_escape_string($db->connection, $_POST['cost']);
                            $supplier = mysqli_real_escape_string($db->connection, $_POST['supplier']);
                            $category = mysqli_real_escape_string($db->connection, $_POST['category']);
                            $quantity = mysqli_real_escape_string($db->connection, $_POST['quantity']);
                            $date = mysqli_real_escape_string($db->connection, $_POST['date']);
                            $item = mysqli_real_escape_string($db->connection, $_POST['item']);
                            $seller = mysqli_real_escape_string($db->connection, $_POST['seller']);
                           

                            
                           // $count = $db->countOf("stock_sales", "stock_id ='$stockid'");

                            if ($db->query("insert into stock_sales(transactionid, quantity, customer_id, date, stock_name, seller) values('$stockid', '$quantity', '$name', '$date', '$item','$seller')")) 
                                {
                                    $amount = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$item'");
                                    echo "<br><font color=green size=+1 > Venta [ $amount] Realizada con exito !</font>";
                                    //$db->query("insert into stock_avail(name,quantity) values('$name','$quantity')");
                                } 
                                /*
                            if ($count == 1) {
                                echo "<font color=red> Registro Duplicado. Por favor Verificar</font>";
                            } else {

                                if ($db->query("insert into stock_sales(quantity) values('$quantity')")) 
                                {
                                    echo "<br><font color=green size=+1 > [ $quantity] Producto Agregado !</font>";
                                    //$db->query("insert into stock_avail(name,quantity) values('$name','$quantity')");
                                } 
                                else
                                    echo "<br><font color=red size=+1 >El producto no se pudo agregar !</font>";

                            }*/


                        }

                    }


                    ?>

                    <form name="form1" method="post" id="form1" action="">


                        <table class="form" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <?php
                                $max = $db->maxOfAll("id", "stock_sales");
                                $max = $max + 1;
                                $autoid = "SL" . $max . "";
                                ?>
                                <td><span class="man">*</span>ID&nbsp;Factura:</td>
                                <td><input name="stockid" type="text" id="stockid" readonly="readonly" maxlength="200"
                                           class="round default-width-input"
                                           value="<?php echo isset($autoid) ? $autoid : ''; ?>"/></td>

                                <td>Fecha:</td>
                                <td><input name="date" id="test1" readonly="readonly" value="<?php date_default_timezone_set("America/Guatemala");echo date('Y-m-d H:i:s');?>"
                                style="margin-left: 15px;"type="text" id="date" maxlength="200" class="round default-width-input"
                                value="<?php echo isset($date) ? $date : ''; ?>"/>
                                </td>
                                
                                
                            </tr>
                            <tr>
                                <td><span class="man">*</span>Cliente:</td>
                                <td><input name="name" placeholder="INGRESE NOMBRE DEL CLIENTE" type="text" id="supplier"
                                           maxlength="200" class="round default-width-input" style="width:150px "
                                           value="<?php echo isset($name) ? $name : ''; ?>"/></td>
                                
                                <td><span class="man"></span>Direccion:</td>
                                <td><input name="address" placeholder="INGRESE DIRECCION DEL CLIENTE" type="text" id="address"
                                           maxlength="200" class="round default-width-input" style="width:200px;  margin-left: 20px"
                                           value="<?php echo isset($address) ? $address : ''; ?>"/></td>

                                <td><span class="man"></span>Contacto:</td>
                                <td><input name="contact" placeholder="INGRESE CONTACTO DEL CLIENTE" type="text" id="contact"
                                           maxlength="200" class="round default-width-input" style="width:120px "
                                           value="<?php echo isset($contact) ? $contact : ''; ?>"/></td>
                            </tr>
                            <tr>
                                <td><span class="man"></span>Vendedor:</td>
                                <td><input name="seller" placeholder="VENDEDOR" type="text" id="seller"
                                           maxlength="200" class="round default-width-input"
                                           
                                           value="<?php echo isset($seller) ? $seller : ''; ?>"/></td>

                                <td><span class="man">*</span>Precio&nbsp;de Venta</td>
                                <td><input name="cost" placeholder="INGRESE PRECIO DE VENTA" type="text" id="cost"
                                           maxlength="200" class="round default-width-input"
                                           onkeypress="return numbersonly(event)"
                                           value="<?php echo isset($cost) ? $cost : ''; ?>"/></td>

                            </tr>
                            </table>
                            <table class="form">
                            <tr>
                                <td>Producto</td>
                                <td>Cantidad</td>

                                <td>Precio</td>
                                <td>Disponibilidad Stock</td>
                                <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total</td>
                                <td> &nbsp;</td>
                            </tr>
                            <tr>
                            <td><input name="item" type="text" id="item" maxlength="200"
                                           class="round default-width-input " style="width: 150px"
                                           value="<?php echo isset($item) ? $item : ''; ?>"/> 
                                           </td>

                                <td><input name="quantity" type="text" id="quantity" maxlength="200"
                                           class="round default-width-input my_with"
                                           onKeyPress="quantity_chnage(event);return numbersonly(event)"
                                           onkeyup="total_amount();unique_check();stock_size();"
                                           value="<?php echo isset($quantity) ? $quantity : ''; ?>"/></td>


                                <td><input name="cost" type="text" id="cost"  maxlength="200"
                                           class="round default-width-input my_with"
                                           value="<?php echo isset($cost) ? $cost : ''; ?>"/></td>


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
                                <td>Proveedor:</td>
                                <td><input name="sell" placeholder="INGRESE PROVEEDOR" type="text" id="sell"
                                           maxlength="200" class="round default-width-input"
                                           value="<?php echo isset($sell) ? $sell : ''; ?>"/></td>

                                <td>Tipo de Producto:</td>
                                <td><input name="category" placeholder="INGRESE TIPO DE PRODUCTO" type="text" id="category"
                                           maxlength="200" class="round default-width-input"
                                           value="<?php echo isset($category) ? $category : ''; ?>"/></td>
                            </tr>
                        
                        
                            <tr>
                                <td>Metodo pago &nbsp;</td>
                                <td>
                                    <select name="mode">
                                        <option value="cash">Efectivo</option>
                                        <option value="cheque">Cheque</option>
                                        <option value="other">Otro</option>
                                    </select>
                                </td>                         
                         
                                <td>Descripcion</td>
                                <td><textarea name="description"></textarea></td>
                                <td> &nbsp;</td>
                                <td> &nbsp;</td>
                            </tr>
                    


                            <tr>
                                <td>
                                    &nbsp;
                                </td>
                                
                                <td>
                                    <input class="button round blue image-right ic-add text-upper" type="submit"
                                           name="Submit" value="Añadir">
                                    

                                <td align="right"><input class="button round red   text-upper" type="reset" name="Reset"
                                                         value="Limpiar"></td>
                            </tr>
                        </table>
                    </form>


                </div>
                <!-- end content-module-main -->


            </div>
            <!-- end content-module -->


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