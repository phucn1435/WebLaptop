<?php include("./Views/Layout/header.php"); ?>
<style>
	.navbar-nav {
		width: 16.667%;
	}
	.container-fluid{
		width: 100%;
	}

	a.btn.btn-dark.dropdown-toggle {
		width: 220px;
		position: relative;
		margin-top: 15px;
	}

	a.btn.btn-dark.dropdown-toggle:hover{
		box-shadow: 1px 1px 6px 0.1px white;
		background: none;
		transition: all .1s linear;
	}
.logout:hover {
    background-color: rgb(186, 182, 182);
	transition: background-color .3s ease-in-out;
	border-radius: 5px;
}
.container-fluid {
	width: 100%;
}
.col-md-2 .border-bottom{
    margin-left: 10px;
    height: auto;
    padding: 20px 0;
}

/* .collapse > a > li:hover{
	color: #fff;
} */


.nav-stacked {
	padding-bottom: 100px;
}

.hihi {
	text-align: left;
	width: 100%;
}

.fa-caret-down:before {
	position: absolute;
	right: 13px;
	/* margin-top: -15px; */
}

.dropdown-toggle:after{
	/* display: none; */
	right: 0;
}

.dropdown-toggle:before{
	display: inline-block;
}

.fa-caret-down {
	position: absolute;
	right: 0;
	/* display: inline-block; */
	margin-top: 28px;
}


.aaa {
	display: inline-block;
	width: 20px;
}

.bbb {
	display: inline-block;
	width: 145px;
	text-align: left;
	margin-left: 5px;
}

.collapse > a > li:hover {
    /* color: #fff; */
	/* transition: all .10s linear; */
}

.profile {
  margin: 50px auto;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  background-color: #ffffff;
  max-width: 600px;
}

.profile-header {
  display: flex;
  flex-direction: row;
  align-items: center;
}

.profile-image img {
  border-radius: 50%;
  border: 4px solid #ffffff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.profile-info {
  margin-left: 20px;
}

.profile-name {
  font-size: 24px;
  margin: 0;
}

.profile-email, .profile-location {
  font-size: 16px;
  margin: 0;
  color: #666666;
}

.profile-interests {
  margin-top: 20px;
}

.profile-section-title {
  font-size: 18px;
  margin: 0 0 10px 0;
}

.profile-interests-list {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.profile-interests-list li {
  font-size: 16px;
  padding: 5px 0;
  border-bottom: 1px solid #eeeeee;
}


/* Add */

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap');
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Popins', sans-serif;
    }

    .wrapper {
        width: 100%;
        height: 100%;
    }

    .header {
        height: 70px;
        width: 100%;
        position: fixed;
       
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: -1px 4px 5px #c1c1c1;
        z-index: 1000;
        background: black;
    }

    .body {
        display: flex;
        z-index: 0;
        
    }

    .left {
        width: 16%;
        min-height: 100vh;
        background-color: black;    
        position: fixed;
        top: 70px;
        transition: linear .3s;
    }

    .left1 {
        width: 0;
        opacity: 0;
        transition: linear .3s;
    }

    .right {
        width: 84%;
        min-height: 100vh;
        left: 16%;
        position: absolute;
        top: 70px;
        transition: linear .3s;
        z-index: 1;
        background-color: #ebebeb;
    }

    .right1 {
        width: 100%;
        left: 0;
        transition: linear .3s;
    }

    .dropdown-toggle::after {
        position: absolute;
        right: 0;
        margin-top: 10px;
        font-size: 20px;
        color: white;
    }
    
    .li1 {
        transition:  .5s ease-in-out;
    }

    .expand {
        left: 10%;
        z-index: 10000000;
        display: block;
    }

    .showWeb {
        display: block;
    }

    .hideWeb {
        display: none;
    }

    .animation {
        animation: scale 1s ease-in-out infinite;
    }

    @keyframes scale {
        from {
            transform: scale(2);
            opacity: 0.5;
        }
        to {
            opacity: 1;
            transform: scale(1);

        }
    }

    .billManage {
        width: 22%;
        height: auto;
    }

    .content-contain {
        width: 22%; 
        background: red; 
        padding: 10px;
        border-radius: 7px;
    }

    a {
        text-decoration: none;
    }


</style>


<div class="col-md-12 mt-2">
    <span class="h3 m-2">Profile</span>
	<span style="color: blue;">
        <i class="fa fa-angle-double-right" aria-hidden="true" style="font-size: 15px; "></i>
		My Profile
    </span>

</div>
<hr>


<div class="col-md-12 mt-3">
<?php 
    if(!empty($result)):
        $i = 0;
    foreach ($result as $row) : extract($row);$i++; ?> 
	<?php if($row['TenDangNhap'] === $_SESSION['dangnhap']) { ?>
<div class="profile">
      <div class="profile-header">
        <div class="profile-image">
          <img src="../Assets/AvatarNhanVien/<?= $row['AnhDaiDien'] ?>" alt="Profile Picture" width="150px" height="150px">
        </div>
        <div class="profile-info">
          <h1 class="profile-name"><?=$row['TenNhanVien']?></h1>
          <p class="profile-email"><?=$row['GioiTinh'] == 1 ? "Nam" : "Nữ"; ?></p>
          <p class="profile-email"><?=$row['Email']?></p>
          <p class="profile-location"><?=$row['DiaChi']?></p>
          <p class="profile-location"><?=$row['SoDienThoai']?></p>
        </div>
      </div>
      <div class="profile-interests">
        <h2 class="profile-section-title">Account</h2>
        <ul class="profile-interests-list">
          <li>Tên đăng nhập: <?=$row['TenDangNhap']?></li>
          <li>Trạng thái: <?=$row['TrangThai'] == 1 ? "Active" : "Non-Active"; ?></li>
        </ul>
      </div>
    </div>
</div>
<?php } ?>
<?php endforeach; endif; ?>
<?php
    include "./Views/Layout/footer.php";
?>
			
</html>
<!-- <style>
				a{
					text-decoration: none;
				}
				a > li{
					color: gray;
				}
				.collapse > a > li:hover{
					color: white;
				}

				.collapse > a {
					width: 233px;
					display: inline-block;
					margin-left: -45px;
				}

				.collapse > a > li {
					padding: 5px 0;
				}

				.collapse > a > li:hover {
					background: #7b7979;
					transition: all .2s linear;
					border-radius: 5px;
				}

				.collapse > a > li > span {
					/* width: 265px; */
					display: inline-block;
					margin-left: 45px;
				}
			</style> -->