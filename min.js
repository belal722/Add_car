// function search(){
//     let searchBar = document.querySelector('.search-input').Value.toUpperCase();
//     let productList = document.querySelector('.product-list');
//     let product = document.querySelectorAll('.product');
//     let productName = document.getElementsByName('h2');

//     for (let i = 0; i<productName.length; i++) {
//         if (productName[i].innerHTML.toUpperCase().indexOf(searchBar) >= 0 ){
//             product[i].style.display = "";
//         } else{
//             product[i].style.display = "none";
//         }
//     }
// // }



function searchProducts() {
    // احصل على القيمة المدخلة في مربع البحث
    let input = document.querySelector('.search-input').value.toLowerCase();

    // احصل على جميع عناصر المنتجات
    let products = document.querySelectorAll('.product');

    // تكرار على جميع المنتجات
    products.forEach(product => {
        // احصل على اسم المنتج (h2)
        let productName = product.querySelector('h2').textContent.toLowerCase();

        // تحقق ما إذا كان اسم المنتج يتطابق مع المدخل
        if (productName.includes(input)) {
            // إذا تطابق، اظهر المنتج
            product.style.display = 'block';
        } else {
            // إذا لم يتطابق، أخفي المنتج
            product.style.display = 'none';
        }
    });
}
