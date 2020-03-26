<?php

declare(strict_types=1);

use App\Occurrence;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

//Screens

// Platform
Breadcrumbs::for('platform.main', function (BreadcrumbsGenerator $trail) {
    $trail->push(__('Main'), route('platform.main'));
});

// Platform > System > Users
Breadcrumbs::for('platform.systems.users', function (BreadcrumbsGenerator $trail) {
    $trail->parent('platform.systems.index');
    $trail->push(__('Users'), route('platform.systems.users'));
});

// Platform > System > Users > User
Breadcrumbs::for('platform.systems.users.edit', function (BreadcrumbsGenerator $trail, $user) {
    $trail->parent('platform.systems.users');
    $trail->push(__('Edit User'), route('platform.systems.users.edit', $user));
});

// Platform > System > Roles
Breadcrumbs::for('platform.systems.roles', function (BreadcrumbsGenerator $trail) {
    $trail->parent('platform.systems.index');
    $trail->push(__('Roles'), route('platform.systems.roles'));
});

// Platform > System > Roles > Create
Breadcrumbs::for('platform.systems.roles.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('platform.systems.roles');
    $trail->push(__('Create'), route('platform.systems.roles.create'));
});

// Platform > System > Roles > Role
Breadcrumbs::for('platform.systems.roles.edit', function (BreadcrumbsGenerator $trail, $role) {
    $trail->parent('platform.systems.roles');
    $trail->push(__('Role'), route('platform.systems.roles.edit', $role));
});

// Platform > Events
Breadcrumbs::for('platform.events.list', function (BreadcrumbsGenerator $trail) {
    $trail->parent('platform.main');
    $trail->push(__('Events'), route('platform.events.list'));
});

// Platform > Events > Edit
Breadcrumbs::for('platform.events.edit', function (BreadcrumbsGenerator $trail, $event) {
    $trail->parent('platform.events.list');
    $trail->push(__('Edit Event'), route('platform.events.edit', $event));
});

// Platform > Events > New Occurrence
Breadcrumbs::for('platform.occurrences.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('platform.events.list');
    $trail->push(__('Create Occurrence'), route('platform.occurrences.create'));
});

// Platform > Events > Event > Occurrence
Breadcrumbs::for('platform.occurrences.edit', function (BreadcrumbsGenerator $trail, $occurrence) {
    $trail->parent('platform.events.edit', Occurrence::find($occurrence)->event);
    $trail->push(__('Occurrence'), route('platform.occurrences.edit', $occurrence));
});
