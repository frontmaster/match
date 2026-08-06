<template>
  <div class="p-mypage__registered">
    <h2 class="p-mypage__subTitle">登録済み案件一覧</h2>
    <div class="p-mypage__projectListContainer">
      <div v-if="loading">読み込み中...</div>
      <div v-else-if="projects.length === 0">
        登録済みの案件はありません
      </div>
      <ProjectItem v-else v-for="project in projects" :key="project.id" :project="project" />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import ProjectItem from "./ProjectItem.vue";

const projects = ref([]);
const loading = ref(true);

onMounted(async () => {
  try {
    const res = await axios.get("/api/registered-projects");
    projects.value = res.data;
  } catch (error) {
    console.error("登録済み案件の取得に失敗しました", error);
  } finally {
    loading.value = false;
  }
});
</script>