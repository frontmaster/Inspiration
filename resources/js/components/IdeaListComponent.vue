<template>
  <div class="p-ideaList__Container">
    <div class="p-ideaList__searchBox">
      <input
        type="text"
        class="p-ideaList__search"
        v-model="keyword"
        placeholder="カテゴリ・価格・投稿日で検索"
      />
      <span class="p-ideaList__searchIcon"><i class="fas fa-search"></i></span>
    </div>
    <div class="p-ideaList__partContainer">
      <div
        class="p-ideaList__part"
        v-for="idea in filteredIdeas"
        :key="idea.id"
      >
        <div class="p-ideaList__itemContainer">
          <div class="p-ideaList__item">
            <label for="idea" class="p-ideaList__label">アイディア名</label>
            <p class="p-ideaList__item--part">{{ idea.idea_name }}</p>
          </div>

          <div class="p-ideaList__item">
            <label for="idea" class="p-ideaList__label">カテゴリ</label>
            <p class="p-ideaList__item--part">
              {{ idea.category.category_name }}
            </p>
          </div>

          <div class="p-ideaList__item">
            <label for="idea" class="p-ideaList__label">価格</label>
            <p class="p-ideaList__item--part">¥{{ idea.price | localeNum }}</p>
          </div>

          <div class="p-ideaList__item">
            <label for="idea" class="p-ideaList__label">投稿日</label>
            <p class="p-ideaList__item--part">
              {{ idea.created_at | moment }}
            </p>
          </div>
        </div>

        <div class="p-ideaList__item">
          <label for="idea" class="p-ideaList__label">概要</label>
          <p class="p-ideaList__item--part">
            {{ idea.summary }}
          </p>
        </div>

        <div class="p-ideaList__itemContainer--review">
          <div class="p-ideaList__item">
            <label for="idea" class="p-ideaList__label">口コミ数</label>
            <p class="p-ideaList__item--part"></p>
          </div>

          <div class="p-ideaList__item">
            <label for="idea" class="p-ideaList__label">平均評価点数</label>
            <p class="p-ideaList__item--part"></p>
          </div>
        </div>

        <div class="p-ideaList__item--link">
          <a :href="'/idea_detail/' + idea.id" class="c-btn p-ideaList__btn"
            >詳細</a
          >
        </div>
      </div>
    </div>
    <div class="p-ideaList__pagination">
      <pagination-component
        :data="ideas"
        @move-page="movePage($event)"
      ></pagination-component>
    </div>
  </div>
</template>

<script>
import PaginationComponent from "./PaginationComponent.vue";
import moment from "moment";
export default {
  components: {
    PaginationComponent,
  },

  data: function () {
    return {
      ideas: {},
      keyword: "",
    };
  },
  filters: {
    localeNum: function (val) {
      return val.toLocaleString();
    },
    moment(date) {
      return moment(date).format("YYYY/MM/DD");
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
      let classes = ["page-item"];

      if (this.isCurrentPage(page)) {
        classes.push("active");
      }

      return classes;
    },
    getItems() {
      const url = "/ajax/idea_list?page=" + this.page;
      axios.get(url).then((response) => {
        this.ideas = response.data;
      });
    },

    movePage(page) {
      this.page = page;
      this.getItems();
    },
  },

  mounted() {
    var self = this;
    var url = "/ajax/idea_list";
    axios.get(url).then(function (response) {
      self.ideas = response.data;
    });
  },
  computed: {
    filteredIdeas: function () {
      var ideas = [];

      for (var i in this.ideas.data) {
        var idea = this.ideas.data[i];

        if (
          idea.category.category_name.indexOf(this.keyword) !== -1 ||
          String(idea.price).indexOf(this.keyword) !== -1 ||
          idea.created_at.indexOf(this.keyword) !== -1
        ) {
          ideas.push(idea);
        }
      }
      return ideas;
    },
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
