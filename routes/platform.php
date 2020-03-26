<?php

declare(strict_types=1);

use App\Orchid\Screens\Event\EventListScreen;
use App\Orchid\Screens\Event\EventEditScreen;
use App\Orchid\Screens\Occurrence\OccurrenceEditScreen;
use App\Orchid\Screens\Occurrence\OccurrenceBatchCreateScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)->name('platform.main');

// Users...
Route::screen('users/{users}/edit', UserEditScreen::class)->name('platform.systems.users.edit');
Route::screen('users', UserListScreen::class)->name('platform.systems.users');

// Roles...
Route::screen('roles/{roles}/edit', RoleEditScreen::class)->name('platform.systems.roles.edit');
Route::screen('roles/new', RoleEditScreen::class)->name('platform.systems.roles.create');
Route::screen('roles', RoleListScreen::class)->name('platform.systems.roles');

Route::screen('occurrences/{occurrence}/edit', OccurrenceEditScreen::class)->name('platform.occurrences.edit');
Route::screen('occurrences/new', OccurrenceBatchCreateScreen::class)->name('platform.occurrences.create');

Route::screen('events/{event}/edit', EventEditScreen::class)->name('platform.events.edit');
Route::screen('events/new', EventEditScreen::class)->name('platform.events.create');
Route::screen('events', EventListScreen::class)->name('platform.events.list');
