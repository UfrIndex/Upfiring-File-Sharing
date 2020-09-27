@if (Auth::user()->role_id == 3 )
    <li class="sidebar-item">
        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.user.index') }}" aria-expanded="false">
            <i class="fas fa-users"></i> <span class="hide-menu">{{ __('message.all_users') }}</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.pages.index') }}" aria-expanded="false">
            <i class="fas fa-copy"></i> <span class="hide-menu">{{ __('message.pages') }}</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.setting.index') }}" aria-expanded="false">
            <i class="fas fa-cogs"></i> <span class="hide-menu">{{ __('message.pages') }}</span>
        </a>
    </li>

@endif

<li class="sidebar-item">
    <a class="sidebar-link has-arrow waves-effect waves-dark"  aria-expanded="false">
        <i class="fas fa-copy"></i> <span class="hide-menu">{{ __('message.ufr_files') }}</span>
    </a>
    <ul aria-expanded="false" class="collapse  first-level">
        <li class="sidebar-item"><a href="{{ route('admin.files.index') }}?show=hidden&find=" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> {{ __('message.for_approval') }} </span></a></li>
        <li class="sidebar-item"><a href="{{ route('admin.files.index') }}?show=show&find=" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> {{ __('message.approved') }} </span></a></li>
    </ul>
</li>

<li class="sidebar-item">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.report.index') }}" aria-expanded="false">
        <i class="fas fa-bullhorn"></i> <span class="hide-menu">Reports</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.comments.index') }}" aria-expanded="false">
        <i class="fas fa-copy"></i> <span class="hide-menu">{{ __('message.comments') }}</span>
    </a>
</li>

@if (Auth::user()->role_id == 3 )

    <li class="sidebar-item">
        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.advertising_management') }}" aria-expanded="false">
            <i class="fab fa-amazon-pay"></i> <span class="hide-menu">{{ __('message.advertising_management') }}</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.site_options') }}" aria-expanded="false">
            <i class="fas fa-wrench"></i> <span class="hide-menu">{{ __('message.website_options') }}</span>
        </a>
    </li>

@endif
