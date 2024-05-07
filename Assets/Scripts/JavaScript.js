
document.addEventListener('DOMContentLoaded', function(){
  var checkboxAll = $('#checkboxAll');
  var checkbox = $('.checkbox1');
  // console.log(checkbox);
  checkboxAll.change(function(){
  var isChecked = $(this).prop('checked');
  checkbox.prop('checked', isChecked);
  })
  
  // console.log(checkbox);
  checkbox.change(function(){
  var isChecked = checkbox.length === $('.checkbox1:checked').length;
  // console.log(isChecked);
  checkboxAll.prop('checked', isChecked);
});
});
$(document).ready(function(){
    $('.slick-slider').slick({
      dots: true, // Hiển thị điểm chuyển đổi
      infinite: true, // Vô hạn cuộn
      speed: 500, // Tốc độ cuộn (milliseconds)
      slidesToShow: 1, // Số lượng hiển thị ảnh cùng lúc
      slidesToScroll: 1, // Số lượng ảnh cuộn trong mỗi lần chuyển đổi
      autoplay: true,
      autoplaySpeed: 2000,
      prevArrow: 
        `<button style='display: none;' type='button' class='slick-prev pull-left'><i class="fa-solid fa-arrow-left"></i></button>`,
      nextArrow:
        `<button type='button' class='slick-next pull-right'><i class="fa-solid fa-arrow-right"></i></button>`,
    });
  });

$(document).ready(function(){
    $('.slick-slider1').slick({
      dots: false, // Hiển thị điểm chuyển đổi
      infinite: true, // Vô hạn cuộn
      speed: 500, // Tốc độ cuộn (milliseconds)
      slidesToShow: 5, // Số lượng hiển thị ảnh cùng lúc
      slidesToScroll: 1, // Số lượng ảnh cuộn trong mỗi lần chuyển đổi
      autoplay: true,
      autoplaySpeed: 2000,
      arrows: true,
      prevArrow: 
        `<button style='display: none;' type='button' class='slick-prev1 pull-left'><i class="fa-solid fa-arrow-left"></i></button>`,
      nextArrow:
        `<button type='button' class='slick-next1 pull-right'><i class="fa-solid fa-arrow-right"></i></button>`,
    });
  });

  $(document).ready(function(){
    $('.slick-slider3').slick({
      dots: false, // Hiển thị điểm chuyển đổi
      infinite: true, // Vô hạn cuộn
      speed: 500, // Tốc độ cuộn (milliseconds)
      slidesToShow: 5, // Số lượng hiển thị ảnh cùng lúc
      slidesToScroll: 5, // Số lượng ảnh cuộn trong mỗi lần chuyển đổi
      autoplay: false,
      // autoplaySpeed: 2000,
      arrows: true,
      prevArrow: 
        `<button style='display: none;' type='button' class='slick-prev3 pull-left'><i class="fa-solid fa-arrow-left"></i></button>`,
      nextArrow:
        `<button type='button' class='slick-next3 pull-right'><i class="fa-solid fa-arrow-right"></i></button>`,
    });
  });

  




 


  $(document).ready(function(){
    $('.slick-slider2').slick({
      dots: false, // Hiển thị điểm chuyển đổi
      infinite: true, // Vô hạn cuộn
      speed: 500, // Tốc độ cuộn (milliseconds)
      slidesToShow: 4, // Số lượng hiển thị ảnh cùng lúc
      slidesToScroll: 1, // Số lượng ảnh cuộn trong mỗi lần chuyển đổi
      autoplay: true,
      autoplaySpeed: 2000,
      arrows: true,
      prevArrow: 
        `<button style='display: none;' type='button' class='slick-prev2 pull-left'><i class="fa-solid fa-arrow-left"></i></button>`,
      nextArrow:
        `<button type='button' class='slick-next2 pull-right'><i class="fa-solid fa-arrow-right"></i></button>`,
    });
  });



window.addEventListener('scroll', function() {
    var element = document.getElementById('fixed');
    var element1 = document.getElementById('hide-element');
    var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
  
    if (scrollPosition >= 100) { // Đổi giá trị 200 thành độ pixel mà bạn muốn kích hoạt fixed
      element.classList.add('fixed');
      element1.classList.add('hide-element');
      document.getElementById('header-cate').style.display = "inline-block";
    } else {
      element.classList.remove('fixed');
      element1.classList.remove('hide-element');
      document.getElementById('header-cate').style.display = "none";
      document.querySelector('.header-cate--title--list').style.display = 'none';
    }

  });

  window.addEventListener('scroll', function() {
    var backToTopButton = document.getElementById('back-to-top');
    
    if (window.pageYOffset > 530) { // Khi cuộn xuống 200px
      backToTopButton.style.display = 'block';
      backToTopButton.classList.add('show');
    } else {
      backToTopButton.style.display = 'none';
    }
  });
  
  document.getElementById('back-to-top').addEventListener('click', function(e) {
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: 'smooth' }); // Cuộn về đầu trang một cách mượt mà
  });

  var categoryTitle = document.querySelector('.header-cate--container');
var categoryList = document.querySelector('.header-cate--title--list');

categoryTitle.addEventListener('click', function() {
if (categoryList.style.display === 'none') {
categoryList.style.display = 'block'; // Hiển thị danh sách danh mục
} else {
categoryList.style.display = 'none'; // Ẩn danh sách danh mục
}
});

