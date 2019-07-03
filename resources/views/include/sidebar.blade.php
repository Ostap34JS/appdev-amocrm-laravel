<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image"/>
        <div>
            <p class="app-sidebar__user-name">{{ auth()->user()->name }}</p>
            <p class="app-sidebar__user-designation">{{ auth()->user()->email }}</p>
        </div>
    </div>
    <ul class="app-menu">
        <li>
            <a class="app-menu__item" href="{{ route('contacts.index') }}">
                <i class="app-menu__icon fa fa-book"></i>
                <span class="app-menu__label">Contacts</span>
            </a>
        </li>
    </ul>
</aside>

