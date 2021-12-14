<template>
  <div class="p-ideaDetail__Container">
    <div class="p-ideaDetail__partContainer">
      <div class="p-ideaDetail__part" v-for="idea in ideas" :key="idea.id">
        <div class="p-ideaDetail__postUser">
          <label for="postUser" class="p-ideaDetail__label"
            >アイディア投稿者</label
          >
          <div class="p-ideaDetail__postUserInfo">
            <img
              v-if="idea.user.user_img == null"
              src="/img/person.jpg"
              alt=""
              class="c-img p-ideaDetail__img"
            />
            <img
              v-if="idea.user.user_img"
              :src="'/' + idea.user.user_img"
              alt=""
              class="c-img p-ideaDetail__img"
            />
            <p class="p-ideaDetail__postUserInfo--name">{{ idea.user.name }}</p>
          </div>
        </div>

        <div class="p-ideaDetail__item">
          <label for="idea" class="p-ideaDetail__label">アイディア名</label>
          <p class="p-ideaDetail__item--part">{{ idea.idea_name }}</p>
        </div>

        <div class="p-ideaDetail__item">
          <label for="category" class="p-ideaDetail__label">カテゴリ</label>
          <p class="p-ideaDetail__item--part">
            {{ idea.category.category_name }}
          </p>
        </div>

        <div class="p-ideaDetail__item">
          <label for="summary" class="p-ideaDetail__label">概要</label>
          <p class="p-ideaDetail__item--part">{{ idea.summary }}</p>
        </div>

        <div class="p-ideaDetail__item">
          <label for="content" class="p-ideaDetail__label">内容</label>
          <p class="p-ideaDetail__item--part">購入後に表示されます</p>
        </div>

        <div class="p-ideaDetail__item">
          <label for="idea" class="p-ideaDetail__label">価格</label>
          <p class="p-ideaDetail__item--part">¥{{ idea.price | localeNum }}</p>
        </div>
      </div>
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
