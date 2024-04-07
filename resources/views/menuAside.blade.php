<div id="container">
<div id="content">
<aside id="sous-menu">
        <ul>
          <li><a href="#">Recherche</a></li>
          <ol class="option">
            <li><a href="{{ route('activity.index') }}">Activités</a></li>
            <li><a href="{{ route('mission.index') }}">Missions</a></li>
            <li><a href="{{ route('rule.index') }}">Règles</a></li>
            <li><a href="{{ route('typology.index') }}">Typologies</a></li>
            <li><a href="{{ route('reference.index') }}">références</a></li>
            <li><a href="{{ route('basket.index') }}">Paniers</a></li>
          </ol>

          <li><a href="#">Ajouter</a></li>
          <ol class="option">
            <li><a href="{{ route('activity.create') }}">Une classe</a></li>
            <li><a href="{{ route('mission.create') }}">Un domaine</a></li>
            <li><a href="{{ route('rule.create') }}">Un règle</a></li>
            <li><a href="{{ route('typology.create') }}">Une typologie</a></li>
            <li><a href="{{ route('reference.create') }}">Une réferenece</a></li>
          </ol>

          <li><a href="#">Contrôle</a></li>
          <ol class="option">
            <li><a href="{{ route('validation.index') }}">Approuvée</a></li>
            <li><a href="{{ route('validation.index') }}">Attente</a></li>
          </ol>

          <li><a href="#">Paramtre</a></li>
          <ol class="option">
            <li><a href="{{ route('setting.index') }}">Mon compte</a></li>
            <li><a href="{{ route('setting.index') }}">Généraux</a></li>
          </ol>


          <li><a href="#">Forum</a></li>
          <ol class="option">
            <li><a href="{{ route('forum.index') }}">Nouveautés</a></li>
            <li><a href="{{ route('forum.index') }}">Sujets épinglés</a></li>
            <li><a href="{{ route('forum.index') }}">En ligne</a></li>
          </ol>
        </ul>
</aside>
</div>
