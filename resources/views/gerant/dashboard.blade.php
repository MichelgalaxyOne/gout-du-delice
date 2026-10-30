<x-app-layout>
    <x-slot name="header">
        <h2>📊 Tableau de bord</h2>
    </x-slot>

    <div class="p-3 p-md-4">

        {{-- Stats --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3">
                <div class="card-stat">
                    <div class="stat-num">{{ $stats['commandes_jour'] }}</div>
                    <div class="stat-label">Commandes aujourd'hui</div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card-stat">
                    <div class="stat-num">{{ number_format($stats['ventes_jour'], 0, ',', ' ') }}</div>
                    <div class="stat-label">FCFA — Ventes du jour</div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card-stat">
                    <div class="stat-num">{{ $stats['plats_total'] }}</div>
                    <div class="stat-label">Plats au menu</div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card-stat">
                    <div class="stat-num">{{ $stats['commandes_en_cours'] }}</div>
                    <div class="stat-label">Commandes en cours</div>
                </div>
            </div>
        </div>

        {{-- Dernières commandes --}}
        <div class="bg-white rounded-3 p-3 p-md-4" style="box-shadow:0 2px 10px rgba(0,0,0,0.06)">
            <h5 class="mb-3" style="font-family:'Playfair Display',serif;font-size:16px;font-weight:700">
                Dernières commandes
            </h5>

            @forelse($dernieres_commandes as $cmd)
                <div class="order-card d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <div style="font-weight:600;font-size:14px">{{ $cmd->reference }}</div>
                        <div style="font-size:12px;color:#6B7280">
                            <i class="bi bi-geo-alt"></i> Table {{ $cmd->table->numero ?? 'En ligne' }}
                            · {{ $cmd->created_at->format('H:i') }}
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span style="font-weight:600;font-size:14px;color:#0F0F0F">
                            {{ number_format($cmd->montant_total, 0, ',', ' ') }} FCFA
                        </span>
                        <span class="badge-statut badge-{{ $cmd->statut }}">
                            {{ ucfirst(str_replace('_', ' ', $cmd->statut)) }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-center py-4" style="color:#6B7280;font-size:14px">
                    Aucune commande pour le moment.
                </p>
            @endforelse
        </div>

    </div>
</x-app-layout>