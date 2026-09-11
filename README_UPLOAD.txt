UPLOAD HOMEPAGE LIVE - GOLFBANGERS.COM

1. Backup dulu file homepage lama di hosting kalau ada.

2. Upload file ini langsung ke:
   domains/golfbangers.com/public_html/

3. File yang perlu di-upload:
   - index.php
   - game.php
   - api.php
   - config.sample.php
   - schema.sql, hanya kalau database belum pernah di-import

4. Kalau config.php sudah ada di folder live/test-live lama, copy config.php itu ke public_html.
   Kalau belum ada, copy config.sample.php menjadi config.php lalu isi data MySQL.

5. Di hosting, buat MySQL database baru jika belum ada.
   Catat:
   - database name
   - database username
   - database password
   - database host, biasanya localhost

6. Copy config.sample.php menjadi config.php.
   Isi data MySQL.
   Upload juga config.php ke public_html.
   Kalau ingin notifikasi email saat game baru dibuat, isi juga:
   'notify_email' => 'email_bapak@example.com',
   'site_url' => 'https://golfbangers.com',

7. Buka phpMyAdmin.
   Pilih database.
   Import file schema.sql jika tabel belum ada.

8. Buka:
   https://golfbangers.com/

9. Buat game baru.
   - Admin/Edit link dipakai orang yang input score.
   - View-only link dibagikan ke player lain.
   - Monitor Game Hari Ini bisa dipakai master admin untuk melihat list game aktif.

Catatan:
- Untuk tahap test, admin key ada di link edit. Jangan share link edit ke semua orang.
- View-only auto refresh data dari server.
- Game expired 24 jam dari saat dibuat.
- Viewer password default untuk list monitor adalah 1234.
