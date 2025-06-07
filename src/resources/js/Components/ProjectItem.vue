<template>
  <div class="p-4 border rounded mb-2">
    <h2 class="text-xl font-bold">{{ project.title }}</h2>
    <p>
      種別:
      {{ project.project_type === "single" ? "単発" : "レベニューシェア" }}
    </p>
    <p v-if="project.price !== null">
      金額: ¥{{ project.price.toLocaleString() }}
    </p>
    <p>内容: {{ project.description }}</p>
  </div>
</template>
  
  <script>
export default {
  props: {
    project: {
      type: Object,
      required: true,
    },
  },
};
</script>
  