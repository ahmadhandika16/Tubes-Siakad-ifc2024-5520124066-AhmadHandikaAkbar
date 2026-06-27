<?php $__env->startSection('title', 'Jadwal Kuliah'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-5">
    <h1 class="text-lg font-bold text-gray-700">Jadwal Kuliah Saya</h1>
    <p class="text-gray-500 text-xs mt-1">Jadwal berdasarkan mata kuliah yang Anda ambil di KRS.</p>
</div>

<?php
    $hariUrut = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    $jadwalPerHari = $jadwal->groupBy('hari');
?>

<div class="grid md:grid-cols-2 gap-4">
    <?php $__empty_1 = true; $__currentLoopData = $hariUrut; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hari): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php if($jadwalPerHari->has($hari)): ?>
            <div class="bg-white border border-gray-300">
                <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
                    <h2 class="font-semibold text-gray-700 text-sm"><?php echo e($hari); ?></h2>
                </div>
                <div class="divide-y divide-gray-100">
                    <?php $__currentLoopData = $jadwalPerHari[$hari]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="px-4 py-3">
                            <div class="flex items-center justify-between">
                                <p class="font-medium text-gray-700 text-sm"><?php echo e($j->matakuliah->nama_matakuliah ?? '-'); ?></p>
                                <span class="text-xs text-blue-700"><?php echo e(\Carbon\Carbon::parse($j->jam)->format('H:i')); ?></span>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Kelas <?php echo e($j->kelas); ?> - <?php echo e($j->dosen->nama ?? '-'); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <?php endif; ?>
</div>

<?php if($jadwal->isEmpty()): ?>
    <div class="bg-white border border-gray-300 p-8 text-center">
        <p class="text-gray-400 text-sm">Belum ada jadwal kuliah. Silakan ambil mata kuliah pada menu KRS terlebih dahulu.</p>
        <a href="<?php echo e(route('mahasiswa.krs.index')); ?>" class="inline-block mt-2 text-blue-600 hover:underline text-sm">Kelola KRS &rarr;</a>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dik\Documents\Tubes-Siakad-ifc2024-5520124066-AhmadHandikaAkbar\resources\views/mahasiswa/jadwal/index.blade.php ENDPATH**/ ?>