<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico">
    <title>CAM - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<style>
    * {
        color: white;
    }
</style>

<body>
    <section class="background-radial-gradient overflow-auto">
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0" style="background-color: rgb(138, 154, 91);">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <a href="<?=urlpath('dashboard')?>" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline">Contact App Manager</span>
                        </a>
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                            <li>
                                <a href="#" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-journal-bookmark-fill"></i> <span class="ms-1 d-none d-sm-inline">Kontak</span> </a>
                            </li>
                        </ul>
                        <hr>
                        <div class="dropdown mb-4">
                            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi-person mx-2"></i>
                                <span class="">User</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                <li><a class="dropdown-item" href="<?= urlpath('logout') ?>">Log out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col py-3 pt-5">
                    <div class="col-md">
                        <button class="btn btn-light btn-sm text-white border-0" style="font-weight: 600; background-color:darkcyan;" data-bs-toggle="modal" data-bs-target="#tambahData">
                            <i class="bi bi-person-plus-fill"></i>&nbsp;Tambah data
                        </button>
                    </div>
                    <div class="col pt-5">
                        <div class="col-md">
                            <table id="dataContact" class="list table table-striped table-responsive table-hover text-center" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Nomor HP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($contacts)) : ?>
                                        <tr>
                                            <td colspan="5">No contacts found.</td>
                                        </tr>
                                    <?php else : ?>
                                        <?php foreach ($contacts as $index => $contact) : ?>
                                            <tr>
                                                <td><?php echo $index + 1; ?></td>
                                                <td><?php echo $contact['contact_name']; ?></td>
                                                <td><?php echo $contact['phone']; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahData-<?php echo $contact['id']; ?>"><i class="bi bi-pencil" style="color: black;"></i>
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteData-<?php echo $contact['id']; ?>"><i class="bi bi-trash2"></i>
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php foreach ($contacts as $contact) : ?>
                <!-- VIEW MODAL FORM UNTUK MENGUBAH DATA KONTAK -->
                <div class="modal fade" id="ubahData-<?php echo $contact['id']; ?>" tabindex="-1" aria-labelledby="ubahDataLabel-<?php echo $contact['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" style="color: black;" id="ubahDataLabel-<?php echo $contact['id']; ?>">
                                    Ubah data</h5>
                                <span aria-hidden="true">&times;</span>
                            </div>
                            <div class="modal-body">
                                <form action="<?= urlpath('dashboard/edit-contact') ?>" method="POST">
                                    <input type="hidden" name="contactId" value="<?php echo $contact['id']; ?>">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" name="contactName" value="<?php echo $contact['contact_name']; ?>" placeholder="Masukkan Nama" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="tel" class="form-control" name="phone" value="<?php echo $contact['phone']; ?>" placeholder="Masukkan Nomor HP" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- VIEW MODAL KONFIRMASI UNTUK MENGHAPUS DATA KONTAK -->
                <div class="modal fade" id="deleteData-<?php echo $contact['id']; ?>" tabindex="-1" aria-labelledby="deleteDataLabel-<?php echo $contact['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" style="color: black;" id="ubahDataLabel-<?php echo $contact['id']; ?>">
                                    Konfirmasi hapus data</h5>
                                <span aria-hidden="true">&times;</span>
                            </div>
                            <div class="modal-body" style="color: black;">
                                Apakah Anda yakin untuk menghapus kontak ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form action="<?= urlpath('dashboard/delete-contact') ?>" method="POST">
                                    <input type="hidden" name="contactId" value="<?php echo $contact['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- VIEW MODAL FORM UNTUK MENAMBAH DATA KONTAK -->
            <div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" style="color: black;" id="tambahDataLabel">Tambah data</h5>
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= urlpath('dashboard/add-contact') ?>" method="post">
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" name="contactName" id="name" placeholder="Masukkan Nama" required>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="Masukkan Nomor HP" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" value="Simpan" class="btn btn-primary"></input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
            </script>
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.3/dist/js/bootstrap.bundle.min.js"></script>
    </section>
</body>

</html>