<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $sql = "SELECT * FROM tbl_products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        
        $sql = "UPDATE tbl_products SET name=?, description=?, price=?, quantity=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdii", $name, $description, $price, $quantity, $id);
        
        if ($stmt->execute()) {
            echo "Product updated successfully";
        } else {
            echo "Error updating product: " . $conn->error;
        }
    }
} else {
    die("ID not supplied!");
}
?>

<h2>Edit Product</h2>
<form method="post">
    Name: <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br>
    Description: <textarea name="description"><?php echo $product['description']; ?></textarea><br>
    Price: <input type="text" name="price" value="<?php echo $product['price']; ?>" required><br>
    Quantity: <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" required><br>
    <input type="submit" value="Update">
</form>
<a href="index.php">Back to List</a>

<?php
$stmt->close();
$conn->close();
?>
