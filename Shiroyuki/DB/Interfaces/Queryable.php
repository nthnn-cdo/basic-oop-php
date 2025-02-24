<?php

namespace Shiroyuki\DB\Interfaces;

/**
 * Kelas Interface adalah sebuah "template" yang bisa digunakan secara berulang-ulang
 * dengan tujuan supaya kelas yang mengimplementasikan interface tersebut harus
 * mengimplementasikan method-method yang sama. Sehingga tidak akan terjadi inkonsistensi
 * kode pada saat pengembangan.
 */
interface Queryable
{
    public function query(): self;

    public function select(array $columns = ['*']): self;

    public function where(string $column, string $operator, mixed $value): self;

    public function groupBy(string $column): self;

    public function orderBy(string $column, string $direction = 'ASC'): self;

    public function limit(int $limit): self;

    public function offset(int $limit): self;

    public function buildQuery(): string;

    public function get(): array;

    public static function create(array $data): self;

    public function update(array $data): self;

    public function delete(): self;
}