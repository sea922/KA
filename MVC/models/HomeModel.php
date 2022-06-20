<?php
class HomeModel extends DB
{
    public function countOrder()
    {
        $sql = "SELECT count(*) FROM orders";
        return mysqli_query($this->con, $sql);
    }
    public function countComment()
    {
        $sql = "SELECT count(*) FROM comment";
        return mysqli_query($this->con, $sql);
    }
}
