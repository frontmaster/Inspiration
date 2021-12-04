<template>
  <div>
    <div class="p-postIdeaList__partContainer">
      <div class="p-postIdeaList__part" v-for="idea in ideas" :key="idea.id">
        <div class="p-postIdeaList__item">
          <label for="idea" class="p-postIdeaList__label">アイディア名</label>
          <p class="p-postIdeaList__item--part">{{ idea.idea_name }}</p>
        </div>

        

        <div class="p-postIdeaList__item">
          <label for="idea" class="p-postIdeaList__label">価格</label>
          <p class="p-postIdeaList__item--part">
            ¥{{ idea.price | localeNum }}
          </p>
        </div>

        <div class="p-postIdeaList__item--link">
          <a href="" class="c-btn p-postIdeaList__btn">詳細を見る</a>
          <a :href="'/post_idea_edit/' + idea.id" class="c-btn p-postIdeaList__btn">編集する</a>
        </div>
      </div>
    </div>
    <div class="p-postIdeaList__pagination">
        <pagination-component
          :data="ideas"
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
      ideas: {},
    };
  },
  filters: {
    localeNum: function (val) {
      return val.toLocaleString();
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
      const url = "/ajax/post_idea_list?page=" + this.page;
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
    var url = "/ajax/post_idea_list/" + this.post_user_id;
    axios.get(url).then(function (response) {
      self.ideas = response.data;
    });
  },
  computed: {
    /*filteredItems: function () {
      var items = [];

      for (var i in this.items.data) {
        var item = this.items.data[i];

        if (item.category_name.indexOf(this.keyword) !== -1) {
          items.push(item);
        }
      }
      return items;
    },*/
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
