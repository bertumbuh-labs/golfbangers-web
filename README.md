# GolfBangers Web

Website live score golf (PWA) untuk Ciputra Golf Surabaya.

- Live site: https://golfbangers.com  
- Repo: https://github.com/bertumbuh-labs/golfbangers-web  

Panduan di bawah ini ditulis untuk orang yang **belum terbiasa dengan Git**. Ikuti dari atas ke bawah, satu langkah pada satu waktu.

---

## Apa yang terjadi kalau kamu mengubah kode?

Alur singkat:

1. Kamu mengubah file di komputer (atau di GitHub).
2. Kamu **simpan perubahan** (disebut *commit*).
3. Kamu **kirim ke GitHub** (disebut *push*) ke cabang `main`.
4. GitHub otomatis meng-update server production.
5. Beberapa detik/menit kemudian, perubahan muncul di https://golfbangers.com

Kamu **tidak perlu** login ke server VPS untuk mengedit website sehari-hari.

---

## Hal penting sebelum mulai

| Aturan | Penjelasan |
|--------|------------|
| Hanya pakai cabang `main` | Jangan buat cabang lain kecuali diminta admin. |
| Jangan edit / commit `config.php` | File password database. Sudah disembunyikan dari Git. |
| Jangan hapus file secara acak | Kalau ragu, tanya dulu. |
| Satu orang, satu perubahan besar | Selesaikan push-mu dulu sebelum orang lain push yang besar, supaya jarang bentrok. |

---

## Persiapan (sekali saja)

### 1. Buat / siapkan akun GitHub

1. Buka https://github.com  
2. Login (atau daftar).  
3. Pastikan email GitHub kamu sudah **verified** (Settings → Emails).

### 2. Minta akses write ke repo

Repo ini **public** (siapa saja bisa lihat), tapi untuk **mengirim perubahan** kamu perlu diundang sebagai collaborator / member.

Minta admin org `bertumbuh-labs` menambahkan akun GitHub kamu ke repo  
`bertumbuh-labs/golfbangers-web` dengan permission **Write**.

Tanpa akses Write, kamu hanya bisa melihat kode, tidak bisa push langsung.

### 3. Install GitHub Desktop (disarankan untuk pemula)

Ini cara paling mudah (klik-klik, bukan ketik perintah).

1. Download: https://desktop.github.com  
2. Install, lalu login dengan akun GitHub kamu.  
3. Selesai.

> Alternatif untuk yang sudah nyaman: pakai VS Code / Cursor + Git, atau command line. Di bagian akhir ada ringkasan perintah.

### 4. (Opsional) Install editor ber-AI

Kalau mau dibantu AI menulis/mengubah kode, pilih salah satu:

