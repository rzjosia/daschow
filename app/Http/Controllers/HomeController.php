<?php

namespace App\Http\Controllers;
use App\Http\Forms\UserForm;
use App\User;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
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
     * @param FormBuilder $formBuilder
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(FormBuilder $formBuilder, $id) {
        if ($id != \Auth::user()->id) {
            return redirect()->route('useredit', ['id' => \Auth::user()->id]);
        }
        $user = User::findOrFail($id);
        $user->password = "";
        $form = $formBuilder->create(UserForm::class, [
            'model' => $user,
            'method' => 'POST',
            'url' => route("userupdate"),
        ]);
        return view('auth.update', compact('form', 'user'));
    }

    /**
     * @param FormBuilder $formBuilder
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update(FormBuilder $formBuilder, Request $request) {
        $user = User::where('id', \Auth::user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::needsRehash($request->password) ?  \Hash::make($request->password) : $request->password
        ]);
        $user = User::where('email', $request->email)->first();

        $form = $formBuilder->create(UserForm::class, [
            'model' => $user,
            'method' => 'POST',
            'url' => route("userupdate")
        ]);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        return redirect()->route('useredit', ['id' => $user->id])
            ->withUser($user)->withForm($form);
    }


}
