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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('postidealist-component', require('./components/PostIdeaListComponent.vue').default);
Vue.component('pagination-component', require('./components/PaginationComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import PostIdeaListComponent from "./components/PostIdeaListComponent.vue"
import paginationComponent from "./components/PaginationComponent.vue"
import Vue from "vue";
const app = new Vue({
    el: '#app',
    components: {
        'postidealist-component': PostIdeaListComponent,
        'pagination-component': paginationComponent
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

//文字数表示(ニックネーム)
const inputName = document.getElementById("js-count-name");
const showname = document.querySelector('.js-show-count-name');
showname.innerHTML = inputName.value.length;

//文字数表示(自己紹介)
const inputText = document.getElementById("js-count-text");
const showtext = document.querySelector(".js-show-count-text");
showtext.innerHTML = inputText.value.length;

//文字カウント
window.ShowLength = function ShowLength(str, field) {
    document.getElementById(field).innerHTML = str.length;
    
    //ニックネーム２０文字以上で文字カウント表示の色変更
    if (inputName.value.length > 20) {
        const element = document.querySelector('.c-countarea--name');
        element.classList.add("c-countarea--changecolor");
    } else if (inputName.value.length <= 20) {
        const element = document.querySelector('.c-countarea--name');
        element.classList.remove("c-countarea--changecolor");
    }
    
    //自己紹介10000文字以上で文字カウント表示の色変更
    if (inputText.value.length > 10000) {
        const element = document.querySelector('.c-countarea--text');
        element.classList.add("c-countarea--changecolor");
    } else if (inputText.value.length <= 10000) {
        const element = document.querySelector('.c-countarea--text');
        element.classList.remove("c-countarea--changecolor");
    }
}


















