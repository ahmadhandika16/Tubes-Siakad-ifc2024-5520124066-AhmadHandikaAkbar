<?php $__env->startSection('title', 'Detail Dosen'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <a href="<?php echo e(route('admin.dosen.index')); ?>" class="text-sm text-gray-500 hover:underline">&larr; Kembali ke Data Dosen</a>
    <h1 class="text-lg font-bold text-gray-700 mt-2"><?php echo e($dosen->nama); ?></h1>
    <p class="text-gray-500 text-xs">NIDN: <?php echo e($dosen->nidn); ?></p>
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Mahasiswa Bimbingan (<?php echo e($dosen->mahasiswa->count()); ?>)</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                <?php $__empty_1 = true; $__currentLoopData = $dosen->mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mhs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-4 py-2 text-gray-700"><?php echo e($mhs->nama); ?></td>
                        <td class="px-4 py-2 text-right text-gray-400 font-mono text-xs"><?php echo e($mhs->npm); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td class="px-4 py-3 text-gray-400">Belum ada mahasiswa bimbingan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Jadwal Mengajar (<?php echo e($dosen->jadwal->count()); ?>)</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                <?php $__empty_1 = true; $__currentLoopData = $dosen->jadwal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-4 py-2">
                            <p class="text-gray-700"><?php echo e($j->matakuliah->nama_matakuliah ?? '-'); ?></p>
                            <p class="text-xs text-gray-400">Kelas <?php echo e($j->kelas); ?></p>
                        </td>
                        <td class="px-4 py-2 text-right text-gray-500 text-xs"><?php echo e($j->hari); ?>, <?php echo e(\Carbon\Carbon::parse($j->jam)->format('H:i')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td class="px-4 py-3 text-gray-400">Belum ada jadwal mengajar.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dik\Documents\Tubes-Siakad-ifc2024-5520124066-AhmadHandikaAkbar\resources\views/admin/dosen/show.blade.php ENDPATH**/ ?>