<?php $__env->startSection('title', 'Detail Mahasiswa'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <a href="<?php echo e(route('admin.mahasiswa.index')); ?>" class="text-sm text-gray-500 hover:underline">&larr; Kembali ke Data Mahasiswa</a>
    <h1 class="text-lg font-bold text-gray-700 mt-2"><?php echo e($mahasiswa->nama); ?></h1>
    <p class="text-gray-500 text-xs">NPM: <?php echo e($mahasiswa->npm); ?> - Dosen Wali: <?php echo e($mahasiswa->dosen->nama ?? '-'); ?></p>
</div>

<div class="bg-white border border-gray-300">
    <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
        <h2 class="font-semibold text-gray-700 text-sm">Kartu Rencana Studi (KRS)</h2>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Kode</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Mata Kuliah</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">SKS</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Semester</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $mahasiswa->krs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="px-4 py-2 font-mono text-gray-600"><?php echo e($k->kode_matakuliah); ?></td>
                    <td class="px-4 py-2 text-gray-700"><?php echo e($k->matakuliah->nama_matakuliah ?? '-'); ?></td>
                    <td class="px-4 py-2 text-gray-600"><?php echo e($k->matakuliah->sks ?? '-'); ?></td>
                    <td class="px-4 py-2 text-gray-500"><?php echo e($k->semester); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="4" class="px-4 py-6 text-center text-gray-400">Belum ada KRS yang diambil.</td></tr>
            <?php endif; ?>
        </tbody>
        <?php if($mahasiswa->krs->isNotEmpty()): ?>
            <tfoot>
                <tr class="bg-gray-50 font-semibold border-t border-gray-300">
                    <td colspan="2" class="px-4 py-2 text-right text-gray-600">Total SKS</td>
                    <td class="px-4 py-2 text-gray-800"><?php echo e($mahasiswa->krs->sum(fn($k) => $k->matakuliah->sks ?? 0)); ?></td>
                    <td></td>
                </tr>
            </tfoot>
        <?php endif; ?>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dik\Documents\Tubes-Siakad-ifc2024-5520124066-AhmadHandikaAkbar\resources\views/admin/mahasiswa/show.blade.php ENDPATH**/ ?>