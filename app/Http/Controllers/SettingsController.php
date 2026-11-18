<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        $preferences = array_merge([
            'notifications' => true,
            'recipe_updates' => true,
        ], $user->preferences ?? []);

        return view('settings.edit', compact('user', 'preferences'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],

            'username' => [
                'required',
                'string',
                'max:100',
                Rule::unique('users', 'username')->ignore($user->id),
            ],

            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'bio' => ['nullable', 'string', 'max:500'],

            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $data['avatar'] = $request->file('avatar')
                ->store('avatars', 'public');
        }

        unset($data['avatar']);

        $user->fill([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'bio' => $data['bio'] ?? null,
        ]);

        if (isset($data['avatar'])) {
            $user->avatar = $data['avatar'];
        }

        $user->preferences = [
            'notifications' => $request->boolean('notifications'),
            'recipe_updates' => $request->boolean('recipe_updates'),
        ];

        $user->save();

        return redirect()->route('settings.edit')
            ->with('success', 'Configurações atualizadas com sucesso!');
    }
}
