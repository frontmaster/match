<?php

namespace App\Services;

use App\Models\Project;

class ProjectService
{
    public function createProject(array $data)
    {
        $data['user_id'] = auth()->id();
        // 案件種別に応じた処理を記述
        if ($data['project_type'] === 'single') {
            $data['price'] = !empty($data['price']) ? $data['price'] : 0; // 単発案件なら価格が必須
        } else {
            $data['price'] = null; // レベニューシェア案件なら価格をnullに
        }

        return Project::create($data);
    }
}
