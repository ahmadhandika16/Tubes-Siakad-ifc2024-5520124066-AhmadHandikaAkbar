<?php $__env->startSection('title', 'Dashboard Mahasiswa'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-5">
    <h1 class="text-lg font-bold text-gray-700">Selamat datang, <?php echo e($mahasiswa->nama); ?></h1>
    <p class="text-gray-500 text-xs mt-1">NPM: <?php echo e($mahasiswa->npm); ?> - Dosen Wali: <?php echo e($mahasiswa->dosen->nama ?? '-'); ?></p>
</div>

<div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-6">
    <div class="bg-white border border-gray-300 p-4">
        <p class="text-xl font-bold text-gray-800"><?php echo e($totalMatakuliah); ?></p>
        <p class="text-xs text-gray-500">Mata Kuliah Diambil</p>
    </div>
    <div class="bg-white border border-gray-300 p-4">
        <p class="text-xl font-bold text-gray-800"><?php echo e($totalSks); ?></p>
        <p class="text-xs text-gray-500">Total SKS Semester Ini</p>
    </div>
    <div class="bg-white border border-gray-300 p-4">
        <p class="text-sm font-bold text-gray-800 truncate"><?php echo e($mahasiswa->dosen->nama ?? '-'); ?></p>
        <p class="text-xs text-gray-500">Dosen Wali</p>
    </div>
</div>

<div class="bg-white border border-gray-300">
    <div class="px-4 py-2 border-b border-gray-300 bg-gray-50 flex items-center justify-between">
        <h2 class="font-semibold text-gray-700 text-sm">Kartu Rencana Studi (KRS) Saat Ini</h2>
        <a href="<?php echo e(route('mahasiswa.krs.index')); ?>" class="text-blue-600 hover:underline text-xs">Kelola KRS &rarr;</a>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Kode</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Mata Kuliah</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">SKS</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $mahasiswa->krs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="px-4 py-2 font-mono text-gray-600"><?php echo e($k->kode_matakuliah); ?></td>
                    <td class="px-4 py-2 text-gray-700"><?php echo e($k->matakuliah->nama_matakuliah ?? '-'); ?></td>
                    <td class="px-4 py-2 text-gray-600"><?php echo e($k->matakuliah->sks ?? '-'); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="3" class="px-4 py-6 text-center text-gray-400">Belum ada mata kuliah yang diambil. <a href="<?php echo e(route('mahasiswa.krs.index')); ?>" class="text-blue-600 hover:underline">Ambil sekarang &rarr;</a></td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dik\Documents\Tubes-Siakad-ifc2024-5520124066-AhmadHandikaAkbar\resources\views/mahasiswa/dashboard.blade.php ENDPATH**/ ?>