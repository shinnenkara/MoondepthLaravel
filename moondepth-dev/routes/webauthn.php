<?php

use App\Http\Controllers\Auth\WebAuthnConfirmController;
use App\Http\Controllers\Auth\WebAuthnDeviceLostController;
use App\Http\Controllers\Auth\WebAuthnRecoveryController;
use App\Http\Controllers\Auth\WebAuthnRegisterController;
use App\Http\Controllers\Auth\WebAuthnLoginController;
use Illuminate\Support\Facades\Route;

Route::get('webauthn/register', [WebAuthnRegisterController::class, 'showWebAuthnRegisterForm'])
    ->name('webauthn.register.form');
Route::post('webauthn/register', [WebAuthnRegisterController::class, 'register'])
    ->name('webauthn.register');
Route::post('webauthn/register/options', [WebAuthnRegisterController::class, 'options'])
    ->name('webauthn.register.options');

Route::get('webauthn/login', [WebAuthnLoginController::class, 'showWebAuthnLoginForm'])
    ->name('webauthn.login.form');
Route::post('webauthn/login', [WebAuthnLoginController::class, 'login'])
    ->name('webauthn.login');
Route::post('webauthn/login/options', [WebAuthnLoginController::class, 'options'])
    ->name('webauthn.login.options');

Route::get('webauthn/lost', [WebAuthnDeviceLostController::class, 'showDeviceLostForm'])
    ->name('webauthn.lost.form');
Route::post('webauthn/lost', [WebAuthnDeviceLostController::class, 'sendRecoveryEmail'])
    ->name('webauthn.lost.send');

Route::get('webauthn/recover', [WebAuthnRecoveryController::class, 'showResetForm'])
    ->name('webauthn.recover.form');
Route::post('webauthn/recover/register', [WebAuthnRecoveryController::class, 'recover'])
    ->name('webauthn.recover');
Route::post('webauthn/recover/options', [WebAuthnRecoveryController::class, 'options'])
    ->name('webauthn.recover.options');

Route::get('webauthn/confirm', [WebAuthnConfirmController::class, 'showConfirmForm'])
    ->name('webauthn.confirm.form');
Route::post('webauthn/confirm', [WebAuthnConfirmController::class, 'confirm'])
    ->name('webauthn.confirm');
Route::post('webauthn/confirm/options', [WebAuthnConfirmController::class, 'options'])
    ->name('webauthn.confirm.options');
