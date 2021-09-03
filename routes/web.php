<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Agentes
    Route::delete('agentes/destroy', 'AgentesController@massDestroy')->name('agentes.massDestroy');
    Route::resource('agentes', 'AgentesController');

    // Sedes
    Route::delete('sedes/destroy', 'SedesController@massDestroy')->name('sedes.massDestroy');
    Route::resource('sedes', 'SedesController');

    // Prioridad
    Route::delete('prioridads/destroy', 'PrioridadController@massDestroy')->name('prioridads.massDestroy');
    Route::resource('prioridads', 'PrioridadController');

    // Incidente
    Route::delete('incidentes/destroy', 'IncidenteController@massDestroy')->name('incidentes.massDestroy');
    Route::resource('incidentes', 'IncidenteController');

    // Estado
    Route::delete('estados/destroy', 'EstadoController@massDestroy')->name('estados.massDestroy');
    Route::resource('estados', 'EstadoController');

    // Tickets
    Route::delete('tickets/destroy', 'TicketsController@massDestroy')->name('tickets.massDestroy');
    Route::post('tickets/media', 'TicketsController@storeMedia')->name('tickets.storeMedia');
    Route::post('tickets/ckmedia', 'TicketsController@storeCKEditorImages')->name('tickets.storeCKEditorImages');
    Route::resource('tickets', 'TicketsController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Reportes
    Route::delete('reportes/destroy', 'ReportesController@massDestroy')->name('reportes.massDestroy');
    Route::resource('reportes', 'ReportesController');

    // Fichas Tecnicas
    Route::delete('fichas-tecnicas/destroy', 'FichasTecnicasController@massDestroy')->name('fichas-tecnicas.massDestroy');
    Route::post('fichas-tecnicas/parse-csv-import', 'FichasTecnicasController@parseCsvImport')->name('fichas-tecnicas.parseCsvImport');
    Route::post('fichas-tecnicas/process-csv-import', 'FichasTecnicasController@processCsvImport')->name('fichas-tecnicas.processCsvImport');
    Route::resource('fichas-tecnicas', 'FichasTecnicasController');

    // Imprimir
    Route::delete('imprimirs/destroy', 'ImprimirController@massDestroy')->name('imprimirs.massDestroy');
    Route::resource('imprimirs', 'ImprimirController');

    // Componentes
    Route::delete('componentes/destroy', 'ComponentesController@massDestroy')->name('componentes.massDestroy');
    Route::post('componentes/parse-csv-import', 'ComponentesController@parseCsvImport')->name('componentes.parseCsvImport');
    Route::post('componentes/process-csv-import', 'ComponentesController@processCsvImport')->name('componentes.processCsvImport');
    Route::resource('componentes', 'ComponentesController');

    // Imprimirmto
    Route::delete('imprimirmtos/destroy', 'ImprimirmtoController@massDestroy')->name('imprimirmtos.massDestroy');
    Route::resource('imprimirmtos', 'ImprimirmtoController');

    // Hojas De Vida Mantenimiento
    Route::delete('hojas-de-vida-mantenimientos/destroy', 'HojasDeVidaMantenimientoController@massDestroy')->name('hojas-de-vida-mantenimientos.massDestroy');
    Route::post('hojas-de-vida-mantenimientos/parse-csv-import', 'HojasDeVidaMantenimientoController@parseCsvImport')->name('hojas-de-vida-mantenimientos.parseCsvImport');
    Route::post('hojas-de-vida-mantenimientos/process-csv-import', 'HojasDeVidaMantenimientoController@processCsvImport')->name('hojas-de-vida-mantenimientos.processCsvImport');
    Route::resource('hojas-de-vida-mantenimientos', 'HojasDeVidaMantenimientoController');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
