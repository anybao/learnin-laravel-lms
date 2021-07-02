<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.index') }}">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
            </svg> Dashboard</a></li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.invoices') }}">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-cart"></use>
            </svg> Invoices</a></li>
    <li class="c-sidebar-nav-title">Courses</li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.courses') }}">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-school"></use>
            </svg> Courses</a></li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.courses.add') }}">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-plus"></use>
            </svg> Add new Course</a></li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.courses.categories') }}">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-list"></use>
            </svg> Course Category</a></li>
    <li class="c-sidebar-nav-title">Users</li>

    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.users') }}">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-people"></use>
            </svg> Users</a></li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.subscriptions') }}">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-money"></use>
            </svg> Subscriptions</a></li>
    <li class="c-sidebar-nav-divider"></li>
    <li class="c-sidebar-nav-title">Extras</li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.files') }}">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-paperclip"></use>
            </svg> Files</a></li>
</ul>
