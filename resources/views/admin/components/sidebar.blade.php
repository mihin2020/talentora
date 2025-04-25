<div class="dlabnav">
    <div class="dlabnav-scroll">
        <div class="dropdown header-profile2 ">
            <a class="nav-link " href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                <div class="header-info2 d-flex align-items-center">
                    @php
                    $photo = Auth::user()->role->name === 'Administrateur'
                    ? 'images/profile/photo.png'
                    : (Auth::user()->profile->photo ?? 'images/profile/entreprise.jpg');
                    @endphp

                    <img src="{{ asset(Str::startsWith($photo, 'entreprises/') ? 'storage/' . $photo : $photo) }}" alt="Photo de profil" class="rounded-full w-10 h-10 object-cover">

                    <div class="d-flex align-items-center sidebar-info">
                        <div>
                            <span class="font-w400 d-block">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
                            <small class="text-end font-w400">{{ Auth::user()->role->name }}</small>
                        </div>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a href="{{ route('edit.profile') }}" class="dropdown-item ai-icon ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span class="ms-2">Mon profil</span>
                </a>
                @include('admin.components.logout')

            </div>
        </div>
        <ul class="metismenu" id="menu">
            <li><a class="has-arrow " href="{{ route('dashboard') }}" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <!-- <ul aria-expanded="false">
                    <li><a href="">Les postes à pourvoir</a></li>
                    <li><a href="">Les statistiques</a></li>
                    <li><a href="">Les entreprises</a></li>
                </ul> -->

            </li>

            @can('access-entreprise')
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-building"></i>
                    <span class="nav-text">Gestion d'entreprise</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('entreprise.index') }}">Liste des entreprises</a></li>
                    <li><a href="{{ route('admin.addEntreprise') }}">Ajouter une entreprise</a></li>
                </ul>
            </li>
            @endcan

            @can('is-admin')

            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-building"></i>
                    <span class="nav-text">Mon entreprise</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('entreprise.index') }}">Aperçu</a></li>
                </ul>
            </li>

            <li class="mt-2">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-briefcase"></i>
                    <span class="nav-text">Gestion d'offre</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('entreprise.offre.create') }}">Créer une offre</a></li>
                    <li><a href="{{ route('entreprise.offre.index') }}">Liste de mes offres</a></li>
                </ul>
            </li>

            <li class="mt-2">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-users"></i>
                    <span class="nav-text">Candidature</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{  route('candidatures.mesCandidatures') }}">Mes candidatures</a></li>
                    <li><a href="{{ route('candidatures.selectionne') }}">Mes candidatures selectionnées</a></li>
                </ul>
            </li>
            @endcan

        </ul>
    </div>
</div>