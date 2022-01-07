<template>
  <div class="p-postIdeaList__Container">
    <div class="p-postIdeaList__partContainer">
      <div
        class="p-postIdeaList__part"
        v-for="idea in postIdeas"
        :key="idea.id"
      >
        <div class="p-postIdeaList__item">
          <div class="p-postIdeaList__item--part">
            <label for="idea" class="p-postIdeaList__label">アイディア名</label>
            <p class="p-postIdeaList__item--part">{{ idea.idea_name }}</p>
          </div>

          <div class="p-postIdeaList__item--part">
            <label for="category" class="p-postIdeaList__label">カテゴリ</label>
            <p class="p-postIdeaList__item--part">
              {{ idea.category.category_name }}
            </p>
          </div>

          <div class="p-postIdeaList__item--part">
            <label for="idea" class="p-postIdeaList__label">価格</label>
            <p class="p-postIdeaList__item--part">
              ¥{{ idea.price | localeNum }}
            </p>
          </div>
</div>
          <div class="p-postIdeaList__item--link">
            <a
              :href="'/idea_detail/' + idea.id"
              class="c-btn p-postIdeaList__btn"
              >詳細を見る</a
            >
            <a
              :href="'/post_idea_edit/' + idea.id"
              class="c-btn p-postIdeaList__btn"
              >編集</a
            >
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
    getItems() {
      const url =
        "/ajax/post_idea_list/" + this.post_user_id + "?page=" + this.page;
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
    postIdeas: function () {
      var ideas = [];

      for (var i in this.ideas.data) {
        var idea = this.ideas.data[i];

        ideas.push(idea);
      }
      return ideas;
    },
  },
};
</script>
