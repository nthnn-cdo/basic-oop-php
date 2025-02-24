<?php

use Components\UserDataTable;
use Models\User;

include_once './layouts/header.php';

if (isset ($_POST['action'])) {
    switch ($_POST['action']) {
        case 'addUser':
            User::create($_POST);
            break;

        case 'editUser':
            (new User)->query()
                ->where('id', '=', $_POST['id'])
                ->update($_POST);
            break;

        case 'deleteUser':
            (new User)->query()
                ->where('id', '=', $_POST['id'])
                ->delete();
            break;

        default:
            # code...
            break;
    }
}

?>

<div class="container">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="h4">
            User Data
        </h4>
        <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            Tambah User
        </a>
    </div>

    <div class="overflow-x-auto">
        <?= UserDataTable::render(); ?>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">
                        Tambah User
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="" method="post">
                    <input type="hidden" name="action" value="addUser">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="col-form-label">
                                Nama:
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="email" class="col-form-label">
                                Email:
                                <span class="text-danger">*</span>
                            </label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                required
                            />
                        </div>

                        <div class="mb-3">
                            <label for="hobby" class="col-form-label">
                                Hobi:
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="hobby"
                                name="hobby"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="height" class="col-form-label">
                                Tinggi:
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="number"
                                class="form-control"
                                id="height"
                                name="height"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="weight" class="col-form-label">
                                Berat:
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="number"
                                class="form-control"
                                id="weight"
                                name="weight"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="col-form-label">
                                Jenis Kelamin:
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                name="gender"
                                id="gender"
                                class="form-control"
                                required
                            >
                                <option value="L">L</option>
                                <option value="P">P</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">
                        Edit User
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="" method="post">
                    <input type="hidden" name="action" value="editUser" />
                    <input type="hidden" name="id" />

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="col-form-label">
                                Nama:
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="email" class="col-form-label">
                                Email:
                                <span class="text-danger">*</span>
                            </label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                required
                            />
                        </div>

                        <div class="mb-3">
                            <label for="hobby" class="col-form-label">
                                Hobi:
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="hobby"
                                name="hobby"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="height" class="col-form-label">
                                Tinggi:
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="number"
                                class="form-control"
                                id="height"
                                name="height"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="weight" class="col-form-label">
                                Berat:
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="number"
                                class="form-control"
                                id="weight"
                                name="weight"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="col-form-label">
                                Jenis Kelamin:
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                name="gender"
                                id="gender"
                                class="form-control"
                                required
                            >
                                <option value="L">L</option>
                                <option value="P">P</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">
                        Delete User
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="" method="post">
                    <input type="hidden" name="action" value="deleteUser" />
                    <input type="hidden" name="id" />

                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data ini?
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const setModalData = (data) => {
            const form = document.querySelector('#editModal form');

            for (const key in data) {
                if (Object.hasOwnProperty.call(data, key)) {
                    const element = data[key];
                    const input = form.querySelector(`input[name="${key}"]`);

                    if (input) {
                        input.value = element;
                    }
                }
            }
        }

        const setDeletionId = (id) => {
            const form = document.querySelector('#deleteModal form');
            const input = form.querySelector('input[name="id"]');

            input.value = id;
        }
    </script>
</div>

<?php include_once './layouts/footer.php'; ?>
