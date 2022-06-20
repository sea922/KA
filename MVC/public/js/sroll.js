// window.addEventListener("scroll", function () {
//     let headerMenu = document.querySelector('#menu-area');
//     if (window.pageYOffset > 0) {
//         headerMenu.classList.add("cus-nav");
//     } else {
//         headerMenu.classList.remove("cus-nav");
//     }
// })

function loginOnclick() {
  var x = document.querySelector(".login-children__list");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}

function loginOnblur() {
  var x = document.querySelector(".login-children__list");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}

function deleteComment(id) {
  var option = confirm("Bạn có chắc chắn muốn xoá sản phẩm này không?");
  if (!option) {
    return;
  }
  $.post(
    "../deleteComment",
    {
      id: id,
      action: "delete",
    },
    function (data) {
      location.reload();
    }
  );
}

$(document).ready(function () {
  // PHÂN TRANG
  phantrang();
  showNumAjax();

  var category = [];
  $(".category").click(function () {
    console.log(category);
    phantrang();
    showNumAjax();
  });

  var locSP = "DESC";
  $(".locSP").click(function () {
    var locSP = $(".locSP").val();
    phantrang();
    showNumAjax();
  });

  function phantrang(page) {
    var category = getClass("category");
    var locSP = $(".locSP").val();

    $.ajax({
      url: "http://localhost/DuAn1/home/phantrang",
      method: "POST",
      data: {
        page: page,
        category: category,
        locSP: locSP,
      },
      success: function (data) {
        $("#pagination_data").html(data);
      },
    });
  }

  function showNumAjax(page) {
    var category = getClass("category");
    $.ajax({
      url: "http://localhost/DuAn1/home/showNumAjax",
      method: "POST",
      data: {
        page: page,
        category: category,
      },
      success: function (data) {
        $("#showNum").html(data);
      },
    });
  }

  $(document).on("click", ".pagination_link", function () {
    var page = $(this).attr("id");
    phantrang(page);
  });

  function getClass(className) {
    var filter = [];
    $("." + className + ":checked").each(function () {
      filter.push($(this).val());
    });
    return filter;
  }

  // Thanh toán
  $("#checkoutSubmit").click(function () {
    $("#checkoutForm").submit();
  });

  var address = $("#address").length;
  // var checkoutSubmit= $("#checkoutSubmit");
  if (address == 0) {
    $("button#checkoutSubmit").prop("disabled", true);
  }

  // checkoutForm
  $("#checkoutForm").validate({
    rules: {
      name: {
        required: true,
      },
      phone: {
        required: true,
        number: true,
        minlength: 10,
      },
      address: {
        required: true,
        minlength: 10,
      },
    },
    messages: {
      name: {
        required: "Bạn chưa nhập tên",
      },
      phone: {
        required: "Bạn chưa nhập số điện thoại",
        required: "Vua lòng nhập số",
        required: "Số điện thoại phải trên 10 số",
      },
      address: {
        required: "Bạn chưa nhập nội dung",
        minlength: "Ký tự tối thiểu là 10",
      },
    },
  });

  // Bình luận
  $("#formComment").validate({
    rules: {
      content: {
        required: true,
        minlength: 2,
      },
    },
    messages: {
      content: {
        required: "Bạn chưa nhập nội dung",
        minlength: "Ký tự tối thiểu là 2",
      },
    },
    submitHandler: function (form) {
      $.ajax({
        type: "POST",
        url: "../commentAction",
        id: "id",
        data: $(form).serializeArray(),
        success: function (response) {
          response = JSON.parse(response);
          if (response.status == 0) {
            swal("Thất bại!", response.message, "error");
          } else {
            document.getElementById("formComment").reset();
            // swal("Thành công!", response.message, "success");
            loadComment();
          }
        },
      });
    },
  });

  loadComment();
  function loadComment() {
    $.ajax({
      url: "../loadComment",
      type: "post",
      data: {
        orderby: "DESC",
      },
    }).done(function (data) {
      $("#loadComment").html(data);
    });
  }

  function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
  }

  var data = $(this).attr("value");
  var nho = $("p.Nhỏ").attr("name");
  var vua = $("p.Vừa").attr("name");
  var lon = $("p.Lớn").attr("name");

  if (nho == 0) {
    console.log("undefined");
    $("#sizeNho").prop("disabled", true);
  }
  if (vua == 0) {
    console.log("undefined");
    $("#sizeVua").prop("disabled", true);
  }
  if (lon == 0) {
    console.log("undefined");
    $("#sizeLon").prop("disabled", true);
  }

  // CART NUMBER
  $("input[type=radio]").change(function () {
    var data = $(this).attr("value");
    var nho = $("p.Nhỏ").attr("name");
    var vua = $("p.Vừa").attr("name");
    var lon = $("p.Lớn").attr("name");

    if (data == "Nhỏ") {
      nho2 = formatNumber(nho);
      $("#priceSize").html(nho2 + " VNĐ");
      $("#pricePost").val(nho2 + " VNĐ");
      $("#pricePost2").val(nho);
    }
    if (data == "Vừa") {
      vua2 = formatNumber(vua);
      $("#priceSize").html(vua2 + " VNĐ");
      $("#pricePost").val(vua2 + " VNĐ");
      $("#pricePost2").val(vua);
    }
    if (data == "Lớn") {
      lon2 = formatNumber(lon);
      $("#priceSize").html(lon2 + " VNĐ");
      $("#pricePost").val(lon2 + " VNĐ");
      $("#pricePost2").val(lon);
    }
  });

  var inputVal = $("input#input").val();
  $("span#plus").click(function () {
    inputVal++;
    $("input[name='num']").val(inputVal);
    return false;
  });
  $("span#minus").click(function () {
    inputVal--;
    if ((inputVal = 1)) {
      $("span#minus").prop("disabled", true);
    }
    $("input[name='num']").val(inputVal);
    console.log(inputVal);
    return false;
  });

  //   On TOP
  $(window).scroll(function () {
    if ($(this).scrollTop() > 500) {
      $("#toTop").fadeIn();
    } else {
      $("#toTop").fadeOut();
    }
  });
  $("#toTop").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
  });

  //  Thanh toán
  $("input[type=radio][name=banking]").change(function () {
    if (this.value == "payLater") {
      $(".content-banking").addClass("content-banking-none");
    } else if (this.value == "banking") {
      $(".content-banking").removeClass("content-banking-none");
    }
  });

  // Đăng nhập

  $("#login-tab").click(function () {
    $("#login").css("display", "block");
    $(".app").css("opacity", "0.8");
    $("html, body").animate({ scrollTop: 0 }, 100);
    return false;
    // $('html, body').css({
    //     overflow: 'hidden',
    //     height: '100%'
    // });
  });
  $(".close-login").click(function () {
    $("#login").css("display", "none");
    $(".app").css("opacity", "1");
  });

  // Đăng ký
  $(".regsiter-show").click(function () {
    $("#login").css("display", "none");
    $("#regsiter").css("display", "block");
  });
  $(".login-show").click(function () {
    $("#regsiter").css("display", "none");
    $("#login").css("display", "block");
  });
  $(".close-regsiter").click(function () {
    $("#regsiter").css("display", "none");
    $(".app").css("opacity", "1");
  });

  // Quên mật khẩu
  $(".forgot-show").click(function () {
    $("#login").css("display", "none");
    $("#regsiter").css("display", "none");
    $("#forgot").css("display", "block");
    $(".app").css("opacity", "0.8");
    $("html, body").animate({ scrollTop: 0 }, 100);
  });
  $(".login-show").click(function () {
    $("#regsiter").css("display", "none");
    $("#forgot").css("display", "none");
    $("#login").css("display", "block");
  });
  $(".close-forgot").click(function () {
    $("#forgot").css("display", "none");
    $(".app").css("opacity", "1");
    $("html, body").css({
      overflow: "auto",
      height: "auto",
    });
  });
});

