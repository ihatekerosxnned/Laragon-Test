<?php
class Genders{
    
    function addGender($data){
        global $conn;

        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $address = $data['address'];
        $phone_num = $data['phone_num'];

        $sql = "INSERT INTO tbl_contacts (first_name, last_name, address, phone_num) VALUES ('$first_name', '$last_name', '$address', '$phone_num') ";

        return mysqli_query($conn, $sql);
    }
    function displayGender(){
        global $conn;

        $sql = "SELECT * FROM tbl_gender ORDER BY gender_name ASC";
        $result = $conn-> query($sql);
        return $result;
    }
} 
?>