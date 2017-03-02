<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);

        include_once 'include/database.php';
        include_once 'include/conn.php';
        include_once 'include/phpfunctions.php';

        $error= "";
        $update= true;


        //see if user has access using the Uservalidate function
        if (UserValidate()==FALSE) {

            echo 'you are not allowed to add items';
            echo '</br><a href="index.php">Back to main page.</a>';
            exit();

        }


        // validation --- see if it is post and assign variables to post data will update with a function but for now we will just use the basic if/else claus-- use an is empty function returning text
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $balance = strip_tags($_POST["balance"]);

            $sub = strip_tags($_POST["sub"]);

            if (empty($_POST["acct"])) {

                $update = false;
                $error = "Please make sure you entered the required fields with *!";
            }
            else {
                $acct = strip_tags($_POST["acct"]);

            }
            if (empty($_POST["risk"])) {

                $update = false;
                $error = "Please make sure you entered the required fields with *!";
            }
            else {
                $risk= strip_tags($_POST["risk"]);

            }

            if (empty($_POST["status"])) {

                $update = false;
                $error = "Please make sure you entered the required fields with *!";
            }
            else {
                $status = strip_tags($_POST["status"]);

            }
            if (empty($_POST["pi"])) {

                $update = false;
                $error = "Please make sure you entered the required fields with *!";
            }
            else {
                $pi = strip_tags($_POST["pi"]);

            }
            if (empty($_POST["admin"])) {

                $update = false;
                $error = "Please make sure you entered the required fields with *!";
            }
            else {
                $admin = strip_tags($_POST["admin"]);

            }

            if (empty($_POST["agency"])) {

                $update = false;
                $error = "Please make sure you entered the required fields with *!";
            }
            else {
                $agency = strip_tags($_POST["agency"]);

            }

            if (empty($_POST["fed"])) {

                $update = false;
                $error = "Please make sure you entered the required fields with *!";
            }
            else {
                $fed = strip_tags($_POST["fed"]);

            }

            if (empty($_POST["start"])) {

                $update = false;
                $error = "Please make sure you entered the required fields with *!";
            }
            else {
                $start = strip_tags($_POST["start"]);

            }

            if (empty($_POST["end"])) {

                $update = false;
                $error = "Please make sure you entered the required fields with *!";
            }
            else {
                $end = strip_tags($_POST["end"]);

            }
            if (empty($_POST["budget_start"])) {

                $update = false;
                $error = "Please make sure you entered the required fields with *!";
            }
            else {
                $budget_start = strip_tags($_POST["budget_start"]);

            }
            if (empty($_POST["budget_end"])) {

                $update = false;
                $error = "Please make sure you entered the required fields with *!";
            }
            else {
                $budget_end = strip_tags($_POST["budget_end"]);

            }
            if (empty($_POST["obligated"])) {

                $update = false;
                $error = "Please make sure you entered the required fields with *!";
            }
            else {
                $obligated = strip_tags($_POST["obligated"]);

            }
            if (empty($_POST["po"])) {

                $update = false;
                $error = "Please make sure you entered the required fields with *!";
            }
            else {
                $po = strip_tags($_POST["po"]);

            }

            if (empty($_POST["admin_email"])) {

                $update = false;
                $error = "Please make sure you entered the required fields with *!";
            }
            else {
                $admin_email = strip_tags($_POST["admin_email"]);

            }


            if (empty($_POST["prime_start"])) {

                $update = false;
                $error = "Please make sure you entered the required fields with *!";
            }
            else {
                $prime_start = strip_tags($_POST["prime_start"]);

            }


            if (empty($_POST["financial_email"])) {

                $update = false;
                $error = "Please make sure you entered the required fields with *!";
            }
            else {
                $financial_email = strip_tags($_POST["financial_email"]);

            }
            if (empty($_POST["pi_email"])) {

                $update = false;
                $error = "Please make sure you entered the required fields with *!";
            }
            else {
                $pi_email= strip_tags($_POST["pi_email"]);

            }

            $comments= strip_tags($_POST["comments"]);
            $question = strip_tags($_POST["question"]);
            $received = strip_tags($_POST["received"]);


             //end validation we are stripping out the html/ and other non string characters
            //
            //
            //
            // insert into the database using prepared statements with stripping non-html
            $db = new mysqli($db_host, $db_name, $db_pass, $db_name);

            if (isset($_POST['submit']) && !isset($_POST['id']) && $update==true) {

                $rt = strip_tags($_POST['rt']);

                $currdate= date("Y/m/d");



                $stmt = $db->prepare("insert into Subcontracts (acct,rt,risk,status,pi,admin,agency,fed,prime_start,sub,start,end,budget_start,budget_end,obligated,
                          balance,po,financial_email,pi_email,admin_email,updated,comments,received,question) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

                $stmt->bind_param("ssssssssssssssssssssssss", $acct, $rt, $risk, $status, $pi, $admin, $agency, $fed,$prime_start,$sub, $start, $end, $budget_start, $budget_end, $obligated,$balance, $po, $financial_email, $pi_email,$admin_email,$currdate,$comments,$received,$question);

                $stmt->execute();

                $stmt->close();
                $db->close();

                //redirect
                header('Location:index.php');
            }


        }


        ?>


