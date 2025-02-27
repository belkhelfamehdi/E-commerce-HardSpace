<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
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
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage())
                ->subject(Lang::get('Vérification de l\'adresse e-mail'))
                ->line(Lang::get('Veuillez cliquer sur le bouton ci-dessous pour vérifier votre adresse e-mail.'))
                ->action(Lang::get('Vérifier adresse e-mail'), $url)
                ->line(Lang::get('Si vous n\'avez pas créé de compte, aucune action supplémentaire n\'est requise.'));
        });
    }
}
