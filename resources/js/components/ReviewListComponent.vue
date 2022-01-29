<template>
  <div class="p-reviewList__Container">
    <div class="p-reviewList__partContainer">
      <div  
        class="p-reviewList__part"
        v-for="review in reviews"
        :key="review.id"
      >
        <div class="p-reviewList__itemContainer">
          <div class="p-reviewList__item">
            <label for="idea" class="p-reviewList__label">アイディア名</label>
            <p class="p-reviewList__item--part">{{ review.idea.idea_name }}</p>
          </div>
          <div class="p-reviewList__item--user">
            <img
              v-if="review.user.user_img == null"
              :src="'/img/person.jpg'"
              alt=""
              class="c-img p-reviewList__img"
            />

            <img
              v-if="review.user.user_img != null"
              :src="'/' + review.user.user_img"
              alt=""
              class="c-img p-reviewList__img"
            />
            <p class="p-reviewList__item--part">{{ review.user.name }}</p>
          </div>

          <div class="p-reviewList__item">
            <p v-if="review.stars == 1" class="p-reviewList__item--part">
              <i class="p-reviewList__star fas fa-star"></i>
            </p>
            <p v-if="review.stars == 2" class="p-reviewList__item--part">
              <i class="p-reviewList__star fas fa-star"></i>
              <i class="p-reviewList__star fas fa-star"></i>
            </p>
            <p v-if="review.stars == 3" class="p-reviewList__item--part">
              <i class="p-reviewList__star fas fa-star"></i>
              <i class="p-reviewList__star fas fa-star"></i>
              <i class="p-reviewList__star fas fa-star"></i>
            </p>
            <p v-if="review.stars == 4" class="p-reviewList__item--part">
              <i class="p-reviewList__star fas fa-star"></i>
              <i class="p-reviewList__star fas fa-star"></i>
              <i class="p-reviewList__star fas fa-star"></i>
              <i class="p-reviewList__star fas fa-star"></i>
            </p>
            <p v-if="review.stars == 5" class="p-reviewList__item--part">
              <i class="p-reviewList__star fas fa-star"></i>
              <i class="p-reviewList__star fas fa-star"></i>
              <i class="p-reviewList__star fas fa-star"></i>
              <i class="p-reviewList__star fas fa-star"></i>
              <i class="p-reviewList__star fas fa-star"></i>
            </p>
          </div>

          <div class="p-reviewList__item">
            
            <p class="p-reviewList__item--part">{{ review.comment }}</p>
          </div>

          <div class="p-reviewList__item--link">
            <a
              :href="'/idea_detail/' + review.idea.id"
              class="c-btn p-reviewList__btn"
              >詳細を見る</a
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      reviews: {},
    };
  },
  mounted() {
    const self = this;
    const url = "/ajax/review_list/";
    axios.get(url).then(function (response) {
      self.reviews = response.data;
    });
  },
};
</script>
