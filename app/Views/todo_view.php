<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Squad - To-Do List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        .container { max-width: 850px; }
        .header-card { 
            background: linear-gradient(135deg, #0d6efd, #003d99); 
            color: white; 
            border-radius: 15px; 
            padding: 2.5rem; 
            margin-bottom: 2rem; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
        }
        .header-logo {
            width: 70px;
            height: auto;
            margin-right: 20px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
            object-fit: contain;
        }
        .task-item { border: none; border-radius: 12px; transition: 0.3s; border-left: 6px solid #0d6efd; margin-bottom: 1rem; background: #fff; }
        .task-item:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(0,0,0,0.08); }
        .completed { border-left-color: #198754; opacity: 0.6; background-color: #f8f9fa; }
        .completed h5 { text-decoration: line-through; color: #6c757d; }
        
        /* Member Card Style (Rapi & Minimalis) */
        .member-card { 
            text-align: center; 
            padding: 15px; 
            border-radius: 12px; 
            background: #ffffff; 
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        .member-card:hover {
            border-color: #0d6efd;
            background: #f8fbff;
        }
        .member-name {
            font-size: 0.95rem;
            font-weight: 600;
            color: #333;
            line-height: 1.4;
            margin-bottom: 0;
        }
        .footer-section { background: #fff; border-radius: 15px; padding: 2.5rem; margin-top: 3rem; box-shadow: 0 -2px 10px rgba(0,0,0,0.05); }
        .section-title {
            font-size: 1.1rem;
            letter-spacing: 1px;
            color: #555;
            margin-bottom: 2rem;
            position: relative;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <!-- Header dengan Logo Kampus -->
    <div class="header-card text-center d-flex flex-column align-items-center justify-content-center">
        <div class="d-flex align-items-center mb-2 flex-wrap justify-content-center">
            <!-- Silakan ganti 'path/to/logo-kampus.png' dengan URL atau path file logo kampus Anda -->
            <img src="<?= base_url('logo_amik.jpg') ?>" alt="Logo Kampus" class="header-logo" onerror="this.src='https://via.placeholder.com/70?text=Logo'">
            <h1 class="fw-bold display-6 mb-0">Elite Squad To-Do List</h1>
        </div>
        <p class="mb-0 opacity-75">Sistem Informasi Berbasis Web untuk Produktivitas Harian</p>
    </div>

    <!-- Modal Pop-up Notifikasi -->
    <?php $successMsg = session()->getFlashdata('success'); $errorMsg = session()->getFlashdata('error'); ?>
    <?php if ($successMsg || $errorMsg) : ?>
    <div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-body text-center py-5">
                    <div class="mb-3">
                        <span class="display-1"><?= $successMsg ? '✅' : '❌' ?></span>
                    </div>
                    <h4 class="fw-bold mb-3"><?= $successMsg ? 'Berhasil!' : 'Gagal!' ?></h4>
                    <p class="text-muted fs-5"><?= $successMsg ?: $errorMsg ?></p>
                    <button type="button" class="btn btn-primary px-5 mt-3 fw-bold" data-bs-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Form Input (Create) -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold text-primary mb-3">Buat Tugas Baru</h5>
            <form action="/todo/create" method="POST">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Judul Tugas</label>
                        <input type="text" name="title" class="form-control" placeholder="Contoh: Belajar PHP" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Deskripsi</label>
                        <input type="text" name="description" class="form-control" placeholder="Tambahkan rincian...">
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary px-4 fw-bold">Simpan Tugas</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="row mb-4 g-2">
        <div class="col-md-7">
            <div class="btn-group w-100 shadow-sm">
                <a href="/" class="btn btn-primary <?= !$current_status ? '' : 'btn-light' ?>">Semua</a>
                <a href="/?status=pending" class="btn <?= $current_status == 'pending' ? 'btn-primary' : 'btn-light' ?>">Aktif</a>
                <a href="/?status=completed" class="btn <?= $current_status == 'completed' ? 'btn-primary' : 'btn-light' ?>">Selesai</a>
            </div>
        </div>
        <div class="col-md-5">
            <form action="/" method="GET" class="d-flex shadow-sm">
                <input type="text" name="search" class="form-control rounded-start" placeholder="Cari kata kunci..." value="<?= esc($current_search) ?>">
                <button type="submit" class="btn btn-dark px-3 rounded-end">Cari</button>
            </form>
        </div>
    </div>

    <!-- Task List -->
    <div class="list-group">
        <?php if (empty($tasks)) : ?>
            <div class="text-center py-5 opacity-50 bg-white rounded-3 border">
                <h5>Belum ada tugas dalam daftar ini.</h5>
            </div>
        <?php endif; ?>

        <?php foreach ($tasks as $task) : ?>
            <div class="card task-item shadow-sm <?= $task['status'] == 'completed' ? 'completed' : '' ?>">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1 fw-bold"><?= esc($task['title']) ?></h5>
                        <p class="mb-0 small text-muted"><?= esc($task['description']) ?></p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="/todo/updateStatus/<?= $task['id'] ?>/<?= $task['status'] == 'pending' ? 'completed' : 'pending' ?>" 
                           class="btn btn-sm <?= $task['status'] == 'pending' ? 'btn-success' : 'btn-warning' ?> px-3 fw-bold">
                            <?= $task['status'] == 'pending' ? 'Selesai' : 'Batal' ?>
                        </a>
                        <a href="/todo/delete/<?= $task['id'] ?>" class="btn btn-sm btn-danger px-3 fw-bold" onclick="return confirm('Hapus permanen?')">Hapus</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Footer Identity (Anggota Kelompok - Layout 3-3) -->
    <div class="footer-section shadow-sm border mt-5">
        <div class="text-center mb-4">
            <h5 class="section-title fw-bold text-uppercase">Anggota Kelompok Elite Squad</h5>
        </div>
        
        <!-- Baris 1: 3 Orang -->
        <div class="row g-3 justify-content-center mb-3">
            <div class="col-6 col-md-4">
                <div class="member-card shadow-sm">
                    <p class="member-name">Mira Dila Syafitri Gurning</p>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="member-card shadow-sm">
                    <p class="member-name">Sun Angel Febyani</p>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="member-card shadow-sm">
                    <p class="member-name">Farrel Diva Eliasar</p>
                </div>
            </div>
        </div>

        <!-- Baris 2: 3 Orang -->
        <div class="row g-3 justify-content-center">
            <div class="col-6 col-md-4">
                <div class="member-card shadow-sm">
                    <p class="member-name">Jonatan Hose Sihombing</p>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="member-card shadow-sm">
                    <p class="member-name">Wira Astika Sihite</p>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="member-card shadow-sm">
                    <p class="member-name">Putri Sonaria Damanik</p>
                </div>
            </div>
        </div>

        <hr class="my-5 opacity-25">
        <div class="text-center text-muted small">
            <p class="mb-1">Prodi Manajemen Informatika - AMIK Universal</p>
            <p class="fw-bold text-primary mb-0">Dosen Pengampu: Kornelius Sitepu., M.Kom</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var modalEl = document.getElementById('statusModal');
        if (modalEl) {
            var myModal = new bootstrap.Modal(modalEl);
            myModal.show();
        }
    });
</script>
</body>
</html>