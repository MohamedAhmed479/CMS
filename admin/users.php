<?php
ob_start();
session_start();
include "includes/admin_header.php"; 

?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">


                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php if(isset($_SESSION['username'])) echo $_SESSION['username']?></small>
                        </h1>
                    
                    <?php
                    if(isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = "";
                    }


                    switch ($source) {
                        case 'Add_users':
                            require_once "Add_users.php";
                            break;

                        case 'Edit_user':
                            require_once "includes/Edit_user.php";
                            break;
                        
                        default:
                            require_once "includes/show_all_users.php";
                            break;
                    }

                    ?>


                        
                        



                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
       
<?php include "includes/admin_footer.php"; ?>
