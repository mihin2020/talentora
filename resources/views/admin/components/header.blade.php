
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                        Dashboard
                    </div>
                    @include('admin.components.search')
                </div>
                <ul class="navbar-nav header-right">

                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                        @php
                    $photo = Auth::user()->role->name === 'Administrateur'
                    ? 'images/profile/photo.png'
                    : (Auth::user()->profile->photo ?? 'images/profile/entreprise.jpg');
                    @endphp

                    <img src="{{ asset(Str::startsWith($photo, 'entreprises/') ? 'storage/' . $photo : $photo) }}" alt="Photo de profil" width="20">
                    
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="{{ route('edit.profile') }}" class="dropdown-item ai-icon">
                                <svg id="icon-user2"  class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span class="ms-2">Mon profile </span>
                            </a>
                            @include('admin.components.logout')
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
  
