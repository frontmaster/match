<?php

namespace App\Services;

use App\Models\ApplyProject;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectService
{
    public function createProject(array $data)
    {
        $data['user_id'] = auth()->id();
        // 案件種別に応じた処理を記述
        if ($data['project_type'] === 'single') {
            $data['price_min'] = !empty($data['price_min']) ? $data['price_min'] : 0; // 単発案件なら価格が必須
            $data['price_max'] = !empty($data['price_max']) ? $data['price_max'] : 0; // 単発案件なら価格が必須
        } else {
            $data['price_min'] = null; // レベニューシェア案件なら価格をnullに
            $data['price_max'] = null;
        }

        return Project::create($data);
    }

    public function getUserProjects()
    {
        return Project::where('user_id', Auth::id())
            ->latest()
            ->get();
    }
}
