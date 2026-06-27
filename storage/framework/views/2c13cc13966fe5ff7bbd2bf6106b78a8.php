<?php $__env->startSection('title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-5">
    <h1 class="text-lg font-bold text-gray-700">Dashboard Admin</h1>
    <p class="text-gray-500 text-xs mt-1">Ringkasan statistik Sistem Informasi Akademik.</p>
</div>

<!-- Stat Cards -->
<div class="grid grid-cols-2 md:grid-cols-5 gap-3 mb-6">
    <div class="bg-white border border-gray-300 p-4">
        <p class="text-xl font-bold text-gray-800"><?php echo e($totalDosen); ?></p>
        <p class="text-xs text-gray-500">Dosen</p>
    </div>
    <div class="bg-white border border-gray-300 p-4">
        <p class="text-xl font-bold text-gray-800"><?php echo e($totalMahasiswa); ?></p>
        <p class="text-xs text-gray-500">Mahasiswa</p>
    </div>
    <div class="bg-white border border-gray-300 p-4">
        <p class="text-xl font-bold text-gray-800"><?php echo e($totalMatakuliah); ?></p>
        <p class="text-xs text-gray-500">Mata Kuliah</p>
    </div>
    <div class="bg-white border border-gray-300 p-4">
        <p class="text-xl font-bold text-gray-800"><?php echo e($totalJadwal); ?></p>
        <p class="text-xs text-gray-500">Jadwal</p>
    </div>
    <div class="bg-white border border-gray-300 p-4">
        <p class="text-xl font-bold text-gray-800"><?php echo e($totalKrs); ?></p>
        <p class="text-xs text-gray-500">Total KRS</p>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-4 mb-4">
    <!-- Mata kuliah terpopuler -->
    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Mata Kuliah Terpopuler</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                <?php $__empty_1 = true; $__currentLoopData = $matakuliahTerpopuler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-4 py-2">
                            <p class="text-gray-700"><?php echo e($mk->nama_matakuliah); ?></p>
                            <p class="text-xs text-gray-400"><?php echo e($mk->kode_matakuliah); ?> - <?php echo e($mk->sks); ?> SKS</p>
                        </td>
                        <td class="px-4 py-2 text-right text-gray-600"><?php echo e($mk->krs_count); ?> mhs</td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td class="px-4 py-3 text-gray-400">Belum ada data KRS.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Dosen bimbingan terbanyak -->
    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Dosen dengan Bimbingan Terbanyak</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                <?php $__empty_1 = true; $__currentLoopData = $dosenBimbinganTerbanyak; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-4 py-2">
                            <p class="text-gray-700"><?php echo e($d->nama); ?></p>
                            <p class="text-xs text-gray-400">NIDN: <?php echo e($d->nidn); ?></p>
                        </td>
                        <td class="px-4 py-2 text-right text-gray-600"><?php echo e($d->mahasiswa_count); ?> mhs</td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td class="px-4 py-3 text-gray-400">Belum ada data.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-4">
    <!-- Distribusi jadwal per hari -->
    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Distribusi Jadwal per Hari</h2>
        </div>
        <div class="p-4 space-y-2">
            <?php $maxTotal = $jadwalPerHari->max('total') ?: 1; ?>
            <?php $__empty_1 = true; $__currentLoopData = $jadwalPerHari; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="flex items-center gap-2">
                    <span class="w-14 text-xs text-gray-500"><?php echo e($jh->hari); ?></span>
                    <div class="flex-1 bg-gray-100 h-2.5">
                        <div class="bg-blue-600 h-2.5" style="width: <?php echo e(($jh->total / $maxTotal) * 100); ?>%"></div>
                    </div>
                    <span class="text-xs text-gray-600 w-5 text-right"><?php echo e($jh->total); ?></span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-sm text-gray-400">Belum ada data jadwal.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Info tambahan -->
    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Statistik Lainnya</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <td class="px-4 py-2 text-gray-600">Rata-rata SKS diambil per mahasiswa</td>
                    <td class="px-4 py-2 text-right font-medium text-gray-800"><?php echo e(number_format($rataRataSks ?? 0, 1)); ?></td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-600">Rasio mahasiswa per dosen</td>
                    <td class="px-4 py-2 text-right font-medium text-gray-800"><?php echo e($totalDosen > 0 ? number_format($totalMahasiswa / $totalDosen, 1) : 0); ?> : 1</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-600">Rata-rata jadwal per mata kuliah</td>
                    <td class="px-4 py-2 text-right font-medium text-gray-800"><?php echo e($totalMatakuliah > 0 ? number_format($totalJadwal / $totalMatakuliah, 1) : 0); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dik\Documents\Tubes-Siakad-ifc2024-5520124066-AhmadHandikaAkbar\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>