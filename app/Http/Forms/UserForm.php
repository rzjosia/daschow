<?php

namespace App\Http\Forms;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;

class UserForm extends Form
{
    public function buildForm()
    {
        // Add fields here...
        // Add fields here...
        $this
            ->add('name', Field::TEXT, [
                'rules' =>'min:4',
                'label' => "Nom d'utilisateur",
                'placeholder' => "Martin Dubois"
            ])
            ->add('email', Field::TEXT, [
                    'rules' =>'email',
                    'label' => "Adresse email",
                    'placeholder' => "joe@domain.com"
                ])
            ->add('password', Field::PASSWORD, [
                'rules' =>'min:6|confirmed',
                'placeholder' => "Votre mot de passe"
            ])
            ->add('password_confirmation', Field::PASSWORD, [
                'rules' =>'min:6',
                'placeholder' => "Votre mot de passe"
            ])
            ->add('submit', 'submit', [
                'label' => 'Sauver',
                'attr' => [
                    'class' => "btn btn-primary float-right"
                ]
            ]);
    }
}