| Aplikasi | Catatan |
|----------|---------|
| [Cursor](https://cursor.com) | Editor mirip VS Code + AI chat/agent |
| [Trae](https://www.trae.ai) | Editor ber-AI (mirip alur Cursor) |
| VS Code + Copilot / ChatGPT | Bisa, tapi alurnya mirip: buka folder project → chat → review |

Setelah install: **File → Open Folder** → pilih folder hasil clone `golfbangers-web`.

---

## Pakai AI (Cursor / Trae / IDE lain) — panduan pemula

AI bisa membantu mengubah teks, CSS, layout, atau memperbaiki bug. Tapi **kamu tetap bertanggung jawab** mengecek hasilnya sebelum push.

### Aturan wajib saat minta bantuan AI

1. **Pull dulu** (ambil update terbaru) sebelum minta AI mengedit.  
2. Minta AI mengubah **satu hal jelas** per permintaan (jangan “perbaiki semua”).  
3. **Jangan** minta AI mengubah / commit `config.php` (password database).  
4. **Jangan** minta AI force push, hapus history Git, atau hapus folder `.git`.  
5. Setelah AI selesai: cek file yang berubah → coba buka di browser kalau bisa → baru commit & push.  
6. Kalau AI menawarkan commit/push otomatis: boleh, asal pesan commit jelas dan hanya file yang relevan.

### Cara singkat di Cursor / Trae

1. Buka folder project `golfbangers-web`.  
2. Pastikan sudah sync dengan GitHub (`git pull` / tombol Pull).  
3. Buka **Chat / Agent**.  
4. **Copy-paste salah satu prompt** di bawah (ganti bagian dalam `[...]`).  
5. Tunggu AI selesai, baca ringkasan perubahannya.  
6. Commit & push (lewat Git di sidebar IDE, atau GitHub Desktop).  
7. Cek https://github.com/bertumbuh-labs/golfbangers-web/actions sampai hijau, lalu cek https://golfbangers.com

### Prompt siap pakai (copy-paste)

**A. Ubah teks / label di halaman**

```text
Kamu sedang mengerjakan repo GolfBangers Web (PHP + PWA).
Cabang yang dipakai hanya `main`. Jangan ubah config.php.
Jangan commit file rahasia (config.php, apk, zip).

Tugas: ubah teks berikut di file yang relevan:
- Dari: "[teks lama]"
- Menjadi: "[teks baru]"

Setelah selesai: ringkas file apa saja yang diubah.
Kalau saya minta, bantu commit dengan pesan singkat dalam Bahasa Indonesia, lalu push ke origin main.
```

**B. Ubah tampilan (warna / ukuran / mobile)**

```text
Kamu sedang mengerjakan GolfBangers Web (live score golf, PHP).
Hanya kerjakan permintaan ini, jangan refactor besar-besaran.
Jangan sentuh config.php dan jangan ubah password di api.php kecuali saya minta eksplisit.

Tugas: [contoh: buat tombol "Install App" lebih besar di HP / ubah warna header jadi lebih gelap]
File yang mungkin relevan: index.php, game.php, atau CSS di dalamnya.

Pertahankan gaya desain yang sudah ada. Setelah selesai jelaskan perubahanmu singkat.
```

**C. Perbaiki bug**

```text
Ini project GolfBangers Web. Jelaskan dulu penyebabnya singkat, lalu perbaiki dengan perubahan seminimal mungkin.
Jangan ubah config.php. Jangan rewrite history Git.

Masalah yang saya alami:
- Halaman: [index.php / game.php / download / ...]
- Yang terjadi: [tulis gejala]
- Yang diharapkan: [tulis yang seharusnya]

Kalau perlu, tanya saya 1–2 pertanyaan klarifikasi sebelum mengedit.
```

**D. Prompt “aman” di awal chat (tempel sekali tiap sesi baru)**

```text
Konteks project: GolfBangers Web — https://github.com/bertumbuh-labs/golfbangers-web
Stack: PHP 8.1, MySQL, PWA. Production di-deploy otomatis saat push ke branch main.

Aturan untukmu:
1. Hanya branch main.
2. Jangan edit atau commit config.php / online/config.php.
3. Jangan force push, jangan git reset --hard, jangan hapus .git.
4. Perubahan kecil dan fokus; jangan refactor tanpa diminta.
5. Setelah edit, sebutkan daftar file yang berubah.
6. Commit/push hanya jika saya minta, dengan pesan commit yang jelas (Bahasa Indonesia boleh).
```

### Tips biar hasil AI bagus

- Sebutkan **nama file** kalau sudah tahu (`index.php`, `game.php`, dll.).  
- Lampirkan **screenshot** atau quote error kalau ada.  
- Kalau hasil AI salah: bilang “batalkan perubahan itu” / “revert file X”, jangan langsung push.  
- Satu fitur = satu commit lebih aman daripada 20 perubahan sekaligus.

---

## Cara kerja sehari-hari (GitHub Desktop)

### Langkah A — Clone repo (ambil salinan ke komputer)

Hanya dilakukan **pertama kali**.

1. Buka GitHub Desktop.  
2. File → Clone Repository → tab **URL**.  
3. Paste:

   ```text
   https://github.com/bertumbuh-labs/golfbangers-web.git
   ```

4. Pilih folder di komputermu (misalnya `Documents/Projects`).  
5. Klik **Clone**.  

Sekarang kamu punya folder project lokal.

### Langkah B — Selalu ambil update terbaru dulu

Sebelum mengedit, ambil dulu perubahan orang lain:

1. Buka GitHub Desktop.  
2. Pastikan repo **golfbangers-web** yang aktif.  
3. Klik **Fetch origin**.  
4. Jika muncul tombol **Pull origin**, klik itu.  

Ini penting supaya filemu tidak bentrok dengan orang lain.

### Langkah C — Edit file

1. Buka folder project dengan editor (Notepad++, VS Code, Cursor, dll.).  
2. Edit file yang diperlukan, contoh:
   - `index.php` — halaman utama  
   - `game.php` — halaman score  
   - `api.php` — logika server / password monitor  
3. **Jangan** buat / ubah `config.php` untuk di-commit.  
   (Kalau perlu contoh setting, lihat `config.sample.php` saja.)

### Langkah D — Commit (simpan catatan perubahan)

1. Kembali ke GitHub Desktop.  
2. Di kiri, akan muncul daftar file yang berubah.  
3. Centang file yang memang ingin dikirim.  
4. Di kolom **Summary** (bawah kiri), tulis pesan singkat, contoh:
   - `Perbaiki teks tombol Install App`
   - `Ubah warna header di game.php`
5. Klik **Commit to main**.

Pesan commit sebaiknya menjelaskan **apa yang diubah**, bukan hanya “update”.

### Langkah E — Push (kirim ke GitHub + deploy otomatis)

1. Klik **Push origin**.  
2. Tunggu sampai selesai (tidak error).  
3. Buka: https://github.com/bertumbuh-labs/golfbangers-web/actions  
4. Pastikan workflow **Deploy** berwarna hijau (sukses).  
5. Cek website: https://golfbangers.com  

Kalau Actions merah (gagal), **jangan panik** — hubungi admin / orang yang manage server. Jangan coba “memperbaiki” dengan menghapus history Git.

---

## Cara edit kecil langsung di GitHub (tanpa install apa pun)

Cocok untuk ubah teks singkat / satu file saja.

1. Buka https://github.com/bertumbuh-labs/golfbangers-web  
2. Masuk ke file yang mau diubah (klik nama file).  
3. Klik ikon pensil (**Edit this file**).  
4. Ubah isinya.  
5. Scroll ke bawah → isi pesan commit singkat.  
6. Pilih **Commit directly to the `main` branch**.  
7. Klik **Commit changes**.  

Deploy otomatis tetap jalan setelah commit ke `main`.

> Untuk ubah banyak file sekaligus, lebih aman pakai GitHub Desktop.

---

## Checklist sebelum push

- [ ] Sudah **Fetch / Pull** dulu?  
- [ ] Hanya file yang relevan yang di-commit?  
- [ ] Tidak ada `config.php` di daftar commit?  
- [ ] Pesan commit sudah jelas?  
- [ ] Setelah push, cek **Actions** hijau dan website sudah berubah?

---

## File yang tidak boleh di-commit

Sudah diatur di `.gitignore`. Jangan memaksa menambahkannya.

| File / folder | Alasan |
|---------------|--------|
| `config.php` | Password database |
| `online/config.php` | Password database |
| `*.apk`, `*.zip` | File besar / bukan kode sumber |
| `AppIconsv2/` | Paket ikon besar (runtime pakai folder `icons/`) |

Kalau GitHub Desktop menawarkan file di atas, **jangan dicentang**.

---

## Kalau ada konflik (file bentrok)

Artinya kamu dan orang lain mengubah bagian yang sama.

Yang harus dilakukan pemula:

1. **Stop.** Jangan tekan “Overwrite” / force push.  
2. Klik **Pull** / ambil update.  
3. Kalau muncul konflik, minta bantuan orang yang lebih paham Git.  
4. Jangan hapus folder `.git`.

---

## Setup lokal (opsional — untuk coba di komputer sendiri)

Hanya jika kamu ingin menjalankan website di laptop (butuh PHP + MySQL).

1. Copy config:

   ```bash
   cp config.sample.php config.php
   cp online/config.sample.php online/config.php
   ```

2. Isi data MySQL di kedua `config.php`.  
3. Import `online/schema.sql` ke database.  
4. Arahkan web root ke folder project ini.

Untuk hanya mengubah tampilan/teks di production, **setup lokal tidak wajib** — cukup edit → commit → push ke `main`.

---

## Ringkasan perintah (untuk yang pakai terminal)

```bash
# Clone (sekali)
git clone https://github.com/bertumbuh-labs/golfbangers-web.git
cd golfbangers-web

# Sebelum edit: ambil update
git pull origin main

# Setelah edit
git status
git add .
git commit -m "Jelaskan perubahanmu di sini"
git push origin main
```

Pastikan dulu identitas Git di komputermu:

```bash
git config --global user.name "NamaKamu"
git config --global user.email "email_yang_sama_dengan_github@example.com"
```

Email sebaiknya sama dengan email terverifikasi di GitHub, supaya commit terhubung ke akunmu.

---

## Bantuan cepat (troubleshooting)

| Masalah | Apa artinya | Apa yang dilakukan |
|---------|-------------|--------------------|
| Tidak bisa push / Permission denied | Belum punya akses Write | Minta admin undang akunmu |
| Push ditolak (*rejected*) | Ada update di GitHub yang belum kamu ambil | `Fetch` lalu `Pull`, baru `Push` lagi |
| Actions merah | Deploy gagal | Hubungi admin server, jangan rewrite history |
| Website belum berubah | Cache atau deploy belum selesai | Tunggu 1–2 menit, hard refresh (Ctrl+F5), cek Actions |
| File `config.php` tidak ada di GitHub | Normal | File itu sengaja tidak di-upload (rahasia) |

---

## Stack teknis (referensi)

- PHP 8.1 + MySQL  
- Nginx di VPS  
- PWA: `manifest.webmanifest`, `sw.js`, folder `icons/`  
- Deploy otomatis: `.github/workflows/deploy.yml` (push ke `main`)

---

## Kontak

Kalau stuck di langkah mana pun: tanya admin repo / orang yang manage VPS **sebelum** mencoba perintah “bahaya” (force push, reset keras, hapus `.git`, dll.).
