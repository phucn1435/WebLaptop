<?php
    include "./Views/HomeLayout/header.php";
    echo "<title>Thông tin tài khoản</title>";
?>
<style>
    
    
    .container-address1 {
        width: 100%;
        height: 100%;
        background: red;
        /* display: none; */
        /* position: absolute; */
        /* z-index: -1; */
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container-address2 {
        width: 512px;
        height: auto;
        background: yellow;
        /* display: none; */
        position: absolute;
    }
</style>
        <div class="body klkl" style="width: 80%; margin: 12px auto 0;">
            <div style="width: 100%; height: 100%; " class="">
                
                <div style="display: flex;">
                    <?php if(isset($thongtin)) { foreach($thongtin as $row) : extract ($row); ?>
                    <?php include("./Views/HomeLayout/sideleft.php"); ?>
                    <?php endforeach; }?>
                    
                    <div style="width: 100%;" class="">
                        <div style="padding-bottom: 5px;display: flex; justify-content: space-between;" class="">
                            <div style="font-size: 20px; color: black; font-weight: 550;" class="">Thông báo của bạn</div>
                            <div class=""><a style="text-decoration: none;" href="?xemthongbaoall">Đánh dấu tất cả là đã đọc</a></div>
                        </div>
                        <?php  if(isset($_SESSION['id_user'])) { ?>
                        <div style="box-shadow: 1px 2px 3px 4px gray; max-height: 100vh; overflow: auto;" class="">
                        <?php if (is_array($thongbao1)) foreach($thongbao1 as $row) : extract ($row); ?>
                                <?php if($row['action'] == 0) { ?>
                                <a href="../TrangChu/LichSuMuaHang?id=<?=$row['ID']?>&daxem=1" style="text-decoration: none; display: flex; align-items: center; justify-content: space-between; color: black; line-height: 1.5;" class="thongbao--component">
                                    <div class="">
                                        <div style="text-align: left;" class="">
                                            <?=$row['content']?> (MDH: <?=$row['ID_DH']?>)
                                        </div>
                                        <div style="text-align: left; color: blue; font-size: 14px; font-weight: 550;" class="">
                                            <?=$row['ngay']?>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div style="width: 12px; height: 12px; border-radius: 50%; background: blue;" class=""></div>
                                    </div>
                                </a>
                                <?php } else { ?> 
                                 <!-- <a id="link2" class="linkk" style="text-decoration: none;" href="#">Chưa đọc</a>  -->
                                 <!-- <input type="submit" name="OKE" value="SUBMIT">  -->
                                <a href="../TrangChu/LichSuMuaHang?daxem=1" style="text-decoration: none; display: flex; align-items: center; justify-content: space-between; color: black; line-height: 1.5;" class="thongbao--component">
                                    <div class="">
                                        <div style="text-align: left;" class="">
                                            <?=$row['content']?> (MDH: <?=$row['ID_DH']?>)
                                        </div>
                                        <div style="text-align: left; color: #c0c0c0; font-size: 14px; font-weight: 550;" class="">
                                            <?=$row['ngay'];?>
                                        </div>
                                    </div>
                                </a>
                                 <?php } ?>
                                <?php endforeach; ?>
                        </div>
                        <?php } ?>
                    </div>
                    
                </div>
            </div>
        </div>
        
<?php include "./Views/HomeLayout/footer.php" ?>






