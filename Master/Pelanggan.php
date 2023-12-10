<?php

namespace Master;

use Config\Query_builder;

class Pelanggan
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('pelanggan')->get()->resultArray();
        $res = '<a href="?target=pelanggan&act=tambah_pelanggan" class="btn btn-info btn-sm">Tambah pelanggan</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>No. Telp</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                <td width="10">' . $no . '</td>
                <td width="100">' . $r['id'] . '</td>
                <td>' . $r['nama'] . '</td>
                <td>' . $r['no_telp'] . '</td>
                <td>' . $r['email'] . '</td>
                <td>' . $r['alamat'] . '</td>
                <td width="150">
                    <a href="?target=pelanggan&act=edit_pelanggan&id=' . $r['id'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=pelanggan&act=delete_pelanggan&id=' . $r['id'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=pelanggan" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=pelanggan&act=simpan_pelanggan">
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" id="id" name="id">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="mb-3">
                <label for="no_telp" class="form-label">No. Telp</label>
                <input type="text" class="form-control" id="no_telp" name="no_telp">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="date" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan()
    {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $no_telp = $_POST['no_telp'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];

        $data = array(
            'id' => $id,
            'nama' => $nama,
            'no_telp' => $no_telp,
            'email' => $email,
            'alamat' => $alamat,
        );
        return $this->db->table('pelanggan')->insert($data);
    }
    public function edit($id)
    {
        // get data pelanggan
        $r = $this->db->table('pelanggan')->where("id='$id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=pelanggan" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=pelanggan&act=update_pelanggan">
            <input type="hidden" class="form-control" id="param" name="param" value="' . $r['id'] . '">

            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" id="id" name="id" value="' . $r['id'] . '">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="' . $r['nama'] . '">
            </div>
            <div class="mb-3">
                <label for="no_telp" class="form-label">No. Telp</label>
                <input type="text" class="form-control" id="no_telp" name="no_telp" value="' . $r['no_telp'] . '">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="' . $r['email'] . '">
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="' . $r['alamat'] . '">
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
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $no_telp = $_POST['no_telp'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];

        $data = array(
            'id' => $id,
            'nama' => $nama,
            'no_telp' => $no_telp,
            'email' => $email,
            'alamat' => $alamat,
        );
        return $this->db->table('pelanggan')->where("id='$param'")->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('pelanggan')->where("id='$id'")->delete();
    }
}
