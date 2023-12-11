<?php

namespace Master;

use Config\Query_builder;

class Produk
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('produk')->get()->resultArray();
        $res = '<a href="?target=produk&act=tambah_produk" class="btn btn-info btn-sm">Tambah produk</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>id</th>
                    <th>Nama_Produk</th>
                    <th>harga</th>
                    <th>item</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                <td width="10">' . $no . '</td>
                <td>' . $r['id'] . '</td>
                <td>' . $r['nama_produk'] . '</td>
                <td>' . $r['harga'] . '</td>
                <td>' . $r['item'] . '</td>
                <td width="150">
                    <a href="?target=produk&act=edit_produk&id=' . $r['id'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=produk&act=delete_produk&id=' . $r['id'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=produk" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=produk&act=simpan">
            <div class="mb-3">
                <label for="id" class="form-label">id</label>
                <input type="text" class="form-control" id="id" name="id">
            </div>
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama_Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">harga</label>
                <input type="text" class="form-control" id="harga" name="harga">
            </div>
            <div class="mb-3">
                <label for="item" class="form-label">item</label>
                <input type="text" class="form-control" id="item" name="item">
            </div>


            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan()
    {
        $id = $_POST['id'];
        $nama_produk = $_POST['nama_produk'];
        $harga = $_POST['harga'];
        $item = $_POST['item'];

        $data = array(
            'id' => $id,
            'nama_produk' => $nama_produk,
            'harga' => $harga,
            'item' => $item,

        );
        return $this->db->table('produk')->insert($data);
    }
    public function edit($id)
    {
        // get data produk
        $r = $this->db->table('produk')->where("produk='$id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=produk" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=produk&act=update_produk">
            <input type="hidden" class="form-control" id="param" name="param" value="' . $r['id'] . '">

            <div class="mb-3">
                <label for="id" class="form-label">id</label>
                <input type="text" class="form-control" id="id" name="id" value="' . $r['id'] . '">
            </div>
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama_Produk</label>
                <input type="text" class="form-control" id="nama_roduk" name="nama_produk" value="' . $r['nama_produk'] . '">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">harga</label>
                <input type="text" class="form-control" id="harga" name="harga" value="' . $r['harga'] . '">
            </div>
            <div class="mb-3">
                <label for="item" class="form-label">item</label>
                <input type="text" class="form-control" id="item" name="item" value="' . $r['item'] . '">
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
        $nama_produk = $_POST['nama_produk'];
        $harga = $_POST['harga'];
        $item = $_POST['item'];

        $data = array(
            'id' => $id,
            'nama_produk' => $nama_produk,
            'harga' => $harga,
            'item' => $item,
        );
        return $this->db->table('produk')->where("id='$param'")->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('produk')->where("id='$id'")->delete();
    }
}
