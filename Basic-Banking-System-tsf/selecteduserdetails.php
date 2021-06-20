<?php
include 'data.php';

if(isset($_POST['submit'])) {
    $form = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $selectQueryFrom = "SELECT * from customers where id=$form";
    $query = mysqli_query($conn, $selectQueryFrom);
    $result1 = mysqli_fetch_array($query);

    $selectQueryTo = "SELECT * from customers where id=$to";
    $query = mysqli_query($conn, $selectQueryTo);
    $result2 = mysqli_fetch_array($query);

    // Checking if the amount is negative
    if (($amount) < 0) {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';
    }

    // constraint to check insufficient balance.
    else if ($amount > $result1['customers_Currbalance']) {

        echo '<script type="text/javascript">';
        echo ' alert("  Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }

    // constraint to check zero values
    else if ($amount == 0) {

        echo "<script type='text/javascript'>";
        echo "alert('Oops! Zero balance cannot be transferred')";
        echo "</script>";
    } else {
        $newbalance = $result1['customers_Currbalance'] - $amount;
        $updateSenderQuery = "UPDATE customers set customers_Currbalance=$newbalance where id=$form";
        mysqli_query($conn, $updateSenderQuery);

        $newbalance = $result2['customers_Currbalance'] + $amount; 
        $updateReceiverQuery = "UPDATE customers set customers_Currbalance=$newbalance where id=$to";
        mysqli_query($conn, $updateReceiverQuery);

        // Insert in transaction history table
        $sender = $result1['customers_name'];
        $receiver = $result2['customers_name'];
        $insertQuery = "INSERT INTO `transfers_money`(`sender`, `receiver`, `amount`) VALUES ('$sender','$receiver','$amount')";
        $query = mysqli_query($conn, $insertQuery);

        if ($query) {

            echo '<script>';
            echo 'alert("Payment successfull");window.location="transactionhistory.php";';

            echo '</script>';
        } else {

            echo '<script>';
            echo 'alert("Something went wrong")';
            echo '</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transfer Money</title>
   
   
    <!-- off-canvas -->
    <link href="css/mobile-menu.css" rel="stylesheet">
    <!-- font-awesome -->
    <link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Style CSS -->
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>
<body>
<div id="main-wrapper">

<div class="uc-mobile-menu-pusher">
<div class="content-wrapper">

<?php include "nav.php" ?>
<section class="single-page-title">
    <div class="container text-center">
     
    </div>
</section>
<section class="about-text ptb-100">
    <section class="section-title">
         
    </section>
    <?php
 //   include 'data.php';
    $sql = "SELECT * FROM customers";
    $result = mysqli_query($conn,$sql);
?>           
<div class="container">
 <form action="" method="POST">
        <div class="sender-info">
            <?php
           // include 'data.php';
            $senderId = $_GET['id'];
            $selectSenderQuery = "SELECT * FROM  customers where id=$senderId";
            $result = mysqli_query($conn, $selectSenderQuery);
            $rows = mysqli_fetch_assoc($result);
            ?>
            <div class="user-info">
                <h1 class="heading-user" style=" cursive;">Sender Information</h1>
                <div class="info">
                    <div>
                        <p><b>NAME</b></p>
                    </div>
                    <div>
                        <p><?php echo $rows['customers_name'] ?></p>
                    </div>
                </div>
                <div class="info">
                    <div>
                        <p><b>EMAIL</b></p>
                    </div>
                    <div>
                        <p><?php echo $rows['customers_email'] ?></p>
                    </div>
                </div>
                <div class="info">
                    <div>
                        <p><b>AMOUNT</b></p>
                    </div>
                    <div>
                        <p><?php echo $rows['customers_Currbalance'] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="receiver-info">
            <?php
            $selectRemainingUser = "SELECT * FROM customers where id!=$senderId";
            $result = mysqli_query($conn, $selectRemainingUser);
            ?>
            <div class="receiver">
                <h1 class="trans-heading" >Transfer To</h1>
                <div class="selectInput-section">
                    <select name="to" class="select-sender" required style="background:white;width:500px;height:50px;text-align:center">
                        <option value="" disabled selected style="color: black;text-align:center;height:20px">---        Choose    ---</option>
                        <?php
                        while ($rows = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo $rows['id'] ?>" style="font-size: 20px;color:black">
                                <?php echo $rows['customers_name']; ?>
                            </option>
                        <?php
                        }

                        ?>
                    </select>
                </div>
            </div>
            <div class="amount">
                <h1 class="trans-heading">Amount</h1>
                <div class="amountInput-section">
                    <input type="number" name="amount" id="ak" required style="font-size: 25px;width:300px;">
                </div>
            </div>
            <div class="submit">
                <input class="submit-btn" type="submit" value="Transfer" name="submit"  >
            </div>
        </div>
    </form>         
</div>
</section>
<?php
  include "footer.php";
?>
 
 <style type="text/css">
   

  
   
 
  
   .user-info,.receiver-info h1{
        color: black;
        padding-top: 2%;
        
       
        text-align: center;
   }
   .info{
       display: inline-table;
       padding-inline: 5px;
       padding-top: 1%;
       background:grey; 
       
       font-size: 20px;
       height: 120px;
   width: 200px;
   text-align: center;
   }
   .selectInput-section .select-sender{
      
       
       
       text-align: center;
       letter-spacing: 2px;
       max-inline-size: 25%;
       inline-size: unset;
       padding-inline: 50px;
       margin-inline-start: 37%;
   width: 200px;
   }
   .amountInput-section{
       margin-inline-start: 44%;
       padding-top: 2px;
       
   }
   .submit{
       margin-inline-start: 47%;
       padding-top: 25px;
       border-color: navy ;
       font-weight: 500;
       font-size: 25px;
      width: 90px;
   }
   .submit .submit-btn{
       padding:6px 12px;
       
       border: 0px;
       border-radius: 6px;
       padding: 10px;
       margin :20px;
       background:green; 
       color:black;
       letter-spacing: 1.5px;
       font-size: 20px;
       transition: 0.5s;
   }
   #ak{
       margin-right: 2000px;
       margin-left: -80px;
       
   }
   
   </style>
      
</body>
</html>