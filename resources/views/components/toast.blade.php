@props(['type' => 'success', 'message' => ''])

@php
    $bgColor = $type === 'success' ? '#22c55e' : '#ef4444';
    $icon = $type === 'success' ? '✅' : '❌';
    $id = 'toast-' . $type . '-' . uniqid();
    $duration = $type === 'success' ? 4000 : 7000;
@endphp

<div id="{{ $id }}" 
     style="position: fixed; top: 20px; right: 20px; z-index: 9999; background: {{ $bgColor }}; color: white; padding: 20px; border-radius: 8px; font-weight: bold; box-shadow: 0 4px 6px rgba(0,0,0,0.3); transition: opacity 0.5s ease; max-width: 350px;">
    
    <div style="display: flex; align-items: start; gap: 10px;">
        <span>{{ $icon }}</span>
        <div>
            @if($type === 'error' && is_array($message))
                <span style="display: block; margin-bottom: 5px;">VALIDATION ERROR:</span>
                <ul style="margin: 0; padding-left: 15px; font-weight: normal; font-size: 0.85em; list-style: disc;">
                    @foreach ($message as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @else
                {{ $message }}
            @endif
        </div>
    </div>

    <div style="position: absolute; bottom: 0; left: 0; height: 4px; background: rgba(255,255,255,0.5); width: 100%; animation: shrink {{ $duration }}ms linear forwards;"></div>
</div>

<style>
    @keyframes shrink {
        from { width: 100%; }
        to { width: 0%; }
    }
</style>

<script>
    setTimeout(() => {
        const toast = document.getElementById('{{ $id }}');
        if (toast) {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 500);
        }
    }, {{ $duration }});
</script>
