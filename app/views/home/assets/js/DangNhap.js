// index
$(document).ready(function () {
    // owlCarousel
    $('#slider .owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        // dots:false,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 3,
            },
            1000: {
                items: 5,
            }
        }
    });
    // owlCarousel2
    $('#slider2 .owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        // dots:false,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 3,
            },
            1000: {
                items: 5,
            }
        }
    });



    // Back to top
    //Check to see if the window is top if not then display button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#myBtn').fadeIn(800);
        } else {
            $('#myBtn').fadeOut(800);
        }
    });

    //Click event to scroll to top
    $('#myBtn').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 800);
        return false;
    });

    

    // Chuyển sang tab tạo tài khoản

    $('#btnTaoTK').on('click', function (e) {
        e.preventDefault()
        $('#myTab a[href="#profile"]').tab('show');
      })

    
});

var vue = new Vue({
    el: '#app',
    data:{
        // DN_h2_text:"Đăng nhập",
        // DN_p_text:"Đăng nhập để theo dõi đơn hàng, lưu danh sách sản phẩm yêu thích, nhận nhiều ưu đãi hấp dẫn."
        DangNhap_left_check: true,
        DangKy_left_check: false,

        //Kiểm tra đăng ký
        // Tạo biến quản lý lỗi là mảng rỗng
        errors: [],
        // Tạo biến quản lý việc kiếm tra Ràng buộc dữ liệu (validation) hay chưa?
        // Mặc định là chưa kiểm tra
        dakiemtraloixong: false,
        // Khởi tạo giá trị ban đầu cho FORM
        DN_hoten:'',
        DN_email:'',
        DN_SDT:'',
        DN_Pass:'',


    },
    methods:{
        DangNhap_left:function(){
            // alert('aaaa');
            this.DangNhap_left_check=true;
            this.DangKy_left_check= false;
        },
        DangKy_left:function(){
            this.DangKy_left_check=true;
            this.DangNhap_left_check=false;
        },

        // Kiểm tra đăng nhập
        kiemTraDangNhap:function(e){
            // e.preventDefault();
            // alert('Vui lòng tạo tài khoản trước khi đăng nhập!');
        },

        //Kiểm tra đăng ký
        kiemTraDuLieu: function (e) {
            // Dừng sự kiện tiếp theo của FORM
            e.preventDefault();
            // Trước khi kiểm tra, cần reset lại biến lỗi
            // => Giả sử như chưa có lỗi xảy ra
            this.errors = [];
            this.dakiemtraloixong = false;
            // Validate Họ tên
            // Kiểm tra rỗng
            if (this.DN_hoten == "") {
                this.errors.push('Vui lòng nhập Họ tên');
            } else if (this.DN_hoten.length < 5) { // Kiểm tra độ dài
                this.errors.push('Vui lòng nhập Họ tên 5 ký tự trở lên');
            }
            // Validate Email
            // Kiểm tra rỗng
            if (this.DN_email == "") {
                this.errors.push('Vui lòng nhập địa chỉ Email');
            } else if (this.DN_email.length < 5) { // Kiểm tra độ dài
                this.errors.push('Vui lòng nhập địa chỉ Email 5 ký tự trở lên');
            } else if (!this.validateEmail(this.DN_email)) { // Kiểm tra mẫu nhập EMAIL
                this.errors.push('Vui lòng nhập email đúng định dạng');
            }
            // Validate Số điện thoại
            // Kiểm tra rỗng
            if (this.DN_SDT == "") {
                this.errors.push('Vui lòng nhập số điện thoại');
            } else if (this.DN_SDT.length < 10) { // Kiểm tra độ dài
                this.errors.push('Vui lòng nhập số điện thoại 10 ký tự trở lên');
            }
            // Validate Lời nhắn
            // Kiểm tra rỗng
            if (this.DN_Pass == "") {
                this.errors.push('Vui lòng nhập mật khẩu');
            } else if (this.DN_Pass.length < 5) { // Kiểm tra độ dài
                this.errors.push('Vui lòng nhập mật khẩu 5 ký tự trở lên');
            }
            // Đã kiểm tra lỗi xong
            this.dakiemtraloixong = true;
            // Ví dụ demo, ngưng gởi dữ liệu SUBMIT đi
            // Always return false
            return false;
        },
        validateEmail: function (email) {
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                return true;
            }
            return false;
        },
        hienThiThongBaoLoi: function() {
            // Nếu chưa vượt qua bước kiểm tra lỗi thì không được hiển thị thông báo
            if(this.dakiemtraloixong == false) {
                return false;
            }
            // Nếu có bất kỳ lỗi nào (mảng array lỗi không rỗng) => độ dài array > 0)
            // Có lỗi => được hiển thị thông báo lỗi
            if(this.errors.length > 0) {
                return true;
            } 
            // Nếu không có lỗi thì không được hiển thị thông báo lỗi
            return false;
        },
        hienThiThongBaoChaoMung: function() {
            // Nếu chưa vượt qua bước kiểm tra lỗi thì không được hiển thị thông báo
            if(this.dakiemtraloixong == false) {
                return false;
            }
            // Nếu không có bất kỳ lỗi nào (mảng array lỗi là rỗng) => độ dài array == 0)
            // Không có lỗi => được hiển thị thông báo chào mừng
            if(this.errors.length == 0) {
                return true;
            } 
            // Mặc định không hiển thị
            return false;
        }
    },
});
