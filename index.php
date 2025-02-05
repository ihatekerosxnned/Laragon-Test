<?php
include('includes/header.php');
include('classes/Contact.php');
$Contact = new Contacts();

// DEFAULT DISPLAY ALL BY ID ASC
if (!isset($_REQUEST['search'])) {
    $DisplayAll = $Contact->displayContact([]);
} else {
    $search = $_REQUEST['search'];
    $DisplayAll = $Contact->displayContact($_REQUEST);
}

// INSERT NEW DATA
if (isset(($_REQUEST['btn']))) {
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $address = $_REQUEST['address'];
    $phone_num = $_REQUEST['phone_num'];

    $Contact->addContact($_REQUEST);
    echo '<script> alert("Success:)  window.location.href = "index.php"; </script>';
}

// SINGLE DELETE 
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $Contact->deleteById($id);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// DELETE MULTIPLE BY ID 
if (isset($_POST['multi_delete'])) {
    if (!empty($_POST['selected_id'])) {
        $id = implode(',', $_POST['selected_id']);
        $Contact->deleteMultipleById($id);
        header("Location: " . $_SERVER['PHP_SELF']);
    } else {
        echo '<script>alert("WHAT THE FUCK?")</script>';
    }
}



?>


<div class="w-full min-h-screen flex justify-between">
    <!-- FORM -->
    <div class="w-full p-4">
        <form action="index.php" method="post" class="p-4">
            <div class="w-full flex gap-2">
                <div class="flex flex-col w-full mb-4">
                    <label class="mb-2">First Name</label>
                    <input type="text" id='first_name' name="first_name" placeholder="First Name"
                        class="w-full px-4 py-2 text-black border-1 bg-gray-100 rounded-md shadow-sm">
                </div>
                <div class="flex flex-col w-full mb-4">
                    <label class="mb-2">Last Name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Last Name"
                        class="w-full px-4 py-2 text-black border-1 bg-gray-100 rounded-md shadow-sm">
                </div>
            </div>
            <div class="w-full">
                <div class="flex flex-col w-full mb-4">
                    <label class="mb-2">Home Address</label>
                    <input type="text" id="address" name="address" placeholder="Home Address"
                        class="w-full px-4 py-2 text-black border-1 bg-gray-100 rounded-md shadow-sm">
                </div>
                <div class="flex flex-col w-full mb-4">
                    <label class="mb-2">Contact Number</label>
                    <input type="number" id="phone_num" name="phone_num" placeholder="Contact Number"
                        class="w-full px-4 py-2 text-black border-1 bg-gray-100 rounded-md shadow-sm">
                </div>
            </div>
            <div class="w-full mt-4">
                <button type='submit' value='submit' name="btn" id="btn"
                    class="w-full bg-blue-300 py-2 rounded-md shadow-md text-white font-bold mt-4 hover:cursor-pointer hover:bg-blue-600 transition delay-150 duration-300 ease-in-out">Submit</button>
            </div>
        </form>
    </div>
    <!-- TABLE -->
    <div class="w-full p-2">
        <!-- SEARCH FUNCTION -->
        <form action="" method="post" class="w-full flex mb-2 shadow-md">
            <input class="px-6 py-3 bg-gray-50 w-9/12" type="text" placeholder="Search..." id="search" name="search">
            <button
                class="px-6 py-3 bg-blue-400 rounded-tr-full rounded-br-full w-3/12 flex text-white justify-between font-bold hover:bg-blue-600 cursor-pointer transition delay-150 duration-300 ease-in-out"
                type="button" value="submit" name="search" id="search">

                Search
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
            </button>
        </form>
        <form method="post">
        <div class="w-full my-2">
            <button type='submit' name="multi_delete" value="Delete" class="px-4 py-2 bg-red-400 text-white rounded hover:bg-red-600" onclick="return confirm('Delete Shtis?')" >Delete</button>
        </div>
        <!-- TABLE STARTING -->
        <table class="w-full bg-white rounded-md shadow-md table-fixed">
            <thead class="text-lg text-gray-700 uppercase text-left bg-gray-200">
                <th></th>
                <th class="px-6 py-3 font-bold">ID</th>
                <th class="px-6 py-3">First Name</t>
                <th class="px-6 py-3">Last Name</t>
                <th class="px-6 py-3">Address</t>
                <th class="px-6 py-3">Phone Number</th>
                <th class="px-6 py-3">Actions</th>
            </thead>
            <tbody class="bg-white">
                <?php foreach ($DisplayAll as $row) { ?>
                    <tr class="mb-40 border-b">
                        <td class="px-6 py-4">
                        <div class="inline-flex items-center">
                            <label
                                class="relative flex cursor-pointer items-center rounded-full p-3"
                                for="ripple-on"
                                data-ripple-dark="true">
                                <input
                                    name="selected_id[]" value="<?php echo $row["id"] ?>"
                                    id="ripple-on"
                                    type="checkbox"
                                    class="peer relative h-5 w-5 cursor-pointer appearance-none rounded border border-blue-300 shadow hover:shadow-md transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-400 before:opacity-0 before:transition-opacity checked:border-blue-800 checked:bg-blue-800 checked:before:bg-blue-400 hover:before:opacity-10" />
                                <span class="pointer-events-none absolute top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 text-white opacity-0 transition-opacity peer-checked:opacity-100">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-3.5 w-3.5"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        stroke="currentColor"
                                        stroke-width="1">
                                        <path
                                            fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>    </label></div>
                        </td>
                        <td class="px-6 py-4"><?php echo $row["id"] ?></td>
                        <td class="px-6 py-4"><?php echo $row["first_name"] ?></td>
                        <td class="px-6 py-4"><?php echo $row["last_name"] ?></td>
                        <td class="px-6 py-4"><?php echo $row["address"] ?></td>
                        <td class="px-6 py-4"><?php echo $row["phone_num"] ?></td>
                        <td class="px-6 py-4 hover:cursor-pointer">
                            <!-- <div action="update.php?id=<?php echo $row['id']; ?>" method="post" class="flex"> -->
                            <div class="flex">
                                <!-- EDIT -->
                                <a href="update.php?id=<?php echo $row['id']; ?>"
                                    class="icons hover:bg-green-200 w-10 h-10 justify-center items-center flex rounded-md text-green-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                <!-- DELETE -->
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button value="<?php echo $row['id']; ?>" id="delete" name="delete" onclick="return confirm('Are you sure?')" 
                                        class="icons hover:bg-red-200 w-10 h-10 justify-center items-center flex rounded-md text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>

                                </di>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
        </form>
    </div>
</div>
<!-- BOOSTRAP -->
<div class="p-3 mb-2 bg-info text-white container-fluid d-flex gap-2">
    <form class="col">
        <h1>Boostrap Forms</h1>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <table class="table col">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>
</div>
<?php
include("./includes/footer.php")
?>
<!-- 
SELECT * FROM tbl_contacts WHERE address LIKE "%Alijis%";

INSERT INTO tbl_contacts (first_name, last_name, address, phone_num) VALUES ("Rafael", "Villa","Silay", "09225121845"),("Nicole", "Menez","Taculing", "09225181845"),("Boss Carl", "Hahaha","Banago", "09225189925"); -->

<!-- $successMessage = ''; -->
<!-- if ($successMessage):  -->
<!-- echo $successMessage; -->
<!-- endif; -->