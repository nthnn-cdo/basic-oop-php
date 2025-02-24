<?php
    include_once __DIR__ . str_replace('/', DIRECTORY_SEPARATOR, '/../Shiroyuki/autoload.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OOP With Bootstrap</title>
    <!-- Baris Link di bawah digunakan untuk mendapatkan file CSS dari Bootstrap secara langsung. -->
    <!-- Plus: Jika terkoneksi dengan internet, maka styling CSS akan dapat diambil. -->
    <!-- Minus: Jika tidak terkoneksi dengan internet, maka styling CSS tidak akan dapat diambil. -->

    <!-- Dari Tag <link> ini, yang paling penting adalah atribut "href" dan "rel". -->
    <!-- Integrity dan Crossorigin adalah atribut opsional tambahan yang dapat digunakan ketika ada masalah terkait CORS. -->
    <!-- Silahkan dibrowsing terkait CORS, tapi jangan dijadikan fokus utama. -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    />
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-4">
        <div class="container">
            <a
                class="navbar-brand"
                href="./index.php"
            >
                Beranda
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./user.php">
                            User
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>