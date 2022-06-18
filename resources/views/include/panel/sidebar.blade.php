<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
	<div class="scrollbar-inner">
	<!-- Brand -->
	<div class="sidenav-header bg-default align-items-center">
		<a class="navbar-brand" href="javascript:void(0)">
			<img src="{{asset('img/logo-header.svg')}}" class="navbar-brand-img" alt="...">
		</a>
	</div>
	<div class="navbar-inner">
		<!-- Collapse -->
		<div class="collapse navbar-collapse" id="sidenav-collapse-main">
			<!-- Nav items -->
			<ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/evento')) || (request()->is('admin/evento/*')) ? 'active' : '' }}" href="{{ route('panel.evento.list') }}">
                        <i class="ni ni-single-02 text-default"></i>
                        <span class="nav-link-text">Eventos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/cupon')) || (request()->is('admin/cupon/*')) ? 'active' : '' }}" href="{{ route('panel.cupon.list') }}">
                        <i class="ni ni-single-02 text-default"></i>
                        <span class="nav-link-text">Cupones</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/orden')) || (request()->is('admin/orden/*')) ? 'active' : '' }}" href="{{ route('panel.orden.list') }}">
                        <i class="ni ni-single-02 text-default"></i>
                        <span class="nav-link-text">Ventas</span>
                    </a>
                </li>
                @can(PermissionKey::Admin['permissions']['index']['name'])
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('admin/cuentas*')) ? 'active' : '' }}" href="#navbar-cuentas" data-toggle="collapse" role="button" aria-expanded="{{ (request()->is('admin/cuentas*')) ? 'true' : 'false' }}" aria-controls="navbar-cuentas">
                        <i class="ni ni-single-02 text-default"></i>
                        <span class="nav-link-text">Administración</span>
                    </a>
                    <div class="collapse {{ (request()->is('admin/cuentas*')) ? 'show' : '' }}" id="navbar-cuentas">
                        <ul class="nav nav-sm flex-column">
                            @can(PermissionKey::Admin['permissions']['index']['name'])
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('admin/cuentas/usuarios*')) ? 'active' : '' }}" href="{{ route('panel.admins.index') }}">
                                        <span class="nav-link-text">Usuarios</span>
                                    </a>
                                </li>
                            @endcan
                            @can(PermissionKey::Role['permissions']['index']['name'])
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('admin/cuentas/roles*')) ? 'active' : '' }}" href="{{ route('panel.roles.index') }}">
                                        <span class="nav-link-text">Roles</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan

			</ul>
		</div>
	</div>
	</div>
</nav>
