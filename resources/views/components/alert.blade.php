<div {{ $attributes->merge(['class' => 'border p-4 rounded ' . $classForType()]) }}>
    <strong class="font-bold uppercase">{{ $type }}!</strong>
    <span class="block sm:inline">{{ $message ?? $slot }}</span>
</div>
