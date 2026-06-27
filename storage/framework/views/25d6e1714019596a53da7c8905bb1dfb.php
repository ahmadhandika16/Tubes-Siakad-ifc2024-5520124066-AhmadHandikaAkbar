<?php $__env->startSection('title', 'KRS Saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-between mb-4 flex-wrap gap-2">
    <div>
        <h1 class="text-lg font-bold text-gray-700">Kartu Rencana Studi (KRS)</h1>
        <p class="text-gray-500 text-xs mt-1">Semester <?php echo e($semesterAktif); ?></p>
    </div>
    <div class="flex gap-2">
        <a href="<?php echo e(route('mahasiswa.krs.export.pdf')); ?>" class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1.5">
            Export PDF
        </a>
        <a href="<?php echo e(route('mahasiswa.krs.export.excel')); ?>" class="bg-green-600 hover:bg-green-700 text-white text-sm px-3 py-1.5">
            Export Excel
        </a>
    </div>
</div>

<!-- KRS yang sudah diambil -->
<div class="bg-white border border-gray-300 mb-5">
    <div class="px-4 py-2 border-b border-gray-300 bg-gray-50 flex items-center justify-between">
        <h2 class="font-semibold text-gray-700 text-sm">Mata Kuliah yang Sudah Diambil</h2>
        <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['type' => $totalSks >= $maxSks ? 'danger' : 'info']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($totalSks >= $maxSks ? 'danger' : 'info')]); ?><?php echo e($totalSks); ?> / <?php echo e($maxSks); ?> SKS <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Kode</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Mata Kuliah</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">SKS</th>
                <th class="text-left px-4 py-2 font-semibold text-gray-600">Jadwal</th>
                <th class="text-right px-4 py-2 font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $krsAktif; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="px-4 py-2 font-mono text-gray-600"><?php echo e($k->kode_matakuliah); ?></td>
                    <td class="px-4 py-2 text-gray-800"><?php echo e($k->matakuliah->nama_matakuliah ?? '-'); ?></td>
                    <td class="px-4 py-2 text-gray-600"><?php echo e($k->matakuliah->sks ?? '-'); ?></td>
                    <td class="px-4 py-2 text-gray-500 text-xs">
                        <?php $__empty_2 = true; $__currentLoopData = $k->matakuliah->jadwal ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                            <div><?php echo e($j->hari); ?>, <?php echo e(\Carbon\Carbon::parse($j->jam)->format('H:i')); ?> (Kelas <?php echo e($j->kelas); ?> - <?php echo e($j->dosen->nama ?? '-'); ?>)</div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                            <span class="text-gray-400">Belum ada jadwal</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-2 text-right">
                        <form action="<?php echo e(route('mahasiswa.krs.destroy', $k->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin men-drop mata kuliah <?php echo e($k->matakuliah->nama_matakuliah ?? ''); ?>?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:underline text-xs">Drop</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" class="px-4 py-6 text-center text-gray-400">Belum ada mata kuliah yang diambil.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Mata kuliah yang tersedia untuk diambil -->
<div class="bg-white border border-gray-300">
    <div class="px-4 py-2 border-b border-gray-300 bg-gray-50">
        <h2 class="font-semibold text-gray-700 text-sm">Mata Kuliah Tersedia</h2>
    </div>

    <div class="p-4">
        <form method="GET" class="flex gap-2 mb-4">
            <input type="text" name="search" value="<?php echo e($search); ?>" placeholder="Cari mata kuliah..."
                class="flex-1 px-3 py-1.5 border border-gray-300 text-sm focus:outline-none focus:border-blue-500">
            <button type="submit" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-700 text-sm px-3 py-1.5">
                Cari
            </button>
        </form>

        <div class="grid md:grid-cols-2 gap-3">
            <?php $__empty_1 = true; $__currentLoopData = $matakuliahTersedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="border border-gray-300 p-3 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <p class="font-medium text-gray-800"><?php echo e($mk->nama_matakuliah); ?></p>
                            <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e($mk->sks); ?> SKS <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                        </div>
                        <p class="text-xs text-gray-400 font-mono mb-2"><?php echo e($mk->kode_matakuliah); ?></p>
                        <div class="text-xs text-gray-500 space-y-0.5 mb-3">
                            <?php $__empty_2 = true; $__currentLoopData = $mk->jadwal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                <p><?php echo e($j->hari); ?>, <?php echo e(\Carbon\Carbon::parse($j->jam)->format('H:i')); ?> - Kelas <?php echo e($j->kelas); ?> - <?php echo e($j->dosen->nama ?? '-'); ?></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                <p class="text-gray-400">Jadwal belum ditentukan</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <form action="<?php echo e(route('mahasiswa.krs.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="kode_matakuliah" value="<?php echo e($mk->kode_matakuliah); ?>">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm py-1.5">
                            + Ambil Mata Kuliah
                        </button>
                    </form>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-sm text-gray-400 col-span-2 text-center py-6">Tidak ada mata kuliah tersedia untuk diambil.</p>
            <?php endif; ?>
        </div>

        <div class="mt-4">
            <?php echo e($matakuliahTersedia->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dik\Documents\Tubes-Siakad-ifc2024-5520124066-AhmadHandikaAkbar\resources\views/mahasiswa/krs/index.blade.php ENDPATH**/ ?>