<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class increment{
    function autonumber($id_terakhir, $panjang_kode, $panjang_angka) {
 
        // mengambil nilai kode ex: KNS0015 hasil KNS
        $kode = substr($id_terakhir, 0, $panjang_kode);
     
        // mengambil nilai angka
        // ex: KNS0015 hasilnya 0015
        $angka = substr($id_terakhir, $panjang_kode, $panjang_angka);
     
        // menambahkan nilai angka dengan 1
        // kemudian memberikan string 0 agar panjang string angka menjadi 4
        // ex: angka baru = 6 maka ditambahkan strig 0 tiga kali
        // sehingga menjadi 0006
        $angka_baru = str_repeat("0", $panjang_angka - strlen($angka+1)).($angka+1);
     
        // menggabungkan kode dengan nilang angka baru
        $id_baru = $kode.$angka_baru;
     
        return $id_baru;
    }
}