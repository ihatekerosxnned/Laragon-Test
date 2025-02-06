<?php
class Contacts{
    
    function addContact($data){
        global $conn;

        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $address = $data['address'];
        $phone_num = $data['phone_num'];
        $gender_id = $data['gender_id'];

        $sql = "INSERT INTO tbl_contacts (first_name, last_name, address, phone_num, gender_id) 
                VALUES ('$first_name', '$last_name', '$address', '$phone_num', $gender_id) ";
        
        $result = $conn->query($sql);

        return $result;

        // return mysqli_query($conn, $sql);
    }

    function displayContact($data){
        global $conn;

        $search = isset($data['search']) ? $data['search'] : '';

        if(empty($search)){
            $sql = "SELECT tbl_contacts.id, first_name, last_name, address, phone_num, gender_name
                    FROM tbl_contacts
                    INNER JOIN tbl_gender ON tbl_contacts.gender_id = tbl_gender.id
                    ORDER BY first_name ASC, last_name ASC";
            $result = $conn->query($sql); 
        }
        else{
            $sql = "SELECT tbl_contacts.id, first_name, last_name, address, phone_num, gender_name,gender_name 
                    FROM tbl_contacts
                    INNER JOIN tbl_gender ON tbl_contacts.gender_id = tbl_gender.id
                    WHERE tbl_contacts.address LIKE '%$search%' 
                    ORDER BY tbl_contacts.first_name ASC, tbl_contacts.last_name ASC";
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

    function updateContactById($id, $data) {
        global $conn;
    
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $address = $data['address'];
        $phone_num = $data['phone_num'];
        $gender_id = $data['gender_id'];
    
        $sql = "UPDATE tbl_contacts SET 
                first_name = '$first_name', 
                last_name = '$last_name', 
                address = '$address', 
                phone_num = '$phone_num',
                gender_id = '$gender_id'
                WHERE id = '$id'";

        $result = $conn->query($sql);
    
        if (!$result) {
            echo "Error updating record: " . $conn->error;
        }
    
        return $result;
    }
    
    function deleteById($id){
        global $conn;

        

        $sql = "DELETE FROM tbl_contacts WHERE id = '$id' ";
        $result = $conn->query($sql);

        return $result;
    }

    function deleteMultipleById($id){
        global $conn;

        echo $id;
        $sql = " DELETE FROM tbl_contacts WHERE id IN ($id)";
        $result = $conn->query($sql);

        return $result;
    }
    function totalCount(){
        global $conn;

        $sql = " SELECT COUNT(*) as totalCount FROM tbl_contacts";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        return (string)$row['totalCount'];
    }
} 
?>