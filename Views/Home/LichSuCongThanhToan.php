<?php
include "./Views/HomeLayout/header.php";
?>

<div class="container rounded mt-4">
    
    <div class="row">
    
                    <?php foreach($thongtin as $row) : extract ($row); ?>
                    <?php include("./Views/HomeLayout/sideleft.php"); ?>
                    <?php endforeach; ?>
        <div class="col-md-9 bg-light rounded row">
            <h3 style="">Lịch sử cổng thanh toán: <?=$lichsu[0]['id_tttt'];?> </h3>
            
            <div class="container">
                <div class="btn-group col-md-12 row mx-0 mt-3">
                    <div class="">
                        <div style="width: 100%; text-align: center; margin-top: 10px;" class="">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">VNP_BankTrans</th>
                                    <th scope="col">VNP_BankCode</th>
                                    <th scope="col">Order_Info</th>
                                    <th scope="col">VNP_Amount</th>
                                    <th scope="col">VNP_CardType</th>
                                    <th scope="col">VNP_PayDate</th>
                                    <th scope="col">VNP_TmnCode</th>
                                    <th scope="col">VNP_Trans</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($lichsu)) { foreach($lichsu as $row) :extract($lichsu); ?>
                                <tr>
                                    <td><?=$row['vnp_banktrans']?></td>
                                    <td><?=$row['vnp_bankcode']?></td>
                                    <td><?=$row['vnp_orderinfo']?></td>
                                    <td><?=$row['vnp_amount']?></td>
                                    <td><?=$row['vnp_cardtype']?></td>
                                    <td><?=$row['vnp_paydate']?></td>
                                    <td><?=$row['vnp_tmncode']?></td>
                                    <td><?=$row['vnp_transaction']?></td>
                                </tr>
                                <?php endforeach; } ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-outline-primary col-md-2">Chờ xác nhận</button> -->
                   
                </div>
                
     



                    <br>

                </div>
            </div>
        </div>
    </div>
</div>
