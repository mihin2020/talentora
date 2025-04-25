@extends('admin.layouts.main')
@section('content')
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
                                        <a href="index.html" class="brand-logo">
                                            <svg class="logo-abbr me-1" xmlns="http://www.w3.org/2000/svg" width="62.074" height="65.771" viewBox="0 0 62.074 65.771">
                                                <g id="search_11_" data-name="search (11)" transform="translate(12.731 12.199)">
                                                    <rect class="rect-primary-rect" id="Rectangle_1" data-name="Rectangle 1" width="60" height="60" rx="30" transform="translate(-10.657 -12.199)" fill="#f73a0b" />
                                                    <path id="Path_2001" data-name="Path 2001" d="M32.7,5.18a17.687,17.687,0,0,0-25.8,24.176l-19.8,21.76a1.145,1.145,0,0,0,0,1.62,1.142,1.142,0,0,0,.81.336,1.142,1.142,0,0,0,.81-.336l19.8-21.76a17.687,17.687,0,0,0,29.357-13.29A17.57,17.57,0,0,0,32.7,5.18Zm-1.62,23.392A15.395,15.395,0,0,1,9.312,6.8,15.395,15.395,0,1,1,31.083,28.572Zm0,0" transform="translate(1 0)" fill="#fff" stroke="#fff" stroke-width="1" />
                                                    <path id="Path_2002" data-name="Path 2002" d="M192.859,115.547a4.523,4.523,0,0,0,.7-2.415v-2.284a4.55,4.55,0,0,0-9.1,0v2.284a4.523,4.523,0,0,0,.7,2.415,4.954,4.954,0,0,0-3.708,4.788v1.623a2.4,2.4,0,0,0,2.4,2.4h10.323a2.4,2.4,0,0,0,2.4-2.4v-1.623a4.954,4.954,0,0,0-3.708-4.788Zm-6.114-4.7a2.259,2.259,0,0,1,4.518,0v2.284a2.259,2.259,0,1,1-4.518,0Zm7.53,11.111a.11.11,0,0,1-.11.11H183.843a.11.11,0,0,1-.11-.11v-1.623a2.656,2.656,0,0,1,2.653-2.653h5.237a2.656,2.656,0,0,1,2.653,2.653Zm0,0" transform="translate(-168.591 -98.178)" fill="#fff" stroke="#fff" stroke-width="1" />
                                                </g>
                                            </svg>
                                        </a>
                                    </div>

                                    @if (session('success'))
                                    <div class="alert alert-warning alert-dismissible fade show">
                                        <strong>Attention !</strong> {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif

                                    <h4 class="text-center mb-4">Formulaire d'inscription</h4>

                                    <form action="{{ route('entreprise.storeEntreprise') }}" method="POST">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Nom de l’entreprise</strong></label>
                                            <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                                name="firstname" value="{{ old('firstname') }}" placeholder="Entrez le nom de l'entreprise" required>
                                            @error('firstname')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Adresse Email</strong></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" placeholder="Entrez une adresse email valide" required>
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Numéro de téléphone</strong></label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                name="phone" value="{{ old('phone') }}" placeholder="Ex: 70-00-00-00" required>
                                            @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        @auth
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block mb-3">Inscription</button>
                                        </div>
                                        @endauth

                                        @guest
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">S’inscrire</button>
                                        </div>
                                        <div class="new-account mt-3 text-center">
                                        <p>Vous avez déjà un compte? <a class="text-primary" href="{{ route('login') }}">Connectez-vous</a></p>
                                        @endguest

                                       
                                    </form>

                                    @auth
                                    <a href="{{ route('dashboard') }}" class="btn btn-dark btn-block">
                                        Dashboard
                                    </a>

                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection