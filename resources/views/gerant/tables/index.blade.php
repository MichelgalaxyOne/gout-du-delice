<x-app-layout>
    <x-slot name="header">
        <h2>🪑 Gestion des tables</h2>
    </x-slot>

    <div class="p-3 p-md-4">

        @if(session('success'))
            <div class="alert alert-success" style="border-radius:10px;font-size:14px">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <div style="font-size:13px;color:#6B7280">
                {{ $tables->count() }} tables au total
            </div>
            <form action="{{ route('gerant.tables.qr.all') }}" method="POST"
                onsubmit="return confirm('Générer les QR codes pour toutes les tables ?')">
                @csrf
                <button type="submit" class="btn btn-or">
                    <i class="bi bi-qr-code me-1"></i> Générer tous les QR codes
                </button>
            </form>
        </div>

        <div class="row g-3">
            @foreach($tables as $table)
                @php
                    $couleurStatut = match($table->statut) {
                        'libre' => ['#D1FAE5', '#065F46'],
                        'occupee' => ['#FEE2E2', '#991B1B'],
                        'reservee' => ['#FEF3C7', '#92400E'],
                    };
                @endphp
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="bg-white rounded-3 p-3 text-center" style="box-shadow:0 2px 10px rgba(0,0,0,0.06)">
                        <div style="font-family:'Playfair Display',serif;font-size:24px;font-weight:700;color:#0F0F0F">
                            Table {{ $table->numero }}
                        </div>

                        <div class="my-2">
                            <span class="badge-statut" style="background:{{ $couleurStatut[0] }};color:{{ $couleurStatut[1] }}">
                                {{ ucfirst($table->statut) }}
                            </span>
                        </div>

                        @if($table->qr_code)
                            <img src="{{ asset('storage/'.$table->qr_code) }}" alt="QR Table {{ $table->numero }}"
                                style="width:100%;max-width:120px;margin:8px auto;border:1px solid #E5E7EB;border-radius:8px;cursor:pointer"
                                onclick="agrandirQr('{{ asset('storage/'.$table->qr_code) }}', {{ $table->numero }})">
                        @else
                            <div style="width:100%;max-width:120px;height:120px;margin:8px auto;background:#F5F5F3;border-radius:8px;display:flex;align-items:center;justify-content:center">
                                <i class="bi bi-qr-code" style="font-size:32px;color:#D1D5DB"></i>
                            </div>
                        @endif

                        <div class="d-flex flex-column gap-1 mt-2">
                            <form action="{{ route('gerant.tables.qr', $table) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm w-100" style="background:#F5F5F3;border:1px solid #E5E7EB;border-radius:8px;font-size:11px">
                                    <i class="bi bi-arrow-clockwise"></i> {{ $table->qr_code ? 'Régénérer' : 'Générer' }}
                                </button>
                            </form>

                            @if($table->qr_code)
                                <a href="{{ asset('storage/'.$table->qr_code) }}" download="table-{{ $table->numero }}.svg"
                                class="btn btn-sm w-100" style="background:#0F0F0F;color:white;border-radius:8px;font-size:11px;text-decoration:none">
                                    <i class="bi bi-download"></i> Télécharger
                                </a>
                            @endif

                            <select class="form-select form-select-sm mt-1" style="font-size:11px;border-radius:8px"
                                onchange="changerStatut({{ $table->id }}, this.value)">
                                <option value="libre" {{ $table->statut === 'libre' ? 'selected' : '' }}>Libre</option>
                                <option value="occupee" {{ $table->statut === 'occupee' ? 'selected' : '' }}>Occupée</option>
                                <option value="reservee" {{ $table->statut === 'reservee' ? 'selected' : '' }}>Réservée</option>
                            </select>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    {{-- Modal agrandissement QR --}}
    <div class="modal fade" id="modalQr" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content text-center" style="border-radius:16px">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="qrModalTitle" style="font-size:16px"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-0">
                    <img id="qrModalImg" src="" style="width:100%;border-radius:8px">
                </div>
            </div>
        </div>
    </div>

    {{-- Forms cachés pour changement de statut --}}
    @foreach($tables as $table)
        <form id="statutForm{{ $table->id }}" action="{{ route('gerant.tables.statut', $table) }}" method="POST" style="display:none">
            @csrf @method('PATCH')
            <input type="hidden" name="statut" id="statutInput{{ $table->id }}">
        </form>
    @endforeach

    <script>
        function agrandirQr(src, numero) {
            document.getElementById('qrModalImg').src = src;
            document.getElementById('qrModalTitle').innerText = 'Table ' + numero;
            new bootstrap.Modal(document.getElementById('modalQr')).show();
        }

        function changerStatut(tableId, statut) {
            document.getElementById('statutInput' + tableId).value = statut;
            document.getElementById('statutForm' + tableId).submit();
        }
    </script>

</x-app-layout>