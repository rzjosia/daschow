<?php

namespace App\Http\Forms;

use App\Rules\DifferentTo;
use App\User;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {
        // Add fields here...
        // Add fields here...
        $this
            ->add('name', Field::TEXT, [
                'rules' => 'required|min:4|max:191',
                'label' => "Nom d'utilisateur",
                'placeholder' => "Martin Dubois"
            ])
            ->add('email', Field::TEXT, [
                'rules' => ['required', 'email', 'max:191', 'unique:users'],
                'label' => "Adresse email",
                'placeholder' => "joe@domain.com"
            ])
            ->add('submit', 'submit', [
                'label' => 'Sauver',
                'attr' => [
                    'class' => "btn btn-primary float-right"
                ]
            ]);
    }
}
