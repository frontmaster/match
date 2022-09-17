<div class="l-sidebar">
    <ul>
        <h3 class="c-sidebar__menu--title">案件の投稿</h3>
        <div class="c-sidebar__menublock">
            <li class="c-sidebar__menu">
                <a href="{{ route('post.project.show', auth()->user()->id) }}" class="c-sidebar__menu--linkLast">案件を投稿する</a>
            </li>
        </div>
        <h3 class="c-sidebar__menu--title">案件を見る</h3>
        <div class="c-sidebar__menublock">
            <li class="c-sidebar__menu">
                <a href="{{ route('projectList.show') }}" class="c-sidebar__menu--link">案件一覧を見る</a>
                <a href="{{ route('post.projectList.show', auth()->user()->id) }}" class="c-sidebar__menu--link">登録した案件を見る</a>
                <a href="{{ route('apply.projectList.show', auth()->user()->id) }}" class="c-sidebar__menu--linkLast">応募した案件を見る</a>
            </li>
        </div>

        <div class="c-sidebar__menublock--short">
            <li class="c-sidebar__menu--short">
                <a href="{{ route('profile.edit', auth()->user()->id) }}" class="c-sidebar__menu--linkLast">プロフィール編集</a>
            </li>
        </div>
    </ul>
</div>