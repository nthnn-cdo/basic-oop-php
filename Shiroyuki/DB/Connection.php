<?php

namespace Shiroyuki\DB;

use PDO;

/**
 * Membuat koneksi ke database menggunakan PDO. PDO adalah singkatan dari
 * PHP Data Object yang berfungsi untuk menjembatani antara kode PHP dengan
 * basis data yang diinginkan. Kelebihan PDO adalah dapat digunakan untuk
 * lebih dari satu jenis basis data, seperti MySQL, PostgreSQL, SQLite, dll.
 */
class Connection
{
    /**
     * Host dari database yang akan diakses.
     *
     * @var string|null
     */
    protected ?string $host = null;

    /**
     * Port dari database yang akan diakses.
     *
     * @var int|null
     */
    protected ?int $port = null;

    /**
     * Username dari database yang akan diakses.
     *
     * @var string|null
     */
    protected ?string $username = null;

    /**
     * Password dari database yang akan diakses.
     *
     * @var string|null
     */
    protected ?string $password = null;

    /**
     * Nama database yang akan diakses.
     *
     * @var string|null
     */
    protected ?string $database = null;

    /**
     * Koneksi ke database yang akan digunakan.
     *
     * @var PDO|null
     */
    protected ?PDO $connection = null;

    /**
     * Membuat koneksi ke database menggunakan PDO.
     *
     * @param  string  $host
     * @param  int  $port
     * @param  string  $username
     * @param  string  $password
     * @param  string  $database
     * @return void
     */
    public function __construct(
        string $host = '127.0.0.1',
        int $port = 3308,
        string $username = 'oop',
        string $password = 'password',
        string $database = 'oop',
    ) {
        $this->host = $host;

        $this->port = $port;

        $this->username = $username;

        $this->password = $password;

        $this->database = $database;

        try {
            $connection = new PDO("mysql:host={$host};dbname={$database};port={$port}", $username, $password);

            $connection->setAttribute(
                attribute: PDO::ATTR_ERRMODE,
                value: PDO::ERRMODE_EXCEPTION,
            );

            $this->connection = $connection;
        } catch (\Throwable $th) {
            die('Connection failed: ' . $th->getMessage());
        }
    }
}