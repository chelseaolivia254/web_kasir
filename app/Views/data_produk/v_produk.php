<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <script src="<?= base_url("assets/jquery-3.7.1.min.js") ?>"></script>


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="col-12">
            <h3 class="text-center">Data Produk</h3>
            <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalTambahProduk">
                <i class="fas fa-shopping-cart"></i> Tambah Data
            </button>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="container mt-5">
                <table class="table table-bordered" id="produkTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data akan dimasukkan melalui AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahProduk" aria-labelledby="modalTambahProduk" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="modalTambahProdukLabel">Tambah Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formProduk">
                        <div class="row mb-3">
                            <label for="namaProduk" class="col-form-label">Nama Produk</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="namaProduk" name="namaProduk">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="hargaProduk" class="col-sm-4 col-form-label">Harga</label>
                            <div class="col-sm-8">
                                <input type="number" step="0.01" class="form-control" id="hargaProduk">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="stokProduk" class="col-sm-4 col-form-label">Stok</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="stokProduk">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="simpanProduk" class="btn btn-primary float-end">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditProduk" aria-labelledby="modalEditProduk" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="modalEditProdukLabel">Edit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formProduk">
                        <div class="row mb-3">
                            <label for="namaProdukEdit" class="col-form-label">Nama Produk</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="namaProdukEdit" name="namaProdukEdit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="hargaProdukEdit" class="col-sm-4 col-form-label">Harga</label>
                            <div class="col-sm-8">
                                <input type="number" step="0.01" class="form-control" id="hargaProdukEdit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="stokProdukEdit" class="col-sm-4 col-form-label">Stok</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="stokProdukEdit">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="simpanEditProduk" class="btn btn-primary float-end">Simpan</button>
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
            // Menampilkan data produk
            function tampilProduk() {
                $.ajax({
                    url: '<?= base_url('produk/tampil') ?>', // URL server untuk menampilkan produk
                    type: 'GET',
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            var produkTable = $('#produkTable tbody');
                            produkTable.empty(); // Kosongkan tabel sebelum menambahkan data baru
                            var no = 1;
                            hasil.produk.forEach(function(item) {
                                var row = `<tr>
                            <td>${no}</td>
                            <td>${item.nama_produk}</td>
                            <td>${item.harga}</td>
                            <td>${item.stok}</td>
                            <td>
                                <button class="btn btn-warning btn-sm editProduk" data-bs-toggle="modal" data-bs-target="#modalEditProduk" data-id="${item.produk_id}"><i class="fa-solid fa-pencil"></i> Edit</button>
                                <button class="btn btn-danger btn-sm hapusProduk" data-id="${item.produk_id}"><i class="fa-solid fa-trash-can"></i> Hapus</button>
                            </td>
                        </tr>`;
                                produkTable.append(row);
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

            tampilProduk(); // Panggil fungsi untuk menampilkan produk saat dokumen siap

            // Simpan produk baru
            $("#simpanProduk").on("click", function() {
                var formData = {
                    nama_produk: $('#namaProduk').val(),
                    harga: $('#hargaProduk').val(),
                    stok: $('#stokProduk').val()
                };
                $.ajax({
                    url: '<?= base_url('produk/simpan') ?>', // URL server untuk menyimpan produk baru
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            $('#modalTambahProduk').modal('hide');
                            $('#formProduk')[0].reset();
                            tampilProduk(); // Perbarui tabel setelah menyimpan
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

            // Edit produk
            $(document).on('click', '.editProduk', function() {
                var produkID = $(this).data('id');
                $.ajax({
                    url: '<?= base_url('produk/getProduk') ?>/' + produkID, // URL server untuk mendapatkan data produk
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data.status === 'success') {
                            $('#namaProdukEdit').val(data.produk.nama_produk);
                            $('#hargaProdukEdit').val(data.produk.harga);
                            $('#stokProdukEdit').val(data.produk.stok);
                            $('#simpanEditProduk').data('id', produkID); // Set data-id untuk menyimpan perubahan
                        } else {
                            alert('Gagal mengambil data produk');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            });

            // Simpan perubahan pada produk edit
            $('#simpanEditProduk').on('click', function() {
                var produkID = $(this).data('id');
                var formData = {
                    nama_produk: $('#namaProdukEdit').val(),
                    harga: $('#hargaProdukEdit').val(),
                    stok: $('#stokProdukEdit').val()
                };
                $.ajax({
                    url: '<?= base_url('produk/update_produk') ?>/' + produkID, // URL server untuk memperbarui produk
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            $('#modalEditProduk').modal('hide');
                            tampilProduk(); // Perbarui tabel setelah perubahan
                            Swal.fire({
                                title: "Sukses Tersimpan!",
                                icon: "success"
                            });
                        } else {
                            alert('Gagal menyimpan perubahan: ' + JSON.stringify(hasil.errors));
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            });
        });

        $(document).on('click', '.hapusProduk', function() {
            var produkID = $(this).data('id');
            var confirmHapus = confirm("Apakah Anda yakin ingin menghapus produk ini?");

            if (confirmHapus) {
                $.ajax({ // Hapus produk
                    url: '<?= base_url('produk/hapus') ?>/' + produkID, // URL server untuk menghapus produk
                    type: 'POST',
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            $('#produk-' + produkID).remove();
                            Swal.fire({
                                title: "Produk berhasil dihapus!",
                                icon: "success",
                                timer: 1500,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                title: "Gagal menghapus produk!",
                                icon: "error",
                                text: hasil.message || "Terjadi kesalahan."
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: "Terjadi kesalahan!",
                            icon: "error",
                            text: error
                        });
                    }
                });
            }
        });
    </script>
</body>

</html>