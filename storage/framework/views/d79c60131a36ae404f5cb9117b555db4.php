<?php $__env->startSection('title', 'Detail Mata Kuliah'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <a href="<?php echo e(route('admin.matakuliah.index')); ?>" class="text-sm text-gray-500 hover:underline">&larr; Kembali ke Data Mata Kuliah</a>
    <h1 class="text-lg font-bold text-gray-700 mt-2"><?php echo e($matakuliah->nama_matakuliah); ?></h1>
    <p class="text-gray-500 text-xs">Kode: <?php echo e($matakuliah->kode_matakuliah); ?> - <?php echo e($matakuliah->sks); ?> SKS</p>
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Jadwal Kelas (<?php echo e($matakuliah->jadwal->count()); ?>)</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                <?php $__empty_1 = true; $__currentLoopData = $matakuliah->jadwal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-4 py-2">
                            <p class="text-gray-700">Kelas <?php echo e($j->kelas); ?> - <?php echo e($j->dosen->nama ?? '-'); ?></p>
                            <p class="text-xs text-gray-400"><?php echo e($j->hari); ?>, <?php echo e(\Carbon\Carbon::parse($j->jam)->format('H:i')); ?></p>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td class="px-4 py-3 text-gray-400">Belum ada jadwal untuk mata kuliah ini.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Mahasiswa Peserta (<?php echo e($matakuliah->mahasiswa->count()); ?>)</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                <?php $__empty_1 = true; $__currentLoopData = $matakuliah->mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mhs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-4 py-2 text-gray-700"><?php echo e($mhs->nama); ?></td>
                        <td class="px-4 py-2 text-right text-gray-400 font-mono text-xs"><?php echo e($mhs->npm); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td class="px-4 py-3 text-gray-400">Belum ada mahasiswa yang mengambil mata kuliah ini.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dik\Documents\Tubes-Siakad-ifc2024-5520124066-AhmadHandikaAkbar\resources\views/admin/matakuliah/show.blade.php ENDPATH**/ ?>