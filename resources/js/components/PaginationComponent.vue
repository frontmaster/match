<template>
  <div>
    <ul class="c-pagination">
      <li class="c-pagination__item" v-if="hasPrev">
        <a
          class="c-pagination__item--link"
          href="#"
          @click.prevent="move(data.current_page - 1)"
          ><i class="fas fa-solid fa-angle-left"></i></a
        >
      </li>
      <li :class="getPageClass(page)" v-for="page in pages" :key="page.id">
        <a
          class="c-pagination__item--link"
          href="#"
          v-text="page"
          @click.prevent="move(page)"
        ></a>
      </li>
      <li class="c-pagination__item" v-if="hasNext">
        <a
          class="c-pagination__item--link"
          href="#"
          @click.prevent="move(data.current_page + 1)"
          ><i class="fas fa-solid fa-angle-right"></i></a
        >
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    data: {},
    linkMax: {
      type: Number,
      default: 5,
    },
  },

  methods: {
    move(page) {
      if (!this.isCurrentPage(page)) {
        this.$emit("move-page", page);
      }
    },

    isCurrentPage(page) {
      return this.data.current_page == page;
    },
    getPageClass(page) {
      let classes = ["c-pagination__item"];

      if (this.isCurrentPage(page)) {
        classes.push("active");
      }

      return classes;
    },

    movePage(page) {
      this.page = page;
      this.getItems();
    },
  },
  computed: {
    hasPrev() {
      return this.data.prev_page_url != null;
    },
    hasNext() {
      return this.data.next_page_url != null;
    },
    pages() {
      let pages = [];
      const last_page = this.data.last_page;

      for (let i = 1; i <= last_page; i++) {
        pages.push(i);
      }

      if  (pages.length > this.linkMax) {
        const pageIndex = this.data.current_page - 1;
        const leftMaxPage = Math.floor(this.linkMax * 0.5);
        const rightMaxPage = this.linkMax - leftMaxPage;
        const leftDiff = pageIndex - leftMaxPage;
        const rightDiff = pageIndex + rightMaxPage - pages.length;
        let start = leftDiff >= 0 ? leftDiff - Math.max(0, rightDiff) : 0;
        const end = start + this.linkMax;
        pages = pages.slice(start, end);
      }
      return pages;
    },
  },
};
</script>

