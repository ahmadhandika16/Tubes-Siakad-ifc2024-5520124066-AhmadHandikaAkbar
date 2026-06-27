<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['type' => 'info']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['type' => 'info']); ?>
<?php foreach (array_filter((['type' => 'info']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$classes = match($type) {
    'success' => 'bg-green-50 text-green-700 border-green-300',
    'warning' => 'bg-yellow-50 text-yellow-700 border-yellow-300',
    'danger' => 'bg-red-50 text-red-700 border-red-300',
    default => 'bg-blue-50 text-blue-700 border-blue-300',
};
?>

<span <?php echo e($attributes->merge(['class' => "inline-block px-2 py-0.5 text-xs border $classes"])); ?>>
    <?php echo e($slot); ?>

</span>
<?php /**PATH C:\Users\dik\Documents\Tubes-Siakad-ifc2024-5520124066-AhmadHandikaAkbar\resources\views/components/badge.blade.php ENDPATH**/ ?>