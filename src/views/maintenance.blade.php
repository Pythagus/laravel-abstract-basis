@php $maintenance_date = maintenance_date() ; @endphp
@if($maintenance_date && $maintenance_date->isFuture())
    <div id="maintenance-message" class="rounded px-5 py-3 mb-3 text-center" style="z-index: 9999 ; position: fixed ; bottom: 0 ; left: 50% ; transform: translateX(-50%)">
        <h2 class="text-warning mb-0">Maintenance scheduled at {{ $maintenance_date->format('H\hi') }}</h2>
    </div>
@endif