document.addEventListener('DOMContentLoaded', function(){
var checkboxAll = $('#checkboxAll');
var checkbox = $('.checkbox1');
// console.log(checkbox);
checkboxAll.change(function(){
var isChecked = $(this).prop('checked');
checkbox.prop('checked', isChecked);
})

// console.log(checkbox);
checkbox.change(function(){
var isChecked = checkbox.length === $('.checkbox1:checked').length;
// console.log(isChecked);
checkboxAll.prop('checked', isChecked);
})
}) 

document.getElementById("showMoreLink").addEventListener("click", function(event) {
event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ <a>
var container = document.querySelector(".checkbox-container");
var showMore = document.querySelector(".show-more");
container.style.maxHeight = "none"; // Xóa giới hạn chiều cao
showMore.style.display = "none";
});

document.getElementById("kiki").addEventListener("click", function() {
var container = document.querySelector(".checkbox-container");
var container1 = document.querySelector(".fa-arrow-up1");
if (container.style.display == "none") {
container.style.display = "block";
container1.style.transform = "rotate(0)";
container1.style.transition = "transform .4s";

} else {
container.style.display = "none";
container1.style.transform = "rotate(-180deg)";
container1.style.transition = "transform .4s";
}
});
  
    function showNotification() {
        var notification = document.getElementById("notifications");
        notification.innerHTML = "Đã thêm!";
        notification.classList.add("show");
        setTimeout(function() {
          notification.classList.remove("show");
        }, 3000);
        return false; // Ngăn form gửi đi và tải lại trang
      }  

      
      
     

      function showForm() {
        // event.preventDefault();
        const formContainer = document.getElementById('inform-receiveProduct');
        // const overlay = document.createElement('div');
        // overlay.classList.add('overlay');
        const test10 = document.getElementById('container10');
        
        // document.body.style.opacity = '0.5'; // Làm mờ body
        // document.body.appendChild(overlay);
        test10.style.opacity = '0.5';
        formContainer.style.display = 'block';
        
        test10.style.pointerEvents = "none";
        document.body.style.overflow = "hidden";
        formContainer.style.animation = 'slideDown 0.5s'; 


        // handle
        
      }

      function showForm1() {
        // event.preventDefault();
        const formContainer = document.getElementById('inform-receiveProduct1');
        // const overlay = document.createElement('div');
        // overlay.classList.add('overlay');
        const test10 = document.getElementById('container10');
        
        // document.body.style.opacity = '0.5'; // Làm mờ body
        // document.body.appendChild(overlay);
        test10.style.opacity = '0.5';
        formContainer.style.display = 'block';
        
        test10.style.pointerEvents = "none";
        document.body.style.overflow = "hidden";
        formContainer.style.animation = 'slideDown 0.5s'; 

        // handle
        
      }

     
     
      function hideForm() {
        const formContainer = document.getElementById('inform-receiveProduct');
        // const overlay = document.querySelector('.overlay');
        const test10 = document.getElementById('container10');
        formContainer.style.animation = 'slideUp 0.5s forwards';
        setTimeout(() => {
          formContainer.style.display = 'none';
          test10.style.opacity = '1';
          document.body.style.overflow = "auto";
          test10.style.pointerEvents = "auto";

          formContainer.style.animation = '';
        }, 500);

        // document.body.removeEventListener("click", arguments.callee);
        // overlay.parentNode.removeChild(overlay);
      }

      function hideForm1() {
        const formContainer = document.getElementById('inform-receiveProduct1');
        // const overlay = document.querySelector('.overlay');
        const test10 = document.getElementById('container10');
        formContainer.style.animation = 'slideUp 0.5s forwards';
        setTimeout(() => {
          formContainer.style.display = 'none';
          test10.style.opacity = '1';
          document.body.style.overflow = "auto";
          test10.style.pointerEvents = "auto";

          formContainer.style.animation = '';
        }, 500);

        // document.body.removeEventListener("click", arguments.callee);
        // overlay.parentNode.removeChild(overlay);
      }

      function validateDate() {
        // Lấy giá trị ngày hiện tại
        var ngaybatdau = new Date(document.getElementById("ngaybatdau").value);
  
        // Lấy giá trị ngày được chọn từ trường input date
        var ngayketthuc = new Date(document.getElementById("ngayketthuc").value);
  
        // So sánh ngày được chọn với ngày hiện tại
        if (ngayketthuc < ngaybatdau) {
          // Nếu ngày được chọn nhỏ hơn ngày hiện tại, báo lỗi
          alert("Ngày không hợp lệ. Vui lòng chọn một ngày trong tương lai.");
          // Xoá giá trị ngày đã chọn
          document.getElementById("ngayketthuc").value = "";
        }
      }

     



      // const size = document.querySelector('.size');

      // const lefft = document.getElementById('leftt');
      // const rightt = document.getElementById('rightt');
      // const expand = document.querySelector('.expand');
      // const expand1 = document.getElementById('expanded');


      // const showWeb = document.getElementById('showWeb1');
      // const showWeb1 = document.getElementById('showw');

      // showWeb.onclick = () => {
      //     showWeb1.classList.toggle('showWeb');
      //     showWeb1.classList.toggle('hideWeb');
      // }


      // size.onclick = () => {
      //     lefft.classList.toggle('left1');
      //     rightt.classList.toggle('right1');
      //     expand1.classList.toggle('expand');
      // }

      

      
      
