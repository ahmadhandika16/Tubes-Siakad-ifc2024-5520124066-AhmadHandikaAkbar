<?php $__env->startSection('title', 'Jadwal Kuliah'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-between mb-4 flex-wrap gap-2">
    <div>
        <h1 class="text-lg font-bold text-gray-700">Jadwal Perkuliahan</h1>
        <p class="text-gray-500 text-xs mt-1">Kelola jadwal kuliah: dosen pengajar, hari & jam, dan kelas.</p>
    </div>
    <a href="<?php echo e(route('admin.jadwal.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5">
        + Tambah Jadwal
    </a>
</div>

<div class="bg-white border border-gray-300 p-3 mb-4">
    <form method="GET" class="flex flex-wrap gap-2">
        <input type="text" name="search" value="<?php echo e($search); ?>" placeholder="Cari mata kuliah atau dosen..."
            class="flex-1 min-w-[180px] px-3 py-1.5 border border-gray-300 text-sm focus:outline-none focus:border-blue-500">
        <select name="hari" class="px-3 py-1.5 border border-gray-300 text-sm">
            <option value="">-- Semua Hari --</option>
            <?php $__currentLoopData = $hariList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($h); ?>" <?php echo e($hari == $h ? 'selected' : ''); ?>><?php echo e($h); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <button type="submit" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-700 text-sm px-3 py-1.5">
            Filter
        </button>
        <?php if($search || $hari): ?>
            <a href="<?php echo e(route('admin.jadwal.index')); ?>" class="text-gray-500 text-sm px-3 py-1.5">Reset</a>
        <?php endif; ?>
    </form>
</div>

<div class="bg-white border border-gray-300 overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-300">
            <tr>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Mata Kuliah</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Kelas</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Dosen Pengajar</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Hari</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Jam</th>
                <th class="text-right px-4 py-2 font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $jadwal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 text-gray-800"><?php echo e($j->matakuliah->nama_matakuliah ?? '-'); ?></td>
                    <td class="px-4 py-2"><?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Kelas <?php echo e($j->kelas); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?></td>
                    <td class="px-4 py-2 text-gray-600"><?php echo e($j->dosen->nama ?? '-'); ?></td>
                    <td class="px-4 py-2 text-gray-600"><?php echo e($j->hari); ?></td>
                    <td class="px-4 py-2 text-gray-600"><?php echo e(\Carbon\Carbon::parse($j->jam)->format('H:i')); ?></td>
                    <td class="px-4 py-2 text-right space-x-2 whitespace-nowrap">
                        <a href="<?php echo e(route('admin.jadwal.show', $j->id)); ?>" class="text-gray-500 hover:underline text-xs">Detail</a>
                        <a href="<?php echo e(route('admin.jadwal.edit', $j->id)); ?>" class="text-blue-600 hover:underline text-xs">Edit</a>
                        <form action="<?php echo e(route('admin.jadwal.destroy', $j->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:underline text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" class="px-4 py-6 text-center text-gray-400">Tidak ada data jadwal ditemukan.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-4">
    <?php echo e($jadwal->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dik\Documents\Tubes-Siakad-ifc2024-5520124066-AhmadHandikaAkbar\resources\views/admin/jadwal/index.blade.php ENDPATH**/ ?>