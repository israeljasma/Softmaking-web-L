<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > Users
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('home');
    $trail->push('Users', url('admin/users'));
});

// Home > Users > Invoices
Breadcrumbs::for('invoices', function ($trail) {
    $trail->parent('users');
    $trail->push('Invoices');
});