// BÌNH LUẬN > MÔ TẢ
$(".mota").click(function () {
  $("#mota").css("display", "block");
  $("#danhgia").css("display", "none");
  $(".mota").addClass("active");
  $(".danhgia").removeClass("active");
  return false;
});
$(".danhgia").click(function () {
  $("#mota").css("display", "none");
  $("#danhgia").css("display", "block");
  $(".mota").removeClass("active");
  $(".danhgia").addClass("active");
  return false;
});

// ĐỔI MẬT KHẨU
$("#changepass_form").validate({
  rules: {
    password: {
      required: true,
      minlength: 6,
    },
    passwordnew: {
      required: true,
      minlength: 6,
    },
  },
  messages: {
    password: {
      required: "Bạn phải nhập mật khẩu",
      minlength: "Mật khẩu tối thiểu là 6 ký tự",
    },
    passwordnew: {
      required: "Bạn phải nhập mật khẩu",
      minlength: "Mật khẩu tối thiểu là 6 ký tự",
    },
  },
  submitHandler: function (form) {
    $.ajax({
      type: "POST",
      url: "http://localhost/DuAn1/Home/changepass",
      data: $(form).serializeArray(),
      success: function (response) {
        response = JSON.parse(response);
        if (response.status == 0) {
          swal("Thất bại!", response.message, "error");
        } else {
          swal("Thành công!", response.message, "success");
          setTimeout("location.href = './user';", 1000);
        }
      },
    });
  },
});

