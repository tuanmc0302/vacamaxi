@props([
    'kicker' => null,
    'title',
    'description' => null,
])

<div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
    <div>
        @if ($kicker)
            <p class="text-sm font-medium uppercase tracking-[0.2em] text-slate-500">{{ $kicker }}</p>
        @endif

        <h2 class="mt-3 text-3xl font-bold text-slate-900">{{ $title }}</h2>

        @if ($description)
            <p class="mt-2 text-sm text-slate-500">{{ $description }}</p>
        @endif
    </div>

    @if (trim($slot))
        <div class="flex items-center gap-3">
            {{ $slot }}
        </div>
    @endif
</div>
