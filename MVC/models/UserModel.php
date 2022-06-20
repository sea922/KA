<?php
class UserModel extends DB
{
    public function ShowNameUser($user_id)
    {
        $sql = "SELECT * FROM user WHERE user_id='$user_id'";
        return mysqli_query($this->con, $sql);
    }

    public function ListAll()
    {
        $sql = "SELECT * FROM user";
        return mysqli_query($this->con, $sql);
    }
    public function countUser()
    {
        $sql = "SELECT count(*) FROM user";
        return mysqli_query($this->con, $sql);
    }
    public function ListUserRole()
    {
        $sql = "SELECT * FROM user 
        INNER JOIN role WHERE role.role_id = user.role_id ORDER BY user_id DESC";
        return mysqli_query($this->con, $sql);
    }
    // public function checkPass($password,$passwordnew, $user_id){
    //     $sql = "SELECT * FROM user WHERE user_id='$user_id' AND password ='$password'";
    //     $check = mysqli_query($this->con, $sql);
    //     if(mysqli_num_rows($check)>0){
    //         $sql = "UPDATE user set password ='$passwordnew' where user_id ='$user_id'";
    //         $result = mysqli_query($this->con, $sql);
    //         echo '
    //         <script>
    //             alert("sửa thông tin người dùng thành công");
    //             window.location.assign("./user");
    //         </script>
    //         ';
    //     }
    // }


