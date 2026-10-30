<x-app-layout>
    <x-slot name="header">
        <h2>📂 Gestion des catégories</h2>
    </x-slot>

    <div class="p-3 p-md-4">

        @if(session('success'))
            <div class="alert alert-success" style="border-radius:10px;font-size:14px">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" style="border-radius:10px;font-size:14px">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
        @endif

        {{-- Bouton ajouter --}}
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-or" data-bs-toggle="modal" data-bs-target="#modalAjouter">
                <i class="bi bi-plus-circle me-1"></i> Nouvelle catégorie
            </button>
        </div>

        {{-- Liste des catégories --}}
        <div class="row g-3">
            @forelse($categories as $cat)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="bg-white rounded-3 p-3" style="box-shadow:0 2px 10px rgba(0,0,0,0.06)">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <span style="font-size:28px">{{ $cat->icone }}</span>
                                <div>
                                    <div style="font-weight:700;font-size:15px">{{ $cat->nom }}</div>
                                    <div style="font-size:12px;color:#6B7280">{{ $cat->plats_count }} plat(s)</div>
                                </div>
                            </div>
                            <span class="badge-statut" style="background:{{ $cat->actif ? '#D1FAE5' : '#FEE2E2' }};color:{{ $cat->actif ? '#065F46' : '#991B1B' }}">
                                {{ $cat->actif ? 'Active' : 'Inactive' }}
                            </span>
                        </div>

                        <div class="d-flex gap-2 mt-3">
                            <button class="btn btn-sm flex-fill" style="background:#F5F5F3;border:1px solid #E5E7EB;border-radius:8px;font-size:12px"
                                data-bs-toggle="modal" data-bs-target="#modalEdit{{ $cat->id }}">
                                <i class="bi bi-pencil"></i> Modifier
                            </button>
                            <form action="{{ route('gerant.categories.toggle', $cat) }}" method="POST" class="flex-fill">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-sm w-100" style="background:#F5F5F3;border:1px solid #E5E7EB;border-radius:8px;font-size:12px">
                                    <i class="bi bi-toggle-{{ $cat->actif ? 'on' : 'off' }}"></i> {{ $cat->actif ? 'Désactiver' : 'Activer' }}
                                </button>
                            </form>
                            <form action="{{ route('gerant.categories.destroy', $cat) }}" method="POST"
                                onsubmit="return confirm('Supprimer cette catégorie ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background:#FEE2E2;border:1px solid #FECACA;border-radius:8px;color:#991B1B;font-size:12px;padding:6px 10px">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Modal Modifier --}}
                <div class="modal fade" id="modalEdit{{ $cat->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="border-radius:16px">
                            <form action="{{ route('gerant.categories.update', $cat) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" style="font-size:16px">Modifier la catégorie</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label" style="font-size:13px;font-weight:600">Icône (emoji)</label>
                                        <input type="text" name="icone" class="form-control" value="{{ $cat->icone }}" maxlength="10">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="font-size:13px;font-weight:600">Nom de la catégorie</label>
                                        <input type="text" name="nom" class="form-control" value="{{ $cat->nom }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm" data-bs-dismiss="modal" style="background:#F5F5F3">Annuler</button>
                                    <button type="submit" class="btn btn-or btn-sm">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-folder2-open" style="font-size:48px;color:#E5E7EB"></i>
                    <p style="color:#6B7280;font-size:14px;margin-top:12px">Aucune catégorie pour le moment.</p>
                </div>
            @endforelse
        </div>

    </div>

    {{-- Modal Ajouter --}}
    <div class="modal fade" id="modalAjouter" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:16px">
                <form action="{{ route('gerant.categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-size:16px">Nouvelle catégorie</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" style="font-size:13px;font-weight:600">Icône (emoji)</label>
                            <input type="text" name="icone" class="form-control" placeholder="🍽️" maxlength="10">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="font-size:13px;font-weight:600">Nom de la catégorie</label>
                            <input type="text" name="nom" class="form-control" placeholder="Ex: Pâtes" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm" data-bs-dismiss="modal" style="background:#F5F5F3">Annuler</button>
                        <button type="submit" class="btn btn-or btn-sm">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>