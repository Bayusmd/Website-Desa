<?php

namespace App\Filament\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Forms\Components\TextInput;

class AdminLogin extends BaseLogin
{
    protected function getLoginFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required(),

            TextInput::make('password')
                ->label('Password')
                ->password()
                ->required(),
        ];
    }

    public function getCredentials(): array
    {
        return [
            'email' => $this->form->getState()['email'],
            'password' => $this->form->getState()['password'],
        ];
    }

    public function getAuthGuard(): string
    {
        return 'admin';
    }

    public function getUsernameField(): string
    {
        return 'email';
    }
}
