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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pemeriksaan Dokter & Rekam Medis</h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 space-y-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <!-- Tabel Antrean Pasien -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Antrean Pasien Hari Ini (Belum Diperiksa)</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Antrean</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No RM</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pasien</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Poli</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dokter</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = $antreans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $antrean): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="px-4 py-3 text-sm font-bold text-blue-600"><?php echo e($antrean->no_antrean); ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-600"><?php echo e($antrean->pasien->no_rm); ?></td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-900"><?php echo e($antrean->pasien->nama); ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-600"><?php echo e($antrean->poli); ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-600"><?php echo e($antrean->dokter->name); ?></td>
                                    <td class="px-4 py-3 text-sm text-center">
                                        <a href="<?php echo e(route('rekam-medis.create', $antrean->id)); ?>" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-semibold">Periksa Pasien</a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-center text-sm text-gray-500">Tidak ada antrean pasien menunggu saat ini.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Riwayat Rekam Medis -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Riwayat Rekam Medis Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No RM</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pasien</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keluhan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diagnosa</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Resep</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = $historyMedis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-500"><?php echo e($rm->created_at->format('d/m/Y H:i')); ?></td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-700"><?php echo e($rm->pasien->no_rm); ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-900"><?php echo e($rm->pasien->nama); ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-600"><?php echo e($rm->keluhan_utama); ?></td>
                                    <td class="px-4 py-3 text-sm font-medium text-blue-700"><?php echo e($rm->diagnosa); ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-600"><?php echo e($rm->resep_obat ?? '-'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-center text-sm text-gray-500">Belum ada riwayat rekam medis.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
<?php endif; ?><?php /**PATH C:\laragon\www\simrs-app\resources\views/rekam_medis/index.blade.php ENDPATH**/ ?>