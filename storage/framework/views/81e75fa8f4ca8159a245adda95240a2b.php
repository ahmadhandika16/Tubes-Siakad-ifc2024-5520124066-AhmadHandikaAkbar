<?php $__env->startSection('title', 'Tambah Mata Kuliah'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-4">
  <a href="<?php echo e(route('admin.matakuliah.index')); ?>" class="text-sm text-gray-500 hover:text-gray-700">&larr; Kembali ke Data Mata Kuliah</a>
  <h1 class="text-lg font-bold text-gray-800 mt-2">Tambah Mata Kuliah Baru</h1>
</div>

<div class="bg-white border border-gray-300 p-6 max-w-xl">
  <form action="<?php echo e(route('admin.matakuliah.store')); ?>" method="POST" class="space-y-4">
    <?php echo csrf_field(); ?>
    <div>
      <label for="kode_matakuliah" class="block text-sm font-medium text-gray-700 mb-1">Kode Mata Kuliah <span class="text-red-500">*</span></label>
      <input type="text" name="kode_matakuliah" id="kode_matakuliah" value="<?php echo e(old('kode_matakuliah')); ?>" maxlength="8" required
        class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm <?php $__errorArgs = ['kode_matakuliah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
        placeholder="Contoh: IF53413">
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
      <label for="nama_matakuliah" class="block text-sm font-medium text-gray-700 mb-1">Nama Mata Kuliah <span class="text-red-500">*</span></label>
      <input type="text" name="nama_matakuliah" id="nama_matakuliah" value="<?php echo e(old('nama_matakuliah')); ?>" maxlength="50" required
        class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm <?php $__errorArgs = ['nama_matakuliah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
        placeholder="Contoh: Pemrograman Web II">
      <?php $__errorArgs = ['nama_matakuliah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label for="sks" class="block text-sm font-medium text-gray-700 mb-1">SKS <span class="text-red-500">*</span></label>
      <input type="number" name="sks" id="sks" value="<?php echo e(old('sks')); ?>" min="1" max="6" required
        class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm <?php $__errorArgs = ['sks'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
      <?php $__errorArgs = ['sks'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="flex gap-3 pt-2">
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-3 py-1.5  transition">
        Simpan
      </button>
      <a href="<?php echo e(route('admin.matakuliah.index')); ?>" class="text-gray-500 hover:text-gray-700 text-sm font-medium px-3 py-1.5">
        Batal
      </a>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dik\Documents\Tubes-Siakad-ifc2024-5520124066-AhmadHandikaAkbar\resources\views/admin/matakuliah/create.blade.php ENDPATH**/ ?>