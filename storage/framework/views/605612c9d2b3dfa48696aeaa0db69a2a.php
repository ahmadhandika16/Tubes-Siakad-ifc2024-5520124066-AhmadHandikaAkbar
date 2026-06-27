<?php $__env->startSection('title', 'Edit KRS'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <a href="<?php echo e(route('admin.krs.index')); ?>" class="text-sm text-gray-500 hover:underline">&larr; Kembali ke Data KRS</a>
    <h1 class="text-lg font-bold text-gray-700 mt-2">Edit Data KRS</h1>
</div>

<div class="bg-white border border-gray-300 p-4 max-w-xl">
    <form action="<?php echo e(route('admin.krs.update', $krs->id)); ?>" method="POST" class="space-y-3">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <div>
            <label for="npm" class="block text-xs font-medium text-gray-600 mb-1">Mahasiswa <span class="text-red-500">*</span></label>
            <select name="npm" id="npm" required
                class="w-full px-3 py-1.5 border border-gray-300 text-sm focus:outline-none focus:border-blue-500 <?php $__errorArgs = ['npm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $__currentLoopData = $mahasiswaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($m->npm); ?>" <?php echo e(old('npm', $krs->npm) == $m->npm ? 'selected' : ''); ?>><?php echo e($m->nama); ?> (<?php echo e($m->npm); ?>)</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['npm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div>
            <label for="kode_matakuliah" class="block text-xs font-medium text-gray-600 mb-1">Mata Kuliah <span class="text-red-500">*</span></label>
            <select name="kode_matakuliah" id="kode_matakuliah" required
                class="w-full px-3 py-1.5 border border-gray-300 text-sm focus:outline-none focus:border-blue-500 <?php $__errorArgs = ['kode_matakuliah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $__currentLoopData = $matakuliahList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($mk->kode_matakuliah); ?>" <?php echo e(old('kode_matakuliah', $krs->kode_matakuliah) == $mk->kode_matakuliah ? 'selected' : ''); ?>>
                        <?php echo e($mk->nama_matakuliah); ?> (<?php echo e($mk->kode_matakuliah); ?>) - <?php echo e($mk->sks); ?> SKS
                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['kode_matakuliah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div>
            <label for="semester" class="block text-xs font-medium text-gray-600 mb-1">Semester <span class="text-red-500">*</span></label>
            <input type="text" name="semester" id="semester" value="<?php echo e(old('semester', $krs->semester)); ?>" maxlength="20" required
                class="w-full px-3 py-1.5 border border-gray-300 text-sm focus:outline-none focus:border-blue-500 <?php $__errorArgs = ['semester'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <?php $__errorArgs = ['semester'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="flex gap-2 pt-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5">
                Perbarui
            </button>
            <a href="<?php echo e(route('admin.krs.index')); ?>" class="text-gray-500 hover:underline text-sm px-3 py-1.5">
                Batal
            </a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dik\Documents\Tubes-Siakad-ifc2024-5520124066-AhmadHandikaAkbar\resources\views/admin/krs/edit.blade.php ENDPATH**/ ?>