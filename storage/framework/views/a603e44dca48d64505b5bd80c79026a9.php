<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'SIAKAD'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-gray-50 text-gray-800 text-sm">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="hidden md:block w-56 bg-white border-r border-gray-300 shrink-0">
            <div class="px-4 py-4 border-b border-gray-300">
                <h1 class="font-bold text-gray-700">SIAKAD</h1>
                <p class="text-xs text-gray-500">Sistem Informasi Akademik</p>
            </div>

            <nav class="py-3">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->role === 'admin'): ?>
                        <p class="px-4 py-1 text-xs font-bold text-gray-400 uppercase">Menu Admin</p>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="block px-4 py-2 border-l-4 <?php echo e(request()->routeIs('admin.dashboard') ? 'border-blue-600 bg-blue-50 text-blue-700 font-medium' : 'border-transparent text-gray-600 hover:bg-gray-100'); ?>">
                            Dashboard
                        </a>
                        <a href="<?php echo e(route('admin.dosen.index')); ?>" class="block px-4 py-2 border-l-4 <?php echo e(request()->routeIs('admin.dosen.*') ? 'border-blue-600 bg-blue-50 text-blue-700 font-medium' : 'border-transparent text-gray-600 hover:bg-gray-100'); ?>">
                            Data Dosen
                        </a>
                        <a href="<?php echo e(route('admin.mahasiswa.index')); ?>" class="block px-4 py-2 border-l-4 <?php echo e(request()->routeIs('admin.mahasiswa.*') ? 'border-blue-600 bg-blue-50 text-blue-700 font-medium' : 'border-transparent text-gray-600 hover:bg-gray-100'); ?>">
                            Data Mahasiswa
                        </a>
                        <a href="<?php echo e(route('admin.matakuliah.index')); ?>" class="block px-4 py-2 border-l-4 <?php echo e(request()->routeIs('admin.matakuliah.*') ? 'border-blue-600 bg-blue-50 text-blue-700 font-medium' : 'border-transparent text-gray-600 hover:bg-gray-100'); ?>">
                            Mata Kuliah
                        </a>
                        <a href="<?php echo e(route('admin.jadwal.index')); ?>" class="block px-4 py-2 border-l-4 <?php echo e(request()->routeIs('admin.jadwal.*') ? 'border-blue-600 bg-blue-50 text-blue-700 font-medium' : 'border-transparent text-gray-600 hover:bg-gray-100'); ?>">
                            Jadwal Kuliah
                        </a>
                        <a href="<?php echo e(route('admin.krs.index')); ?>" class="block px-4 py-2 border-l-4 <?php echo e(request()->routeIs('admin.krs.*') ? 'border-blue-600 bg-blue-50 text-blue-700 font-medium' : 'border-transparent text-gray-600 hover:bg-gray-100'); ?>">
                            Data KRS
                        </a>
                    <?php else: ?>
                        <p class="px-4 py-1 text-xs font-bold text-gray-400 uppercase">Menu Mahasiswa</p>
                        <a href="<?php echo e(route('mahasiswa.dashboard')); ?>" class="block px-4 py-2 border-l-4 <?php echo e(request()->routeIs('mahasiswa.dashboard') ? 'border-blue-600 bg-blue-50 text-blue-700 font-medium' : 'border-transparent text-gray-600 hover:bg-gray-100'); ?>">
                            Dashboard
                        </a>
                        <a href="<?php echo e(route('mahasiswa.krs.index')); ?>" class="block px-4 py-2 border-l-4 <?php echo e(request()->routeIs('mahasiswa.krs.*') ? 'border-blue-600 bg-blue-50 text-blue-700 font-medium' : 'border-transparent text-gray-600 hover:bg-gray-100'); ?>">
                            KRS
                        </a>
                        <a href="<?php echo e(route('mahasiswa.jadwal.index')); ?>" class="block px-4 py-2 border-l-4 <?php echo e(request()->routeIs('mahasiswa.jadwal.*') ? 'border-blue-600 bg-blue-50 text-blue-700 font-medium' : 'border-transparent text-gray-600 hover:bg-gray-100'); ?>">
                            Jadwal Kuliah
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </nav>

            <?php if(auth()->guard()->check()): ?>
            <div class="absolute bottom-0 w-56 border-t border-gray-300 px-4 py-3 bg-white">
                <p class="text-xs font-medium text-gray-700 truncate"><?php echo e(auth()->user()->name); ?></p>
                <p class="text-xs text-gray-400 mb-2"><?php echo e(auth()->user()->role === 'admin' ? 'Administrator' : 'Mahasiswa'); ?></p>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="text-xs text-red-600 hover:underline">Logout</button>
                </form>
            </div>
            <?php endif; ?>
        </aside>

        <!-- Mobile top bar -->
        <div class="md:hidden fixed top-0 left-0 right-0 bg-white border-b border-gray-300 px-4 py-3 flex items-center justify-between z-30">
            <span class="font-bold text-gray-700">SIAKAD</span>
            <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')" class="text-gray-600 border border-gray-300 px-2 py-1 text-xs">Menu</button>
        </div>
        <div id="mobileMenu" class="hidden md:hidden fixed top-12 left-0 right-0 bg-white border-b border-gray-300 z-20 px-4 py-2">
            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->role === 'admin'): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="block px-2 py-2 border-b border-gray-100 text-gray-600">Dashboard</a>
                    <a href="<?php echo e(route('admin.dosen.index')); ?>" class="block px-2 py-2 border-b border-gray-100 text-gray-600">Data Dosen</a>
                    <a href="<?php echo e(route('admin.mahasiswa.index')); ?>" class="block px-2 py-2 border-b border-gray-100 text-gray-600">Data Mahasiswa</a>
                    <a href="<?php echo e(route('admin.matakuliah.index')); ?>" class="block px-2 py-2 border-b border-gray-100 text-gray-600">Mata Kuliah</a>
                    <a href="<?php echo e(route('admin.jadwal.index')); ?>" class="block px-2 py-2 border-b border-gray-100 text-gray-600">Jadwal Kuliah</a>
                    <a href="<?php echo e(route('admin.krs.index')); ?>" class="block px-2 py-2 border-b border-gray-100 text-gray-600">Data KRS</a>
                <?php else: ?>
                    <a href="<?php echo e(route('mahasiswa.dashboard')); ?>" class="block px-2 py-2 border-b border-gray-100 text-gray-600">Dashboard</a>
                    <a href="<?php echo e(route('mahasiswa.krs.index')); ?>" class="block px-2 py-2 border-b border-gray-100 text-gray-600">KRS</a>
                    <a href="<?php echo e(route('mahasiswa.jadwal.index')); ?>" class="block px-2 py-2 border-b border-gray-100 text-gray-600">Jadwal Kuliah</a>
                <?php endif; ?>
                <form action="<?php echo e(route('logout')); ?>" method="POST" class="py-2">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="text-xs text-red-600">Logout</button>
                </form>
            <?php endif; ?>
        </div>

        <!-- Main content -->
        <main class="flex-1 min-w-0 md:pt-0 pt-14">
            <div class="p-4 md:p-6">
                <?php if(session('success')): ?>
                    <div class="mb-4 px-3 py-2 border border-green-300 bg-green-50 text-green-700 text-sm">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="mb-4 px-3 py-2 border border-red-300 bg-red-50 text-red-700 text-sm">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="mb-4 px-3 py-2 border border-red-300 bg-red-50 text-red-700 text-sm">
                        <p class="font-medium mb-1">Terjadi kesalahan validasi:</p>
                        <ul class="list-disc list-inside">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>
    </div>
</body>
</html>
<?php /**PATH C:\Users\dik\Documents\Tubes-Siakad-ifc2024-5520124066-AhmadHandikaAkbar\resources\views/layouts/app.blade.php ENDPATH**/ ?>