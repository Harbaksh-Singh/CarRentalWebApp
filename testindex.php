<?php  include('testphp_code.php'); ?>
<?php 
if (isset($_GET['edit'])) {
    $customer_id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM customer WHERE customer_id=$customer_id");

    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        
        $customer_id = $n['customer_id'];
        $oldcustomer_id = $customer_id;
        $first_name = $n['first_name'];
        $last_name = $n['last_name'];
        $email = $n['email'];
        $phone_number = $n['phone_number'];
        $address = $n['address'];
        $date_of_birth = $n['date_of_birth'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD: CReate, Update, Delete PHP MySQL</title>
    <link rel="stylesheet" type="text/css" href="teststyle.css">

</head>
<body>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="msg">
            <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>

<?php $results = mysqli_query($db, "SELECT * FROM customer"); ?>

    
<table>
        <thead>
                <tr>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th colspan="7">Action</th>
                </tr>
        </thead>
        
        <?php while ($row = mysqli_fetch_array($results)) { ?>
                <tr>
                    
                    <td><?php echo $row['customer_id']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone_number']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['date_of_birth']; ?></td>
                    <td>
                        <a class="edit_btn" href="testindex.php?edit=<?php echo $row['customer_id']; ?>">Edit</a>
                    </td>
                    <td>
                        <a class="del_btn" href="testphp_code.php?del=<?php echo $row['customer_id']; ?>">Delete</a>
                    </td>
                </tr>
        <?php } ?>
</table>


<form method="post" action="testphp_code.php" >
    <input type="hidden" name="oldcustomer_id" value="<?php echo $oldcustomer_id; ?>">

    <div class="input-group">
        <label>Customer ID</label>
        <input type="text" name="customer_id" value="<?php echo $customer_id; ?>">
    </div>
    <div class="input-group">
        <label>First Name</label>
        <input type="text" name="first_name" value="<?php echo $first_name; ?>">
    </div>
    <div class="input-group">
        <label>Last Name</label>
        <input type="text" name="last_name" value="<?php echo $last_name; ?>">
    </div>
    <div class="input-group">
        <label>Email</label>
        <input type="text" name="email" value="<?php echo $email; ?>">
    </div>
    <div class="input-group">
        <label>phone_number</label>
        <input type="text" name="phone_number" value="<?php echo $phone_number; ?>">
    </div>
    <div class="input-group">
        <label>address</label>
        <input type="text" name="address" value="<?php echo $address; ?>">
    </div>
    <div class="input-group">
        <label>date_of_birth</label>
        <input type="text" name="date_of_birth" value="<?php echo $date_of_birth; ?>">
    </div>
    <div class="input-group">
    <?php if ($update == true): ?>
        <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
    <?php else: ?>
        <button class="btn" type="submit" name="save" >Save</button>
    <?php endif ?>       
    </div>
</form>
</body>

</html>