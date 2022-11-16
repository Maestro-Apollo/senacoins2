<?php
include '../class/database.php';
$name = $_GET['name'];
if (strcmp($name, 'REPUBBLICA ITALIANA') == 0) {
    class premiumR extends database
    {

        protected $link;

        public function pUserfunction()
        {
            $name = $_GET['name'];
            $sqlR = "select * from data_tbl where timeperiod = '$name' ";
            $resR = mysqli_query($this->link, $sqlR);
            if ($resR) {
                return $resR;
            } else {
                return false;
            }
            # code...
        }
    }
    $objR = new premiumR;
    $objpUserR = $objR->pUserfunction();
} else if (strcmp($name, 'UNIONE EUROPEA') == 0) {

    class premiumE extends database
    {

        protected $link;

        public function pUserfunction()
        {
            $name = $_GET['name'];
            $sqlE = "select * from data_tbl where timeperiod = '$name' ";
            $resE = mysqli_query($this->link, $sqlE);
            if ($resE) {
                return $resE;
            } else {
                return false;
            }
            # code...
        }
    }
    $objE = new premiumE;
    $objpUserE = $objE->pUserfunction();
} else {
    class premium extends database
    {

        protected $link;

        public function pUserfunction()
        {
            $name = $_GET['name'];
            $sql = "select * from data_tbl where timeperiod = '$name' ";
            $res = mysqli_query($this->link, $sql);
            if ($res) {
                return $res;
            } else {
                return false;
            }
            # code...
        }
    }
    $obj = new premium;
    $objpUser = $obj->pUserfunction();
}