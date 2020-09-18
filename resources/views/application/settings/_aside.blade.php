<ul class="sidebar-menu">
    <li class="sidebar-menu-item">
        <a href="{{ route('settings.account') }}" class="sidebar-menu-button {{ $tab == 'account' ? 'text-primary' : 'text-secondary' }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">person</i>
            <span class="sidebar-menu-text">{{ __('messages.account_settings') }}</span>
        </a>
    </li>

    <li class="sidebar-menu-item">
        <a href="{{ route('settings.notifications') }}" class="sidebar-menu-button {{ $tab == 'notification' ? 'text-primary' : 'text-secondary' }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">notifications</i>
            <span class="sidebar-menu-text">{{ __('messages.notification_settings') }}</span>
        </a>
    </li>

    <li class="sidebar-menu-item">
        <a href="{{ route('settings.company') }}" class="sidebar-menu-button {{ $tab == 'company' ? 'text-primary' : 'text-secondary' }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">business</i>
            <span class="sidebar-menu-text">{{ __('messages.company_settings') }}</span>
        </a>
    </li>

    <li class="sidebar-menu-item">
        <a href="{{ route('settings.preferences') }}" class="sidebar-menu-button {{ $tab == 'preferences' ? 'text-primary' : 'text-secondary' }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">tune</i>
            <span class="sidebar-menu-text">{{ __('messages.preferences') }}</span>
        </a>
    </li>

    <li class="sidebar-menu-item">
        <a href="{{ route('settings.invoice') }}" class="sidebar-menu-button {{ $tab == 'invoice' ? 'text-primary' : 'text-secondary' }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">receipt</i>
            <span class="sidebar-menu-text">{{ __('messages.invoice_settings') }}</span>
        </a>
    </li>

    <li class="sidebar-menu-item">
        <a href="{{ route('settings.estimate') }}" class="sidebar-menu-button {{ $tab == 'estimate' ? 'text-primary' : 'text-secondary' }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">description</i>
            <span class="sidebar-menu-text">{{ __('messages.estimate_settings') }}</span>
        </a>
    </li>

    <li class="sidebar-menu-item">
        <a href="{{ route('settings.payment') }}" class="sidebar-menu-button {{ $tab == 'payment' ? 'text-primary' : 'text-secondary' }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">payment</i>
            <span class="sidebar-menu-text">{{ __('messages.payment_settings') }}</span>
        </a>
    </li>

    <li class="sidebar-menu-item">
        <a href="{{ route('settings.product') }}" class="sidebar-menu-button {{ $tab == 'product' ? 'text-primary' : 'text-secondary' }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">store</i>
            <span class="sidebar-menu-text">{{ __('messages.product_settings') }}</span>
        </a>
    </li>

    <li class="sidebar-menu-item">
        <a href="{{ route('settings.tax_types') }}" class="sidebar-menu-button {{ $tab == 'tax_types' ? 'text-primary' : 'text-secondary' }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">pages</i>
            <span class="sidebar-menu-text">{{ __('messages.tax_types') }}</span>
        </a>
    </li>

    <li class="sidebar-menu-item">
        <a href="{{ route('settings.expense_categories') }}" class="sidebar-menu-button {{ $tab == 'expense_categories' ? 'text-primary' : 'text-secondary' }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">account_balance_wallet</i>
            <span class="sidebar-menu-text">{{ __('messages.expense_categories') }}</span>
        </a>
    </li>

    <li class="sidebar-menu-item">
        <a href="{{ route('settings.email_template') }}" class="sidebar-menu-button {{ $tab == 'email_template' ? 'text-primary' : 'text-secondary' }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">email</i>
            <span class="sidebar-menu-text">{{ __('messages.email_templates') }}</span>
        </a>
    </li>

    <li class="sidebar-menu-item">
        <a href="{{ route('settings.team') }}" class="sidebar-menu-button {{ $tab == 'team' ? 'text-primary' : 'text-secondary' }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">group</i>
            <span class="sidebar-menu-text">{{ __('messages.team') }}</span>
        </a>
    </li>
</ul>