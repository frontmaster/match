<template>
  <div class="p-projectList__container">
    <div class="p-projectList__searchBox">
      <div class="p-projectList__searchContainer">
        <select v-model="selectedCategory" class="p-projectList__category">
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
          class="p-projectList__input"
          placeholder="案件名で検索"
        />
        <i class="fas fa-search p-projectList__searchIcon"></i>
      </div>
    </div>
    <div class="p-projectList__partContainer">
      <div
        class="p-projectList__part"
        v-for="project in filteredProjects"
        :key="project.id"
      >
        <div class="p-projectList__itemContainer">
          <div class="p-projectList__item">
            <label for="project" class="p-projectList__label">案件名</label>
            <p class="p-projectList__item--part">{{ project.title }}</p>
            <label for="category" class="p-projectList__label">案件種別</label>
            <p class="p-projectListe__item--part">
              {{ project.category.category_name }}
            </p>
            <label for="price" class="p-projectList__label">金額</label>
            <div class="p-projectList__priceContainer" v-if="project.low_price">
              <p class="p-projectList__item--part">
                {{ project.low_price }}千円
              </p>
              <span class="p-projectList__tilde">~</span>
              <p class="projectList__item--part">
                {{ project.high_price }}千円
              </p>
            </div>
            <div
              class="p-projectList__priceContainer"
              v-if="!project.low_price"
            >
              <p>売り上げに応じて変動</p>
            </div>
            <a
              :href="'/projectDetail/' + project.id"
              class="c-btn p-projectList__link"
              >詳細</a
            >
          </div>
        </div>
      </div>
    </div>
    <div class="p-projectList__pagination">
      <pagination-component
        :data="projectLists"
        @move-page="movePage($event)"
      ></pagination-component>
    </div>
  </div>
</template>

<script>
import PaginationComponent from "./PaginationComponent.vue";
export default {
  components: {
    PaginationComponent,
  },
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
  methods: {
    move(page) {
      if (!this.isCurrentPage(page)) {
        this.$emit("move-page", page);
      }
    },
    getItems() {
      const url = "/ajax/projectList?page=" + this.page;
      axios.get(url).then((response) => {
        this.projectLists = response.data;
      });
    },
    movePage(page) {
      this.page = page;
      this.getItems();
    },
  },
  mounted() {
    const self = this;
    const url = "/ajax/projectList";
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
