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

    <!-- Optimize for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- jQuery & JS files -->
    <?php include_once("tpl/common_js.php"); ?>
    <script src="js/script.js"></script>
    <script src="js/add_category.js"></script>
   
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
            <li><a href="view_product.php" class="active-tab stock-tab">Stocks / Productos</a></li>
            <li><a href="view_payments.php" class="payment-tab">Inventario</a></li>
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

            <h3>Administración de Productos</h3>
            <ul>
                <li><a href="add_stock.php">Añadir Stock/Producto</a></li>
                <li><a href="view_product.php">Ver Stock/Producto</a></li>
                <li><a href="add_category.php">Añadir Tipo de Producto</a></li>
                <li><a href="view_category.php">Ver Tipo de Producto</a></li>
                <li><a href="view_stock_availability.php">Ver Unidades Disponibles</a></li>
            </ul>

        </div>
        <!-- end side-menu -->

        <div class="side-content fr">

            <div class="content-module">

                <div class="content-module-heading cf">

                    <h3 class="fl">Añadir Tipo de Producto</h3>
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
                            'address' => 'max_len,200',

                        ));

                        $gump->filter_rules(array(
                            'name' => 'trim|sanitize_string|mysqli_escape',
                            'address' => 'trim|sanitize_string|mysqli_escape',

                        ));

                        $validated_data = $gump->run($_POST);
                        $name = "";
                        $address = "";


                        if ($validated_data === false) {
                            echo $gump->get_readable_errors(true);
                        } else {


                            $name = mysqli_real_escape_string($db->connection, $_POST['name']);
                            $address = mysqli_real_escape_string($db->connection, $_POST['address']);


                            $count = $db->countOf("category_details", "category_name='$name'");
                            if ($count == 1) {
                                echo "<font color=red> Dublicat Entry. Please Verify</font>";
                            } else {

                                if ($db->query("insert into category_details values(NULL,'$name','$address')"))
                                    echo "<br><font color=green size=+1 > Categoria [ $name ]  Agregada Correctamente !</font>";
                                else
                                    echo "<br><font color=red size=+1 >Problem in Adding !</font>";

                            }


                        }

                    }


                    ?>

                    <form name="form1" method="post" id="form1" action="">

                        <p><strong>Añadir Nuevo Tipo </strong> - Añadir Nuevo ( Control +A)</p>
                        <table class="form" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><span class="man">*</span>Nombre:</td>
                                <td><input name="name" placeholder="INGRESE TIPO DE PRODUCTO" type="text" id="name"
                                           maxlength="200" class="round default-width-input"
                                           value="<?php echo isset($name) ? $name : ''; ?>"/></td>

                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Descripción:</td>
                                <td><textarea name="address" placeholder="INGRESE LA DESCRIPCIÓN DEL PRODCUTO" cols="8"
                                              class="round full-width-textarea"><?php echo isset($address) ? $address : ''; ?></textarea>
                                </td>

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