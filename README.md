# CarRentalWebApp

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
                                <a class="edit_btn" href="testindex.php?edit=<?php echo $row['id']; ?>">Edit</a>
                        </td>
                        <td>
                                <a class="del_btn" href="testphp_code.php?del=<?php echo $row['id']; ?>">Delete</a>
                        </td>
                </tr>
        <?php } ?>
</table>



<table>
    <thead>
        <tr>
            <th>1</th>
            <th>2</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_array($results)) { ?>
                <tr>
                    <td><?php echo $row['customer_id']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td>
                        <a class="edit_btn" href="testindex.php?edit=<?php echo $row['id']; ?>">Edit</a>
                    </td>
                    <td>
                        <a class="del_btn" href="testphp_code.php?del=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>

    </tbody>
</table>