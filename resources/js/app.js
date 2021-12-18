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

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('postidealist-component', require('./components/PostIdeaListComponent.vue').default);
Vue.component('ideadlist-component', require('./components/IdeaListComponent.vue').default);
Vue.component('likeidealist-component', require('./components/LikeIdeaListComponent.vue').default);
Vue.component('pagination-component', require('./components/PaginationComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import PostIdeaListComponent from "./components/PostIdeaListComponent.vue"
import IdeaListComponent from "./components/IdeaListComponent.vue"
import LikeIdeaListComponent from "./components/LikeIdeaListComponent.vue"
import paginationComponent from "./components/PaginationComponent.vue"
import Vue from "vue";
const app = new Vue({
    el: '#app',
    components: {
        'postidealist-component': PostIdeaListComponent,
        'idealist-component': IdeaListComponent,
        'likeidealist-component': LikeIdeaListComponent,
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

//「気になる」を追加・削除機能
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







//文字数表示(ニックネーム・アイディア名)
const shortString = document.getElementById("js-count-short");
const shortCount = document.querySelector('.js-show-count-short');
shortCount.innerHTML = shortString.value.length;

//文字数表示(概要)
const midString = document.getElementById("js-count-mid");
const midCount = document.querySelector('.js-show-count-mid');
midCount.innerHTML = midString.value.length;

//文字数表示(自己紹介)
const longString = document.getElementById("js-count-long");
const longCount = document.querySelector(".js-show-count-long");
longCount.innerHTML = longString.value.length;




//文字カウント
window.ShowLength = function ShowLength(str, field) {
    document.getElementById(field).innerHTML = str.length;

    //文字数表示(ニックネーム・アイディア名)
    const shortString = document.getElementById("js-count-short");
    const shortCount = document.querySelector('.js-show-count-short');
    shortCount.innerHTML = shortString.value.length;

    //文字数表示(概要)
    const midString = document.getElementById("js-count-mid");
    const midCount = document.querySelector('.js-show-count-mid');
    midCount.innerHTML = midString.value.length;

    //文字数表示(自己紹介)
    const longString = document.getElementById("js-count-long");
    const longCount = document.querySelector(".js-show-count-long");
    longCount.innerHTML = longString.value.length;

    //２０文字以上で文字カウント表示の色変更
    if (shortString.value.length > 20) {
        const element = document.querySelector('.c-countarea--short');
        element.classList.add("c-countarea--changecolor");
    } else if (shortString.value.length <= 20) {
        const element = document.querySelector('.c-countarea--short');
        element.classList.remove("c-countarea--changecolor");
    }

    //10０文字以上で文字カウント表示の色変更
    if (midString.value.length > 100) {
        const element = document.querySelector('.c-countarea--mid');
        element.classList.add("c-countarea--changecolor");
    } else if (midString.value.length <= 100) {
        const element = document.querySelector('.c-countarea--mid');
        element.classList.remove("c-countarea--changecolor");
    }

    //10000文字以上で文字カウント表示の色変更
    if (longString.value.length > 10000) {
        const element = document.querySelector('.c-countarea--long');
        element.classList.add("c-countarea--changecolor");
    } else if (longString.value.length <= 10000) {
        const element = document.querySelector('.c-countarea--long');
        element.classList.remove("c-countarea--changecolor");
    }
}





























