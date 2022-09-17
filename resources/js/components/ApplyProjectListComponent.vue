<template>
  <div class="p-applyProjectList__container">
    <div class="p-applyProjectList__searchBox">
      <div class="p-applyProjectList__searchContainer">
        <select v-model="selectedCategory" class="p-applyProjectList__category">
          <option value="">すべて</option>
          <option
            v-for="category in optionCategory"
            v-bind:value="category.category_name"
            v-bind:key="category.id"
          >
            {{ category.category_name }}
          </option>
        </select>
        <input
          type="text"
          v-model="keyword"
          class="p-applyProjectList__input"
          placeholder="案件名で検索"
        />
        <i class="fas fa-search p-applyProjectList__searchIcon"></i
        >
        
      </div>
    </div>
    <div class="p-applyProjectList__partContainer">
      <div
        class="p-applyProjectList__part"
        v-for="project in filteredProjects"
        :key="project.id"
      >
        <div class="p-applyProjectList__itemContainer">
          <div class="p-applyProjectList__item">
            <label for="project" class="p-applyProjectList__label">案件名</label>
            <p class="p-applyProjectList__item--part">{{ project.title }}</p>
            <label for="category" class="p-applyProjectList__label">案件種別</label>
            <p class="p-applyProjectListe__item--part">
              {{ project.category.category_name }}
            </p>
            <label for="price" class="p-applyProjectList__label">金額</label>
            <div class="p-applyProjectList__priceContainer" v-if="project.low_price">
              <p class="p-applyProjectList__item--part">
                {{ project.low_price }}千円
              </p>
              <span class="p-applyProjectList__tilde">~</span>
              <p class="projectList__item--part">
                {{ project.high_price }}千円
              </p>
            </div>
            <div
              class="p-applyProjectList__priceContainer"
              v-if="!project.low_price"
            >
              <p>売り上げに応じて変動</p>
            </div>
            <a :href="'/projectDetail/' + project.project_id" class="c-btn p-applyProjectList__link">詳細</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      projectLists: {},
      keyword: "",
      selectedCategory: "",
      optionCategory: [
        { id: 1, category_name: "単発" },
        { id: 2, category_name: "レベニューシェア" },
      ],
    };
  },
  mounted() {
    const self = this;
    const url = "/ajax/apply_project_list/" + this.apply_user_id;
    axios.get(url).then(function (response) {
      self.projectLists = response.data;
    });
  },
  computed: {
    filteredProjects: function () {
      const projectLists = [];
      for (let i in this.projectLists.data) {
        const projectList = this.projectLists.data[i];
        if (
          projectList.title.indexOf(this.keyword) !== -1 &&
          projectList.category.category_name.indexOf(this.selectedCategory) !==
          -1
        ) {
          projectLists.push(projectList);
        }
      }
      return projectLists;
    },
  },
};
</script>
