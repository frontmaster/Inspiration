<template>
  <div>
    <ul class="c-pagination">
      <li class="c-pagination__item" v-if="hasPrev">
        <a
          class="c-pagination__item-link"
          href="#"
          @click.prevent="move(data.current_page - 1)"
          >前へ</a
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
          >次へ</a
        >
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    data: {
      ideas: {},
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

      for (let i = 1; i <= this.data.last_page; i++) {
        pages.push(i);
      }
      return pages;
    },
  },
};
</script>

