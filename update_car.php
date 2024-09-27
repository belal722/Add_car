<?php
session_start();
require_once('_conn.php');

// التأكد من استلام جميع البيانات المطلوبة
if (!isset($_POST['name']) || !isset($_POST['number']) || !isset($_POST['product_id'])) {
    echo "البيانات المطلوبة غير مكتملة.";
    exit;
}

// تنظيف المدخلات
$product_id = intval($_POST['product_id']);
$name = htmlspecialchars(trim($_POST['name']));
$car_number = htmlspecialchars(trim($_POST['number']));

// جلب البيانات القديمة من قاعدة البيانات
$st = $db->prepare("SELECT img, pdf FROM products WHERE id = ?");
$st->execute([$product_id]);
$old_data = $st->fetch(PDO::FETCH_ASSOC);

// التحقق من رفع ملفات جديدة
$img_name = $old_data['img']; // استخدم الصورة القديمة إذا لم يتم رفع صورة جديدة
$pdf_name = $old_data['pdf']; // استخدم ملف الـ PDF القديم إذا لم يتم رفع PDF جديد

// التحقق من الصورة الجديدة
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $img_ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
    $allowed_img_ext = ['jpg', 'jpeg', 'png'];

    if (!in_array($img_ext, $allowed_img_ext)) {
        echo "صيغة الصورة غير مدعومة. الصيغ المدعومة هي: " . implode(", ", $allowed_img_ext);
        exit;
    }

    // إنشاء اسم جديد للصورة
    $img_name = $name . time() . '.' . $img_ext;
    $p_photo = 'image/' . $img_name;

    // رفع الصورة الجديدة
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $p_photo)) {
        // حذف الصورة القديمة من الخادم
        if ($old_data['img'] && file_exists('image/' . $old_data['img'])) {
            unlink('image/' . $old_data['img']);
        }
    } else {
        echo "فشل في رفع الصورة.";
        exit;
    }
}

// التحقق من ملف الـ PDF الجديد
if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
    $pdf_ext = strtolower(pathinfo($_FILES['pdf']['name'], PATHINFO_EXTENSION));
    $allowed_pdf_ext = ['pdf'];

    if (!in_array($pdf_ext, $allowed_pdf_ext)) {
        echo "صيغة ملف PDF غير مدعومة.";
        exit;
    }

    // إنشاء اسم جديد لملف PDF
    $pdf_name = $name . time() . '.pdf';
    $p_pdf = 'pdf/' . $pdf_name;

    // رفع ملف الـ PDF الجديد
    if (move_uploaded_file($_FILES['pdf']['tmp_name'], $p_pdf)) {
        // حذف ملف الـ PDF القديم من الخادم
        if ($old_data['pdf'] && file_exists('pdf/' . $old_data['pdf'])) {
            unlink('pdf/' . $old_data['pdf']);
        }
    } else {
        echo "فشل في رفع ملف PDF.";
        exit;
    }
}

// تحديث قاعدة البيانات بالبيانات الجديدة
$st = $db->prepare("UPDATE products SET name = ?, car_number = ?, img = ?, pdf = ? WHERE id = ?");
if ($st->execute([$name, $car_number, $img_name, $pdf_name, $product_id])) {
    $_SESSION['msg'] = ["success", "تم تعديل العنصر بنجاح"];
    header("Location: edit_car.php?msg=success&product_id=" . $product_id);
    exit;
} else {
    $_SESSION['msg'] = ["error", "عذرًا! لم نتمكن من تعديل العنصر. الرجاء الاتصال بالمشرف."];
    header("Location: edit_car.php?msg=error&product_id=" . $product_id);
    exit;
}
?>
