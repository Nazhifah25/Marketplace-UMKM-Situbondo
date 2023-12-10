<?php

namespace Master;

use Config\Query_builder;

class Pelaku_UMKM
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('Pelaku_UMKM')->get()->resultArray();
        $res = '<a href="?target=Pelaku_UMKM&act=tambah_Pelaku_UMKM" class="btn btn-info btn-sm">Tambah Pelaku_UMKM</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>ID_Pelaku_UMKM</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Nama_usaha</th>
                    <th>Alamat</th>
                    <th>Jenis_Usaha</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                <td width="10">' . $no . '</td>
                <td width="100">' . $r['id_Pelaku_UMKM'] . '</td>
                <td>' . $r['Email_pelaku_UMKM'] . '</td>
                <td>' . $r['Nama_pelaku_UMKM'] . '</td>
                <td>' . $r['Nama_usaha_pelaku_UMKM'] . '</td>
                <td>' . $r['Alamat_pelaku_UMKM'] . '</td>
                <td>' . $r['Jenis_usaha_pelaku_UMKM'] . '</td>
                <td width="150">
                    <a href="?target=Pelaku_UMKM&act=edit_pelaku_UMKM&id=' . $r['id_pelaku_UMKM'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=Pelaku_UMKM&act=delete_pelaku_UMKM&id=' . $r['id_pelaku_UMKM'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=Pelaku_UMKM" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=Pelaku_UMKM&act=simpan_Pelaku_UMKM">
            <div class="mb-3">
                <label for="id_Pelaku_UMKM" class="form-label">id_Pelaku_UMKM</label>
                <input type="text" class="form-control" id="id_Pelaku_UMKM" name="id_Pelaku_UMKM">
            </div>
            <div class="mb-3">
                <label for="Email_Pelaku_UMKM" class="form-label">Email_Pelaku_UMKM</label>
                <input type="text" class="form-control" id="Email_Pelaku_UMKM" name="id_Pelaku_UMKM">
            </div>
            <div class="mb-3">
                <label for="Nama_Pelaku_UMKM" class="form-label">Nama</label>
                <input type="text" class="form-control" id="Nama_Pelaku_UMKM" name="Nama_Pelaku_UMKM">
            </div>
            <div class="mb-3">
                <label for="Nama_usaha_Pelaku_UMKM" class="form-label">Jabatan</label>
                <input type="text" class="form-control" id="Nama_usaha_Pelaku_UMKM" name="Nama_usaha_Pelaku_UMKM">
            </div>
            <div class="mb-3">
                <label for="alamat_pelaku_UMKM" class="form-label">Alamat Pelaku_UMKM</label>
                <input type="text" class="form-control" id="alamat_pelaku_UMKM" name="alamat_pelaku_UMKM">
            </div>
            <div class="mb-3">
                <label for="Jenis_usaha_pelaku_UMKM" class="form-label">Jenis_usaha_pelaku_UMKM</label>
                <input type="text" class="form-control" id="Jenis_usaha_pelaku_UMKM" name="Jenis_usaha_pelaku_UMKM">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan()
    {
        $id_Pelaku_UMKM = $_POST['id_Pelaku_UMKM'];
        $Email_Pelaku_UMKM = $_POST['Email_Pelaku_UMKM'];
        $Nama_Pelaku_UMKM = $_POST['Nama_Pelaku_UMKM'];
        $Nama_usaha_Pelaku_UMKM = $_POST['Nama_usaha_Pelaku_UMKM'];
        $alamat_pelaku_UMKM = $_POST['alamat_pelaku_UMKM'];
        $Jenis_usaha_pelaku_UMKM = $_POST['alamat_pelaku_UMKM'];
        $data = array(
            'id_Pelaku_UMKM' => $id_Pelaku_UMKM,
            'Email_Pelaku_UMKM' => $Email_Pelaku_UMKM,
            'Nama_Pelaku_UMKM' => $Nama_Pelaku_UMKM,
            'Nama_usaha_Pelaku_UMKM' => $Nama_usaha_Pelaku_UMKM,
            'alamat_pelaku_UMKM' => $alamat_pelaku_UMKM,
            'Jenis_usaha_pelaku_UMKM' => $alamat_pelaku_UMKM,
        );
        return $this->db->table('Pelaku_UMKM')->insert($data);
    }
    public function edit($id)
    {
        // get data Pelaku_UMKM
        $r = $this->db->table('Pelaku_UMKM')->where("id_Pelaku_UMKM='$id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=Pelaku_UMKM" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=Pelaku_UMKM&act=update_pegawai">
            <input type="hidden" class="form-control" id="param" name="param" value="' . $r['id_Pelaku_UMKM'] . '">
            <div class="mb-3">
                <label for="id_Pelaku_UMKM" class="form-label">ID</label>
                <input type="text" class="form-control" id="id_Pelaku_UMKM" name="id_Pelaku_UMKM" value="' . $r['id_Pelaku_UMKM'] . '">
            </div>
            <div class="mb-3">
                <label for="Email_Pelaku_UMKM" class="form-label">Email</label>
                <input type="text" class="form-control" id="Email_Pelaku_UMKM" name="Email_Pelaku_UMKM" value="' . $r['Email_Pelaku_UMKM'] . '">
            </div>
            <div class="mb-3">
                <label for="Nama_Pelaku_UMKM" class="form-label">Nama Pelaku</label>
                <input type="text" class="form-control" id="Nama_Pelaku_UMKM" name="Nama_Pelaku_UMKM" value="' . $r['Nama_Pelaku_UMKM'] . '">
            </div>
            <div class="mb-3">
                <label for="Nama_usaha_Pelaku_UMKM" class="form-label">Nama usaha</label>
                <input type="text" class="form-control" id="Nama_usaha_Pelaku_UMKM" name="Nama_usaha_Pelaku_UMKM" value="' . $r['Nama_usaha_Pelaku_UMKM'] . '">
            </div>
            <div class="mb-3">
                <label for="alamat_pelaku_UMKM" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat_pelaku_UMKM" name="alamat_pelaku_UMKM" value="' . $r['alamat_pelaku_UMKM'] . '">
            </div>
            <div class="mb-3">
                <label for="Jenis_usaha_pelaku_UMKM" class="form-label">Jenis usaha</label>
                <input type="text" class="form-control" id="Jenis_usaha_pelaku_UMKM" name="Jenis_usaha_pelaku_UMKM">
            </div>

            <button type="submit" class="btn btn-primary">Ubah</button>
        </form>';
        return $res;
    }

    public function cekRadio($val, $val2)
    {
        if ($val == $val2) {
            return "checked";
        }
        return "";
    }

    public function update()
    {
        $param = $_POST['param'];
        $id_Pelaku_UMKM = $_POST['id_Pelaku_UMKM'];
        $Email_Pelaku_UMKM = $_POST['Email_Pelaku_UMKM'];
        $Nama_Pelaku_UMKM = $_POST['Nama_Pelaku_UMKM'];
        $Nama_usaha_Pelaku_UMKM = $_POST['Nama_usaha_Pelaku_UMKM'];
        $alamat_pelaku_UMKM = $_POST['alamat_pelaku_UMKM'];
        $Jenis_pelaku_UMKM = $_POST['jenis_pelaku_UMKM'];

        $data = array(
            'id_Pelaku_UMKM' => $id_Pelaku_UMKM,
            'Email_Pelaku_UMKM' => $Email_Pelaku_UMKM,
            'Nama_Pelaku_UMKM' => $Nama_Pelaku_UMKM,
            'Nama_usaha_Pelaku_UMKM' => $Nama_usaha_Pelaku_UMKM,
            'alamat_pelaku_UMKM' => $alamat_pelaku_UMKM,
            'Jenis_usaha_pelaku_UMKM' => $alamat_pelaku_UMKM,
        );
        return $this->db->table('Pelaku_UMKM')->where("id_Pelaku_UMKM='$param'")->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('Pelaku_UMKM')->where("id_Pelaku_UMKM='$id'")->delete();
    }
}
