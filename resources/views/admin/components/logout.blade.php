<form method="POST" action="{{ route('logout') }}" id="logoutForm" class="dropdown-item ai-icon">
    @csrf
    <button type="button" class="btn btn-link p-0 text-danger d-flex align-items-center" id="logoutButton">
        <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
            <polyline points="16 17 21 12 16 7"></polyline>
            <line x1="21" y1="12" x2="9" y2="12"></line>
        </svg>
        <span class="ms-2">Se déconnecter</span>
    </button>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('logoutButton').addEventListener('click', function(e) {
        e.preventDefault(); // Empêche la soumission immédiate du formulaire

        // Afficher le modal de confirmation
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Vous allez vous déconnecter de votre compte.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, se déconnecter',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                // Soumettre le formulaire si l'utilisateur confirme
                document.getElementById('logoutForm').submit();
            }
        });
    });
</script>