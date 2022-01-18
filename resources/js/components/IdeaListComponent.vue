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
            <label for="category" class="p-ideaList__label">カテゴリ</label>
            <p class="p-ideaList__item--part">
              {{ idea.category.category_name }}
            </p>
          </div>

          <div class="p-ideaList__item">
            <label for="price" class="p-ideaList__label">価格</label>
            <p class="p-ideaList__item--part">¥{{ idea.price | localeNum }}</p>
          </div>

          <div class="p-ideaList__item">
            <label for="created_at" class="p-ideaList__label">投稿日</label>
            <p class="p-ideaList__item--part">
              {{ idea.created_at | moment }}
            </p>
          </div>
        </div>

        <div class="p-ideaList__item">
          <label for="summary" class="p-ideaList__label">概要</label>
          <p class="p-ideaList__item--part">
            {{ idea.summary }}
          </p>
        </div>

        <div class="p-ideaList__item">
          <label for="reviews" class="p-ideaList__label">口コミ数</label>
          <p class="p-ideaList__item--part">{{ idea.reviews.length }}件</p>
        </div>

  
        <div class="p-ideaList__item--link">
          <a :href="'/idea_detail/' + idea.id" class="c-btn p-ideaList__btn"
            >詳細を見る</a
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
    decimalFormat: function (val) {
      return parseFloat(val).toFixed(1);
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
  },
};
</script>