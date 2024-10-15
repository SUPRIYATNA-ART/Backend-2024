<?php
class Animal {
    private $animals = [];

    // Constructor untuk menginisialisasi data hewan
    public function __construct($data = []) {
        $this->animals = $data;
    }

    // Menampilkan semua hewan
    public function index() {
        if (empty($this->animals)) {
            echo "Tidak ada hewan.<br>";
        } else {
            foreach ($this->animals as $index => $animal) {
                echo "Hewan ke-{$index}: {$animal} <br>";
            }
        }
    }

    // Menambahkan hewan baru
    public function store($data) {
        $this->animals[] = $data;
        echo "Hewan baru berhasil ditambahkan: {$data} <br>";
    }

    // Mengubah data hewan di index tertentu
    public function update($index, $data) {
        if (isset($this->animals[$index])) {
            $this->animals[$index] = $data;
            echo "Hewan di index {$index} berhasil diubah menjadi {$data} <br>";
        } else {
            echo "Index {$index} tidak ditemukan. <br>";
        }
    }

    // Menghapus hewan di index tertentu
    public function destroy($index) {
        if (isset($this->animals[$index])) {
            unset($this->animals[$index]);
            echo "Hewan di index {$index} berhasil dihapus. <br>";
        } else {
            echo "Index {$index} tidak ditemukan. <br>";
        }
    }
}

// Membuat object Animal dengan data awal
$animal = new Animal(['Ayam', 'Ikan']);

// Menampilkan semua hewan
echo 'Index - Menampilkan semua hewan <br>';
$animal->index();
echo '<br>';

// Menambahkan hewan baru
echo 'Store - Menambahkan hewan baru (burung) <br>';
$animal->store('Burung');
$animal->index();
echo '<br>';

// Memperbarui hewan di index 0
echo 'Update - Mengupdate hewan <br>';
$animal->update(0, 'Kucing Anggora');
$animal->index();
echo '<br>';

// Menghapus hewan di index 1
echo 'Destroy - Menghapus hewan <br>';
$animal->destroy(1);
$animal->index();
echo '<br>';
?>
