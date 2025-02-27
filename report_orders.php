<?php
/*
 * Created on Sun Feb 20 2022
 *
 *  Devlan Agency - devlan.co.ke 
 *
 * hello@devlan.co.ke
 *
 *
 * The Devlan End User License Agreement
 *
 * Copyright (c) 2022 Devlan Agency
 *
 * 1. GRANT OF LICENSE
 * Devlan Agency hereby grants to you (an individual) the revocable, personal, non-exclusive, and nontransferable right to
 * install and activate this system on two separated computers solely for your personal and non-commercial use,
 * unless you have purchased a commercial license from Devlan Agency. Sharing this Software with other individuals, 
 * or allowing other individuals to view the contents of this Software, is in violation of this license.
 * You may not make the Software available on a network, or in any way provide the Software to multiple users
 * unless you have first purchased at least a multi-user license from Devlan Agency.
 *
 * 2. COPYRIGHT 
 * The Software is owned by Devlan Agency and protected by copyright law and international copyright treaties. 
 * You may not remove or conceal any proprietary notices, labels or marks from the Software.
 *
 * 3. RESTRICTIONS ON USE
 * You may not, and you may not permit others to
 * (a) reverse engineer, decompile, decode, decrypt, disassemble, or in any way derive source code from, the Software;
 * (b) modify, distribute, or create derivative works of the Software;
 * (c) copy (other than one back-up copy), distribute, publicly display, transmit, sell, rent, lease or 
 * otherwise exploit the Software.  
 *
 * 4. TERM
 * This License is effective until terminated. 
 * You may terminate it at any time by destroying the Software, together with all copies thereof.
 * This License will also terminate if you fail to comply with any term or condition of this Agreement.
 * Upon such termination, you agree to destroy the Software, together with all copies thereof.
 *
 * 5. NO OTHER WARRANTIES. 
 * DEVLAN AGENCY  DOES NOT WARRANT THAT THE SOFTWARE IS ERROR FREE. 
 * DEVLAN AGENCY SOFTWARE DISCLAIMS ALL OTHER WARRANTIES WITH RESPECT TO THE SOFTWARE, 
 * EITHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, 
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT OF THIRD PARTY RIGHTS. 
 * SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF IMPLIED WARRANTIES OR LIMITATIONS
 * ON HOW LONG AN IMPLIED WARRANTY MAY LAST, OR THE EXCLUSION OR LIMITATION OF 
 * INCIDENTAL OR CONSEQUENTIAL DAMAGES,
 * SO THE ABOVE LIMITATIONS OR EXCLUSIONS MAY NOT APPLY TO YOU. 
 * THIS WARRANTY GIVES YOU SPECIFIC LEGAL RIGHTS AND YOU MAY ALSO 
 * HAVE OTHER RIGHTS WHICH VARY FROM JURISDICTION TO JURISDICTION.
 *
 * 6. SEVERABILITY
 * In the event of invalidity of any provision of this license, the parties agree that such invalidity shall not
 * affect the validity of the remaining portions of this license.
 *
 * 7. NO LIABILITY FOR CONSEQUENTIAL DAMAGES IN NO EVENT SHALL DEVLAN AGENCY  OR ITS SUPPLIERS BE LIABLE TO YOU FOR ANY
 * CONSEQUENTIAL, SPECIAL, INCIDENTAL OR INDIRECT DAMAGES OF ANY KIND ARISING OUT OF THE DELIVERY, PERFORMANCE OR 
 * USE OF THE SOFTWARE, EVEN IF DEVLAN HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES
 * IN NO EVENT WILL DEVLAN  LIABILITY FOR ANY CLAIM, WHETHER IN CONTRACT 
 * TORT OR ANY OTHER THEORY OF LIABILITY, EXCEED THE LICENSE FEE PAID BY YOU, IF ANY.
 */

session_start();
require_once 'config/config.php';
require_once 'config/codeGen.php';

/* Load Header Partial */
require_once('partials/head.php');
?>

<body>

    <!-- Navigation Bar-->
    <?php require_once('partials/navbar.php'); ?>
    <!-- End Navigation Bar-->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="wrapper">
        <div class="container">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Mukure Dairy Control Products Supply Orders</h4>
                    </div>
                </div>
            </div>
            <!-- Add User MOdal -->
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="card-box">
                        <table id="datatable-buttons" class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Product</th>
                                    <th>Supplier</th>
                                    <th>Qty Ordered</th>
                                    <th>Date Posted</th>
                                    <th>Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = "SELECT * FROM orders o
                                INNER JOIN products p ON p.product_id = o.order_product_id
                                INNER JOIN users u ON u.user_id = o.order_supplier_id
                                WHERE order_type = 'supply'";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($orders = $res->fetch_object()) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $orders->order_number; ?> <br>
                                            <?php if ($orders->order_status == 'paid') { ?>
                                                <span class="badge badge-success"><i class="fa fa-check"></i> Paid</span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger">Pending</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php echo $orders->product_code . ' ' . $orders->product_name; ?>
                                        </td>
                                        <td>
                                            <?php echo $orders->user_name; ?>
                                        </td>
                                        <td>
                                            <?php echo $orders->order_qty; ?>
                                        </td>
                                        <td>
                                            <?php echo $orders->order_date; ?>
                                        </td>
                                        <td>
                                            Ksh <?php echo number_format($orders->order_amount, 2); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- end col-->
            </div>
            <!-- end row -->
        </div> <!-- container -->


        <!-- Footer -->
        <?php require_once('partials/footer.php'); ?>
        <!-- End Footer -->

    </div> <!-- End wrapper -->


    <?php require_once('partials/scripts.php'); ?>

</body>

</html>