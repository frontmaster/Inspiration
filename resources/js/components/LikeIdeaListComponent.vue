<template>
  <div class="p-likeIdeaList__Container">
    <div class="p-likeIdeaList__partContainer">
      <div
        class="p-likeIdeaList__part"
        v-for="like in filteredLikes"
        :key="like.id"
      >
        <div class="p-likeIdeaList__item">
          <div class="p-likeIdeaList__item--part">
            <label for="idea" class="p-likeIdeaList__label">アイディア名</label>
            <p class="p-likeIdeaList__item--part">{{ like.idea_name }}</p>
          </div>
          <div class="p-likeIdeaList__item--part">
            <label for="category" class="p-likeIdeaList__label">カテゴリ</label>
            <p class="p-likeIdeaList__item--part">
              {{ like.category.category_name }}
            </p>
          </div>
          <div class="p-likeIdeaList__item--part">
            <label for="price" class="p-likeIdeaList__label">価格</label>
            <p class="p-likeIdeaList__item--part">
              ¥{{ localeNum(like.price) }}
            </p>
          </div>
        </div>

        <div class="p-likeIdeaList__item--link">
          <a
            :href="'/idea_detail/' + like.idea_id"
            class="c-btn p-likeIdeaList__btn"
            >詳細を見る</a
          >
          <p
            @click="likeDelete"
            class="
              c-btn
              p-likeIdeaList__btn--like
              likebtn
              js-unlike-word js-click-like
            "
            :data-like-id="like.idea_id"
          >
            気になるを解除する

            <i
              class="fas fa-heart p-likeIdeaList__heart js-like-heart likeheart"
            ></i>
          </p>
        </div>
      </div>
    </div>
    <div class="p-likeIdeaList__pagination">
      <pagination-component
        :data="likes"
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
      likes: {},
    };
  },
  mounted() {
    const self = this;
    const url = "/ajax/like_idea_list/" + this.user_id;
    axios.get(url).then(function (response) {
      self.likes = response.data;
    });
  },
  computed: {
    filteredLikes: function () {
      const likes = [];

      for (let i in this.likes.data) {
        const like = this.likes.data[i];
        likes.push(like);
      }
      return likes;
    },
  },
  methods: {
    move(page) {
      if (!this.isCurrentPage(page)) {
        this.$emit("move-page", page);
      }
    },
    getItems() {
      const url = "/ajax/like_idea_list/" + this.user_id + "?page=" + this.page;
      axios.get(url).then((response) => {
        this.likes = response.data;
      });
    },
    movePage(page) {
      this.page = page;
      this.getItems();
    },
    likeDelete: function (e) {
      const id = e.currentTarget.getAttribute("data-like-id");
      axios.post("/idea/like/" + id).then((response) => {
        this.data = response.data;

        for (let i in this.likes.data) {
          this.likes.data.splice(i, 1);
        }
      });
    },
    localeNum: function (val) {
      return val.toLocaleString();
    },
  },
};
</script>
