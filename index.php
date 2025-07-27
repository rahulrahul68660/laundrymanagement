<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Laundry Orders</title>
</head>
<body>
    <h2>Laundry Management System</h2>
    <a href="add.php">Add New Order</a>
    <br><br>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Contact</th>
            <th>Item</th>
            <th>Qty</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM orders ORDER BY id DESC");
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['customer_name'] ?></td>
            <td><?= $row['contact_number'] ?></td>
            <td><?= $row['item_type'] ?></td>
            <td><?= $row['quantity'] ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= $row['order_date'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> | 
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this order?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>