<html>
<head>
    <meta charset="UTF-8">
    <title></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/form.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <script src="//code.jquery.com/jquery-1.10.2.js"></script>

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script>
        $(function () {
            $(".date-short").datepicker();
        });


    </script>

    <script type="text/javascript" >



    </script>

 <!------------------------------ start actual form --------------------------------------------->
</head>
        <body>
        <form method="post">
        <ul class="form-style-1">
            <h1>Subcontracts</h1>
            <li><label>Account# <span class="required">*</span></label><input type="text" name="acct" class="field-short"   />
                &nbsp;


                <label>Agency</label><span class="required">*</span><input type="text" name="agency" class="field-long"    />&nbsp;
                &nbsp;

            </li>


            <hr />
            <li>
                <label>Subrecipient</label><span class="required">*</span><input type="text" name="sub" class="field-long"    />&nbsp;
                &nbsp;

                <label>Active <span class="required">*</span></label>
                <select name="status" class="field-short">
                    <option value=""  >Pick One</option>
                    <option value="Active" >Active</option>
                    <option value="Inactive" >Inactive</option>
                    <option value="Closed" >Closed</option>

                </select>
                <label>Prime Start</label><span class="required">*</span><input type="text" name="prime_start" class="date-short"   />&nbsp;
                &nbsp;


            </li>
            <hr/>
            <li>
                <label>Risk<span class="required">*</span></label>
                <input type="text" name="risk" class="field-short" />

                <label>PI<span class="required">*</span></label>
                <input type="text" name="pi" class="field-short"  />


                <label>Admin<span class="required">*</span></label>
                <input type="text" name="admin" class="field-long"  />


                <label>FFATA <span class="required">*</span></label>
                <input type="text" name="fed" class="field-short"  />

            </li>
            <hr/>
            <li>
                <label>Project Start <span class="required">*</span></label>
                <input type="text" name="start" class="date-short"  />

                <label>Project End <span class="required">*</span></label>
                <input type="text" name="end" class="date-short"  />
            </li>
            <hr/>
            <li>
                <label>Budget Start <span class="required">*</span></label>
                <input type="text" name="budget_start" class="date-short" />


                <label>Budget End <span class="required">*</span></label>
                <input type="text" name="budget_end" class="date-short" />
            </li>
            <hr/>
            <li>
                <label>Obligated Amount<span class="required">*</span></label>
                <input type="text" name="obligated" class="field-short"  />


                <label>Current Balance<span class="required">*</span></label>
                <input type="text" name="balance" class="field-short"  />

                <label>PO<span class="required">*</span></label>
                <input type="text" name="po" class="field-long" />

            </li>
            <hr/>
            <li>
                <label>Admin Email <span class="required">*</span></label>
                <input type="email" name="admin_email" class="short"  />


                <label>Financial Admin Email <span class="required">*</span></label>
                <input type="email" name="financial_email" class="short"  />

                <label>PI Email <span class="required">*</span></label>
                <input type="email" name="pi_email" class="short"  />

            </li>


            <li>

                <hr>

                <label>Received</label>
                <input type="text" name="received" class="short"  />

                <label>Reconciled </label><input type="text" name="rt" class="field-short"   />&nbsp;
                &nbsp;



            </li>
            <hr>

            <li>

                <label>Comments</label>
                <textarea  rows="5" id="comments" name="comments"/></textarea>

                <hr>

            <li>

            </li>
            <label>Other Question</label>
            <input type="text" name="question" class="field-long"  style="width:600px;" />
            </li>
            <hr>
            <li>


                <input type="submit" name="submit" value="Submit" />
                <input type="button" onclick="location.href='index.php'" value="Main Menu">
            </li>

            <li style="font-size: 14pt; color: red;">
                <?php echo $error;  ?>
            </li>
        </ul>
        </form>


        </body>
        </html>