// SỬA THÔNG TIN NGƯỜI DÙNG
$("#edit_user").validate({
  rules: {
    name: {
      required: true,
    },
    address: {
      required: true,
    },
    phone: {
      required: true,
      number: true,
      minlength: 10,
    },
  },
  messages: {
    name: {
      required: "Bạn phải nhập họ và tên",
    },
    address: {
      required: "Bạn phải nhập địa chỉ",
    },
    phone: {
      required: "Bạn phải nhập số điện thoại",
      number: "Số điện thoại bắt buộc là số",
      minlength: "Số điện thoại không được dưới 10 ký tự",
    },
  },
  submitHandler: function (form) {
    $.ajax({
      type: "POST",
      url: "http://localhost/DuAn1/Home/edituser",
      data: $(form).serializeArray(),
      success: function (response) {
        response = JSON.parse(response);
        if (response.status == 0) {
          swal("Thất bại!", response.message, "error");
        } else {
          swal("Thành công!", response.message, "success");
          setTimeout("location.href = './user';", 1000);
        }
      },
    });
  },
});

// REGSITER VALIDATE
$("#form_regsiter").validate({
  rules: {
    email: {
      required: true,
      email: true,
    },
    phone: {
      required: true,
      number: true,
      minlength: 10,
    },
    password: {
      required: true,
      minlength: 6,
    },
    repassword: {
      equalTo: "#password",
    },
    name: {
      required: true,
    },
  },
  messages: {
    email: {
      required: "Bạn chưa nhập email",
      email: "Email chưa đúng định dạng",
      remote: "Email đã tồn tại trong hệ thống. Mời bạn chọn email khác",
    },
    phone: {
      required: "Bạn phải nhập số điện thoại",
      number: "Số điện thoại bắt buộc là số",
      minlength: "Số điện thoại không được dưới 10 ký tự",
    },
    password: {
      required: "Bạn phải nhập mật khẩu",
      minlength: "Mật khẩu tối thiểu là 6 ký tự",
    },
    repassword: {
      equalTo: "Mật khẩu không khớp",
    },
    name: {
      required: "Bạn phải nhập họ và tên",
    },
  },
  submitHandler: function (form) {
    $.ajax({
      type: "POST",
      url: "http://localhost/DuAn1/Home/RegisterAction",
      data: $(form).serializeArray(),
      success: function (response) {
        response = JSON.parse(response);
        if (response.status == 0) {
          swal("Thất bại!", response.message, "error");
          $("#regsiter").css("display", "none");
          $("#forgot").css("display", "none");
          $(".app").css("opacity", "1");
        } else {
          swal("Thành công!", response.message, "success");
          setTimeout("location.href = './';", 1000);
          $("#regsiter").css("display", "none");
          $("#forgot").css("display", "none");
          $(".app").css("opacity", "1");
        }
      },
    });
  },
});

// QUÊN MK
$("#form_forgot").validate({
  rules: {
    email: {
      required: true,
      email: true,
    },
  },
  messages: {
    email: {
      required: "Bạn chưa nhập email",
      email: "Email chưa đúng định dạng",
    },
  },
  submitHandler: function (form) {
    $.ajax({
      type: "POST",
      url: "http://localhost/DuAn1/Home/forgotAction",
      data: $(form).serializeArray(),
      success: function (response) {
        response = JSON.parse(response);
        if (response.status == 0) {
          //Đăng nhập lỗi
          $("#login").css("display", "none");
          $("#forgot").css("display", "none");
          $("#regsiter").css("display", "none");
          $(".app").css("opacity", "1");
          swal("Thất bại!", response.message, "error");
        } else {
          //Đăng nhập thành công
          $("#login").css("display", "none");
          $("#forgot").css("display", "none");
          $("#regsiter").css("display", "none");
          $(".app").css("opacity", "1");
          swal("Thành công!", response.message, "success");
        }
      },
    });
  },
});

// LOGIN VALIDATE
$("#form_login").validate({
  rules: {
    email: {
      required: true,
      email: true,
    },
    password: {
      required: true,
      minlength: 6,
    },
  },
  messages: {
    email: {
      required: "Bạn chưa nhập email",
      email: "Email chưa đúng định dạng",
    },
    password: {
      required: "Vui lòng nhập mật khẩu",
      minlength: "Password tối thiểu là 6 ký tự",
    },
  },
  submitHandler: function (form) {
    $.ajax({
      type: "POST",
      url: "http://localhost/DuAn1/Home/loginAction",
      data: $(form).serializeArray(),
      success: function (response) {
        response = JSON.parse(response);
        if (response.status == 0) {
          //Đăng nhập lỗi
          swal("Thất bại!", response.message, "error");
          $("#login").css("display", "none");
          $(".app").css("opacity", "1");
        } else {
          //Đăng nhập thành công
          swal("Thành công!", response.message, "success");
          // location.reload();
          setTimeout("location.href = 'http://localhost/DuAn1/';", 1000);
          $("#login").css("display", "none");
          $(".app").css("opacity", "1");
        }
      },
    });
  },
});

/* Animated Navigation */
// const toggle = document.querySelector("#toggle");
// const nav = document.querySelector("#nav-tablet-mobile");

// toggle.addEventListener("click", () => nav.classList.toggle("active"));
