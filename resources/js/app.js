/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('postidealist-component', require('./components/PostIdeaListComponent.vue').default);
Vue.component('ideadlist-component', require('./components/IdeaListComponent.vue').default);
Vue.component('likeidealist-component', require('./components/LikeIdeaListComponent.vue').default);
Vue.component('boughtidealist-component', require('./components/BoughtIdeaListComponent.vue').default);
Vue.component('reviewlist-component', require('./components/ReviewListComponent.vue').default);
Vue.component('pagination-component', require('./components/PaginationComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import PostIdeaListComponent from "./components/PostIdeaListComponent.vue"
import IdeaListComponent from "./components/IdeaListComponent.vue"
import LikeIdeaListComponent from "./components/LikeIdeaListComponent.vue"
import BoughtIdeaListComponent from "./components/BoughtIdeaListComponent.vue"
import ReviewListComponent from "./components/ReviewListComponent.vue"
import paginationComponent from "./components/PaginationComponent.vue"
import Vue from "vue";
const app = new Vue({
    el: '#app',
    components: {
        'postidealist-component': PostIdeaListComponent,
        'idealist-component': IdeaListComponent,
        'likeidealist-component': LikeIdeaListComponent,
        'boughtidealist-component': BoughtIdeaListComponent,
        'reviewlist-component': ReviewListComponent,
        'pagination-component': paginationComponent,
    },
});



//フラッシュメッセージ
$(function () {
    $('.js-flashMsg').fadeOut(5000);
});

//SPメニュー
$('.js-toggle-sp-menu').on('click', function () {
    $(this).toggleClass('active');
    $('.js-toggle-sp-menu-target').toggleClass('active');
});

//モーダル表示
$(function () {
    $('.js-show-modal').on('click', function () {
        const modalWidth = $('.js-show-modal-target').width();
        const windowWidth = $(window).width();
        console.log(modalWidth);
        console.log(windowWidth);
        $('.js-show-modal-target').attr('style', 'margin-left:' + (windowWidth / 2 - modalWidth / 2 - 15) + 'px');
        $('.js-show-modal-target').show();
        $('.js-show-modal-cover').show();
    });

    $('.js-hide-modal').on('click', function () {
        $('.js-show-modal-target').hide();
        $('.js-show-modal-cover').hide();

    });
});



//アイディア詳細画面から「気になる」を追加・解除する
$(function () {
    const like = $('.js-click-like');

    like.on('click', function () {
        const $this = $(this);
        const likeIdeaId = $this.data('ideaid');
        const likeWord = $('.js-like-word');
        const unlikeWord = $('.js-unlike-word');
        const heart = $('.js-like-heart');


        if (likeWord.text() === '気になる') {
            likeWord.text('気になるを解除する');
        } else if (likeWord.text() === '気になるを解除する') {
            likeWord.text('気になる');
        } else if (unlikeWord.text() === '気になる') {
            unlikeWord.text('気になるを解除する');
        } else if (unlikeWord.text() === '気になるを解除する') {
            unlikeWord.text('気になる');
        }

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '/idea/like/' + likeIdeaId,
            type: 'POST',
            data: { 'ideaid': likeIdeaId },
        })
            /*ajaxが成功した場合、クリックした要素に 'likebtn'、ハートアイコンに 'likeheart'のクラスがあるかどうかを判別し、
              クラスの追加、削除をすることで色の変更を行う*/
            .done(function (data) {
                if (like.hasClass('likebtn') && heart.hasClass('likeheart')) {
                    like.removeClass('likebtn');
                    heart.removeClass('likeheart');
                } else {
                    like.toggleClass('likebtn');
                    heart.toggleClass('likeheart');
                }
            })
    });
});


