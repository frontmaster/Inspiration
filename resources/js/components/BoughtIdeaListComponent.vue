<template>
  <div class="p-ideaList__Container">
    
    <div class="p-ideaList__partContainer">
      <div
        class="p-ideaList__part"
        v-for="idea in boughtIdeas"
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

        
          

        <div class="p-ideaList__item--link">
          <a :href="'/idea_detail/' + idea.idea_id" class="c-btn p-ideaList__btn"
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
    getItems() {
      const url = "/ajax/bought_idea_list/" + this.buy_user_id + "?page=" + this.page;
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
    var url = "/ajax/bought_idea_list/" + this.buy_user_id;
    axios.get(url).then(function (response) {
      self.ideas = response.data;
    });
  },
  computed: {
    boughtIdeas: function () {
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
