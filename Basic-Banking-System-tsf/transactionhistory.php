<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>transaction history</title>
    <style>
th{
    background-color: navy ;
    width: 1200px;
    height: 60px;
    color:white;
    text-align: center;
    font-size: 20px;
}
td{
    text-align: center;
    width:200px;
    height:50px;
    font-size: 20px;
}
    </style>
   
    
    <!-- font-awesome -->
    <link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Style CSS -->
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>
<!-- <body style="background-color : rgb(234, 243,250 )"> -->
 


<div id="main-wrapper">
 
<!-- <div class="uc-mobile-menu-pusher"> -->
<div class="content-wrapper">

 <?php include "nav.php" ?>

 
<section class="single-page-title">
    
</section>
<section class="contact-form ptb-100">
<section class="section-title">
        <div class="container text-center">
           
            <h2>TRANSACTION HISTORY</h2>
        </div>
    </section>
    <div class="container">
       <br>
       <div class="table-responsive-sm" style="background-color: #E0E0E0">
    <table class="table table-hover table-striped table-condensed table-bordered">
        <thead style="color : black;">
            <tr>
                <th class="text-center">S.No.</th>
                <th class="text-center">Sender</th>
                <th class="text-center">Receiver</th>
                <th class="text-center">Amount</th>
            </tr>
        </thead>
        <tbody>
        <?php
            include 'data.php';
            $sql ="select * from transfers_money ";
            $query =mysqli_query($conn, $sql);
            while($rows = mysqli_fetch_assoc($query)){  
        ?>
            <tr style="color : black;">
            <td class="py-2"><?php echo $rows['id']; ?></td>
            <td class="py-2"><?php echo $rows['sender']; ?></td>
            <td class="py-2"><?php echo $rows['receiver']; ?></td>
            <td class="py-2"><?php echo $rows['amount']; ?> </td>      
        <?php
          } 
        ?>
        </tbody>
    </table>
    </div>
 </div> 
</section>
 <?php include "footer.php"; ?>
 
</body>
</html>