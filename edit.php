<?php include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM orders WHERE id=$id");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['customer_name'];
    $contact = $_POST['contact_number'];
    $item = $_POST['item_type'];
    $qty = $_POST['quantity'];
    $status = $_POST['status'];
    $date = $_POST['order_date'];

    if ($name && $contact && $item && $qty && $status && $date) {
        $stmt = $conn->prepare("UPDATE orders SET customer_name=?, contact_number=?, item_type=?, quantity=?, status=?, order_date=? WHERE id=?");
        $stmt->bind_param("sssissi", $name, $contact, $item, $qty, $status, $date, $id);
        $stmt->execute();
        header("Location: index.php");
    } else {
        echo "All fields required.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Order</title>
</head>
<body>
    <h2>Edit Laundry Order</h2>
    <form method="post">
        Customer Name: <input type="text" name="customer_name" value="<?= $row['customer_name'] ?>"><br><br>
        Contact Number: <input type="text" name="contact_number" value="<?= $row['contact_number'] ?>"><br><br>
        Item Type: <input type="text" name="item_type" value="<?= $row['item_type'] ?>"><br><br>
        Quantity: <input type="number" name="quantity" value="<?= $row['quantity'] ?>"><br><br>
        Status: 
        <select name="status">
            <option <?= $row['status']=="Pending" ? "selected" : "" ?>>Pending</option>
            <option <?= $row['status']=="In Process" ? "selected" : "" ?>>In Process</option>
            <option <?= $row['status']=="Completed" ? "selected" : "" ?>>Completed</option>
        </select><br><br>
        Order Date: <input type="date" name="order_date" value="<?= $row['order_date'] ?>"><br><br>
        <input type="submit" value="Update Order">
    </form>
</body>
</html>