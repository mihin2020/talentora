<div>
    <div wire:ignore.self class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Contacter les meilleurs candidats</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <div class="modal-body">
                    <form wire:submit.prevent="sendEmail">

                        <div class="mb-3">

                            <label class="form-label d-flex justify-content-between align-items-center">
                                Sélectionner des candidats :
                                <button type="button" wire:click="toggleSelectAll" class="btn btn-sm btn-primary">
                                    {{ $selectAll ? 'Tout décocher' : 'Tout sélectionner' }}
                                </button>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Sélection</th>
                                            <th scope="col">Prénom</th>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Téléphone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($candidats as $index => $candidat)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <input type="checkbox" value="{{ $candidat->id }}" wire:model="selectedCandidats">
                                            </td>
                                            <td>{{ $candidat->user->firstname }}</td>
                                            <td>{{ $candidat->user->lastname }}</td>
                                            <td>{{ $candidat->user->email }}</td>
                                            <td>{{ $candidat->user->phone }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Message :</label>
                            <textarea class="form-control" wire:model="message" cols="30" rows="5" required></textarea>
                            @error('message') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Joindre un fichier (optionnel) :</label>
                            <input type="file" class="form-control" wire:model="pieceJointe">
                            @error('pieceJointe') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Envoyer l'email</button>

                    </form>
                </div>

            </div>
        </div>
    </div>

</div>

<script>
    Livewire.on('close-modal', () => {
        var modal = bootstrap.Modal.getInstance(document.getElementById('contactModal'));
        if (modal) {
            modal.hide();
        }
    });
</script>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('close-modal', () => {
            var contactModal = new bootstrap.Modal(document.getElementById('contactModal'));
            contactModal.hide();
        });
    });
</script>
