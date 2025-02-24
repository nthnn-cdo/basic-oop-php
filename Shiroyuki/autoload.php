<?php

/**
 * Autoload class-class secara on-demand. Tidak perlu include file secara manual.
 * Kelebihan: Ringan, karena dibutuhkan hanya pada saat tertentu saja.
 * Kekurangan: Membutuhkan waktu untuk mencari file yang sesuai.
 */
spl_autoload_register(function (string $className) {
    /**
     * Dirname berfungsi untuk mendapatkan direktori dari file yang sedang dijalankan.
     * Digunakan sehingga Namespace tidak terduplikasi pada saat menjalankan fungsi
     * include_once.
     */
    $dirname = dirname(__DIR__);

    /**
     * Karena Directory Separator berbeda pada masing-masing Sistem Operasi, maka
     * diperlukan penyesuaian terhadap Directory Separator yang digunakan. PHP
     * sudah menyediakan konstanta DIRECTORY_SEPARATOR yang dapat digunakan.
     */
    $directorySeparator = DIRECTORY_SEPARATOR;

    /**
     * Mengganti Namespace Separator menjadi Directory Separator agar file dapat
     * ditemukan dengan benar berdasarkan Sistem Operasi yang dipakai.
     */
    $fixedClassName = str_replace('\\', $directorySeparator, $className);

    /**
     * Include file yang sesuai dengan Namespace yang diminta.
     */
    include_once "{$dirname}{$directorySeparator}{$fixedClassName}.php";
});