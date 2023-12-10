<?php

namespace Master;

use Config\Query_builder;

class Pelaku
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('pelaku')->get()->resultArray();
        $res = '<a href="?target=pelaku&act=tambah_pelaku" class="btn btn-info btn-sm">Tambah pelaku</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Id</th>
                    <th>Nama_Usaha</th>
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
                <td width="10">' . $r['id'] . '</td>
                <td>' . $r['nama_usaha'] . '</td>
                <td>' . $r['email'] . '</td>
                <td width="10">' . $r['alamat'] . '</td>
                <td width="150">
                    <a href="?target=pelaku&act=edit_pelaku&id=' . $r['id'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=pelaku&act=delete_pelaku&id=' . $r['id'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=pelaku" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=pelaku&act=simpan_pelaku">
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" id="id" name="id">
            </div>
            <div class="mb-3">
                <label for="nama_usaha" class="form-label">Nama Usaha</label>
                <input type="text" class="form-control" id="nama_usaha" name="nama_usaha">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email">
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
        $nama_usaha = $_POST['nama_usaha'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];
        $data = array(
            'id' => $id,
            'nama_usaha' => $nama_usaha,
            'email' => $email,
            'alamat' => $alamat,
        );
        return $this->db->table('pelaku')->insert($data);
    }
    public function edit($id)
    {
        // get data pelaku
        $r = $this->db->table('pelaku')->where("Id='$id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=pelaku" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=pelaku&act=update_pelaku">
            <input type="hidden" class="form-control" id="param" name="param" value="' . $r['id'] . '">
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" id="id" name="id" value="' . $r['id'] . '">
            </div>
            <div class="mb-3">
                <label for="nama_usaha" class="form-label">Nama Usaha</label>
                <input type="text" class="form-control" id="nama_usaha" name="nama_usaha" value="' . $r['nama_usaha'] . '">
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
        $nama_usaha = $_POST['nama_usaha'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];

        $data = array(
            'id' => $id,
            'nama_usaha' => $nama_usaha,
            'email' => $email,
            'alamat' => $alamat,
        );
        return $this->db->table('pelaku')->where("Id='$param'")->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('pelaku')->where("Id='$id'")->delete();
    }
}
