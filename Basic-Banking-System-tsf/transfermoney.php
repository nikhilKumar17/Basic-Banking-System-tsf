<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transfer Money</title>
   
    </style>
     
    <link href="css/mobile-menu.css" rel="stylesheet">
    <!-- font-awesome -->
    <link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Style CSS -->
    <link href="css/style.css" rel="stylesheet">
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
        <div class="container text-center">
            <h2>Transfer Money</h2>
           
        </div>
    </section>
    <?php
    include 'data.php';
    $sql = "SELECT * FROM customers";
    $result = mysqli_query($conn,$sql);
?> 
<div class="container">
        <div class="row">
            <div class="col-md-6">
        <div class="table-responsive-sm">
                    <table class="table table-hover table-sm table-striped table-condensed table-bordered" style="border-color:black;width:1200px;height:500px">
                        <thead style="color : black;">
                            <tr>
                            <th scope="col" class="text-center py-2" >Id</th>
                            <th scope="col" class="text-center py-2">Name</th>
                            <th scope="col" class="text-center py-2">E-Mail</th>
                            <th scope="col" class="text-center py-2">Balance</th>
                            <th scope="col" class="text-center py-2">Transct </th>
                            </tr>
                        </thead>
                        <tbody>
                <?php 
                    while($rows=mysqli_fetch_assoc($result)){
                ?>
                    <tr style="color : black;">
                        
                    <td class="py-2" ><?php echo $rows['id'] ?></td>
                        <td class="py-2"><?php echo $rows['customers_name']?></td>
                        <td class="py-2" ><?php echo $rows['customers_email']?></td>
                        <td class="py-2"><?php echo $rows['customers_Currbalance']?></td>
                     
                        <td><a href="selecteduserdetails.php?id= <?php echo $rows['id'] ;?>">
                                   <button type="button" class="btn btn-success" style="" >Transaction</button></a></td> 
                    </tr>
                <?php
                    }
                ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div> 
         </div>          
</section>  

<?php include "footer.php"?>

</body>
</html>