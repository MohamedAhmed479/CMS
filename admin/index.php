<?php session_start(); ?>
<?php include "includes/admin_header.php"; ?>



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

                        <h1>
                          <?php echo $count_users ?>

                        </h1>


                    </div>
                </div>
                <!-- /.row -->
            <?php include "admin_widgets.php"; ?>


<?php

$query_to_count_posts = "SELECT COUNT(*) as count_draft_posts FROM posts WHERE status = 'draft'";
$run_query_to_count_draft_posts = mysqli_query($conn, $query_to_count_posts);
$count_draft_posts = mysqli_fetch_assoc($run_query_to_count_draft_posts)['count_draft_posts'];

$query_to_count_published_posts = "SELECT COUNT(*) as count_published_posts FROM posts WHERE status = 'published'";
$run_query_to_count_published_posts = mysqli_query($conn, $query_to_count_published_posts);
$count_published_posts = mysqli_fetch_assoc($run_query_to_count_published_posts)['count_published_posts'];


$query_to_count_approved_comments = "SELECT COUNT(*) as count_approved_comments FROM comments WHERE status = 'approved'";
$run_query_to_count_approved_comments = mysqli_query($conn, $query_to_count_approved_comments);
$count_approved_comments = mysqli_fetch_assoc($run_query_to_count_approved_comments)['count_approved_comments'];


$query_to_count_unapproved_comments = "SELECT COUNT(*) as count_unapproved_comments FROM comments WHERE status = 'unapproved'";
$run_query_to_count_unapproved_comments = mysqli_query($conn, $query_to_count_unapproved_comments);
$count_unapproved_comments = mysqli_fetch_assoc($run_query_to_count_unapproved_comments)['count_unapproved_comments'];


$query_to_count_subscribers = "SELECT COUNT(*) as count_subscribers FROM users WHERE role = 'subscriber'";
$run_query_to_count_subscribers = mysqli_query($conn, $query_to_count_subscribers);
$count_subscribers = mysqli_fetch_assoc($run_query_to_count_subscribers)['count_subscribers'];


?>





            <div class="row">
            <script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Data', ''],
      <?php 
        $element_text = ['All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Approved Comments', 'UnApproved Comments ',  'Users', 'Subscribers', 'Categories']; 
        $element_count = [$count_posts, $count_published_posts, $count_draft_posts, $count_comments, $count_approved_comments, $count_unapproved_comments, $count_users, $count_subscribers, $count_categories];

        for ($i = 0; $i < count($element_text); $i++) { 
            $one_element_text = $element_text[$i];
            $one_element_count = $element_count[$i];
            echo "['$one_element_text', $one_element_count],";
        }
      ?>
    ]);

    var options = {
      chart: {
        title: 'Company Performance',
        subtitle: 'Sales, Expenses, and Profit: 2014-2017',
      }
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>
  <div id="columnchart_material" style="width: auto; height: 500px;"></div>
</div>


                 

        </div>
            <!-- /.container-fluid -->

    </div>
       
<?php include "includes/admin_footer.php"; ?>
