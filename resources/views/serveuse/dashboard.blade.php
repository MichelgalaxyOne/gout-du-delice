<x-app-layout>
    <x-slot name="header">
        <h2>🧾 Commandes en cours</h2>
    </x-slot>

    <div class="p-3 p-md-4">

        @forelse($commandes as $cmd)
            <div class="order-card">
                <div class="d-flex justify-content-between align-items-start mb-2 flex-wrap gap-2">
                    <div>
                        <div style="font-weight:700;font-size:15px">{{ $cmd->reference }}</div>
                        <div style="font-size:12px;color:#6B7280">
                            <i class="bi bi-geo-alt"></i> Table {{ $cmd->table->numero ?? 'En ligne' }}
                            · {{ $cmd->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <span class="badge-statut badge-{{ $cmd->statut }}">
                        {{ ucfirst(str_replace('_', ' ', $cmd->statut)) }}
                    </span>
                </div>

                <div style="font-size:13px;color:#374151;margin-bottom:8px">
                    @foreach($cmd->items as $item)
                        {{ $item->quantite }}× {{ $item->plat->nom }}@if(!$loop->last), @endif
                    @endforeach
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <span style="font-weight:700;font-size:15px">
                        {{ number_format($cmd->montant_total, 0, ',', ' ') }} FCFA
                    </span>
                    <span class="badge-statut" style="background:{{ $cmd->statut_paiement === 'confirme' ? '#D1FAE5' : '#FEE2E2' }};color:{{ $cmd->statut_paiement === 'confirme' ? '#065F46' : '#991B1B' }}">
                        {{ $cmd->statut_paiement === 'confirme' ? '✓ Payé' : 'Paiement en attente' }}
                    </span>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-receipt" style="font-size:48px;color:#E5E7EB"></i>
                <p style="color:#6B7280;font-size:14px;margin-top:12px">Aucune commande en cours.</p>
            </div>
        @endforelse

    </div>
</x-app-layout>