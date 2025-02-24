<?php

namespace Shiroyuki\DB;

use PDO;
use Shiroyuki\DB\Interfaces\Queryable;
use Shiroyuki\DB\Traits\HasTableName;

/**
 * Kelas Model ini adalah sebuah contoh implementasi seberapa kompleksnya
 * sebuah model yang bisa digunakan untuk melakukan query ke database.
 *
 * Walaupun didalamnya kompleks, namun kalian bisa memanfaatkan metode-metode
 * yang ada didalamnya untuk mempermudah pengembangan aplikasi. Ingat, pengembangan
 * sebuah Kelas biasanya hanya dilakukan satu kali, sisanya hanyalah berisi
 * pengembangan maintenance dan bugfixing.
 */
abstract class Model extends Connection implements Queryable
{
    use HasTableName;

    /**
     * Query yang akan dijalankan. Isi dari atribut ini akan diisi oleh
     * metode `buildQuery()` yang akan menghasilkan query yang akan dijalankan.
     *
     * @var string
     */
    protected string $query = '';

    /**
     * Kolom-kolom yang akan diambil dari database. Jika tidak diisi, maka
     * semua kolom akan diambil.
     *
     * @var array
     */
    protected array $selectColumns = ['*'];

    /**
     * Kondisi WHERE yang akan digunakan pada query.
     *
     * @var array
     */
    protected array $where = [];

    /**
     * Kolom-kolom yang akan digunakan untuk melakukan GROUP BY.
     *
     * @var array
     */
    protected array $groupBy = [];

    /**
     * Kolom-kolom yang akan digunakan untuk melakukan ORDER BY.
     *
     * @var array
     */
    protected array $orderBy = [];

    /**
     * Limit data yang akan diambil.
     *
     * @var int
     */
    protected int $limit = 0;

    /**
     * Offset data yang akan diambil.
     */
    protected int $offset = 0;

    public function __construct()
    {
        // Kenapa kita harus memanggil __construct dari parent class?
        // Karena kita ingin menginisialisasi koneksi ke database.
        // Jika kita tidak memanggil __construct dari parent class, maka
        // koneksi ke database tidak akan terbentuk.
        parent::__construct();

        // Mengatur nama tabel secara otomatis.
        // Fungsi ini akan mengambil nama class dan mengubahnya menjadi
        // bentuk snake_case.
        $this->setAutomaticTableName();

        // Mengecek apakah kolom yang akan diambil sudah diatur.
        $this->checkIfColumnsAttributeExists();
    }

    /**
     * Mengatur query yang akan dijalankan.
     *
     * @return self
     */
    public function query(): self
    {
        return $this;
    }

    /**
     * Mengatur kolom-kolom yang akan diambil dari database.
     *
     * @param  array  $columns
     */
    public function select(array $columns = ['*']): self
    {
        $this->selectColumns = $columns;

        return $this;
    }

    /**
     * Mengatur kondisi WHERE yang akan digunakan pada query.
     *
     * @param  string  $column
     * @param  string  $operator
     * @param  mixed  $value
     */
    public function where(string $column, string $operator, mixed $value): self
    {
        $this->where[] = [
            'column' => $column,
            'operator' => $operator,
            'value' => $value
        ];

        return $this;
    }

    /**
     * Mengatur kolom-kolom yang akan digunakan untuk melakukan GROUP BY.
     *
     * @param  string  $column
     * @return self
     */
    public function groupBy(string $column): self
    {
        $this->groupBy[] = $column;

        return $this;
    }

    /**
     * Mengatur kolom-kolom yang akan digunakan untuk melakukan ORDER BY.
     *
     * @param  string  $column
     * @param  string  $direction
     * @return self
     */
    public function orderBy(string $column, string $direction = 'ASC'): self
    {
        $this->orderBy[] = [
            'column' => $column,
            'direction' => $direction
        ];

        return $this;
    }

