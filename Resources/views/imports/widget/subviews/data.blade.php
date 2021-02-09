<div class="card-body row text-center">
    <div class="col">
        <div class="text-value-xl">{{ $new }}</div>
        <div class="text-uppercase text-muted small">Novo</div>
    </div>
    <div class="c-vr"></div>
    <div class="col">
        <div class="text-value-xl">{{ $updated }}</div>
        <div class="text-uppercase text-muted small">Atualizado</div>
    </div>
    <div class="c-vr"></div>
    <div class="col">
        <div class="text-value-xl">{{ $failures }}</div>
        <div class="text-uppercase text-muted small">Falha</div>
    </div>
    @if($completed == 100 && ($failures > 0))
    <div class="c-vr"></div>
    <div class="col">
        <div class="text-value-xl">
        <a href="{{ route('imports.widget.report', $import_class) }}" class="text-muted text-decoration-none">
            <i class="cil-file font-2xl"></i>
        </a>
        </div>
        <div class="text-uppercase text-muted small">Relatório</div>
    </div>
    @endif
</div>