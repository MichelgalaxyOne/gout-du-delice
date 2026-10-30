<x-app-layout>
    <x-slot name="header">
        <h2>🍽️ Gestion des plats</h2>
    </x-slot>

    <div class="p-3 p-md-4">

        @if(session('success'))
            <div class="alert alert-success" style="border-radius:10px;font-size:14px">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-or" data-bs-toggle="modal" data-bs-target="#modalAjouterPlat">
                <i class="bi bi-plus-circle me-1"></i> Nouveau plat
            </button>
        </div>

        <div class="row g-3">
            @forelse($plats as $plat)
                @php $imgPrincipale = $plat->images->where('principale', true)->first() ?? $plat->images->first(); @endphp
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="bg-white rounded-3 overflow-hidden" style="box-shadow:0 2px 10px rgba(0,0,0,0.06)">
                        @if($imgPrincipale)
                            <img src="{{ asset('storage/'.$imgPrincipale->image) }}" style="width:100%;height:160px;object-fit:cover">
                        @else
                            <div style="height:160px;background:#1a1a1a;display:flex;align-items:center;justify-content:center">
                                <i class="bi bi-egg-fried" style="font-size:36px;color:#C9A227"></i>
                            </div>
                        @endif

                        <div class="p-3">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <div style="font-weight:700;font-size:15px">{{ $plat->nom }}</div>
                                <span class="badge-statut" style="background:{{ $plat->disponible ? '#D1FAE5' : '#FEE2E2' }};color:{{ $plat->disponible ? '#065F46' : '#991B1B' }}">
                                    {{ $plat->disponible ? 'Disponible' : 'Indisponible' }}
                                </span>
                            </div>
                            <div style="font-size:12px;color:#6B7280;margin-bottom:6px">
    {{ $plat->categorie->icone }} {{ $plat->categorie->nom }} · {{ $plat->images->count() }} photo(s)
</div>

@if($plat->description)
    <p style="font-size:12.5px;color:#4B5563;margin-bottom:8px;line-height:1.5">
        {{ Str::limit($plat->description, 80) }}
    </p>
@endif

<div style="font-weight:700;color:#C9A227;font-size:16px;margin-bottom:10px">
    {{ number_format($plat->prix, 0, ',', ' ') }} FCFA
