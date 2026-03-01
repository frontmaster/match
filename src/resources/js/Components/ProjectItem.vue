<template>
  <div class="p-mypage__projectList">
    <dl class="p-mypage__itemContainer">
      <dt class="p-mypage__itemTitle">案件名</dt>
      <dd>{{ project.project_title }}</dd>
    </dl>

    <dl class="p-mypage__itemContainer">
      <dt class="p-mypage__itemTitle">案件種別</dt>
      <dd class="">
        {{ project.project_type === "single" ? "単発" : "レベニューシェア" }}
      </dd>
    </dl>
    <dl
      v-if="project.project_type === 'single'"
      class="p-mypage__itemContainer"
    >
      <dt class="p-mypage__itemTitle">価格</dt>
      <dd>{{ project.price_min }}〜{{ project.price_max }} 千円</dd>
    </dl>

    <dl class="p-mypage__itemContainer">
      <dt class="p-mypage__itemTitle">内容</dt>
      <dd>{{ project.content }}</dd>
    </dl>
    <a href="">詳細</a>
  </div>
</template>

<script setup>
defineProps({
  project: {
    type: Object,
    required: true,
  },
});
</script>