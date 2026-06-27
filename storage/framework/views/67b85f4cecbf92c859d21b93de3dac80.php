<?php $__env->startSection('title', 'Detail KRS'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <a href="<?php echo e(route('admin.krs.index')); ?>" class="text-sm text-gray-500 hover:underline">&larr; Kembali ke Data KRS</a>
    <h1 class="text-lg font-bold text-gray-700 mt-2">Detail KRS</h1>
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Informasi Mahasiswa</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <td class="px-4 py-2 text-gray-500 w-32">NPM</td>
                    <td class="px-4 py-2 text-gray-800 font-mono"><?php echo e($krs->mahasiswa->npm ?? $krs->npm); ?></td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-500">Nama</td>
                    <td class="px-4 py-2 text-gray-800"><?php echo e($krs->mahasiswa->nama ?? '-'); ?></td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-500">Dosen Wali</td>
                    <td class="px-4 py-2 text-gray-800"><?php echo e($krs->mahasiswa->dosen->nama ?? '-'); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Informasi Mata Kuliah</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <td class="px-4 py-2 text-gray-500 w-32">Kode</td>
                    <td class="px-4 py-2 text-gray-800 font-mono"><?php echo e($krs->matakuliah->kode_matakuliah ?? $krs->kode_matakuliah); ?></td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-500">Nama Mata Kuliah</td>
                    <td class="px-4 py-2 text-gray-800"><?php echo e($krs->matakuliah->nama_matakuliah ?? '-'); ?></td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-500">SKS</td>
                    <td class="px-4 py-2 text-gray-800"><?php echo e($krs->matakuliah->sks ?? '-'); ?></td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-500">Semester</td>
                    <td class="px-4 py-2 text-gray-800"><?php echo e($krs->semester); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="bg-white border border-gray-300 mt-4">
    <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
        <h2 class="font-semibold text-gray-700 text-sm">Jadwal Mata Kuliah Ini</h2>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Kelas</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Dosen Pengajar</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Hari</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Jam</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $krs->matakuliah->jadwal ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="px-4 py-2 text-gray-700"><?php echo e($j->kelas); ?></td>
                    <td class="px-4 py-2 text-gray-600"><?php echo e($j->dosen->nama ?? '-'); ?></td>
                    <td class="px-4 py-2 text-gray-600"><?php echo e($j->hari); ?></td>
                    <td class="px-4 py-2 text-gray-600"><?php echo e(\Carbon\Carbon::parse($j->jam)->format('H:i')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="4" class="px-4 py-4 text-center text-gray-400">Belum ada jadwal untuk mata kuliah ini.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-4 flex gap-2">
    <a href="<?php echo e(route('admin.krs.edit', ['krs' => $krs->id])); ?>" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5">
        Edit
    </a>
    <form action="<?php echo e(route('admin.krs.destroy', ['krs' => $krs->id])); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus data KRS ini?')">
        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1.5">Hapus</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dik\Documents\Tubes-Siakad-ifc2024-5520124066-AhmadHandikaAkbar\resources\views/admin/krs/show.blade.php ENDPATH**/ ?>