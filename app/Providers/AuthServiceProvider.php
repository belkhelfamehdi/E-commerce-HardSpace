<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
            ->subject(Lang::get('Vérifier l\'adresse e-mail'))
            ->line(Lang::get('Veuillez cliquer sur le bouton ci-dessous pour vérifier votre adresse e-mail.'))
            ->action(Lang::get('Vérifier l\'adresse e-mail'), $url)
            ->line(Lang::get('Si vous n\'avez pas créé de compte, aucune action supplémentaire n\'est requise.'));
        });

        ResetPassword::toMailUsing(function($notifiable, $url){
            return (new MailMessage)
            ->subject(Lang::get('Réinitialiser votre mot de passe'))
            ->line(Lang::get('Vous recevez cet e-mail car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.'))
            ->action(Lang::get('Réinitialiser le mot de passe'), $url)
            ->line(Lang::get('Ce lien de réinitialisation de mot de passe expirera dans :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('Si vous n\'avez pas demandé de réinitialisation de mot de passe, aucune action supplémentaire n\'est requise.'));
        });
    }
}
