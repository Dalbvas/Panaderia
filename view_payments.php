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
    <script src="js/add_stock.js"></script>
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
                <li><a href="view_purchase.php" class="purchase-tab">Compras</a></li>
                <li><a href="view_supplier.php" class=" supplier-tab">Proveedores</a></li>
                <li><a href="view_product.php" class="stock-tab">Stocks / Productos</a></li>
                <li><a href="view_payments.php" class="active-tab payment-tab">Inventario</a></li>
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

                <h3>Administración de Inventario</h3>
                    <ul>
                        <li><a href="view_payments.php">Agregar Inventario</a></li>
                        <li><a href="view_out_standing.php">Inventario</a></li>
                    </ul>

        </div>
        <!-- end side-menu -->

        <div class="side-content fr">

            <div class="content-module">

                <div class="content-module-heading cf">

                <h3 class="fl">Inventario</h3>
                            <span class="fr expand-collapse-text">Click para Ocultar</span>
                            <span class="fr expand-collapse-text initial-expand">Click para Expandir</span>

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
                            
                            'cost' => 'required|max_len,200',
                            'supplier' => 'max_len,200',
                            
                             'quantity' => 'max_len,200'

                        ));

                        $gump->filter_rules(array(
                            'name' => 'trim|sanitize_string|mysqli_escape',
                            'stockid' => 'trim|sanitize_string|mysqli_escape',
                            
                            'cost' => 'trim|sanitize_string|mysqli_escape',
                            
                            'supplier' => 'trim|sanitize_string|mysqli_escape',
                            'quantity' => 'trim|sanitize_string|mysqli_escape'

                        ));

                        $validated_data = $gump->run($_POST);
                        $name = "";
                        $stockid = "";
                        
                        $cost = "";
                        $supplier = "";
                        
                        $quantity = "";


                        if ($validated_data === false) {
                            echo $gump->get_readable_errors(true);
                        } else {


                            $name = mysqli_real_escape_string($db->connection, $_POST['name']);
                            $stockid = mysqli_real_escape_string($db->connection, $_POST['stockid']);
                            
                            $cost = mysqli_real_escape_string($db->connection, $_POST['cost']);
                            $supplier = mysqli_real_escape_string($db->connection, $_POST['supplier']);
                        
                            $quantity = mysqli_real_escape_string($db->connection, $_POST['quantity']);


                            $count = $db->countOf("stock_details", "stock_id ='$stockid'");
                            if ($count == 1) {
                                echo "<font color=red> Registro Duplicado. Por favor Verificar</font>";
                            } else {

                                if ($db->query("insert into transactions (name, supplier,quantity,subtotal) values('$name','$supplier','$quantity','$cost')")) {
                                    echo "<br><font color=green size=+1 > [ $name ] Producto Agregado !</font>";
                                   
                                } else
                                    echo "<br><font color=red size=+1 >El producto no se pudo agregar !</font>";

                            }


                        }

                    }


                    ?>

                    <form name="form1" method="post" id="form1" action="">


                        <table class="form" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <?php
                                $max = $db->maxOfAll("id", "transactions");
                                $max = $max + 1;
                                $autoid = "ST" . $max . "";
                                ?>
                                <td><span class="man">*</span>ID&nbsp;Producto:</td>
                                <td><input name="stockid" type="text" id="stockid" readonly="readonly" maxlength="200"
                                           class="round default-width-input"
                                           value="<?php echo isset($autoid) ? $autoid : ''; ?>"/></td>

                                <td><span class="man">*</span>Producto:</td>
                                <td><input name="name" placeholder="INGRESE NOMBRE DE PRODUCTO" type="text" id="name"
                                           maxlength="200" class="round default-width-input"
                                           value="<?php echo isset($name) ? $name : ''; ?>"/></td>

                            </tr>
                            <tr>
                                <td><span class="man">*</span>Costo:</td>
                                <td><input name="cost" placeholder="INGRESE COSTO" type="text" id="cost"
                                           maxlength="200" class="round default-width-input"
                                           onkeypress="return numbersonly(event)"
                                           value="<?php echo isset($cost) ? $cost : ''; ?>"/></td>
                                           <td>Proveedor:</td>
                                <td><input name="supplier" placeholder="INGRESE PROVEEDOR" type="text" id="supplier"
                                           maxlength="200" class="round default-width-input"
                                           value="<?php echo isset($supplier) ? $supplier : ''; ?>"/></td>

                            </tr>
                       
                            <tr>
                                           <td>Unidades:  </td>
                                <td><input name="quantity" placeholder="INGRESE UNIDADES" type="text" id="quantity"
                                           maxlength="200" class="round default-width-input"
                                           value="<?php echo isset($quantity) ? $quantity : ''; ?>"/></td>
                                           <td></td>
                            <td></td>
                            <td></td>
                            </tr>

                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                
                            </tr>


                            <tr>
                                <td>
                                    &nbsp;
                                </td>
                                
                                <td>
                                    <input class="button round blue image-right ic-add text-upper" type="submit"
                                           name="Submit" value="Añadir">
                                    (Control + S)

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