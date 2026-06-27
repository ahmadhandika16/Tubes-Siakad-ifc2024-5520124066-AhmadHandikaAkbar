<?php $__env->startSection('title', 'Tambah Jadwal'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-4">
  <a href="<?php echo e(route('admin.jadwal.index')); ?>" class="text-sm text-gray-500 hover:text-gray-700">&larr; Kembali ke Jadwal Kuliah</a>
  <h1 class="text-lg font-bold text-gray-800 mt-2">Tambah Jadwal Kuliah</h1>
</div>

<div class="bg-white border border-gray-300 p-6 max-w-xl">
  <form action="<?php echo e(route('admin.jadwal.store')); ?>" method="POST" class="space-y-4">
    <?php echo csrf_field(); ?>
    <div>
      <label for="kode_matakuliah" class="block text-sm font-medium text-gray-700 mb-1">Mata Kuliah <span class="text-red-500">*</span></label>
      <select name="kode_matakuliah" id="kode_matakuliah" required
        class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm <?php $__errorArgs = ['kode_matakuliah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <option value="">-- Pilih Mata Kuliah --</option>
        <?php $__currentLoopData = $matakuliahList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($mk->kode_matakuliah); ?>" <?php echo e(old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : ''); ?>>
            <?php echo e($mk->nama_matakuliah); ?> (<?php echo e($mk->kode_matakuliah); ?>)
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
      <label for="nidn" class="block text-sm font-medium text-gray-700 mb-1">Dosen Pengajar <span class="text-red-500">*</span></label>
      <select name="nidn" id="nidn" required
        class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm <?php $__errorArgs = ['nidn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <option value="">-- Pilih Dosen --</option>
        <?php $__currentLoopData = $dosenList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($d->nidn); ?>" <?php echo e(old('nidn') == $d->nidn ? 'selected' : ''); ?>><?php echo e($d->nama); ?></option>
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
    <div class="grid grid-cols-2 gap-4">
      <div>
        <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas <span class="text-red-500">*</span></label>
        <input type="text" name="kelas" id="kelas" value="<?php echo e(old('kelas')); ?>" maxlength="1" required
          class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm uppercase <?php $__errorArgs = ['kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
          placeholder="A" style="text-transform:uppercase">
        <?php $__errorArgs = ['kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div>
        <label for="jam" class="block text-sm font-medium text-gray-700 mb-1">Jam <span class="text-red-500">*</span></label>
        <input type="time" name="jam" id="jam" value="<?php echo e(old('jam')); ?>" required
          class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm <?php $__errorArgs = ['jam'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <?php $__errorArgs = ['jam'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
    </div>
    <div>
      <label for="hari" class="block text-sm font-medium text-gray-700 mb-1">Hari <span class="text-red-500">*</span></label>
      <select name="hari" id="hari" required
        class="w-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:border-blue-500 text-sm <?php $__errorArgs = ['hari'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <option value="">-- Pilih Hari --</option>
        <?php $__currentLoopData = $hariList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($h); ?>" <?php echo e(old('hari') == $h ? 'selected' : ''); ?>><?php echo e($h); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <?php $__errorArgs = ['hari'];
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
      <a href="<?php echo e(route('admin.jadwal.index')); ?>" class="text-gray-500 hover:text-gray-700 text-sm font-medium px-3 py-1.5">
        Batal
      </a>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dik\Documents\Tubes-Siakad-ifc2024-5520124066-AhmadHandikaAkbar\resources\views/admin/jadwal/create.blade.php ENDPATH**/ ?>