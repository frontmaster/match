<template>
  <div class="p-mypage__listContainer">
    <h1 class="p-mypage__title">マイページ</h1>

    <!-- 登録済み案件一覧 -->
    <RegisteredProjectList />

    <!-- 応募した案件一覧 -->
    <AppliedProjectList />
  </div>
</template>

<script setup>
import RegisteredProjectList from "../Components/RegisteredProjectList.vue";
// import AppliedProjectList from "../Components/AppliedProjectList.vue";
</script>