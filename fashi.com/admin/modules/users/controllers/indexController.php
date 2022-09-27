<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    load('helper', 'format');
    $list_users = get_list_users();
    $data['list_users'] = $list_users;
    load_view('index', $data);
}

function loginAction()
{
    global $errors, $email, $password;
    $errors = array();

    if (isset($_POST['signin'])) {
        if (!empty($_POST['email'])) {
            if (is_email($_POST['email'])) {
                $email = $_POST['email'];
            } else {
                $errors['email'] = "Email không hợp lệ!";
            }
        } else {
            $errors['email'] = 'Email không được để trống !';
        }

        if (!empty($_POST['password'])) {
            if (strlen($_POST['password'] < 5)) {
                $errors['password'] = "Password dài tối thiểu 6 ký tự!";
            } else {
                if (is_password($_POST['password'], 5, 60)) {
                    $password = md5($_POST['password']);
                } else {
                    $errors['password'] = "Password không hợp lệ!";
                }
            }
        } else {
            $errors['password'] = "Password không được để trống!";
        }
    } else {
        $errors['login'] = "";
    }

    if (!empty($email) && !empty($password)) {
        $check = check_login($email, $password);
        if ($check) {
            $_SESSION['is_login'] = 1;
            $_SESSION['email'] = $email;
            redirect("?mod=dashboard&action=index");
        } else {
            $errors['login'] = "Email hoăc mật khẩu không chính xác!";
        }
    }
    load_view('login');
}

function logoutAction()
{
    if (!empty($_SESSION['is_login']) && !empty($_SESSION['email'])) {
        unset($_SESSION['is_login']);
        unset($_SESSION['email']);
    }
    redirect("?mod=users&action=login");
}

function addAction()
{
    global $errors, $username, $email, $confirm_password, $password, $conn;
    $errors = array();

    if (isset($_POST['submit'])) {
        //username:
        if (!empty($_POST['username'])) {
            if (is_username($_POST['username'], 5, 60)) {
                $username = $_POST['username'];
            } else {
                $errors['username'] = "Tên người dùng không hợp lệ!";
            }
        } else {
            $errors['username'] = "Tên người dùng không được để trống!";
        }

        // email:
        if (!empty($_POST['email'])) {
            if (is_email($_POST['email'])) {
                $email = $_POST['email'];
            } else {
                $errors['email'] = "Email không hợp lệ!";
            }
        } else {
            $errors['email'] = 'Email không được để trống !';
        }

        // password:
        if (!empty($_POST['password'])) {
            if (strlen($_POST['password'] < 5)) {
                $errors['password'] = "Password dài tối thiểu 6 ký tự!";
            } else {
                if (is_password($_POST['password'], 5, 30)) {
                    $password = $_POST['password'];
                } else {
                    $errors['password'] = "Password không hợp lệ!";
                }
            }
        } else {
            $errors['password'] = "Password không được để trống!";
        }

        // confirm password:
        if (!empty($_POST['confirm_password'])) {
            if (is_password($_POST['confirm_password'], 5, 30)) {
                if ($_POST['confirm_password'] == $password) {
                    $confirm_password = $password;
                } else {
                    $errors['confirm_password'] = "Mật khẩu nhập lại không khớp!";
                }
            } else {
                $errors['confirm_password'] = "Password không hợp lệ!";
            }
        } else {
            $errors['confirm_password'] = "Password không được để trống!";
        }
    } else {
        $errors['add'] = "";
    }

    if (empty($errors)) {
        $data = array(
            "user_name" => $username,
            "email" => $email,
            "password" => md5($password),
        );

        if (add_user($data)) {
            redirect("?mod=users&action=index");
        }
    }

    load_view("add");
}

function profileAction()
{
    global $errors, $fullname, $phone, $address, $avatar;
    if (isset($_POST['update'])) {
        $fullname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        //img
        $upload_dir = 'public/uploads/images/user/';
        $image_name = time() . '_' . basename($_FILES['avatar']['name']);
        $upload_file = $upload_dir . $image_name;
        $is_upload = true;

        if ($_FILES['avatar']['size'] > 30000000) {
            $errors['avatar'] = 'Sorry, The size of your image is too large!<br>';
            $is_upload = false;
        }


        $image_file_type = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
        $type_img_allow = ["jpg", "png", "jpeg", "gif"];

        if (!in_array($image_file_type, $type_img_allow)) {
            $errors['avatar'] = 'Sorry, The type of your image must is JPG, JPEG, PNG, GIF!<br>';
            $is_upload = false;
        }

        if (file_exists($upload_file)) {
            $errors['avatar'] = 'Sorry, The file is exist!<br>';
            $is_upload = false;
        }

        if ($is_upload) {
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_file)) {
                $avatar = $image_name;
            } else {
                $errors['avatar'] = 'fail!';
            }
        } else {
            $errors['avatar'] = "Sorry your file was not uploaded!";
        }
    } else {
        $errors['update'] = "";
    }

    if (empty($errors)) {
        $data = array(
            'full_name' => $fullname,
            "address" => $address,
            "phone_number" => $phone,
            "avatar" => $avatar
        );
        update_user($data, $_SESSION['email']);
    }

    $user = get_user_by_email($_SESSION['email']);
    $data['user'] = $user;
    load_view('profile', $data);
}

function changePasswordAction()
{

    global $errors, $new_password, $old_password, $confirm_password;
    $errors = array();

    if (isset($_POST['update'])) {
        //Old password:
        if (!empty($_POST['old_password'])) {
            if (is_password($_POST['old_password'], 5, 60)) {
                $current_user = get_user_by_email($_SESSION['email']);
                if (md5($_POST['old_password']) == $current_user['password']) {
                    $old_password = $_POST['old_password'];
                } else {
                    $errors['old_password'] = "Vui lòng nhập chính xác mật khẩu!";
                }
            } else {
                $errors['old_password'] = "Mật khẩu không hợp lệ";
            }
        } else {
            $errors['old_password'] = "Không được để trống!";
        }

        //New password:
        if (!empty($_POST['new_password'])) {
            if (is_password($_POST['new_password'], 5, 60)) {
                $new_password = $_POST['new_password'];
            } else {
                $errors['new_password'] = "Mật khẩu không hợp lệ";
            }
        } else {
            $errors['new_password'] = "Không được để trống!";
        }

        //Confirm password:
        if (!empty($_POST['confirm_password'])) {
            if (is_password($_POST['confirm_password'], 5, 60)) {
                if ($_POST['confirm_password'] == $new_password) {
                    $confirm_password = $_POST['confirm_password'];
                } else {
                    $errors['confirm_password'] = "Mật khẩu nhập vào không khớp! Vui lòng xác thực mật khẩu mới!";
                }
            } else {
                $errors['confirm_password'] = "Mật khẩu không hợp lệ";
            }
        } else {
            $errors['confirm_password'] = "Không được để trống!";
        }
    } else {
        $errors['btn-submit'] = "";
    }

    if (empty($errors)) {
        $data = array(
            "password" => md5($new_password),
        );
        
        if (update_user($data, $_SESSION['email'])) {
            redirect("?mod=dashboard&action=index");
        }
    }

    load_view('changePassword');
}
