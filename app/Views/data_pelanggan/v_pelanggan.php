<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <script src="<?= base_url('assets/jquery-3.7.1.min.js') ?>"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <h3 class="text-center">Data Pelanggan</h3>
                <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalTambahPelanggan">
                    <i class="fas fa-user"></i> Tambah Data
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="container mt-5">
                    <table class="table table-bordered" id="pelangganTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Alamat</th>
                                <th>Nomor Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data akan dimasukkan melalui AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Pelanggan -->
        <div class="modal fade" id="modalTambahPelanggan" aria-labelledby="modalTambahPelangganLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h1 class="modal-title fs-5" id="modalTambahPelangganLabel">Tambah Pelanggan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formPelanggan">
                            <div class="row mb-3">
                                <label for="namaPelanggan" class="col-sm-4 col-form-label">Nama Pelanggan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="namaPelanggan" name="namaPelanggan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="alamatPelanggan" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="alamatPelanggan" name="alamatPelanggan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nomorTelepon" class="col-sm-4 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="nomorTelepon" name="nomorTelepon" required>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="simpanPelanggan" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Pelanggan -->
        <div class="modal fade" id="modalEditPelanggan" aria-labelledby="modalEditPelangganLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h1 class="modal-title fs-5" id="modalEditPelangganLabel">Edit Pelanggan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formPelangganEdit">
                            <div class="row mb-3">
                                <label for="namaPelangganEdit" class="col-sm-4 col-form-label">Nama Pelanggan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="namaPelangganEdit" name="namaPelangganEdit" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="alamatPelangganEdit" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="alamatPelangganEdit" name="alamatPelangganEdit" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nomorTeleponEdit" class="col-sm-4 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nomorTeleponEdit" name="nomorTeleponEdit" required>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="simpanEditPelanggan" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery dan Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Menampilkan data pelanggan
            function tampilPelanggan() {
                $.ajax({
                    url: '<?= base_url('pelanggan/tampil') ?>',
                    type: 'GET',
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            var pelangganTable = $('#pelangganTable tbody');
                            pelangganTable.empty();
                            var no = 1;
                            hasil.pelanggan.forEach(function(item) {
                                var row = `<tr>
                                    <td>${no}</td>
                                    <td>${item.nama_pelanggan}</td>
                                    <td>${item.alamat}</td>
                                    <td>${item.nomor_telepon}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm editPelanggan" data-bs-toggle="modal" data-bs-target="#modalEditPelanggan" data-id="${item.id_pelanggan}"><i class="fa-solid fa-pencil"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm hapusPelanggan" data-id="${item.id_pelanggan}"><i class="fa-solid fa-trash-can"></i> Hapus</button>
                                    </td>
                                </tr>`;
                                pelangganTable.append(row);
                                no++;
                            });
                        } else {
                            alert('Gagal mengambil data.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            }

            tampilPelanggan();

            // Simpan pelanggan baru
            $("#simpanPelanggan").on("click", function() {
                var formData = {
                    nama_pelanggan: $('#namaPelanggan').val(),
                    alamat: $('#alamatPelanggan').val(),
                    nomor_telepon: $('#nomorTelepon').val()
                };
                $.ajax({
                    url: '<?= base_url('pelanggan/simpan') ?>',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            $('#modalTambahPelanggan').modal('hide');
                            $('#formPelanggan')[0].reset();
                            tampilPelanggan();
                            Swal.fire({
                                title: "Sukses Tersimpan!",
                                icon: "success"
                            });
                        } else {
                            alert('Gagal menyimpan data: ' + JSON.stringify(hasil.errors));
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            });

            // Edit pelanggan
            $(document).on('click', '.editPelanggan', function() {
                var pelangganID = $(this).data('id'); // Ambil ID pelanggan
                $.ajax({
                    url: '<?= base_url('pelanggan/getPelanggan') ?>/' + pelangganID, // Pastikan URL-nya sesuai dengan routing yang benar
                    type: 'GET',
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            $('#namaPelangganEdit').val(hasil.pelanggan.nama_pelanggan);
                            $('#alamatPelangganEdit').val(hasil.pelanggan.alamat);
                            $('#nomorTeleponEdit').val(hasil.pelanggan.nomor_telepon);
                            $('#simpanEditPelanggan').data('id', pelangganID); // Set ID untuk tombol simpan
                        } else {
                            alert('Data pelanggan tidak ditemukan.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            });


            // Simpan update pelanggan
            $("#simpanEditPelanggan").on("click", function() {
                var pelangganID = $(this).data('id'); // Ambil ID pelanggan dari data tombol simpan
                var formData = {
                    nama_pelanggan: $('#namaPelangganEdit').val(),
                    alamat: $('#alamatPelangganEdit').val(),
                    nomor_telepon: $('#nomorTeleponEdit').val()
                };
                $.ajax({
                    url: '<?= base_url('pelanggan/update_pelanggan') ?>/' + pelangganID, // Pastikan URL-nya benar
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            $('#modalEditPelanggan').modal('hide');
                            $('#formPelangganEdit')[0].reset();
                            tampilPelanggan(); // Update tabel setelah berhasil
                            Swal.fire({
                                title: "Sukses Diperbarui!",
                                icon: "success"
                            });
                        } else {
                            alert('Gagal memperbarui data: ' + JSON.stringify(hasil.errors));
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            });
            // Hapus pelanggan
            $(document).on('click', '.hapusPelanggan', function() {
                var pelangganID = $(this).data('id'); // Ambil ID pelanggan
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data pelanggan ini akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?= base_url('pelanggan/hapus') ?>/' + pelangganID, // Pastikan URL-nya benar
                            type: 'POST',
                            dataType: 'json',
                            success: function(hasil) {
                                if (hasil.status === 'success') {
                                    tampilPelanggan(); // Update tabel setelah berhasil
                                    Swal.fire({
                                        title: 'Sukses Dihapus!',
                                        icon: 'success'
                                    });
                                } else {
                                    alert('Gagal menghapus data: ' + JSON.stringify(hasil.errors));
                                }
                            },
                            error: function(xhr, status, error) {
                                alert('Terjadi kesalahan: ' + error);
                            }
                        });
                    }
                });
            });

        });
    </script>
</body>

</html>