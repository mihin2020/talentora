<div>
    <div class="vh-100">
        <div class="authincation h-100">
            <div class="container h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-md-6">
                        <div class="authincation-content">
                            <div class="row no-gutters">
                                <div class="col-xl-12">
                                    <div class="auth-form">
                                        <div class="text-center mb-3">
                                            <!-- Ton logo ici -->
                                        </div>

                                        @if (session()->has('success'))
                                        <div class="alert alert-warning alert-dismissible fade show">
                                            <strong>Attention !</strong> {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        </div>
                                        @endif

                                        <h4 class="text-center mb-4">Formulaire d'inscription</h4>

                                        <form wire:submit.prevent="storeEntreprise">
                                            <div class="mb-3">
                                                <label class="mb-1"><strong>Nom de l’entreprise</strong></label>
                                                <input type="text" wire:model.defer="firstname" class="form-control @error('firstname') is-invalid @enderror" placeholder="Entrez le nom de l'entreprise">
                                                @error('firstname') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="mb-1"><strong>Adresse Email</strong></label>
                                                <input type="email" wire:model.defer="email" class="form-control @error('email') is-invalid @enderror" placeholder="Entrez une adresse email valide">
                                                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="mb-1"><strong>Numéro de téléphone</strong></label>
                                                <input type="text" wire:model.defer="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Ex: 70-00-00-00">
                                                @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" wire:loading.attr="disabled" class="btn btn-primary btn-block">
                                                    <span wire:loading wire:target="storeEntreprise" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                    <span wire:loading.remove wire:target="storeEntreprise">
                                                        S’inscrire
                                                    </span>
                                                </button>
                                            </div>
                                        </form>
                                        @auth
                                        <a href="{{ route('dashboard') }}" class="btn btn-dark btn-block mt-3">
                                            Dashboard
                                        </a>
                                        @endauth

                                        @guest
                                        <div class="new-account mt-3 text-center">
                                            <p>Vous avez déjà un compte? <a class="text-primary" href="{{ route('login') }}">Connectez-vous</a></p>
                                        </div>
                                        @endguest
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>