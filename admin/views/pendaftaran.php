<?php
$query = "SELECT * FROM view_siswa";
$result = $db->query($query);
$students = $result->fetchAll(PDO::FETCH_ASSOC);
// var_dump($students);

// var_dump ($students);
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pendaftaran Siswa Baru!</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-11 col-md-11">
            <!-- isi content -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">ADD DATA</button>
            <?php
            require_once "controls/tambah.php";
            ?>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#printpdf">Print PDF</button>
            <div class="table-responsive mt-3">
                <table class="table table-bordered text-center" id="datatables">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Aksi</th>
                            <th>Gambar</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jurusan</th>
                            <th>File Ijazah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($students as $student):
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <?php
                                $click_edt = "onclick='btn_edit(" . $student['id'] . ")'";
                                $btn_edt = "<button " . $click_edt . " class='btn btn-success btn-sm p-0 me-3' data-toggle='tooltip' title='Edit'>Ubah</button>";
                                ?>
                                <td><?= $btn_edt ?> <a class="btn btn-danger btn-sm p-0 me-3" href='controls/hapus.php?vz=<?= base64_encode($participant['id']) ?>' onclick="return confirm('Apakah benar ingin di hapus ?')">Hapus</a></td>
                                <td><img src="../assets/imgSiswa/<?= $student['gambar']  ?>" alt="" width="80"></td>
                                <td><?= $student['nik']  ?></td>
                                <td><?= $student['nama']  ?></td>
                                <td><?= $student['email']  ?></td>
                                <td><?= $student['name']  ?></td>
                                <td><a href="../assets/filesSiswa/<?= $student['files']  ?>" target="_blank">view</a></td>
                            </tr>

                        <?php
                        endforeach; 
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- end content -->
        </div>
    </div>
</div>

<!--Modal Edit-->
<div class="modal" data-refresh="true" data-bs-backdrop="static" id="edt" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>

<script>
    function btn_edit(row_id) {
        $("#edt").modal('show').find('.modal-content').load('views/controls/ubah.php', {
            idtag: row_id
        });
    }
</script>