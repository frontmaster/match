<template>
  <div>
    <h1>アイディア一覧</h1>
    <ProjectItem apiUrl="/api/projects" />
  </div>
</template>

<script setup>
import ProjectItem from "../Components/AllProjectList.vue";
</script>