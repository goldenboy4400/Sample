<!-----------------------------------------------------------------------------
This is to view all the subcontracts that are inputted into the system.  With sorting and
able to archive the data with a click.



---->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"> </script>
    <script src="include/jquery.stickytableheaders.js"> </script>


    <!-- load sticky headers so you can scroll through each page !-->

    <script>
        $(document).ready(function () {

            $("table").stickyTableHeaders();
        });

    </script>


    <!-- end of script -->

    <style>
        thead {
            border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 5px;
            background-color: lightgray;
        }

    </style>

</head>

    <?php

    //Include Database Connection
    include_once './include/database.php';
    include_once './include/conn.php';

    //Initial Sort order of the table
    $sort_order = 'desc';


    //Sort the tables depending on the post request
    if (!isset($_POST['activity'])) {

        $activity = 'All';
    }

    else {

        $activity = $_POST['activity'];
    }


    if (isset($_GET['sort_by'])) {

        if ($_GET['sort_by'] == 'asc') {
            $sort_order = 'desc';
            $activity = $_GET['activity'];
        } else {

            $sort_order = 'asc';
            $activity = $_GET['activity'];
        }
    }


    //end of sorting
    ?>


<!-- start of body of the form !-->

<body>
<!-- start of bootstrap container -->
<div class="container">
    <div class="row">

        <h3>Subcontracts</h3>   <a href="create.php">Add a New Subcontract</a>

        <form action="import.php" method="post" >
            <input type="submit" name="csv" value="import">
        </form>

    </div>
    <div class="row">
        <br>

        <form action="index.php" method="post"  >
            <select name="activity" class="field-short">
                <option value="All" <?php if ($activity == "All") echo "selected"; ?> >All</option>
                <option value="Active" <?php if ($activity == "Active") echo "selected"; ?> >Active</option>
                <option value="Inactive" <?php if ($activity == "Inactive") echo "selected"; ?> >Closed</option>

            </select>
            <input type="submit" name="filter" value="filter" id="submit">
        </form>
        <table class="table table-striped table-bordered" style="font-size:11px;">
            <!-- HEADER INFORMATION -->

            <thead>
            <tr>
                <?php echo "<th><a href='index.php?sort=acct&activity=$activity&sort_by=$sort_order'>Account</a></th>" ?>
                <th>Reconciled</th>
                <?php echo "<th><a href='index.php?sort=status&activity=$activity&sort_by=$sort_order'>Status</a></th>" ?>
                <?php echo "<th><a href='index.php?sort=risk&activity=$activity&sort_by=$sort_order'>Risk</a></th>" ?>

                <?php echo "<th><a href='index.php?sort=pi&activity=$activity&sort_by=$sort_order'>PI</a></th>" ?>
                <?php echo "<th><a href='index.php?sort=admin&activity=$activity&sort_by=$sort_order'>Admin</a></th>" ?>
                <th>Agency</th>
                <th>FFATA</th>
                <th>Prime Start</th>
                <?php echo "<th><a href='index.php?sort=sub&activity=$activity&sort_by=$sort_order'>Subrecipient</a></th>" ?>
                <?php echo "<th><a href='index.php?sort=start&activity=$activity&sort_by=$sort_order'>Sub Start</a></th>" ?>
                <?php echo "<th><a href='index.php?sort=end&activity=$activity&sort_by=$sort_order'>Sub End</a></th>" ?>
                <?php echo "<th><a href='index.php?sort=budget_start&activity=$activity&sort_by=$sort_order'>Budget Start</a></th>" ?>
                <?php echo "<th><a href='index.php?sort=budget_end&activity=$activity&sort_by=$sort_order'>Budget End</a></th>" ?>
                <th>Obligated</th>
                <th>Balance</th>
                <th>PO</th>
                <th>Admin Email</th>
                <!--th>PI Email</th-->
                <?php echo "<th><a href='index.php?sort=emailed_date&activity=$activity&sort_by=$sort_order'>Email Date</a></th>" ?>
                <?php echo "<th><a href='index.php?sort=received&activity=$activity&sort_by=$sort_order'>Received</a></th>" ?>
                <th>Monitoring Due</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Email</th>
                <th>Preview</th>
            </tr>

            <!-- END OF HEADER INFORMATION -->
            </thead>



            <tbody style="font-size: 11px;">
            <tr>

                <?php

                // get request check to see if the get request is set to sort the tables

                $sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'id';

                switch ($sort) {

                    case 'id':
                        $order_by = 'id';
                        break;

                    case 'sub':
                        $order_by = 'sub';
                        break;
                }

                //sql choices based on post request
                $db = new Db();

                if (isset($_POST['filter']) && $_POST['activity'] == 'All') {

                    $rows = $db->select("select * from Subcontracts where hidden is NULL order by $sort $sort_order, acct asc");
                }


                if (isset($_POST['filter']) && $_POST['activity'] == 'Active') {


                    $activity = $_POST['activity'];

                    $rows = $db->select("select * from Subcontracts where hidden is NULL and status='Active' order by $sort $sort_order, acct asc");
                }


                if (isset($_POST['filter']) && $_POST['activity'] == 'Inactive') {

                    $activity = $_POST['activity'];

                    $rows = $db->select("select * from Subcontracts where hidden is NULL and status='Closed' order by $sort $sort_order, acct asc");
                }


                if (!isset($_POST['filter'])) {

                    if (isset($_GET['activity'])) {
                        if ($_GET['activity'] == 'Active') {
                            $rows = $db->select("select * from Subcontracts where hidden is NULL and status='Active' order by $sort $sort_order, acct asc");
                        } elseif ($_GET['activity'] == 'Inactive') {
                            $rows = $db->select("select * from Subcontracts where hidden is NULL and status='Closed' order by $sort $sort_order, acct asc");
                        } else {
                            $rows = $db->select("select * from Subcontracts where hidden is NULL order by $sort $sort_order, acct asc");
                        }
                    } else {
                        $rows = $db->select("select * from Subcontracts where hidden is NULL order by $sort $sort_order, acct asc");
                    }
                }


                //  $db->disconnect();
                // print_r($rows);

                foreach ($rows as $row) {

                    echo "<td>" . $row['acct'] . "</td>";
                    echo "<td>" . $row['rt'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td>" . $row['risk'] . "</td>";
                    echo "<td>" . $row['pi'] . "</td>";
                    echo "<td>" . $row['admin'] . "</td>";
                    echo "<td>" . $row['agency'] . "</td>";

                    echo "<td>" . $row['fed'] . "</td>";
                    echo "<td>" . $row['prime_start'] . "</td>";
                    echo "<td>" . $row['sub'] . "</td>";
                    echo "<td>" . $row['start'] . "</td>";
                    echo "<td>" . $row['end'] . "</td>";
                    echo "<td>" . $row['budget_start'] . "</td>";
                    echo "<td>" . $row['budget_end'] . "</td>";
                    echo "<td>" . $row['obligated'] . "</td>";
                    echo "<td>" . $row['balance'] . "</td>";
                    echo "<td>" . $row['po'] . "</td>";
                    echo "<td>" . $row['admin_email'] . "</td>";

                    echo "<td>" . $row['emailed_date'] . "</td>";
                    echo "<td>" . $row['received'] . "</td>";

                    $new_date = '';
                    if (isset($row['emailed_date'])) {

                        if ($row['risk'] == 'Low') {
                            $due = strtotime('+6 month', strtotime($row['emailed_date']));
                            $new_date = date('Y-m-d', $due);
                        }

                        if ($row['risk'] == 'Medium') {
                            $due = strtotime('+4 month', strtotime($row['emailed_date']));
                            $new_date = date('Y-m-d', $due);
                        }

                        if ($row['risk'] == 'High') {
                            $due = strtotime('+2 month', strtotime($row['emailed_date']));
                            $new_date = date('Y-m-d', $due);
                        }
                    } else {
                        if ($row['risk'] == 'Low') {
                            $due = strtotime('+6 month', strtotime($row['start']));
                            $new_date = date('Y-m-d', $due);
                        }

                        if ($row['risk'] == 'Medium') {
                            $due = strtotime('+4 month', strtotime($row['start']));
                            $new_date = date('Y-m-d', $due);
                        }

                        if ($row['risk'] == 'High') {
                            $due = strtotime('+2 month', strtotime($row['start']));
                            $new_date = date('Y-m-d', $due);
                        }
                    }

                    echo "<td>" . $new_date . "</td>";

                    echo '<td><form name="edit" method="post" action="update_form.php">
                                 <input type="hidden" name="id" value="' . $row['id'] . '"/> <input type="submit" name="edit" value="edit"/>
                                  </form></br></br></td>';

                    echo '<td><form method="post" action="index.php">
                                  <input type="hidden" name="id" value="' . $row['id'] . '"/> <input type="submit" name="delete" value="delete"/>
                                   </form></br></br></td>';

                    echo '<td><form method="post" action="pdftest.php">
                                  <input type="hidden" name="id" value="' . $row['id'] . '"/> <input type="submit" name="email" value="email"/>
                                   </form></br></br></td>';

                    echo '<td><form method="post" action="preview.php" target="_blank">
                                  <input type="hidden" name="id" value="' . $row['id'] . '"/> <input type="submit" name="preview" value="preview"/>
                                   </form></br></br></td></tr>';
                }

                //update information if delete button and id is not null update the database and set database field hidden to yes so users will not able to see the record

                if (isset($_POST['delete']) && isset($_POST['id'])) {
                    $id = $_POST['id'];
                    $currdate = date("Y/m/d");

                    $db = new mysqli($db_host, $db_name, $db_pass, $db_name);
                    $stmt = $db->prepare('update Subcontracts set hidden="yes",updated=? where id=?');
                    $stmt->bind_param('si', $currdate, $id);
                    $stmt->execute();
                    $stmt->close();
                    $db->close();
                }
                ?>



            </tbody>



        </table>
    </div>


</div>

</body>
</html>

