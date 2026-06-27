<?php $__env->startSection('title', 'Data Mahasiswa'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-between mb-4 flex-wrap gap-2">
    <div>
        <h1 class="text-lg font-bold text-gray-700">Data Mahasiswa</h1>
        <p class="text-gray-500 text-xs mt-1">Kelola data mahasiswa.</p>
    </div>
    <a href="<?php echo e(route('admin.mahasiswa.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5">
        + Tambah Mahasiswa
    </a>
</div>

<div class="bg-white border border-gray-300 p-3 mb-4">
    <form method="GET" class="flex flex-wrap gap-2">
        <input type="text" name="search" value="<?php echo e($search); ?>" placeholder="Cari NPM atau nama mahasiswa..."
            class="flex-1 min-w-[180px] px-3 py-1.5 border border-gray-300 text-sm focus:outline-none focus:border-blue-500">
        <select name="nidn" class="px-3 py-1.5 border border-gray-300 text-sm">
            <option value="">-- Semua Dosen Wali --</option>
            <?php $__currentLoopData = $dosenList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($d->nidn); ?>" <?php echo e($nidnFilter == $d->nidn ? 'selected' : ''); ?>><?php echo e($d->nama); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <button type="submit" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-700 text-sm px-3 py-1.5">
            Filter
        </button>
        <?php if($search || $nidnFilter): ?>
            <a href="<?php echo e(route('admin.mahasiswa.index')); ?>" class="text-gray-500 text-sm px-3 py-1.5">Reset</a>
        <?php endif; ?>
    </form>
</div>

<div class="bg-white border border-gray-300 overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-300">
            <tr>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">NPM</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Nama Mahasiswa</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Dosen Wali</th>
                <th class="text-right px-4 py-2 font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 font-mono text-gray-700"><?php echo e($m->npm); ?></td>
                    <td class="px-4 py-2 text-gray-800"><?php echo e($m->nama); ?></td>
                    <td class="px-4 py-2 text-gray-600"><?php echo e($m->dosen->nama ?? '-'); ?></td>
                    <td class="px-4 py-2 text-right space-x-2 whitespace-nowrap">
                        <a href="<?php echo e(route('admin.mahasiswa.show', $m->npm)); ?>" class="text-gray-500 hover:underline text-xs">Lihat</a>
                        <a href="<?php echo e(route('admin.mahasiswa.edit', $m->npm)); ?>" class="text-blue-600 hover:underline text-xs">Edit</a>
                        <form action="<?php echo e(route('admin.mahasiswa.destroy', $m->npm)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus mahasiswa <?php echo e($m->nama); ?>? Akun login terkait juga akan terhapus.')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:underline text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="4" class="px-4 py-6 text-center text-gray-400">Tidak ada data mahasiswa ditemukan.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-4">
    <?php echo e($mahasiswa->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dik\Documents\Tubes-Siakad-ifc2024-5520124066-AhmadHandikaAkbar\resources\views/admin/mahasiswa/index.blade.php ENDPATH**/ ?>