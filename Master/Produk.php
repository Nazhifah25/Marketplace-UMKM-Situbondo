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
                    <th>Id</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Item</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                <td width="10">' . $no . '</td>
                <td>' . $r['Id'] . '</td>
                <td>' . $r['Nama_produk'] . '</td>
                <td>' . $r['Harga'] . '</td>
                <td>' . $r['Item'] . '</td>
                <td width="150">
                    <a href="?target=produk&act=edit_produk&id=' . $r['Id'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=produk&act=delete_produk&id=' . $r['Id'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=produk" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=produk&act=simpan_produk">
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" id="id" name="id">
            </div>
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga">
            </div>
            <div class="mb-3">
                <label for="item" class="form-label">Item</label>
                <input type="text" class="form-control" id="item" name="item">
            </div>


            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan()
    {
        $Id = $_POST['Id'];
        $nama_produk = $_POST['Nama_produk'];
        $harga = $_POST['Harga'];
        $item = $_POST['Item'];

        $data = array(
            'Id' => $Id,
            'Nama_produk' => $Nama_produk,
            'Harga' => $Harga,
            'Item' => $Item,

        );
        return $this->db->table('produk')->insert($data);
    }
    public function edit($id)
    {
        // get data produk
        $r = $this->db->table('produk')->where("produk='$Id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=produk" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=produk&act=update_produk">
            <input type="hidden" class="form-control" id="param" name="param" value="' . $r['Id'] . '">

            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" id="id" name="id" value="' . $r['Id'] . '">
            </div>
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_roduk" name="nama_produk" value="' . $r['Nama_produk'] . '">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">harga</label>
                <input type="text" class="form-control" id="harga" name="harga" value="' . $r['Harga'] . '">
            </div>
            <div class="mb-3">
                <label for="item" class="form-label">item</label>
                <input type="text" class="form-control" id="item" name="item" value="' . $r['Item'] . '">
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
        $Id = $_POST['Id'];
        $Nama_produk = $_POST['Nama_produk'];
        $Harga = $_POST['Harga'];
        $Item = $_POST['Item'];

        $data = array(
            'Id' => $id,
            'Nama_produk' => $Nama_produk,
            'Harga' => $Harga,
            'Item' => $Item,
        );
        return $this->db->table('produk')->where("Id='$param'")->update($data);
    }

    public function delete($Id)
    {
        return $this->db->table('produk')->where("Id='$Id'")->delete();
    }
}
