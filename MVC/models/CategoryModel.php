<?php
class CategoryModel extends DB
{
    public function ListAll()
    {
        $sql = "SELECT * FROM category";
        return mysqli_query($this->con, $sql);
    }

    public function countCategory()
    {
        $sql = "SELECT count(*) FROM category";
        return mysqli_query($this->con, $sql);
    }

    public function ListItem($id)
    {
        $sql = "SELECT * FROM category where category_id=$id";
        return mysqli_query($this->con, $sql);
    }

    public function addCategory($name)
    {
        $sql = "INSERT INTO category(category_name) VALUES ('" . $name . "')";
        $result = mysqli_query($this->con, $sql);
        if (!$result) {
            echo '
                        <script>
                            alert("Đã xảy ra lỗi, vui lòng thử lại")
                        </script>
                        ';
            exit;
        } else {
            echo '
                <script>
                    alert("Thêm danh mục thành công")
                    window.location.assign("./Category");
                </script>
                ';
            exit;
        }
    }

    public function checkid($id)
    {
        $check = mysqli_query($this->con, "SELECT * FROM category where category_id = '$id'");
        if (mysqli_num_rows($check) < 1) {
            echo '
                <script>
                    alert("Danh mục không tồn tại")
                    window.location.assign("../Category");
                </script>
            ';
        }
    }
    public function editcategory($id, $name)
    {
        $sql = "UPDATE category SET category_name = '$name' WHERE category_id = '$id'";
        $result = mysqli_query($this->con, $sql);
        if (!$result) {
            echo '
                        <script>
                            alert("Đã xảy ra lỗi, vui lòng thử lại")
                        </script>
                        ';
            exit;
        } else {
            echo '
                <script>
                    alert("Sửa danh mục thành công")
                    window.location.assign("../Category");
                </script>
                ';
            exit;
        }
    }
    public function deleteCategory($id)
    {
        $sql = "DELETE FROM category where category_id=$id";
        return mysqli_query($this->con, $sql);
    }
}
