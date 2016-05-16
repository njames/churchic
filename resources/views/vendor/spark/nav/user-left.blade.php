<!-- Left Side Of Navbar -->

<li class="dropdown">
    <!-- User Photo / Name -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        Integrations
        <span class="caret"></span>
    </a>

    <ul class="dropdown-menu" role="menu">

        <!-- Integrations -->
        <li class="dropdown-header">Integrations</li>

        <li>
            <a href="/integrations">
                <i class="fa fa-fw fa-btn fa-fort-awesome"></i>Integrations
            </a>
        </li>
        <li>
            <a href="/integrations/config">
                <i class="fa fa-fw fa-btn fa-cog"></i>Integration Configuration
            </a>
        </li>

        <li>
            <a href="/integrations/groups">
                <i class="fa fa-fw fa-btn fa-users"></i>Groups
            </a>
        </li>
        <li class="divider"></li>

        <!-- @todo Items to be modified       -->

        <!-- Subscription Reminders -->
        @include('spark::nav.subscriptions')

        <!-- Settings -->
        <li class="dropdown-header">Settings</li>

        <!-- Your Settings -->
        <li>
            <a href="/settings">
                <i class="fa fa-fw fa-btn fa-cog"></i>Your Settings
            </a>
        </li>

        @if (Spark::usesTeams())
            <!-- Team Settings -->
            @include('spark::nav.blade.teams')
        @endif

        <li class="divider"></li>

        <!-- Logout -->
        <li>
            <a href="/logout">
                <i class="fa fa-fw fa-btn fa-sign-out"></i>Logout
            </a>
        </li>
    </ul>
</li>
