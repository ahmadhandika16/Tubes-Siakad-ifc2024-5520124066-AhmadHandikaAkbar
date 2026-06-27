<?php $__env->startSection('title', 'Data Dosen'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-between mb-4 flex-wrap gap-2">
    <div>
        <h1 class="text-lg font-bold text-gray-700">Data Dosen</h1>
        <p class="text-gray-500 text-xs mt-1">Kelola data dosen pengajar.</p>
    </div>
    <a href="<?php echo e(route('admin.dosen.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5">
        + Tambah Dosen
    </a>
</div>

<div class="bg-white border border-gray-300 p-3 mb-4">
    <form method="GET" class="flex gap-2">
        <input type="text" name="search" value="<?php echo e($search); ?>" placeholder="Cari NIDN atau nama dosen..."
            class="flex-1 px-3 py-1.5 border border-gray-300 text-sm focus:outline-none focus:border-blue-500">
        <button type="submit" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-700 text-sm px-3 py-1.5">
            Cari
        </button>
        <?php if($search): ?>
            <a href="<?php echo e(route('admin.dosen.index')); ?>" class="text-gray-500 text-sm px-3 py-1.5">Reset</a>
        <?php endif; ?>
    </form>
</div>

<div class="bg-white border border-gray-300 overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-300">
            <tr>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">NIDN</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Nama Dosen</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Jumlah Bimbingan</th>
                <th class="text-right px-4 py-2 font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $dosen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 font-mono text-gray-700"><?php echo e($d->nidn); ?></td>
                    <td class="px-4 py-2 text-gray-800"><?php echo e($d->nama); ?></td>
                    <td class="px-4 py-2"><?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e($d->mahasiswa_count); ?> mahasiswa <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?></td>
                    <td class="px-4 py-2 text-right space-x-2 whitespace-nowrap">
                        <a href="<?php echo e(route('admin.dosen.show', $d->nidn)); ?>" class="text-gray-500 hover:underline text-xs">Lihat</a>
                        <a href="<?php echo e(route('admin.dosen.edit', $d->nidn)); ?>" class="text-blue-600 hover:underline text-xs">Edit</a>
                        <form action="<?php echo e(route('admin.dosen.destroy', $d->nidn)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus dosen <?php echo e($d->nama); ?>?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:underline text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="4" class="px-4 py-6 text-center text-gray-400">Tidak ada data dosen ditemukan.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-4">
    <?php echo e($dosen->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dik\Documents\Tubes-Siakad-ifc2024-5520124066-AhmadHandikaAkbar\resources\views/admin/dosen/index.blade.php ENDPATH**/ ?>