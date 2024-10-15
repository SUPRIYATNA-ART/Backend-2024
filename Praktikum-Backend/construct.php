<?php

class Person {
    public $nama;
    public $alamat;
    public $jurusan;

    // Constructor untuk menginisialisasi properti
    public function __construct($nama, $alamat, $jurusan) {
        $this->nama = $nama;
        $this->alamat = $alamat;
        $this->jurusan = $jurusan;
    }

    // Metode cetak yang mencetak properti objek secara dinamis
    public function cetak() {
        echo "Nama: " . $this->nama . "<br>";
        echo "Alamat: " . $this->alamat . "<br>";
        echo "Jurusan: " . $this->jurusan . "<br>";
    }
}

// Membuat objek Person
$supri = new Person('Supri', 'Bogor', 'TI');
$pri = new Person('Pri', 'Bandung', 'TI');

// Memanggil metode cetak
$supri->cetak();
echo "<br>"; // Line break antara dua output
$pri->cetak();

?>
