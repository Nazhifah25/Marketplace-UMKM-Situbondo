<?php

namespace Master;

class Menu
{
    public function topMenu()
    {
        $base = "http://localhost/Market/index.php?target=";
        $data = [
            array('Text' => 'Home', 'Link' => $base . 'home'),
            array('Text' => 'Pelaku', 'Link' => $base . 'pelaku'),
            array('Text' => 'Pelanggan', 'Link' => $base . 'pelanggan'),
            array('Text' => 'Produk', 'Link' => $base . 'produk'),
        ];
        return $data;
    }
}
