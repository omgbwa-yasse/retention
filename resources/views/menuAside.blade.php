<div id="container">
<div id="content">
<aside id="sous-menu" class="bg-light" style="min-height: 100vh;">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active bg-dark text-white" data-toggle="collapse" href="#recherche" aria-expanded="true"><i class="bi bi-search"></i> Recherche</a>
            <div class="collapse show" id="recherche">
                <ul class="list-unstyled pl-3">
                    <li><a href="{{ route('activity.index') }}" class="text-dark"><i class="bi bi-list-check"></i> Activités</a></li>
                    <li><a href="{{ route('mission.index') }}" class="text-dark"><i class="bi bi-list-check"></i> Missions</a></li>
                    <li><a href="{{ route('rule.index') }}" class="text-dark"><i class="bi bi-list-check"></i> Règles</a></li>
                    <li><a href="{{ route('typology.index') }}" class="text-dark"><i class="bi bi-list-check"></i> Typologies</a></li>
                    <li><a href="{{ route('reference.index') }}" class="text-dark"><i class="bi bi-list-check"></i> Références</a></li>
                    <li><a href="{{ route('basket.index') }}" class="text-dark"><i class="bi bi-list-check"></i> Paniers</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link bg-dark text-white" data-toggle="collapse" href="#ajouter"><i class="bi bi-plus-circle"></i> Ajouter</a>
            <div class="collapse" id="ajouter">
                <ul class="list-unstyled pl-3">
                    <li><a href="{{ route('activity.create') }}" class="text-dark"><i class="bi bi-plus-square"></i> Une classe</a></li>
                    <li><a href="{{ route('mission.create') }}" class="text-dark"><i class="bi bi-plus-square"></i> Un domaine</a></li>
                    <li><a href="{{ route('rule.create') }}" class="text-dark"><i class="bi bi-plus-square"></i> Un règle</a></li>
                    <li><a href="{{ route('typology.create') }}" class="text-dark"><i class="bi bi-plus-square"></i> Une typologie</a></li>
                    <li><a href="{{ route('reference.create') }}" class="text-dark"><i class="bi bi-plus-square"></i> Une référence</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link bg-dark text-white" data-toggle="collapse" href="#controle"><i class="bi bi-shield-check"></i> Contrôle</a>
            <div class="collapse" id="controle">
                <ul class="list-unstyled pl-3">
                    <li><a href="{{ route('validation.index') }}" class="text-dark"><i class="bi bi-check-circle"></i> Approuvée</a></li>
                    <li><a href="{{ route('validation.index') }}" class="text-dark"><i class="bi bi-hourglass-split"></i> Attente</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link bg-dark text-white" data-toggle="collapse" href="#parametre"><i class="bi bi-gear"></i> Paramètre</a>
            <div class="collapse" id="parametre">
                <ul class="list-unstyled pl-3">
                    <li><a href="{{ route('setting.index') }}" class="text-dark"><i class="bi bi-person-circle"></i> Mon compte</a></li>
                    <li><a href="{{ route('setting.index') }}" class="text-dark"><i class="bi bi-sliders"></i> Généraux</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link bg-dark text-white" data-toggle="collapse" href="#forum"><i class="bi bi-chat-dots"></i> Forum</a>
            <div class="collapse" id="forum">
                <ul class="list-unstyled pl-3">
                    <li><a href="{{ route('forum.index') }}" class="text-dark"><i class="bi bi-chat-square-dots"></i> Nouveautés</a></li>
                    <li><a href="{{ route('forum.index') }}" class="text-dark"><i class="bi bi-chat-square-dots"></i> Sujets épinglés</a></li>
                    <li><a href="{{ route('forum.index') }}" class="text-dark"><i class="bi bi-chat-square-dots"></i> En ligne</a></li>
                </ul>
            </div>
        </li>
    </ul>
</aside>
</div>
</div>