//文字カウント(プロフィール編集画面)
window.addEventListener('DOMContentLoaded',
    function () {

        //文字数表示(ニックネーム)
        const name = document.getElementById('js-count-name');

        const countName = name.value.length;

        const showCountName = document.querySelector('.js-show-count-name');

        showCountName.innerHTML = countName;

        //文字数表示(自己紹介)
        const text = document.getElementById('js-count-text');

        const countText = text.value.length;

        const showCountText = document.querySelector('.js-show-count-text');

        showCountText.innerHTML = countText;



        //文字カウント(ニックネーム)
        name.addEventListener('keyup', function () {
            const name = document.getElementById('js-count-name');

            const countName = name.value.length;

            const showCountName = document.querySelector('.js-show-count-name');

            showCountName.innerHTML = countName;

            //20文字以上入力で文字の色を変化させる
            if (name.value.length > 20) {
                const element = document.querySelector('.c-countarea--short');
                element.classList.add("c-countarea--changecolor");
            } else if (name.value.length <= 20) {
                const element = document.querySelector('.c-countarea--short');
                element.classList.remove("c-countarea--changecolor");
            }
        });

        //文字カウント(自己紹介)
        text.addEventListener('keyup', function () {
            const text = document.getElementById('js-count-text');

            const countText = text.value.length;

            const showCountText = document.querySelector('.js-show-count-text');

            showCountText.innerHTML = countText;

            //10000文字以上入力で文字の色を変化させる
            if (text.value.length > 10000) {
                const element = document.querySelector('.c-countarea--long');
                element.classList.add("c-countarea--changecolor");
            } else if (text.value.length <= 10000) {
                const element = document.querySelector('.c-countarea--long');
                element.classList.remove("c-countarea--changecolor");
            }
        });
    });

//文字カウント(アイディア投稿画面)
window.addEventListener('DOMContentLoaded',
    function () {

        const idea = document.getElementById('js-count-idea');
        const summary = document.getElementById('js-count-summary');
        const content = document.getElementById('js-count-content');

        //文字カウント(アイディア名)
        idea.addEventListener('keyup', function () {

            const countIdea = idea.value.length;

            const showCountIdea = document.querySelector('.js-show-count-idea');

            showCountIdea.innerHTML = countIdea;

            //20文字以上入力で文字の色を変化させる
            if (idea.value.length > 20) {
                const element = document.querySelector('.c-countarea--short');
                element.classList.add("c-countarea--changecolor");
            } else if (idea.value.length <= 20) {
                const element = document.querySelector('.c-countarea--short');
                element.classList.remove("c-countarea--changecolor");
            }

        });

        //文字カウント(概要)
        summary.addEventListener('keyup', function () {

            const countSummary = summary.value.length;

            const showCountSummary = document.querySelector('.js-show-count-summary');

            showCountSummary.innerHTML = countSummary;

            //100文字以上入力で文字の色を変化させる
            if (summary.value.length > 100) {
                const element = document.querySelector('.c-countarea--mid');
                element.classList.add("c-countarea--changecolor");
            } else if (summary.value.length <= 100) {
                const element = document.querySelector('.c-countarea--mid');
                element.classList.remove("c-countarea--changecolor");
            }

        });

        //文字カウント(内容)
        content.addEventListener('keyup', function () {

            const countContent = content.value.length;

            const showCountContent = document.querySelector('.js-show-count-content');

            showCountContent.innerHTML = countContent;

            //100文字以上入力で文字の色を変化させる
            if (content.value.length > 10000) {
                const element = document.querySelector('.c-countarea--long');
                element.classList.add("c-countarea--changecolor");
            } else if (content.value.length <= 10000) {
                const element = document.querySelector('.c-countarea--long');
                element.classList.remove("c-countarea--changecolor");
            }
        });
    });

//文字カウント(アイディア編集画面)
window.addEventListener('DOMContentLoaded',
    function () {

        //文字数表示(アイディア名)
        const idea = document.getElementById('js-count-idea');

        const countIdea = idea.value.length;

        const showCountIdea = document.querySelector('.js-show-count-idea');

        showCountIdea.innerHTML = countIdea;

        //文字数表示(概要)
        const summary = document.getElementById('js-count-summary');

        const countSummary = summary.value.length;

        const showCountSummary = document.querySelector('.js-show-count-summary');

        showCountSummary.innerHTML = countSummary;

        //文字数表示(内容)
        const content = document.getElementById('js-count-content');

        const countContent = content.value.length;

        const showCountContent = document.querySelector('.js-show-count-content');

        showCountContent.innerHTML = countContent;
    });

    //アイディア詳細画面のレビュー文字カウント
    window.addEventListener('DOMContentLoaded', 
    function(){

        const review = document.getElementById('js-count-review');

        review.addEventListener('keyup', function(){

            const countReview = review.value.length;

            const showCountReview = document.querySelector('.js-show-count-review');

            showCountReview.innerHTML = countReview;

            //10000文字以上入力で文字の色を変化させる
            if (review.value.length > 10000) {
                const element = document.querySelector('.c-countarea--long');
                element.classList.add("c-countarea--changecolor");
            } else if (review.value.length <= 10000) {
                const element = document.querySelector('.c-countarea--long');
                element.classList.remove("c-countarea--changecolor");
            }

        });

    });

































