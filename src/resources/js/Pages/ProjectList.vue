(<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">案件一覧</h1>
    <div v-for="p in projects" :key="p.id" :project="p">
      <p>案件名：{{ p.project_title }}</p>
      <p>案件種別：{{ p.project_type }}</p>
      <p>価格：{{ p.price }}</p>
      <p>内容：{{ p.content }}</p>
    </div>
  </div>
</template>
  
  <script>
import axios from "axios";
axios.defaults.withCredentials = true;
import ProjectItem from "../Components/ProjectItem.vue";

export default {
  components: { ProjectItem },
  data() {
    return {
      projects: [],
    };
  },
  mounted() {
    axios.get("http://localhost/sanctum/csrf-cookie").then(() => {
      axios
        .get("http://localhost/api/projects")
        .then((res) => {
          this.projects = res.data;
        })
        .catch((err) => {
          console.error("案件の取得に失敗しました", err);
        });
    });
  },
};
</script>
  )