<x-app-layout>
    <x-slot name="header">
        <h2>🔥 Commandes à préparer</h2>
    </x-slot>

    <div class="p-3 p-md-4">

        <div class="row g-3">
            @forelse($commandes as $cmd)
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="order-card h-100 m-0">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <div style="font-weight:700;font-size:16px">{{ $cmd->reference }}</div>
                                <div style="font-size:12px;color:#6B7280">
                                    <i class="bi bi-geo-alt"></i> Table {{ $cmd->table->numero ?? 'En ligne' }}
                                </div>
                            </div>
                            <span class="badge-statut badge-{{ $cmd->statut }}">
                                {{ ucfirst(str_replace('_', ' ', $cmd->statut)) }}
                            </span>
                        </div>

                        <ul class="list-unstyled mb-3" style="font-size:14px">
                            @foreach($cmd->items as $item)
                                <li class="d-flex justify-content-between py-1" style="border-bottom:1px solid #F3F4F6">
                                    <span>{{ $item->plat->nom }}</span>
                                    <strong>×{{ $item->quantite }}</strong>
                                </li>
                            @endforeach
                        </ul>

                        <div class="d-flex justify-content-between align-items-center">
                            <span style="font-size:12px;color:#6B7280">
                                <i class="bi bi-clock"></i> {{ $cmd->created_at->diffForHumans() }}
                            </span>
                            <button class="btn btn-or btn-sm">
                                <i class="bi bi-check-circle me-1"></i> Marquer prêt
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-emoji-smile" style="font-size:48px;color:#E5E7EB"></i>
                    <p style="color:#6B7280;font-size:14px;margin-top:12px">Aucune commande à préparer.</p>
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>