</div>

                            <div class="d-flex gap-2">
                                <button class="btn btn-sm flex-fill" style="background:#F5F5F3;border:1px solid #E5E7EB;border-radius:8px;font-size:12px"
                                    data-bs-toggle="modal" data-bs-target="#modalEditPlat{{ $plat->id }}">
                                    <i class="bi bi-pencil"></i> Modifier
                                </button>
                                <form action="{{ route('gerant.plats.toggle', $plat) }}" method="POST" class="flex-fill">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-sm w-100" style="background:#F5F5F3;border:1px solid #E5E7EB;border-radius:8px;font-size:12px">
                                        <i class="bi bi-toggle-{{ $plat->disponible ? 'on' : 'off' }}"></i>
                                    </button>
                                </form>
                                <form action="{{ route('gerant.plats.destroy', $plat) }}" method="POST"
                                    onsubmit="return confirm('Supprimer ce plat ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm" style="background:#FEE2E2;border:1px solid #FECACA;border-radius:8px;color:#991B1B;font-size:12px;padding:6px 10px">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Modifier --}}
                <div class="modal fade" id="modalEditPlat{{ $plat->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content" style="border-radius:16px">
                            <form action="{{ route('gerant.plats.update', $plat) }}" method="POST" enctype="multipart/form-data" class="plat-form" data-plat-id="{{ $plat->id }}">
                                @csrf @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" style="font-size:16px">Modifier {{ $plat->nom }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label" style="font-size:13px;font-weight:600">Catégorie</label>
                                            <select name="categorie_id" class="form-select" required>
                                                @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}" {{ $plat->categorie_id == $cat->id ? 'selected' : '' }}>{{ $cat->icone }} {{ $cat->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" style="font-size:13px;font-weight:600">Prix (FCFA)</label>
                                            <input type="number" name="prix" class="form-control" value="{{ $plat->prix }}" required>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" style="font-size:13px;font-weight:600">Nom du plat</label>
                                            <input type="text" name="nom" class="form-control" value="{{ $plat->nom }}" required>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" style="font-size:13px;font-weight:600">Description</label>
                                            <textarea name="description" class="form-control" rows="2">{{ $plat->description }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" style="font-size:13px;font-weight:600">Temps préparation (min)</label>
                                            <input type="number" name="temps_preparation" class="form-control" value="{{ $plat->temps_preparation }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" style="font-size:13px;font-weight:600">Allergènes</label>
                                            <input type="text" name="allergenes" class="form-control" value="{{ $plat->allergenes }}" placeholder="Ex: Gluten, lactose">
                                        </div>

                                        {{-- Photos existantes --}}
                                        @if($plat->images->count() > 0)
                                            <div class="col-12">
                                                <label class="form-label" style="font-size:13px;font-weight:600">Photos actuelles</label>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @foreach($plat->images as $img)
                                                        <div class="position-relative" data-image-id="{{ $img->id }}">
                                                            <img src="{{ asset('storage/'.$img->image) }}"
                                                                style="width:80px;height:65px;object-fit:cover;border-radius:8px;
                                                                {{ $img->principale ? 'border:3px solid #C9A227' : 'border:2px solid #E5E7EB' }}">
                                                            @if($img->principale)
                                                                <span class="position-absolute bottom-0 start-0" style="background:#C9A227;color:white;font-size:8px;padding:1px 5px;border-radius:0 0 0 6px">★</span>
                                                            @endif
                                                            <button type="button" onclick="supprimerImagePlat({{ $img->id }}, this)"
                                                                style="position:absolute;top:-6px;right:-6px;width:18px;height:18px;background:#EF4444;color:white;border:none;border-radius:50%;font-size:10px;cursor:pointer">✕</button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Ajouter photos --}}
                                        <div class="col-12">
                                            <label class="form-label" style="font-size:13px;font-weight:600">Ajouter des photos</label>
                                            <div style="border:2px dashed #C9A227;border-radius:10px;padding:14px;text-align:center;background:#FFFBF0;cursor:pointer"
                                                onclick="document.getElementById('imgInput{{ $plat->id }}').click()">
                                                <i class="bi bi-cloud-upload" style="color:#C9A227;font-size:20px"></i>
                                                <p style="margin:4px 0 0;font-size:12px;color:#0F0F0F">Cliquez pour ajouter des photos</p>
                                            </div>
                                            <input type="file" id="imgInput{{ $plat->id }}" accept="image/*" multiple style="display:none" onchange="ajouterImagesPlat(this, {{ $plat->id }})">
                                            <div id="preview{{ $plat->id }}" class="d-flex flex-wrap gap-2 mt-2"></div>
                                        </div>
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
                    <i class="bi bi-egg-fried" style="font-size:48px;color:#E5E7EB"></i>
                    <p style="color:#6B7280;font-size:14px;margin-top:12px">Aucun plat pour le moment.</p>
                </div>
            @endforelse
        </div>

    </div>

    {{-- Modal Ajouter --}}
    <div class="modal fade" id="modalAjouterPlat" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius:16px">
                <form method="POST" enctype="multipart/form-data" id="formAjouterPlat">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-size:16px">Nouveau plat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" style="font-size:13px;font-weight:600">Catégorie</label>
                                <select name="categorie_id" class="form-select" required>
                                    <option value="">-- Choisir --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->icone }} {{ $cat->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="font-size:13px;font-weight:600">Prix (FCFA)</label>
                                <input type="number" name="prix" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label" style="font-size:13px;font-weight:600">Nom du plat</label>
                                <input type="text" name="nom" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label" style="font-size:13px;font-weight:600">Description</label>
                                <textarea name="description" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="font-size:13px;font-weight:600">Temps préparation (min)</label>
                                <input type="number" name="temps_preparation" class="form-control" value="15" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="font-size:13px;font-weight:600">Allergènes</label>
                                <input type="text" name="allergenes" class="form-control" placeholder="Ex: Gluten, lactose">
                            </div>
                            <div class="col-12">
                                <label class="form-label" style="font-size:13px;font-weight:600">Photos</label>
                                <div style="border:2px dashed #C9A227;border-radius:10px;padding:16px;text-align:center;background:#FFFBF0;cursor:pointer"
                                    onclick="document.getElementById('imgInputNew').click()">
                                    <i class="bi bi-cloud-upload" style="color:#C9A227;font-size:24px"></i>
                                    <p style="margin:6px 0 0;font-size:13px;color:#0F0F0F">Cliquez pour ajouter des photos</p>
                                    <p style="margin:0;font-size:11px;color:#6B7280">La première sera l'image principale</p>
                                </div>
                                <input type="file" id="imgInputNew" accept="image/*" multiple style="display:none" onchange="ajouterImagesNouveau(this)">
                                <div id="previewNew" class="d-flex flex-wrap gap-2 mt-2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm" data-bs-dismiss="modal" style="background:#F5F5F3">Annuler</button>
                        <button type="submit" class="btn btn-or btn-sm" id="btnSubmitNew">Créer le plat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // ══ NOUVEAU PLAT — upload multiple ══
        let nouveauxFichiers = [];

        function ajouterImagesNouveau(input) {
            Array.from(input.files).forEach(f => nouveauxFichiers.push(f));
            input.value = '';
            previewNouveau();
        }

        function supprimerNouveau(index) {
            nouveauxFichiers.splice(index, 1);
            previewNouveau();
        }

        function previewNouveau() {
            const container = document.getElementById('previewNew');
            container.innerHTML = '';
            nouveauxFichiers.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = e => {
                    const div = document.createElement('div');
                    div.style.cssText = 'position:relative';
                    div.innerHTML = `
                        <img src="${e.target.result}" style="width:70px;height:55px;object-fit:cover;border-radius:8px;${index === 0 ? 'border:3px solid #C9A227' : 'border:2px solid #E5E7EB'}">
                        <button type="button" onclick="supprimerNouveau(${index})" style="position:absolute;top:-6px;right:-6px;width:18px;height:18px;background:#EF4444;color:white;border:none;border-radius:50%;font-size:10px;cursor:pointer">✕</button>
                    `;
                    container.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }

        document.getElementById('formAjouterPlat').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;
            const btn = document.getElementById('btnSubmitNew');
            btn.disabled = true;
            btn.innerHTML = 'Création...';

            const formData = new FormData(form);
            nouveauxFichiers.forEach(f => formData.append('images[]', f));

            fetch("{{ route('gerant.plats.store') }}", {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                } else {
                    window.location.reload();
                }
            })
            .catch(() => {
                alert('Erreur lors de la création du plat.');
                btn.disabled = false;
                btn.innerHTML = 'Créer le plat';
            });
        });

        // ══ MODIFIER PLAT — upload multiple ══
        let fichiersParPlat = {};

        function ajouterImagesPlat(input, platId) {
            if (!fichiersParPlat[platId]) fichiersParPlat[platId] = [];
            Array.from(input.files).forEach(f => fichiersParPlat[platId].push(f));
            input.value = '';
            previewPlat(platId);
        }

        function supprimerNouveauPlat(platId, index) {
            fichiersParPlat[platId].splice(index, 1);
            previewPlat(platId);
        }

        function previewPlat(platId) {
            const container = document.getElementById('preview' + platId);
            container.innerHTML = '';
            (fichiersParPlat[platId] || []).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = e => {
                    const div = document.createElement('div');
                    div.style.cssText = 'position:relative';
                    div.innerHTML = `
                        <img src="${e.target.result}" style="width:70px;height:55px;object-fit:cover;border-radius:8px;border:2px solid #E5E7EB">
                        <button type="button" onclick="supprimerNouveauPlat(${platId}, ${index})" style="position:absolute;top:-6px;right:-6px;width:18px;height:18px;background:#EF4444;color:white;border:none;border-radius:50%;font-size:10px;cursor:pointer">✕</button>
                    `;
                    container.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }

        document.querySelectorAll('.plat-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const platId = form.dataset.platId;
                const formData = new FormData(form);
                (fichiersParPlat[platId] || []).forEach(f => formData.append('images[]', f));

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(response => {
                    if (response.redirected) {
                        window.location.href = response.url;
                    } else {
                        window.location.reload();
                    }
                })
                .catch(() => alert('Erreur lors de la modification.'));
            });
        });

        // ══ SUPPRIMER IMAGE EXISTANTE ══
        function supprimerImagePlat(imageId, btn) {
            if (!confirm('Supprimer cette photo ?')) return;

            fetch(`/gerant/plat-images/${imageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    btn.closest('[data-image-id]').remove();
                }
            });
        }
    </script>

</x-app-layout>