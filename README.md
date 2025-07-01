<h1>PustakaVault - Sistem Manajemen Perpustakaan</h1>
<p>PustakaVault adalah aplikasi sistem manajemen perpustakaan berbasis web yang dibangun menggunakan framework Laravel. Aplikasi ini memungkinkan pengguna untuk menjelajahi, meminjam, dan memberikan ulasan pada koleksi buku, sementara admin dapat mengelola seluruh data melalui panel admin yang intuitif.</p>
<br>
<h2>Fitur Utama</h2>
<h3>Fitur untuk Pengguna (Member)</h3>
<ul>
    <li>Autentikasi: Registrasi dan Login pengguna.</li>
    <li>Katalog Buku: Menampilkan semua buku dengan paginasi dan pencarian canggih (berdasarkan judul, penulis, dan kategori).</li>
    <li>Detail Buku Dinamis: Menampilkan detail buku lengkap dalam modal AJAX tanpa reload halaman.</li>
    <li>Sistem Peminjaman: Alur peminjaman lengkap, mulai dari konfirmasi hingga pencatatan riwayat.</li>
    <li>Sistem Pengembalian: Pengguna dapat mengembalikan buku yang telah dipinjam.</li>
    <li>Riwayat Pinjaman: Halaman khusus bagi pengguna untuk melihat riwayat buku yang sedang dan pernah dipinjam.</li>
    <li>Logika Denda: Sistem secara otomatis mendeteksi keterlambatan pengembalian dan menghitung denda.</li>
    <li>Ulasan & Rating: Pengguna dapat memberikan rating (1-5 bintang) dan ulasan pada setiap buku.</li>
    <li>Manajemen Profil: Pengguna dapat mengubah data pribadi dan password mereka.</li>
</ul>
<h3>Fitur untuk Admin</h3>
<ul>
    <li>Panel Admin Aman: Panel admin terpisah yang dibangun dengan Filament, hanya bisa diakses oleh pengguna dengan role 'admin'.</li>
    <li>Dashboard Informatif: Menampilkan kartu statistik (total buku, pengguna, pemijam)</li>
    <li>Manajemen Data (CRUD): Admin dapat mengelola (membuat, melihat, mengedit, menghapus) data Buku, Kategori, dan Pengguna dll</li>
    <li>Monitoring Transaksi: Admin dapat melihat seluruh riwayat peminjaman yang terjadi di sistem.</li>
</ul>
<br>
<h1>Akun Demo</h1>
<h3>Akun Admin</h3>
<ul>
    <li>Email : admin@gmail.com</li>
    <li>Password : 12345</li>
</ul>
<h3>Akun Member</h3>
<ul>
    <li>Email : member@gmail.com</li>
    <li>Password : 12345678</li>
</ul>