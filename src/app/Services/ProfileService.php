<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProfileService
{
    public function getUserProfile()
    {
        return Auth::user();
    }

    public function updateProfile(User $user, array $data)
    {
        // バリデーション
        $validatedData = validator($data, [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'bio' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ])->validate();

        // プロフィール画像の処理
        if (!empty($data['image'])) {
            // 既存の画像を削除
            if ($user->image) {
                Storage::delete('public/profile_images/' . $user->image);
            }
            // 新しい画像を保存
            $imagePath = $data['image']->store('img', 'public');
            $validatedData['image'] = basename($imagePath);
        }

        // ユーザー情報を更新
        $user->update($validatedData);
        // dd(redirect()->route('mypages.show', auth()->id()));
        return redirect()->route('mypages.show', $user->id)->with('success', 'プロフィールを更新しました。');
    }
}
