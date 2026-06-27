<?php $__env->startSection('title', 'Edit Mahasiswa'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-4">
  <a href="<?php echo e(route('admin.mahasiswa.index')); ?>" class="text-sm text-gray-500 hover:text-gray-700">&larr; Kembali ke Data Mahasiswa</a>
  <h1 class="text-lg font-bold text-gray-800 mt-2">Edit Data Mahasiswa</h1>
</div>

<div class="bg-white border border-gray-300 p-6 max-w-xl">
  <form action="<?php echo e(route('admin.mahasiswa.update', $mahasiswa->npm)); ?>" method="POST" class="space-y-4">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
    <div>
      <label for="npm" class="block text-sm font-medium text-gray-700 mb-1">NPM <span class="text-red-500">*</span></label>
      <input type="text" name="npm" id="npm" value="<?php echo e(old('npm', $mahasiswa->npm)); ?>" maxlength="10" required
        class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm <?php $__errorArgs = ['npm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
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
      <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Mahasiswa <span class="text-red-500">*</span></label>
      <input type="text" name="nama" id="nama" value="<?php echo e(old('nama', $mahasiswa->nama)); ?>" maxlength="50" required
        class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
      <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
      <label for="nidn" class="block text-sm font-medium text-gray-700 mb-1">Dosen Wali</label>
      <select name="nidn" id="nidn" class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm <?php $__errorArgs = ['nidn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <option value="">-- Tidak ada --</option>
        <?php $__currentLoopData = $dosenList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($d->nidn); ?>" <?php echo e(old('nidn', $mahasiswa->nidn) == $d->nidn ? 'selected' : ''); ?>><?php echo e($d->nama); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <?php $__errorArgs = ['nidn'];
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
        Perbarui
      </button>
      <a href="<?php echo e(route('admin.mahasiswa.index')); ?>" class="text-gray-500 hover:text-gray-700 text-sm font-medium px-3 py-1.5">
        Batal
      </a>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dik\Documents\Tubes-Siakad-ifc2024-5520124066-AhmadHandikaAkbar\resources\views/admin/mahasiswa/edit.blade.php ENDPATH**/ ?>