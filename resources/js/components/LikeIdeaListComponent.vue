<template>
  <div class="p-postIdeaList__Container">
    <div class="p-postIdeaList__partContainer">
      <div
        class="p-postIdeaList__part"
        v-for="like in filteredLikes"
        :key="like.id"
      >
        <div class="p-postIdeaList__item">
          <label for="idea" class="p-postIdeaList__label">アイディア名</label>
          <p class="p-postIdeaList__item--part">{{ like.idea.idea_name }}</p>
        </div>

        <div class="p-postIdeaList__item">
          <label for="idea" class="p-postIdeaList__label">価格</label>
          <p class="p-postIdeaList__item--part">
            ¥{{ like.idea.price | localeNum }}
          </p>
        </div>

        

        <div class="p-postIdeaList__item--link">
          <a
            :href="'/idea_detail/' + like.idea.id"
            class="c-btn p-postIdeaList__btn"
            >詳細を見る</a
          >
          <p
            class="c-btn p-ideaDetail__btn likebtn js-unlike-word js-click-likelist"
            :data-likeid="like.idea.id"
          >
            気になるを解除する
          </p>
          <i
            class="fas fa-heart p-ideaDetail__heart js-like-heart likeheart"
          ></i>
        </div>
      </div>
    </div>
    <div class="p-postIdeaList__pagination">
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
      const url = "/ajax/like_idea_list/" + this.user_id + "?page=" + this.page;
      axios.get(url).then((response) => {
        this.likes = response.data;
      });
    },

    movePage(page) {
      this.page = page;
      this.getItems();
    },
  },

  mounted() {
    var self = this;
    var url = "/ajax/like_idea_list/" + this.user_id;
    axios.get(url).then(function (response) {
      self.likes = response.data;
    });
  },
  computed: {
    filteredLikes: function () {
      var likes = [];

      for (var i in this.likes.data) {
        var like = this.likes.data[i];
        likes.push(like);
      }
      return likes;
    },
  },
};
</script>
