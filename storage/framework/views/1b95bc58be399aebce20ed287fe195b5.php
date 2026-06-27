<?php $__env->startSection('title', 'Detail Jadwal'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <a href="<?php echo e(route('admin.jadwal.index')); ?>" class="text-sm text-gray-500 hover:underline">&larr; Kembali ke Jadwal Kuliah</a>
    <h1 class="text-lg font-bold text-gray-700 mt-2"><?php echo e($jadwal->matakuliah->nama_matakuliah ?? '-'); ?></h1>
    <p class="text-gray-500 text-xs">Kelas <?php echo e($jadwal->kelas); ?> - <?php echo e($jadwal->hari); ?>, <?php echo e(\Carbon\Carbon::parse($jadwal->jam)->format('H:i')); ?></p>
</div>

<div class="grid md:grid-cols-2 gap-4 mb-4">
    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Informasi Mata Kuliah</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <td class="px-4 py-2 text-gray-500 w-32">Kode</td>
                    <td class="px-4 py-2 text-gray-800 font-mono"><?php echo e($jadwal->matakuliah->kode_matakuliah ?? '-'); ?></td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-500">Nama</td>
                    <td class="px-4 py-2 text-gray-800"><?php echo e($jadwal->matakuliah->nama_matakuliah ?? '-'); ?></td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-500">SKS</td>
                    <td class="px-4 py-2 text-gray-800"><?php echo e($jadwal->matakuliah->sks ?? '-'); ?></td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-500">Kelas</td>
                    <td class="px-4 py-2 text-gray-800"><?php echo e($jadwal->kelas); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="bg-white border border-gray-300">
        <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
            <h2 class="font-semibold text-gray-700 text-sm">Informasi Pengajaran</h2>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <td class="px-4 py-2 text-gray-500 w-32">Dosen Pengajar</td>
                    <td class="px-4 py-2 text-gray-800"><?php echo e($jadwal->dosen->nama ?? '-'); ?></td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-500">NIDN</td>
                    <td class="px-4 py-2 text-gray-800 font-mono"><?php echo e($jadwal->dosen->nidn ?? '-'); ?></td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-500">Hari</td>
                    <td class="px-4 py-2 text-gray-800"><?php echo e($jadwal->hari); ?></td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-500">Jam</td>
                    <td class="px-4 py-2 text-gray-800"><?php echo e(\Carbon\Carbon::parse($jadwal->jam)->format('H:i')); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="bg-white border border-gray-300">
    <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
        <h2 class="font-semibold text-gray-700 text-sm">Mahasiswa Peserta Kelas Ini (<?php echo e($jadwal->matakuliah->krs->count() ?? 0); ?>)</h2>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">NPM</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Nama Mahasiswa</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $jadwal->matakuliah->krs ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="px-4 py-2 font-mono text-gray-700"><?php echo e($k->mahasiswa->npm ?? $k->npm); ?></td>
                    <td class="px-4 py-2 text-gray-700"><?php echo e($k->mahasiswa->nama ?? '-'); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="2" class="px-4 py-4 text-center text-gray-400">Belum ada mahasiswa yang mengambil mata kuliah ini.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-4 flex gap-2">
    <a href="<?php echo e(route('admin.jadwal.edit', $jadwal->id)); ?>" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5">
        Edit
    </a>
    <form action="<?php echo e(route('admin.jadwal.destroy', $jadwal->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1.5">Hapus</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dik\Documents\Tubes-Siakad-ifc2024-5520124066-AhmadHandikaAkbar\resources\views/admin/jadwal/show.blade.php ENDPATH**/ ?>