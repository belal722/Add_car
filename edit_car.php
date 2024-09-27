<?php
session_start();
require_once('_conn.php');

// التحقق من أن الـ ID مرسل بشكل صحيح
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $st = $db->prepare("SELECT * FROM products WHERE id = ?");
    $st->execute([$id]);
    $product = $st->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "المنتج غير موجود.";
        exit;
    }
} else {
    echo "رقم المنتج غير صحيح.";
    exit;
}

// إذا تم تقديم النموذج
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $car_number = htmlspecialchars(trim($_POST['number']));

    // حفظ الصورة وملف الـ PDF
    $img_name = $product['img']; // احتفظ بالاسم القديم في حال لم يتم رفع صورة جديدة
    $pdf_name = $product['pdf']; // احتفظ بالاسم القديم في حال لم يتم رفع ملف PDF جديد

    // التحقق من رفع صورة جديدة
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $img_ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        $allowed_img_ext = ['jpg', 'jpeg', 'png'];

        if (in_array($img_ext, $allowed_img_ext)) {
            $img_name = $name . time() . '.' . $img_ext;
            $img_path = 'image/' . $img_name;

            // رفع الصورة الجديدة وحذف القديمة
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $img_path)) {
                if ($product['img'] && file_exists('image/' . $product['img'])) {
                    unlink('image/' . $product['img']);
                }
            } else {
                echo "فشل في رفع الصورة.";
                exit;
            }
        } else {
            echo "صيغة الصورة غير مدعومة.";
            exit;
        }
    }

    // التحقق من رفع ملف PDF جديد
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
        $pdf_ext = strtolower(pathinfo($_FILES['pdf']['name'], PATHINFO_EXTENSION));
        $allowed_pdf_ext = ['pdf'];

        if (in_array($pdf_ext, $allowed_pdf_ext)) {
            $pdf_name = $name . time() . '.pdf';
            $pdf_path = 'pdf/' . $pdf_name;

            // رفع ملف الـ PDF الجديد وحذف القديم
            if (move_uploaded_file($_FILES['pdf']['tmp_name'], $pdf_path)) {
                if ($product['pdf'] && file_exists('pdf/' . $product['pdf'])) {
                    unlink('pdf/' . $product['pdf']);
                }
            } else {
                echo "فشل في رفع ملف PDF.";
                exit;
            }
        } else {
            echo "صيغة ملف PDF غير مدعومة.";
            exit;
        }
    }

    // تحديث البيانات في قاعدة البيانات
    $st = $db->prepare("UPDATE products SET name = ?, car_number = ?, img = ?, pdf = ? WHERE id = ?");
    if ($st->execute([$name, $car_number, $img_name, $pdf_name, $id])) {
        $_SESSION['msg'] = ["success", "تم تعديل العنصر بنجاح"];
        header("Location: create_car.php");
        exit;
    } else {
        echo "فشل في تحديث البيانات.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
    <!-- ربط Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ربط خط مخصص من Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- تخصيص CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }

        .container {
            margin-top: 50px;
            max-width: 600px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .form-group label {
            font-weight: 600;
            color: #555;
        }

        .form-group input[type="text"],
        .form-group input[type="file"] {
            border-radius: 5px;
            box-shadow: none;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="file"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-group img {
            margin-top: 10px;
            max-width: 100px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group a {
            display: block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }

        .form-group a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>تعديل المنتج</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="name">Car Name</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="number">Car Number</label>
                <input type="text" id="number" name="number" value="<?= htmlspecialchars($product['car_number']) ?>" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="photo">Car Photo</label>
                <input type="file" id="photo" name="photo" class="form-control">
                <img src="image/<?= htmlspecialchars($product['img']) ?>" alt="Current Photo">
            </div>
            <div class="form-group mb-3">
                <label for="pdf">Car PDF</label>
                <input type="file" id="pdf" name="pdf" class="form-control">
                <a href="pdf/<?= htmlspecialchars($product['pdf']) ?>" target="_blank">عرض PDF الحالي</a>
            </div>
            <input type="submit" value="Update" class="btn btn-primary w-100">
        </form>
    </div>
</body>
</html>
