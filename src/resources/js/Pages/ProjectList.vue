(<template>
  <div class="p-mypage__itemContainer">
    <div v-for="p in projects" :key="p.id" :project="p">
      <div class="p-mypage__projectList">
        <p>案件名：{{ p.project_title }}</p>
        <p>
          案件種別：{{
            p.project_type === "single" ? "単発" : "レベニューシェア"
          }}
        </p>
        <div class="p-mypage__item">
          <p v-if="p.project_type === 'single'">価格：{{ p.price_min }}</p>
          <span v-if="p.project_type === 'single'">千円</span>
          <span v-if="p.project_type === 'single'">〜</span>

          <p v-if="p.project_type === 'single'">{{ p.price_max }}</p>
          <span v-if="p.project_type === 'single'">千円</span>
        </div>

        <p>内容：{{ p.content }}</p>
      </div>
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