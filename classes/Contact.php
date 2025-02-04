<?php
class Contacts{
    
    function addContact($data){
        global $conn;

        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $address = $data['address'];
        $phone_num = $data['phone_num'];

        $sql = "INSERT INTO tbl_contacts (first_name, last_name, address, phone_num) VALUES ('$first_name', '$last_name', '$address', '$phone_num') ";

        return mysqli_query($conn, $sql);
    }
    function displayContact($data){
        global $conn;

        $search = isset($data['search']) ? $data['search'] : '';

        if(empty($search)){
            $sql = "SELECT * FROM tbl_contacts";
            $result = $conn->query($sql); 
        }
        else{
            $sql = "SELECT * FROM tbl_contacts WHERE address LIKE '%$search%' ";
            $result = $conn->query($sql);
        }
        return $result;
    }
    

    function getContactById($id){
        global $conn;
        $sql = "SELECT * FROM tbl_contacts WHERE id = '$id' ";
        $result = $conn->query($sql);
        return $result;
    }

    function updateContactById($data, $id) {
        global $conn;
    
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $address = $data['address'];
        $phone_num = $data['phone_num'];
    
        $sql = "UPDATE tbl_contacts SET 
        first_name = '$first_name', 
        last_name = '$last_name', 
        address = '$address', 
        phone_num = '$phone_num' 
        WHERE id = $id ";
    
        $result = $conn->query($sql);
    
        if (!$result) {
            echo "Error updating record: " . $conn->error;
        }
    
        return $result;
    }

    
} 
?>