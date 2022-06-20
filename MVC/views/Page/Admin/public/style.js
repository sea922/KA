// PRODUCTS
function deleteProduct(id) {
  var option = confirm("Bạn có chắc chắn muốn xoá sản phẩm này không?");
  if (!option) {
    return;
  }
  $.post(
    "./deleteProduct",
    {
      id: id,
      action: "delete",
    },
    function (data) {
      location.reload();
    }
  );
}

// USER
function deleteUser(id) {
  var option = confirm("Bạn có chắc chắn muốn xoá người dùng này không?");
  if (!option) {
    return;
  }
  $.post(
    "./deleteUser",
    {
      id: id,
      action: "delete",
    },
    function (data) {
      location.reload();
    }
  );
}

// COMMENT
function deleteComment(id) {
  var option = confirm("Bạn có chắc chắn muốn xoá bình luận này không?");
  if (!option) {
    return;
  }
  $.post(
    "./deleteComment",
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
  // LOGIN
  $("#loginAdmin").validate({
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
        url: "http://localhost/DuAn1/Admin/loginAction",
        data: $(form).serializeArray(),
        success: function (response) {
          response = JSON.parse(response);
          if (response.status == 0) {
            //Đăng nhập lỗi
            swal("Thất bại!", response.message, "error");
          } else {
            //Đăng nhập thành công
            swal("Thành công!", response.message, "success");
            setTimeout("location.href = './home';", 1000);
          }
        },
      });
    },
  });
});

// CATEGORY
function deleteCategory(id) {
  var option = confirm("Bạn có chắc chắn muốn xoá danh mục này không?");
  if (!option) {
    return;
  }
  $.post(
    "./deleteCategory",
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

  // Lọc theo A-Z Z-A
  $("#mySelect").on("change", function () {
    var value = $(this).val();
    if (value == "Theo A-Z") {
      $("tr.sortby").sort(sortbyAZ).appendTo("#tableSearch");
    } 
    else if (value == "Theo Z-A") {
      $("tr.sortby").sort(sortbyZA).appendTo("#tableSearch");
    }
  });

  function sortbyAZ(a, b) {
    return $(a).text() > $(b).text() ? 1 : -1;
  }

  function sortbyZA(a, b) {
    return $(a).text() < $(b).text() ? 1 : -1;
  }

  $(document).ready(function () {
    // Tìm kiếm
    $("#search").on("keyup", function () {
      var value = $(this).val().toLowerCase();
      console.log(value);
      $("#tableSearch tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    });
  });

});

