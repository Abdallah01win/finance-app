<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Error;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use function PHPUnit\Framework\throwException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function getBalance()
    {
        return User::where('id', '=', Auth::id())->limit(1)->get('balance');
    }
    public function getUser()
    {
        return User::where('id', '=', Auth::id())->limit(1)->get();
    }
    public function getAvatar()
    {
        $patch =  User::where('id', '=', Auth::id())->limit(1)->get('image');
        if (!Storage::exists($patch)) {
            throw new Error();
        }
        return response(Storage::disk('local')->get($patch))
            ->header('Content-Type', 'image/jpg');
    }

    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function update(Request $request)
    {
        $request->validate([
            'FirstName' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'image' => 'file|image|mimes:jpg,png,jpeg,gif,svg|max:1024',
        ]);
        $userId = Auth::id();
        if ($request->hasFile('image')) {
            $path = 'public/images/users';
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $newPath = Storage::disk('local')->put($path, $image);
            $imageUrl = asset('storage/app/'. $newPath);
        }
        $user = User::where('id', '=', $userId)->limit(1)->update([
            'name' => $request->FirstName,
            'last_name' => $request->last_name,
            'income_target' => $request->income,
            'expances_target' => $request->expances,
            'savings_target' => $request->savings,
            'currancy' => $request->currancy,
            'language' => $request->language,
            'image' => $imageUrl
        ]);
        return redirect('/settings')->with('success', 'Contact Updated!');
    }
}
