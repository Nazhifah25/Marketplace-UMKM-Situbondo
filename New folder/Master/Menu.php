<?php

namespace Master;

class Menu
{
    public function topMenu()
    {
        $base = "http://localhost/uts/index.php?target=";
        $data = [
            array('Text' => 'Home', 'Link' => $base . 'home'),
            array('Text' => 'Pelaku UMKM', 'Link' => $base . 'pegawai'),
            array('Text' => 'Pelanggan', 'Link' => $base . 'pengunjung'),
            array('Text' => 'Produk', 'Link' => $base . 'profil'),
        ];
        return $data;
    }
}
