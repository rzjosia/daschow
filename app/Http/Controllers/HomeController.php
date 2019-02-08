<?php

namespace App\Http\Controllers;

use App\Http\Forms\PasswordForm;
use App\Http\Forms\UserForm;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class HomeController extends Controller
{
    use FormBuilderTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Formulaire de mofification du profil
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $user = User::findOrFail(\Auth::user()->id);

        $form = $this->form(UserForm::class, [
            'model' => $user,
            'method' => 'POST',
            'url' => route("userupdate"),
        ]);

        $title = "Mon profil";

        return view('edit.update', compact('form', 'user', 'title'));
    }

    /**
     * Appliquer la modificiaton du profil
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $form = $this->form(UserForm::class);

        // Redirection automatique si le formulaire n'est pas validé
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $form->redirectIfNotValid();

        $user = User::findOrFail(Auth::user()->id);

        // Modification des champs
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save(); // Modifier dans la table

        return redirect()->route('useredit');
    }

    public function passEdit() {
        $user = User::findOrFail(\Auth::user()->id);

        $form = $this->form(PasswordForm::class, [
            'model' => [
              "current_password" => \Auth::user()->getAuthPassword()
            ],
            'method' => 'POST',
            'url' => route("passUpdate"),
        ]);

        $title = "Modification du mot de passe";

        return view('edit.update', compact('form', 'user', 'title'));
    }

    public function passUpdate(Request $request) {
        $form = $this->form(PasswordForm::class);
        // Redirection automatique si le formulaire n'est pas validé
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->withTitle("Erreur");
        }

        $form->redirectIfNotValid();

        $user = User::findOrFail(\Auth::user()->id);

        // Modification des champs
        $user->password = \Hash::make($form->getField("password")->getRawValue());

        $user->save(); // Modifier dans la table

        return redirect()->route('passEdit');
    }

}
