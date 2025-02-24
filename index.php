<!-- Pada file ini, kita menerapkan konsep "Layouting". -->

<!-- Konsep Layouting didefinisikan sebagai suatu cara untuk memisahkan -->
<!-- bagian-bagian yang "sering" digunakan sehingga manajemen kode dan -->
<!-- integritas script pada masing-masing halaman akan konsisten. -->

<!-- Menggunakan konsep ini, kalian akan terbantu untuk menyimpan lebih -->
<!-- banyak waktu dikarenakan kalian tidak perlu menulis kode secara berulang. -->

<!-- Kode juga akan terlihat lebih rapih. -->

<?php include_once './layouts/header.php'; ?>

<!-- Seluruh kode kalian harus disimpan di antara Header dan Footer. -->
<div class="container py-4">
    <h4 class="h4">
        Contoh OOP menggunakan PHP dan Bootstrap
    </h4>
    <p class="mb-5">
        Catatan: Pastikan menggunakan PHP 8.1 ke atas.
    </p>
    <p>
        Navigasikan ke halaman User untuk melihat contoh penggunaan OOP.
    </p>
</div>

<?php include_once './layouts/footer.php'; ?>