<?php
$aksi = "modul/mod_agenda/aksi_agenda.php";
$act = isset($_GET['act']) ? $_GET['act'] : ""; 

switch ($act) {
    // Tampil Agenda
    default:
        echo "<div class='container mt-4'>
                <h2>Agenda</h2>
                <button class='btn btn-success mb-3' onclick=location.href='?module=agenda&act=tambahagenda'>
                    <i class='bi bi-plus-lg'></i> Tambah Agenda
                </button>
                <table class='table table-striped table-bordered'>
                    <thead class='table-dark'>
                        <tr>
                            <th>No</th>
                            <th>Tema</th>
                            <th>Tgl. Mulai</th>
                            <th>Tgl. Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>";

        if ($_SESSION['leveluser'] == 'admin') {
            $tampil = mysqli_query($conn, "SELECT * FROM agenda ORDER BY id_agenda DESC");
        } else {
            $tampil = mysqli_query($conn, "SELECT * FROM agenda 
                    WHERE username='$_SESSION[namauser]'       
                    ORDER BY id_agenda DESC");
        }
        
        $no = 1;
        while ($r = mysqli_fetch_array($tampil)) {
            $tgl_mulai   = tgl_indo($r['tgl_mulai']);
            $tgl_selesai = tgl_indo($r['tgl_selesai']);
            echo "<tr>
                    <td>$no</td>
                    <td width='220'>$r[tema]</td>
                    <td>$tgl_mulai</td>
                    <td>$tgl_selesai</td>
                    <td>
                        <a href='?module=agenda&act=editagenda&id=$r[id_agenda]' class='btn btn-warning btn-sm'>
                            <i class='bi bi-pencil-square'></i> Edit
                        </a>
                        <a href='$aksi?module=agenda&act=hapus&id=$r[id_agenda]' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus agenda ini?\")'>
                            <i class='bi bi-trash'></i> Hapus
                        </a>
                    </td>
                </tr>";
            $no++;
        }

        echo "  </tbody>
                </table>
              </div>";
        break;

    case "tambahagenda":
        echo "<div class='container mt-4'>
                <h2>Tambah Agenda</h2>
                <form method='POST' action='$aksi?module=agenda&act=input' class='row g-3'>
                    <div class='col-md-12'>
                        <label class='form-label'>Tema</label>
                        <input type='text' name='tema' class='form-control' required>
                    </div>
                    <div class='col-md-12'>
                        <label class='form-label'>Isi Agenda</label>
                        <textarea name='isi_agenda' class='form-control' rows='4'></textarea>
                    </div>
                    <div class='col-md-6'>
                        <label class='form-label'>Tempat</label>
                        <input type='text' name='tempat' class='form-control' required>
                    </div>
                    <div class='col-md-6'>
                        <label class='form-label'>Pengirim (Contact Person)</label>
                        <input type='text' name='pengirim' class='form-control' required>
                    </div>
                    <div class='col-md-6'>
                        <label class='form-label'>Tgl Mulai </label> ";
                        combotgl(1, 31, 'tgl_mulai', $tgl_skrg);
                        combonamabln(1, 12, 'bln_mulai', $bln_sekarang);
                        combothn(2000, $thn_sekarang, 'thn_mulai', $thn_sekarang);
        echo "      </div>
                    <div class='col-md-6'>
                        <label class='form-label'>Tgl Selesai</label> ";
                        combotgl(1, 31, 'tgl_selesai', $tgl_skrg);
                        combonamabln(1, 12, 'bln_selesai', $bln_sekarang);
                        combothn(2000, $thn_sekarang, 'thn_selesai', $thn_sekarang);
        echo "      </div>
                    <div class='col-12'>
                        <button type='submit' class='btn btn-success'><i class='bi bi-save'></i> Simpan</button>
                        <button type='button' class='btn btn-secondary' onclick='history.back()'><i class='bi bi-x-circle'></i> Batal</button>
                    </div>
                </form>
              </div>";
        break;

    case "editagenda":
        $id = $_GET['id'];
        $query = mysqli_query($conn, "SELECT * FROM agenda WHERE id_agenda = '$id'");
        $r = mysqli_fetch_array($query);

        echo "<div class='container mt-4'>
                <h2>Edit Agenda</h2>
                <form method='POST' action='$aksi?module=agenda&act=update' class='row g-3'>
                    <input type='hidden' name='id_agenda' value='$r[id_agenda]'>
                    <div class='col-md-12'>
                        <label class='form-label'>Tema</label>
                        <input type='text' name='tema' class='form-control' value='$r[tema]' required>
                    </div>
                    <div class='col-md-12'>
                        <label class='form-label'>Isi Agenda</label>
                        <textarea name='isi_agenda' class='form-control' rows='4'>$r[isi_agenda]</textarea>
                    </div>
                    <div class='col-md-6'>
                        <label class='form-label'>Tempat</label>
                        <input type='text' name='tempat' class='form-control' value='$r[tempat]' required>
                    </div>
                    <div class='col-md-6'>
                        <label class='form-label'>Pengirim (Contact Person)</label>
                        <input type='text' name='pengirim' class='form-control' value='$r[pengirim]' required>
                    </div>
                    <div class='col-md-6'>
                        <label class='form-label'>Tgl Mulai </label> ";
                        combotgl(1, 31, 'tgl_mulai', $r['tgl_mulai']);
                        combonamabln(1, 12, 'bln_mulai', $r['tgl_mulai']);
                        combothn(2000, $thn_sekarang, 'thn_mulai', $r['tgl_mulai']);
        echo "      </div>
                    <div class='col-md-6'>
                        <label class='form-label'>Tgl Selesai</label> ";
                        combotgl(1, 31, 'tgl_selesai', $r['tgl_selesai']);
                        combonamabln(1, 12, 'bln_selesai', $r['tgl_selesai']);
                        combothn(2000, $thn_sekarang, 'thn_selesai', $r['tgl_selesai']);
        echo "      </div>
                    <div class='col-12'>
                        <button type='submit' class='btn btn-success'><i class='bi bi-save'></i> Simpan</button>
                        <button type='button' class='btn btn-secondary' onclick='history.back()'><i class='bi bi-x-circle'></i> Batal</button>
                    </div>
                </form>
              </div>";
        break;
}
?>
