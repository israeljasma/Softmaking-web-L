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

// Home > Users > [User] > Inovices > Create Invoice
Breadcrumbs::for('user', function ($trail, $user) {
    $trail->parent('users');
    $trail->push($user->id);
    $trail->push('Invoices', url('home/invoices'));
    $trail->push('Create');
});

// Home > Users > Invoices
Breadcrumbs::for('invoices', function ($trail) {
    $trail->parent('users');
    $trail->push('Invoices', url('home/invoices'));
});

// Home > Users > Invoices
Breadcrumbs::for('invoice', function ($trail, $invoice) {
    $trail->parent('invoices');
    $trail->push($invoice->id);
});

/* // Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > About
Breadcrumbs::for('about', function ($trail) {
    $trail->parent('home');
    $trail->push('About', route('about'));
});

// Home > Blog
Breadcrumbs::for('blog', function ($trail) {
    $trail->parent('home');
    $trail->push('Blog', route('blog'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category->id));
});

// Home > Blog > [Category] > [Post]
Breadcrumbs::for('post', function ($trail, $post) {
    $trail->parent('category', $post->category);
    $trail->push($post->title, route('post', $post->id));
});
 */
