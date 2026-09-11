UPLOAD TEST-LIVE - GOLFBANGERS.COM

1. Di hosting, buat folder:
   public_html/test-live/

2. Upload semua file di folder ini:
   - index.php
   - game.php
   - api.php
   - config.sample.php
   - schema.sql

3. Di hosting, buat MySQL database baru.
   Catat:
   - database name
   - database username
   - database password
   - database host, biasanya localhost

4. Copy config.sample.php menjadi config.php.
   Isi data MySQL.
   Upload juga config.php ke folder test-live.

5. Buka phpMyAdmin.
   Pilih database.
   Import file schema.sql.

6. Buka:
   https://golfbangers.com/test-live/

7. Buat game baru.
   - Admin/Edit link dipakai orang yang input score.
   - View-only link dibagikan ke player lain.
   - Monitor Game Hari Ini bisa dipakai master admin untuk melihat list game aktif.

Catatan:
- Untuk tahap test, admin key ada di link edit. Jangan share link edit ke semua orang.
- View-only auto refresh data dari server.
- Game expired 24 jam dari saat dibuat.
- Viewer password default untuk list monitor adalah 1234.
