<template>
  <div class="p-ideaList__Container">
    <div class="p-ideaList__searchBox">
      <div class="p-ideaList__searchContainer">
        <select v-model="selectedCategory" class="p-ideaList__category">
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
          class="p-ideaList__search"
          v-model="keyword"
          placeholder="アイディア名・概要で検索"
        />
        <span class="p-ideaList__searchIcon"
          ><i class="fas fa-search"></i
        ></span>
      </div>
    </div>
    <div class="p-ideaList__sortContainer">
      <div class="p-ideaList__sortContainer--part">
        <button class="p-ideaList__sort" @click="priceUp">
          価格が高い順<i
            class="fas fa-solid fa-chevron-up p-ideaList__sortIcon"
          ></i>
        </button>
        <button class="p-ideaList__sort" @click="priceLow">
          価格が安い順<i
            class="fas fa-solid fa-chevron-down p-ideaList__sortIcon"
          ></i>
        </button>
      </div>
      <div class="p-ideaList__sortContainer--part">
        <button class="p-ideaList__sort" @click="dateUp">
          日付が古い順<i
            class="fas fa-solid fa-chevron-up p-ideaList__sortIcon"
          ></i>
        </button>
        <button class="p-ideaList__sort" @click="dateLow">
          日付が新しい順<i
            class="fas fa-solid fa-chevron-down p-ideaList__sortIcon"
          ></i>
        </button>
      </div>
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
            <p class="p-ideaList__item--part">¥{{ localeNum(idea.price) }}</p>
          </div>

          <div class="p-ideaList__item">
            <label for="created_at" class="p-ideaList__label">投稿日</label>
            <p class="p-ideaList__item--part">
              {{ moment(idea.created_at) }}
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
      selectedCategory: "",
      optionCategory: [
        { id: 1, category_name: "マッチング" },
        { id: 5, category_name: "掲示板" },
        { id: 7, category_name: "SNS" },
        { id: 9, category_name: "シェアリング" },
        { id: 11, category_name: "ECサイト" },
        { id: 13, category_name: "情報配信" },
        { id: 15, category_name: "その他" },
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
      const url = "/ajax/idea_list?page=" + this.page;
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
    decimalFormat: function (val) {
      return parseFloat(val).toFixed(1);
    },
    moment(date) {
      return moment(date).format("YYYY/MM/DD");
    },

    priceUp() {
      this.ideas.data.sort((a, b) => {
        return b.price - a.price;
      });
    },

    priceLow() {
      this.ideas.data.sort((a, b) => {
        return a.price - b.price;
      });
    },

    dateUp() {
      this.ideas.data.sort((a, b) => {
        return new Date(a.created_at) - new Date(b.created_at);
      });
    },

    dateLow() {
      this.ideas.data.sort((a, b) => {
        return new Date(b.created_at) - new Date(a.created_at);
      });
    },
  },

  mounted() {
    const self = this;
    const url = "/ajax/idea_list";
    axios.get(url).then(function (response) {
      self.ideas = response.data;
    });
  },
  computed: {
    filteredIdeas: function () {
      const ideas = [];

      for (let i in this.ideas.data) {
        const idea = this.ideas.data[i];

        if (
          //String(idea.price).indexOf(this.keyword) !== -1 ||
          //idea.created_at.indexOf(this.keyword) !== -1 ||
          idea.idea_name.indexOf(this.keyword) !== -1 &&
          idea.summary.indexOf(this.keyword) !== -1 &&
          idea.category.category_name.indexOf(this.selectedCategory) !== -1
        ) {
          ideas.push(idea);
        }
      }

      return ideas;
    },
  },
};
</script>