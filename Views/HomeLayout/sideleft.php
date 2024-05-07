
<div class="account-info--container-left">
                        <?php if(isset($_SESSION['id_user'])) { ?>
                        <div style="display: flex;" class="">
                            <div class="">
                                <img style="width: 44px; height: 44px;" src="../Assets/data/AvatarKhachHang/<?= $row['AnhDaiDien']; ?>" alt="">
                            </div>
                            <div style="margin-left: 10px;" class="">
                                <div style="font-weight: 400; font-size: 16px;" class="">Tài khoản của</div>
                                <div style="font-weight: 550; font-size: 17px;" class=""><?=$row['TenKhachHang']?></div>
                            </div>
                        </div>
                        <div class="">
                            <div style="display: flex; align-items: center; margin-top: 15px;" class="">
                                <a style="text-decoration: none;" href="../TrangChu/ThongTinTaiKhoan" style="width: 10%;" class="">
                                    <i class="fa-solid fa-user"></i>
                                </a>
                                <a style="text-decoration: none; margin-left: 18px;" href="../TrangChu/ThongTinTaiKhoan" style="margin-left: 10px;" class="">
                                    Thông tin tài khoản
                                </a>
                            </div>
                            <div style="display: flex; align-items: center; margin-top: 15px;" class="">
                                <a style="width: 10%; text-decoration: none;" href="../TrangChu/LichSuMuaHang" class="">
                                    <i class="fa-solid fa-money-bill"></i>                                
                                </a>
                                <a style="margin-left: 10px;text-decoration: none;" href="../TrangChu/LichSuMuaHang" class="">
                                    Quản lý đơn hàng
                                </a>
                            </div>
                            <div style="display: flex; align-items: center; margin-top: 15px;" class="">
                                <div style="width: 10%;" class="">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div style="margin-left: 10px;" class="">
                                    Sổ địa chỉ
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; margin-top: 15px;" class="">
                                <a style="width: 10%; text-decoration: none;" href="../TrangChu/WhistList" class="">
                                    <i class="fa-solid fa-money-bill"></i>                                
                                </a>
                                <a style="margin-left: 10px;text-decoration: none;" href="../TrangChu/WhistList" class="">
                                    WhistList
                                </a>
                            </div>
                            <?php } ?>
                            <?php include("./Views/HomeLayout/notify.php"); ?>
                        </div>
                    </div>