<?php include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['customer_name'];
    $contact = $_POST['contact_number'];
    $item = $_POST['item_type'];
    $qty = $_POST['quantity'];
    $status = $_POST['status'];
    $date = $_POST['order_date'];

    if ($name && $contact && $item && $qty && $status && $date) {
        $stmt = $conn->prepare("INSERT INTO orders (customer_name, contact_number, item_type, quantity, status, order_date) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiss", $name, $contact, $item, $qty, $status, $date);
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
    <title>Add Order</title>
</head>
<body>
    <h2>Add Laundry Order</h2>
    <form method="post">
        Customer Name: <input type="text" name="customer_name"><br><br>
        Contact Number: <input type="text" name="contact_number"><br><br>
        Item Type: <input type="text" name="item_type"><br><br>
        Quantity: <input type="number" name="quantity"><br><br>
        Status: 
        <select name="status">
            <option value="Pending">Pending</option>
            <option value="In Process">In Process</option>
            <option value="Completed">Completed</option>
        </select><br><br>
        Order Date: <input type="date" name="order_date"><br><br>
        <input type="submit" value="Add Order">
    </form>
</body>
</html>