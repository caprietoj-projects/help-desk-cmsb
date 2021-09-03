<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li>
                    <select class="searchable-field form-control">

                    </select>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('parametro_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/agentes*") ? "menu-open" : "" }} {{ request()->is("admin/sedes*") ? "menu-open" : "" }} {{ request()->is("admin/prioridads*") ? "menu-open" : "" }} {{ request()->is("admin/incidentes*") ? "menu-open" : "" }} {{ request()->is("admin/estados*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.parametro.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('agente_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.agentes.index") }}" class="nav-link {{ request()->is("admin/agentes") || request()->is("admin/agentes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-address-card">

                                        </i>
                                        <p>
                                            {{ trans('cruds.agente.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('sede_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.sedes.index") }}" class="nav-link {{ request()->is("admin/sedes") || request()->is("admin/sedes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-home">

                                        </i>
                                        <p>
                                            {{ trans('cruds.sede.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('prioridad_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.prioridads.index") }}" class="nav-link {{ request()->is("admin/prioridads") || request()->is("admin/prioridads/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-battery-three-quarters">

                                        </i>
                                        <p>
                                            {{ trans('cruds.prioridad.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('incidente_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.incidentes.index") }}" class="nav-link {{ request()->is("admin/incidentes") || request()->is("admin/incidentes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-exclamation-triangle">

                                        </i>
                                        <p>
                                            {{ trans('cruds.incidente.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('estado_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.estados.index") }}" class="nav-link {{ request()->is("admin/estados") || request()->is("admin/estados/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-archway">

                                        </i>
                                        <p>
                                            {{ trans('cruds.estado.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('ticket_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.tickets.index") }}" class="nav-link {{ request()->is("admin/tickets") || request()->is("admin/tickets/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-ticket-alt">

                            </i>
                            <p>
                                {{ trans('cruds.ticket.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('user_alert_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.user-alerts.index") }}" class="nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-bell">

                            </i>
                            <p>
                                {{ trans('cruds.userAlert.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('reporte_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.reportes.index") }}" class="nav-link {{ request()->is("admin/reportes") || request()->is("admin/reportes/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-indent">

                            </i>
                            <p>
                                {{ trans('cruds.reporte.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('sistema_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/fichas-tecnicas*") ? "menu-open" : "" }} {{ request()->is("admin/componentes*") ? "menu-open" : "" }} {{ request()->is("admin/imprimirs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-tv">

                            </i>
                            <p>
                                {{ trans('cruds.sistema.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('fichas_tecnica_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.fichas-tecnicas.index") }}" class="nav-link {{ request()->is("admin/fichas-tecnicas") || request()->is("admin/fichas-tecnicas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-atlas">

                                        </i>
                                        <p>
                                            {{ trans('cruds.fichasTecnica.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('componente_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.componentes.index") }}" class="nav-link {{ request()->is("admin/componentes") || request()->is("admin/componentes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-key">

                                        </i>
                                        <p>
                                            {{ trans('cruds.componente.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('imprimir_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.imprimirs.index") }}" class="nav-link {{ request()->is("admin/imprimirs") || request()->is("admin/imprimirs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-print">

                                        </i>
                                        <p>
                                            {{ trans('cruds.imprimir.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('mantenimiento_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/hojas-de-vida-mantenimientos*") ? "menu-open" : "" }} {{ request()->is("admin/imprimirmtos*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-toolbox">

                            </i>
                            <p>
                                {{ trans('cruds.mantenimiento.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('hojas_de_vida_mantenimiento_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.hojas-de-vida-mantenimientos.index") }}" class="nav-link {{ request()->is("admin/hojas-de-vida-mantenimientos") || request()->is("admin/hojas-de-vida-mantenimientos/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-wrench">

                                        </i>
                                        <p>
                                            {{ trans('cruds.hojasDeVidaMantenimiento.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('imprimirmto_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.imprimirmtos.index") }}" class="nav-link {{ request()->is("admin/imprimirmtos") || request()->is("admin/imprimirmtos/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-print">

                                        </i>
                                        <p>
                                            {{ trans('cruds.imprimirmto.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @php($unread = \App\Models\QaTopic::unreadCount())
                    <li class="nav-item">
                        <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }} nav-link">
                            <i class="fa-fw fa fa-envelope nav-icon">

                            </i>
                            <p>{{ trans('global.messages') }}</p>
                            @if($unread > 0)
                                <strong>( {{ $unread }} )</strong>
                            @endif

                        </a>
                    </li>
                    @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                        @can('profile_password_edit')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                    <i class="fa-fw fas fa-key nav-icon">
                                    </i>
                                    <p>
                                        {{ trans('global.change_password') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            <p>
                                <i class="fas fa-fw fa-sign-out-alt nav-icon">

                                </i>
                                <p>{{ trans('global.logout') }}</p>
                            </p>
                        </a>
                    </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>