    /**
     * Mengatur limit data yang akan diambil.
     *
     * @param  int  $limit
     * @return self
     */
    public function limit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Mengatur offset data yang akan diambil.
     *
     * @param  int  $offset
     * @return self
     */
    public function offset(int $offset): self
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * Membangun query yang akan dijalankan.
     *
     * Pada sintaks SQL, secara umum, ada sintaks yang harus diikuti agar query dapat dijalankan:
     * 1. SELECT statement harus ada pertama kali pada query, diikuti dengan kolom-kolom yang akan diambil.
     * 2. FROM statement harus ada setelah SELECT, diikuti dengan nama tabel yang akan diambil.
     * 3. WHERE statement (jika ada) harus ditempatkan setelah FROM, diikuti dengan kondisi WHERE yang akan digunakan.
     * 4. GROUP BY statement (jika ada) harus ditempatkan setelah WHERE, diikuti dengan kolom-kolom yang akan digunakan untuk GROUP BY.
     * 5. ORDER BY statement (jika ada) harus ditempatkan setelah GROUP BY, diikuti dengan kolom-kolom yang akan digunakan untuk ORDER BY.
     * 6. LIMIT statement (jika ada) harus ditempatkan setelah ORDER BY, diikuti dengan jumlah data yang akan diambil.
     * 7. OFFSET statement (jika ada) harus ditempatkan setelah LIMIT, diikuti dengan jumlah data yang akan di-skip.
     *
     * @return string
     */
    public function buildQuery(): string
    {
        $this->query = 'SELECT ' . implode(', ', $this->selectColumns) . ' FROM ' . $this->getTableName();

        if (!empty($this->where)) {
            $this->query .= ' WHERE ';

            foreach ($this->where as $index => $where) {
                $this->query .= $where['column'] . ' ' . $where['operator'] . ' ' . $where['value'];

                if ($index < count($this->where) - 1) {
                    $this->query .= ' AND ';
                }
            }
        }

        if (!empty($this->groupBy)) {
            $this->query .= ' GROUP BY ' . implode(', ', $this->groupBy);
        }

        if (!empty($this->orderBy)) {
            $this->query .= ' ORDER BY ';

            foreach ($this->orderBy as $index => $orderBy) {
                $this->query .= $orderBy['column'] . ' ' . $orderBy['direction'];

                if ($index < count($this->orderBy) - 1) {
                    $this->query .= ', ';
                }
            }
        }

        if ($this->limit > 0) {
            $this->query .= ' LIMIT ' . $this->limit;
        }

        if ($this->offset > 0) {
            $this->query .= ' OFFSET ' . $this->offset;
        }

        return $this->query;
    }

    /**
     * Menjalankan query yang sudah dibangun dan mengembalikan hasilnya.
     *
     * @return array
     */
    public function get(): array
    {
        $this->buildQuery();

        $statement = $this->connection->prepare($this->query);

        $statement->execute();

        return $statement->fetchAll(
            mode: PDO::FETCH_ASSOC,
        );
    }

    /**
     * Membuat data baru pada database.
     *
     * @param  array  $data
     * @return self
     */
    public static function create(array $data): self
    {
        // Mengambil kolom-kolom yang diperbolehkan.
        $allowedColumns = (new static())->getColumns();

        // Membuat query untuk insert data.
        $query = 'INSERT INTO ' . (new static())->getTableName() . ' (';

        // Mengambil kolom-kolom yang diperbolehkan.
        foreach ($data as $column => $value) {
            if (in_array($column, $allowedColumns)) {
                $query .= "{$column},";
            }
        }

        // Menghapus koma di akhir query.
        $query = rtrim($query, ', ');

        // Menambahkan tanda kurung tutup.
        $query .= ') VALUES (';

        // Mengisi nilai dari kolom-kolom yang diperbolehkan.
        foreach ($data as $column => $value) {
            if (in_array($column, $allowedColumns)) {
                $query .= ":{$column},";
            }
        }

        // Menghapus koma di akhir query.
        $query = rtrim($query, ', ');

        // Menambahkan tanda kurung tutup.
        $query .= ')';

        // Menyiapkan statement untuk dieksekusi.
        $statement = (new static())->connection->prepare($query);

        foreach ($data as $column => $value) {
            if (in_array($column, $allowedColumns)) {
                $statement->bindValue(":{$column}", $value);
            }
        }

        // Menjalankan query.
        $statement->execute();

        return new static();
    }

    /**
     * Mengupdate data pada database.
     *
     * @param  array  $data
     * @return self
     */
    public function update(array $data): self
    {
        $allowedColumns = $this->getColumns();

        $query = 'UPDATE ' . $this->getTableName() . ' SET ';

        foreach ($data as $column => $value) {
            if (in_array($column, $allowedColumns)) {
                $query .= "{$column} = :{$column}, ";
            }
        }

        $query = rtrim($query, ', ');

        if (!empty($this->where)) {
            $query .= ' WHERE ';

            foreach ($this->where as $index => $where) {
                $query .= $where['column'] . ' ' . $where['operator'] . ' ' . $where['value'];

                if ($index < count($this->where) - 1) {
                    $query .= ' AND ';
                }
            }
        }

        $statement = $this->connection->prepare($query);

        foreach ($data as $column => $value) {
            if (in_array($column, $allowedColumns)) {
                $statement->bindValue(":{$column}", $value);
            }
        }

        $statement->execute();

        return $this;
    }

    /**
     * Menghapus data pada database.
     *
     * @return self
     */
    public function delete(): self
    {
        $query = 'DELETE FROM ' . $this->getTableName();

        if (!empty($this->where)) {
            $query .= ' WHERE ';

            foreach ($this->where as $index => $where) {
                $query .= $where['column'] . ' ' . $where['operator'] . ' ' . $where['value'];

                if ($index < count($this->where) - 1) {
                    $query .= ' AND ';
                }
            }
        }

        $statement = $this->connection->prepare($query);

        $statement->execute();

        return $this;
    }
}