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

    <!-- Optimize for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- jQuery & JS files -->
    <?php include_once("tpl/common_js.php"); ?>
    <script src="js/date_pic/jquery.date_input.js"></script>
    <script src="js/script.js"></script>
    <script src="js/view_report.js"></script>
    

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
            <li><a href="view_purchase.php" class=" purchase-tab">Compras</a></li>
            <li><a href="view_supplier.php" class=" supplier-tab">Proveedores</a></li>
            <li><a href="view_product.php" class=" stock-tab">Stocks / Productos</a></li>
            <li><a href="view_payments.php" class="payment-tab">Inventario</a></li>
            <li><a href="view_report.php" class="active-tab report-tab">Reportes</a></li>
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

            <h3>Reporte</h3>
            <ul>
                <ul>
                    <li><a></a></li>

                </ul>
            </ul>


        </div>
        <!-- end side-menu -->

        <div class="side-content fr">

            <div class="content-module">

                <div class="content-module-heading cf">

                    <h3 class="fl">Reporte</h3>
                    <span class="fr expand-collapse-text">Click para Ocultar</span>
                    <span class="fr expand-collapse-text initial-expand">Click para Expandir</span>

                </div>
                <!-- end content-module-heading -->

                <div class="content-module-main cf">
                    <form action="">

                        <table class="form" border="0" cellspacing="0" cellpadding="0">
                            <form action="sales_report.php" method="post" name="form1" id="form1" name="sales_report"
                                  id="sales_report" target="myNewWinsr">
                                <tr>

                                    <td><strong>Reporte de Ventas</strong></td>
                                    <td>Desde</td>
                                    <td><input name="from_sales_date" type="text" id="from_sales_date"
                                               style="width:80px;"></td>
                                    <td>Hasta</td>
                                    <td><input name="to_sales_date" type="text" id="to_sales_date" style="width:80px;">
                                    </td>
                                    <td><div style="padding-left: 15px;"><input class="button round blue image" name="submit" type="button" value="Mostrar" onClick='sales_report_fn();'>
                                        </div></td>

                                </tr>
                            </form>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                            <form action="purchase_report.php" method="post" name="purchase_report" target="_blank">
                                <tr>
                                    <td><strong>Reporte Compras </strong></td>
                                    <td>Desde</td>
                                    <td><input name="from_purchase_date" type="text" id="from_purchase_date"
                                               style="width:80px;"></td>
                                    <td>Hasta</td>
                                    <td><input name="to_purchase_date" type="text" id="to_purchase_date"
                                               style="width:80px;"></td>
                                    <td><div style="padding-left: 15px;"><input class="button round blue image" name="submit" type="button" value="Mostrar" onClick='purchase_report_fn();'>
                                        </div></td>
                                </tr>
                            </form>

                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                            <form action="sales_purchase_report.php" method="post" name="sales_purchase_report"
                                  target="_blank">
                                <tr>
                                    <td><strong>Unidades Compradas</strong></td>
                                    <td>Desde</td>
                                    <td><input name="from_sales_purchase_date" type="text" id="from_sales_purchase_date"
                                               style="width:80px;"></td>
                                    <td>Hasta</td>
                                    <td><input name="to_sales_purchase_date" type="text" id="to_sales_purchase_date"
                                               style="width:80px;"></td>
                                    
                                    <td><div style="padding-left: 15px;"><input  class="button round blue image" name="submit" type="button" value="Mostrar"
                                                onClick='sales_purchase_report_fn();'></div></td>
                                </tr>
                            </form>

                        </table>


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
    <!-- end footer -->

</body>
</html>