    public function checkPass($password, $passwordnew, $user_id)
    {
        if (isset($password) && isset($passwordnew) && isset($user_id)) {
            $sql = "SELECT * FROM user WHERE user_id='$user_id' AND password ='$password'";
            $check = mysqli_query($this->con, $sql);
            if (mysqli_num_rows($check) > 0) {
                $sql = "UPDATE user set password ='$passwordnew' where user_id ='$user_id'";
                $result = mysqli_query($this->con, $sql);
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Đổi mật khẩu thành công'
                ));
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Mật khẩu không trùng'
                ));
                exit;
            }
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Đã xảy ra lỗi'
            ));
            exit;
        }
    }


    public function edit_user($name, $address, $phone, $user_id)
    {
        if (isset($name) && isset($address) && isset($phone)) {
            $sql = "UPDATE user set `name` ='$name', `address` ='$address', `phone` ='$phone' where `user_id` ='$user_id'";
            $result = mysqli_query($this->con, $sql);
            if (!$result) {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Thay đổi thông tin không thành công.'
                ));
            } else {
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Thay đổi thông tin thành công.'
                ));
            }
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Thay đổi không tin không thành công.'
            ));
            exit;
        }
    }


    public function ListItem($id)
    {
        $sql = "SELECT * FROM user WHERE user_id =$id";
        return mysqli_query($this->con, $sql);
    }

    public function showRole()
    {
        $sql = "SELECT * FROM role";
        return mysqli_query($this->con, $sql);
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM user WHERE user_id =$id";
        return mysqli_query($this->con, $sql);
    }

    public function edit()
    {
        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $user_id = $_POST['user_id'];
            $role_id = $_POST['role_id'];

            $sql = "UPDATE user SET name='$name', email = '$email', phone = '$phone',address='$address', role_id = '$role_id'  WHERE user_id = '$user_id' ";
            $result = mysqli_query($this->con, $sql);
            echo '
            <script>
                alert("sửa thông tin người dùng thành công");
                window.location.assign("./user");
            </script>
            ';
            die;
        }
    }

    public function register()
    {
        $error = false;
        if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $hoten = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $verify = (rand(10000, 99999));
            $check = mysqli_query($this->con, "SELECT * FROM user where email = '$email'");
            if (mysqli_num_rows($check) > 0) {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Email đã tồn tại'
                ));
                exit;
            } else {
                $result = mysqli_query($this->con, "INSERT INTO user (role_id,name,email, phone, password, verify)
                VALUES ('1','" . $hoten . "','" . $email . "','" . $phone . "','" . $password . "','" . $verify . "' )");
                if (!$result) {
                    if (strpos(mysqli_error($this->con), "Duplicate entry") !== FALSE) {
                        echo json_encode(array(
                            'status' => 0,
                            'message' => 'Tên đăng nhập đã tồn tại'
                        ));
                        exit;
                    }
                }
                mysqli_close($this->con);
                if ($error !== false) {
                    echo json_encode(array(
                        'status' => 0,
                        'message' => 'Có lỗi khi đăng ký, xin mời thử lại'
                    ));
                    exit;
                } else {
                    echo json_encode(array(
                        'status' => 1,
                        'message' => 'Đăng ký thành công'
                    ));
                    exit;
                }
            }
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Bạn chưa nhập thông tin'
            ));
            exit;
        }
    }

    // Quên mk
    function forgot()
    {
        require("./mvc/public/PHPMailer-master/src/PHPMailer.php");
        require "./mvc/public/PHPMailer-master/src/SMTP.php";
        require "./mvc/public/PHPMailer-master/src/Exception.php";

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $email = $_POST['email']; // Email cần gửi đến
            $subject = "Khôi phục mật khẩu";
            $message = "Xin chào";
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);  //true: cho phép các trường hợp ngoại lệ

            $sql = "SELECT * FROM user WHERE email='$email'";
            $url = BASE_URL;
            $kq = mysqli_query($this->con, $sql);
            $numrows_email = mysqli_num_rows($kq);
            if ($numrows_email == 1) {
                foreach ($kq as $item) {
                    $message = 'Xin chào ' . '<strong>' . $item['name'] . '</strong>' . '
                    <br>Mật khẩu của bạn là: ' . '<strong>' . $item['password'] . '</strong>' . '<br>Hãy đăng nhập để tiến hành sử dụng nhé: ' . $url . '/Home/login';
                }
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Email không tồn tại!'
                ));
                exit;
            }

            // TRY có thể nó sẽ xảy ra ngoại lệ
            try {
                //Server settings
                $mail->isSMTP(); // gửi mail SMTP
                $mail->CharSet  = "utf-8";
                $mail->Host = 'smtp.gmail.com';  // khai báo SMTP servers
                $mail->SMTPAuth = true; // Enable authentication
                $nguoigui = '@gmail.com'; // Tài khoản Email
                $matkhau = ''; // Mật khẩu Email
                $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
                $mail->Port = 465;  // Port kết nối: khai báo 465 hoặc 587                


                // Recipients - Người nhận
                $tennguoigui = 'KA Coffee'; // Tên người gửi lấy từ form nhập
                $mail->Username = $nguoigui; // SMTP username
                $mail->Password = $matkhau;   // SMTP password
                $mail->setFrom($nguoigui, $tennguoigui); //mail và tên người nhận 
                $to = $email; // Email cần gửi đến lấy từ form nhập
                $to_name = "Kim Anh"; // Tên người cần gửi đến

                // Content 
                $mail->addAddress($to, $to_name); //mail và tên người nhận  
                $mail->isHTML(true);  // Khai báo nội dung email hiển thị định dạng html
                $mail->Subject = 'Khôi phục mật khẩu'; // Tiêu đề email
                $mail->Body = $message; // Nội dung email

                $mail->send(); // Tiến hành gửi thư
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Mật khẩu của bạn đã được gứi tới email!'
                ));
                exit;
            }
            // nếu ở trên lỗi thì CATCH sẽ chạy
            catch (Exception $e) {
                // echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Mail không gửi được!'
                ));
                exit;
            }
        }
    }

    // Đăng nhập
    public function Login()
    {
        $error = false;
        if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $result = mysqli_query($this->con, "SELECT * FROM user WHERE email = '$email' AND password = '$password'");
            $data = mysqli_fetch_assoc($result);
            if (!$result) {
                $error = mysqli_error($this->con);
            } else {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['current_user'] = $user;
            }
            mysqli_close($this->con);
            if ($error !== false || $result->num_rows == 0) {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Thông tin đăng nhập không đúng'
                ));
                exit;
            } else {
                $userlogin = [$email, $password, $data['name'], $data['user_id'], $data['phone']];
                $_SESSION['userlogin'] = $userlogin;

                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Đăng nhập thành công'
                ));
                exit;
            }
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Thông tin đăng nhập không đúng'
            ));
            exit;
        }
    }

    public function editUser($user_id, $name, $address, $phone)
    {
        if (isset($user_id) && isset($name) && isset($address) && isset($phone)) {
            $sql = "UPDATE user SET name='$name', address='$address', phone='$phone' WHERE user_id='$user_id'";
            $result = mysqli_query($this->con, $sql);

            if (!$result) {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật thông tin không thành công'
                ));
                exit;
            } else {
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Cập nhật thông tin thành công'
                ));
                exit;
            }
        } {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Đã xảy ra lỗi'
            ));
            exit;
        }
    }

    public function comment()
    {
        $error = false;
        if (isset($_SESSION['userlogin'])) {
            if (isset($_POST['content']) && !empty($_POST['content'])) {
                $comment_content = $_POST['content'];
                $product_id = $_POST['product_id'];
                $user_id = $_POST['user_id'];
                $comment_date = date('Y-m-d H:i:s');
                $result = mysqli_query($this->con, "INSERT INTO comment (user_id,product_id, comment_content,comment_date) VALUES ('" . $user_id . "','" . $product_id . "','" . $comment_content . "','" . $comment_date . "')");
                mysqli_close($this->con);
                if ($error !== false) {
                    echo json_encode(array(
                        'status' => 0,
                        'message' => 'Bình luận không thành công!'
                    ));
                    exit;
                } else {
                    echo json_encode(array(
                        'status' => 1,
                        'message' => 'Bình luận thành công!'
                    ));
                    exit;
                }
            }
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Vui lòng đăng nhập để sử dụng tính năng này'
            ));
            exit;
        }
    }

    public function deleteComment($id)
    {
        $sql = "DELETE FROM comment WHERE comment_id =$id";
        return mysqli_query($this->con, $sql);
    }

    public function showUserCheckout($user_id)
    {
        $sql = "SELECT * FROM user WHERE user_id=$user_id";
        return mysqli_query($this->con, $sql);
    }

    // LOGIN ADMIN

    public function LoginAdmin()
    {
        $error = false;
        if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $result = mysqli_query($this->con, "SELECT * FROM user WHERE email = '$email' AND password = '$password' AND role_id='2'");
            $data = mysqli_fetch_assoc($result);
            if (!$result) {
                $error = mysqli_error($this->con);
            } else {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['current_user'] = $user;
            }
            mysqli_close($this->con);
            if ($error !== false || $result->num_rows == 0) {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Thông tin đăng nhập không đúng'
                ));
                exit;
            } else {
                $userlogin = [$email, $password, $data['name'], $data['user_id'], $data['phone']];
                $_SESSION['userAdmin'] = $userlogin;

                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Đăng nhập thành công'
                ));
                exit;
            }
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Thông tin đăng nhập không đúng'
            ));
            exit;
        }
    }
}
