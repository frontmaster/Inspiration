<template>
  <div class="p-boughtIdeaList__Container">
    
    <div class="p-boughtIdeaList__partContainer">
      <div
        class="p-boughtIdeaList__part"
        v-for="idea in boughtIdeas"
        :key="idea.id"
      >
        <div class="p-boughtIdeaList__itemContainer">
          <div class="p-boughtIdeaList__item">
            <label for="idea" class="p-boughtIdeaList__label">アイディア名</label>
            <p class="p-boughtIdeaList__item--part">{{ idea.idea_name }}</p>
          </div>

          <div class="p-boughtIdeaList__item">
            <label for="idea" class="p-boughtIdeaList__label">カテゴリ</label>
            <p class="p-boughtIdeaList__item--part">
              {{ idea.category.category_name }}
            </p>
          </div>

          <div class="p-boughtIdeaList__item">
            <label for="idea" class="p-boughtIdeaList__label">価格</label>
            <p class="p-boughtIdeaList__item--part">¥{{ localeNum(idea.price) }}</p>
          </div>

          <div class="p-boughtIdeaList__item">
            <label for="idea" class="p-boughtIdeaList__label">投稿日</label>
            <p class="p-boughtIdeaList__item--part">
              {{ moment(idea.created_at) }}
            </p>
          </div>
        </div>

        <div class="p-boughtIdeaList__item">
          <label for="idea" class="p-boughtIdeaList__label">概要</label>
          <p class="p-boughtIdeaList__item--part">
            {{ idea.summary }}
          </p>
        </div>

        
          

        <div class="p-boughtIdeaList__item--link">
          <a :href="'/bought_idea_detail/' + idea.id" class="c-btn p-boughtIdeaList__btn"
            >詳細</a
          >
        </div>
      </div>
    </div>
    <div class="p-boughtIdeaList__pagination">
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
    localeNum: function (val) {
      return val.toLocaleString();
    },
    moment(date) {
      return moment(date).format("YYYY/MM/DD");
    },
  },

  mounted() {
    const self = this;
    const url = "/ajax/bought_idea_list/" + this.buy_user_id;
    axios.get(url).then(function (response) {
      self.ideas = response.data;
    });
  },
  computed: {
    boughtIdeas: function () {
      const ideas = [];

      for (let i in this.ideas.data) {
        const idea = this.ideas.data[i];

          ideas.push(idea);
        }
      return ideas;
    },
  },
};
</script>
