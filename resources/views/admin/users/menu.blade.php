<ul class="list-group mb-3">
    <a href="{{ route('admin.users.detail', $user) }}" class="list-group-item list-group-item-action"><i class="fa fa-question-circle"></i> View info</a>
    <a href="{{ route('admin.users.edit', $user) }}" class="list-group-item list-group-item-action"><i class="fa fa-edit"></i> Update info</a>
    <a href="{{ route('admin.users.status', $user) }}" class="list-group-item list-group-item-action"><i class="fa fa-ban"></i> Deactivate/ Activate</a>
</ul>

<ul class="list-group mb-3">
    <a href="{{ route('admin.users.courses', $user) }}" class="list-group-item list-group-item-action"><i class="fa fa-briefcase"></i> View Courses</a>
    <a href="{{ route('admin.users.invoices', $user) }}" class="list-group-item list-group-item-action"><i class="fa fa-dollar-sign"></i> View Invoices</a>
    <a href="{{ route('admin.users.subscriptions', $user) }}" class="list-group-item list-group-item-action"><i class="fa fa-clock"></i> View Subscription</a>
</ul>
