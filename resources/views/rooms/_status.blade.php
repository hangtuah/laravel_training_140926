@if ($active)
    <span class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full whitespace-nowrap">
        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
        Active
    </span>
@else
    <span class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-600 bg-slate-100 px-2.5 py-1 rounded-full whitespace-nowrap">
        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
        Inactive
    </span>
@endif
