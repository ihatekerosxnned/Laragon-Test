<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_phonebook";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["id"])) {
    $phone_num = $_POST['id'];

    $sql = "SELECT first_name, last_name, address, phone_num FROM tbl_contacts where id = '$id' ";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="styles/styles.css">
    <title>Phonebook</title>
</head>

<body>
    <div class="w-full flex justify-between">
        <!-- FORM -->
        <div class="w-full p-4">
            <form action="index.php" method="post" class="p-4">
                <div class="w-full flex gap-2">
                    <div class="flex flex-col w-full my-4">
                        <label class="mb-2">First Name</label>
                        <input type="text" id='first_name' name="first_name" placeholder="First Name" class="w-full px-4 py-2 text-black border-1 bg-gray-100 rounded-md shadow-sm">
                    </div>
                    <div class="flex flex-col w-full my-4">
                        <label class="mb-2">Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Last Name" class="w-full px-4 py-2 text-black border-1 bg-gray-100 rounded-md shadow-sm">
                    </div>
                </div>
                <div class="w-full">
                    <div class="flex flex-col w-full my-4">
                        <label class="mb-2">Home Address</label>
                        <input type="text" id="address" name="address" placeholder="Contact Number" class="w-full px-4 py-2 text-black border-1 bg-gray-100 rounded-md shadow-sm">
                    </div>
                    <div class="flex flex-col w-full my-4">
                        <label class="mb-2">Contact Number</label>
                        <input type="number" id="phone_num" name="phone_num" placeholder="Contact Number" class="w-full px-4 py-2 text-black border-1 bg-gray-100 rounded-md shadow-sm" max="11">
                    </div>
                </div>
                <div class="w-full">
                    <button type='submit' value='submit' class="w-full bg-blue-300 py-2 rounded-md shadow-md text-white font-bold">Submit</button>
                </div>
            </form>
        </div>
        <!-- TABLE -->
        <!-- <div class="w-full p-2">
            <form action="" method="post" class="w-full flex mb-2 shadow-md">
                <input class="px-6 py-3 bg-gray-50 w-9/12" type="text" placeholder="Search..." id="search" name="search">
                <button class="px-6 py-3 bg-blue-400 rounded-tr-full rounded-br-full w-3/12 flex text-white justify-between font-bold" type="button" value="submit">
                    
                    Search
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
</svg>
</div>
                </button>
            </form>
            <table class="w-full bg-white rounded-md shadow-md">
                <thead class="text-lg text-gray-700 uppercase text-left bg-gray-200">
                    <th class="px-6 py-3 font-bold">ID</th>
                    <th class="px-6 py-3">First Name</t>
                    <th class="px-6 py-3">Last Name</t>
                    <th class="px-6 py-3">Address</t>
                    <th class="px-6 py-3">Phone Number</th>
                    <th class="px-6 py-3">Actions</th>
                </thead>
                <tbody class="bg-white">
                    <?php
                    if (!isset($_POST['search'])) {
                        $sql = "SELECT * FROM tbl_contacts";
                        $result = $conn->query($sql);
                    } else {
                        $search = $_POST['search'];
                        $x = "%";
                        $sql = "SELECT * FROM tbl_contacts WHERE address LIKE '$x$search$x' " ;
                        $result = $conn->query($sql);
                    }
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr class="mb-40 border-b">
                                <td class="px-6 py-4"><?php echo $row["id"] ?></td>
                                <td class="px-6 py-4"><?php echo $row["first_name"] ?></td>
                                <td class="px-6 py-4"><?php echo $row["last_name"] ?></td>
                                <td class="px-6 py-4"><?php echo $row["address"] ?></td>
                                <td class="px-6 py-4"><?php echo $row["phone_num"] ?></td>
                                <td class="px-6 py-4 underline hover:cursor-pointer flex items-center gap-2">
                                    <div class="icons hover:bg-green-200 w-10 h-10 justify-center items-center flex rounded-md text-green-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>

                                        </svg>
                                    </div>
                                    <div class="icons hover:bg-red-200 w-10 h-10 justify-center items-center flex rounded-md text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </div>
                                </td>
                            </tr>
                        <?php   }
                    } else { ?>
                        <div class="noData">
                            <h1>No Results</h1>
                        </div>
                    <?php } ?>
                </tbody>
            </table>
        </div> -->
    </div>


</body>

</html>
<!-- 
SELECT * FROM tbl_contacts WHERE address LIKE "%Alijis%";

INSERT INTO tbl_contacts (first_name, last_name, address, phone_num) VALUES ("Rafael", "Villa","Silay", "09225121845"),("Nicole", "Menez","Taculing", "09225181845"),("Boss Carl", "Hahaha","Banago", "09225189925"); -->