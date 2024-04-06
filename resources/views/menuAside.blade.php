<div id="container">
<div id="content">
<aside id="sous-menu">
        <ul>
          <li><a href="#">Recherche</a></li>
          <ol class="option">
            <li><a href="{{ route('searchActivity') }}">Activités</a></li>
            <li><a href="{{ route('searchRule') }}">Règles</a></li>
            <li><a href="{{ route('searchTypology') }}">Typologies</a></li>
            <li><a href="{{ route('searchReference') }}">références</a></li>
            <li><a href="{{ route('searchBasket') }}">Paniers</a></li>
          </ol>

          <li><a href="#">Ajouter</a></li>
          <ol class="option">
            <li><a href="{{ route('addActivity') }}">Une classe</a></li>
            <li><a href="{{ route('addMission') }}">Un domaine</a></li>
            <li><a href="{{ route('addRule') }}">Un règle</a></li>
            <li><a href="{{ route('addTypology') }}">Un typologie</a></li>
          </ol>

          <li><a href="#">Contrôle</a></li>
          <ol class="option">
            <li><a href="{{ route('approved') }}">Approuvée</a></li>
            <li><a href="{{ route('noApproved') }}">Attente</a></li>
          </ol>

          <li><a href="#">Paramtre</a></li>
          <ol class="option">
            <li><a href="{{ route('settingUser') }}">Mon compte</a></li>
            <li><a href="{{ route('settingHome') }}">Généraux</a></li>
          </ol>


          <li><a href="#">Forum</a></li>
          <ol class="option">
            <li><a href="{{ route('forumTopic') }}">Nouveautés</a></li>
            <li><a href="{{ route('forumTopicBasket') }}">Sujets épinglés</a></li>
            <li><a href="{{ route('forumOnline') }}">En ligne</a></li>
          </ol>
        </ul>
</aside>
</div>
