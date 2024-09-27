<?php
//connect to db page
require_once("_conn.php");
$st = $db->prepare("SELECT * FROM products");
$st->execute();
$rows = $st->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car</title>
    <link rel="icon" href="image/toewta1727369082.webp">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="js/bootstrap.bundle.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 22px;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 15px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 350px;
            margin-bottom: 30px;
        }

        label {
            font-size: 14px;
            color: #555;
        }

        input[type="text"],
        input[type="file"],
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border-radius: 4px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .product {
            background-color: #fff;
            padding: 10px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            width: 100%;
            max-width: 350px;
        }

        .product img {
            width: 80px;
            height: auto;
            border-radius: 4px;
            margin-right: 10px;
        }

        .product-details {
            flex: 1;
            text-align: left;
        }

        .product-details h2 {
            margin: 0;
            font-size: 16px;
            color: #333;
        }

        .product-details h3 {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }

        .product-details a {
            /* display: block; */
            font-size: 12px;
            color: #007bff;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .search-box {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            max-width: 350px;
            width: 100%;
        }

        .search-input {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Add Car</h1>

        <?php
        if (isset($_SESSION['msg'])) {
            $msg = $_SESSION['msg'];
            echo "<div class='alert alert-{$msg[0]}'>{$msg[1]}</div>";
            unset($_SESSION['msg']);
        }
        ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="js/bootstrap.bundle.js">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            background-image: url(images/img.jpeg);
            background-size: cover;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 22px;
            margin-bottom: 20px;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        /* صندوق البحث */
        .search-box {
            background-color:lab(94.1 3.59 17.19 / 0.63);
            /* padding: 10px; */
            border-radius: 8px;
            margin-bottom: 20px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .search-input {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        /* ترتيب الفورم */
        form {
            background-color: lab(53.59 0 -0.02 / 0);
            padding: 15px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
        }

        /* الاسم ورقم السيارة بجانب بعض */
        .form-group.horizontal {
            display: flex;
            justify-content: space-between;
        }

        .form-group.horizontal input {
            width: 48%;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        /* الصور وملفات الـ PDF بجانب بعض */
        .form-group.file-group {
            display: flex;
            justify-content: space-between;
        }

        .form-group.file-group input[type="file"] {
            width: 48%;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .product{
            background-color: #6891005A;
        }
        .edit-btn {
    background-color: #0000008D;
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 12px;
    margin-left: 10px;
    width: 70px;
}



    </style>
</head>

<body>

    <div class="container">
        <!-- صندوق البحث -->
        <div class="search-box">
            <input type="text" placeholder="Search" class="search-input" onkeyup="searchProducts()">
        </div>

        <!-- نموذج إضافة السيارة -->
        <form action="connection.php" method="post" enctype="multipart/form-data">

            <div class="form-group horizontal">
                <div>
                    <label for="name">Car Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter car type" required>
                </div>
                <div>
                    <label for="number">Car Number</label>
                    <input type="text" id="number" name="number" placeholder="Enter car number" required>
                </div>
            </div>

            <div class="form-group file-group">
                <div>
                    <label for="photo">Car Photo</label>
                    <input type="file" id="photo" name="photo" required>
                </div>
                <div>
                    <label for="pdf">Car PDF</label>
                    <input type="file" id="pdf" name="pdf" required>
                </div>
            </div>

            <input type="submit" name="submit" value="Add">
        </form>
    </div>

    <script>
        function searchProducts() {
            const input = document.querySelector('.search-input');
            const filter = input.value.toLowerCase();
            const products = document.querySelectorAll('.product');
            
            products.forEach(product => {
                const name = product.querySelector('h2').textContent.toLowerCase();
                const number = product.querySelector('h3').textContent.toLowerCase();
                if (name.includes(filter) || number.includes(filter)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }
    </script>

</body>

</html>

    <?php foreach ($rows as $row): ?>
    <div class="product" id="product-<?= $row["id"] ?>">
        <img src="./image/<?= htmlspecialchars($row["img"]) ?>" alt="" style="max-width: 200px; display: block;">
        <div class="product-details">
            <h2><?= htmlspecialchars($row["name"]) ?></h2>
            <h3><?= htmlspecialchars($row["car_number"]) ?></h3>
            <a href="pdf/<?= htmlspecialchars($row["pdf"]) ?>" target="_blank" >عرض PDF</a>
            <button class="delete-btn" data-id="<?= $row["id"] ?>">حذف</button>
            <a href="edit_car.php?id=<?= $row['id'] ?>" class="edit-btn">تعديل</a>
        </div>
    </div>
    <?php endforeach; ?>

    <script>

function searchProducts() {
            const searchInput = document.querySelector('.search-input').value.toLowerCase();
            const products = document.querySelectorAll('.product');

            products.forEach(function(product) {
                const productName = product.querySelector('h2').textContent.toLowerCase();
                if (productName.includes(searchInput)) {
                    product.style.display = '';
                } else {
                    product.style.display = 'none';
                }
            });
        }


        $(document).ready(function() {
            $('.delete-btn').click(function() {
                var productId = $(this).data('id');

                if (confirm("هل أنت متأكد أنك تريد حذف هذا العنصر؟")) {
                    $.ajax({
                        url: 'connection.php',
                        type: 'POST',
                        data: { product_id: productId, delete: true },
                        success: function(response) {
                            if (response === 'success') {
                                $('#product-' + productId).remove();
                                alert('تم حذف العنصر بنجاح.');
                            } else {
                                alert('فشل في حذف العنصر.');
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
