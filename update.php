<?php
include('includes/header.php');
include('classes/Contact.php');
$Contact = new Contacts();

$id = $_REQUEST['id'];
$ContactDisplay = $Contact->getContactById($id);
if(isset($_REQUEST['btn'])){
    $id;

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $phone_num = $_POST['phone_num'];
    
    $Contact ->updateContactById($id, $_POST);
}
?>
    <div class="w-full flex justify-between">
        <!-- FORM -->
        <div class="w-full p-4">
            <form action="index.php" method="post" class="p-4">
                <?php foreach($ContactDisplay as $contact) {?>
                <div class="w-full flex gap-2">
                    <div class="flex flex-col w-full my-4">
                        <label class="mb-2">First Name</label>
                        <input type="text" id='first_name' name="first_name" value=<?php echo $contact["first_name"] ?> placeholder="First Name" class="w-full px-4 py-2 text-black border-1 bg-gray-100 rounded-md shadow-sm">
                    </div>
                    <div class="flex flex-col w-full my-4">
                        <label class="mb-2">Last Name</label>
                        <input type="text" id="last_name" name="last_name" value=<?php echo $contact["last_name"] ?> placeholder="Last Name" class="w-full px-4 py-2 text-black border-1 bg-gray-100 rounded-md shadow-sm">
                    </div>
                </div>
                <div class="w-full">
                    <div class="flex flex-col w-full my-4">
                        <label class="mb-2">Home Address</label>
                        <input type="text" id="address" name="address" value=<?php echo $contact["address"] ?> placeholder="Address" class="w-full px-4 py-2 text-black border-1 bg-gray-100 rounded-md shadow-sm">
                    </div>
                    <div class="flex flex-col w-full my-4">
                        <label class="mb-2">Contact Number</label>
                        <input type="number" id="phone_num" name="phone_num" value=<?php echo $contact["phone_num"] ?> placeholder="Contact Number" class="w-full px-4 py-2 text-black border-1 bg-gray-100 rounded-md shadow-sm">
                    </div>
                </div>
                <div class="w-full flex gap-2">
                <button type='submit' value='submit' name="btn" id="btn" class="w-full bg-blue-400 py-2 rounded-md shadow-md text-white font-bold mt-4 hover:cursor-pointer hover:bg-blue-600 transition delay-150 duration-300 ease-in-out">Update</button>
                <button class="w-full bg-none border-2 border-blue-400 py-2 rounded-md shadow-md text-blue-400 font-bold mt-4 hover:cursor-pointer hover:bg-blue-600 hover:text-white transition delay-150 duration-300 ease-in-out">Back</button>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>

<?php include "./includes/footer.php"; ?>
<!-- 
SELECT * FROM tbl_contacts WHERE address LIKE "%Alijis%";

INSERT INTO tbl_contacts (first_name, last_name, address, phone_num) VALUES ("Rafael", "Villa","Silay", "09225121845"),("Nicole", "Menez","Taculing", "09225181845"),("Boss Carl", "Hahaha","Banago", "09225189925"); -->