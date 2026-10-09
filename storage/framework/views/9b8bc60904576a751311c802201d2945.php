<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Pasien SIMRS</h2>
            <a href="<?php echo e(route('pasiens.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-semibold">+ Tambah Pasien Baru</a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Form Pencarian -->
                <form method="GET" action="<?php echo e(route('pasiens.index')); ?>" class="mb-4 flex gap-2">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari Nama / No RM / NIK..." class="border-gray-300 rounded-md shadow-sm w-full md:w-1/3">
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md">Cari</button>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No RM</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIK</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pasien</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">L/P</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl Lahir</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No HP</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = $pasiens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pasien): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="px-4 py-3 text-sm font-bold text-blue-600"><?php echo e($pasien->no_rm); ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-600"><?php echo e($pasien->nik); ?></td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-900"><?php echo e($pasien->nama); ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-600"><?php echo e($pasien->jenis_kelamin); ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-600"><?php echo e($pasien->tanggal_lahir); ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-600"><?php echo e($pasien->no_hp); ?></td>
                                    <td class="px-4 py-3 text-sm text-center">
                                        <a href="<?php echo e(route('pasiens.edit', $pasien->id)); ?>" class="text-indigo-600 hover:text-indigo-900 mr-2 font-medium">Edit</a>
                                        <form action="<?php echo e(route('pasiens.destroy', $pasien->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus data pasien ini?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7" class="px-4 py-4 text-center text-sm text-gray-500">Data pasien tidak ditemukan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <?php echo e($pasiens->links()); ?>

                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\simrs-app\resources\views/pasiens/index.blade.php ENDPATH**/ ?>