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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
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



//文字カウント(ニックネーム)
var countname = document.getElementById("count-name");
var count = countname.value.length;
var showcount = document.querySelector('.js-show-count');
showcount.innerHTML = count;

countname.addEventListener('keyup', function () {
    var count = countname.value.length;
    var showcount = document.querySelector('.js-show-count');
    showcount.innerHTML = count;

    //20文字以上入力でspanタグの色を変更
    if (count > 20) {
        let element = document.getElementsByClassName('p-profile__countarea');
        element[0].classList.add("p-profile__countarea--changecolor");
    } else if (count <= 20) {
        let element = document.getElementsByClassName('p-profile__countarea');
        element[0].classList.remove("p-profile__countarea--changecolor");
    }

});

//文字カウント(自己紹介)
var comment = document.getElementById("count-comment");
comment.addEventListener('keyup', function () {

    var count = comment.value.length;
    var showcount = document.querySelector('.js-show-count-comment');
    showcount.innerHTML = count;

    //10000文字以上入力でspanタグの色を変更
    if (count > 100000) {
        let element = document.getElementsByClassName('p-profile__countarea--comment');
        element[0].classList.add("p-profile__countarea--changecolor");
    } else if (count <= 100000) {
        let element = document.getElementsByClassName('p-profile__countarea--comment');
        element[0].classList.remove("p-profile__countarea--changecolor");
    }

});


