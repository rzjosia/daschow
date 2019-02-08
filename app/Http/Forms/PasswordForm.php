<?php

namespace App\Http\Forms;

use App\Rules\DifferentTo;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class PasswordForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('password_before', Field::PASSWORD, [
                //'rules' => 'required|min:6|max:191|differentTo:["'.\Auth::user()->getAuthPassword().'"]',
                "rules" => ['required', 'min:6', 'max:191', new DifferentTo(\Auth::user()->getAuthPassword())],

                "label" => "Current password"
            ])
            ->add('password', Field::PASSWORD, [
                'rules' => 'required|min:6|max:191|confirmed|different:password_before',
                "label" => "New password"
            ])
            ->add('password_confirmation', Field::PASSWORD, [
                'rules' => 'required|min:6|max:191',
                "label" => "New password confirmation"
            ])
            ->add('submit', 'submit', [
                'label' => 'Sauver',
                'attr' => [
                    'class' => "btn btn-primary float-right"
                ]
            ]);
    }
}
