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

Vue.component('projectlist-component', require('./components/ProjectListComponent.vue').default);
Vue.component('postprojectlist-component', require('./components/PostProjectListComponent.vue').default);
Vue.component('applyprojectlist-component', require('./components/ApplyProjectListComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import ProjectListComponent from "./components/ProjectListComponent.vue"
import PostProjectListComponent from "./components/PostProjectListComponent.vue"
import ApplyProjectListComponent from "./components/ApplyProjectListComponent.vue"
import Vue from "vue";
const app = new Vue({

    el: '#app',
    components: {
        'projectlist-component': ProjectListComponent,
        'postprojectlist-component': PostProjectListComponent,
        'applyprojectlist-component': ApplyProjectListComponent,
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
        $('.js-show-modal-target').attr('style', 'margin-left:' + (windowWidth / 2 - modalWidth / 2 - 15) + 'px');
        $('.js-show-modal-target').show();
        $('.js-show-modal-cover').show();
    });
    $('.js-hide-modal').on('click', function () {
        $('.js-show-modal-target').hide();
        $('.js-show-modal-cover').hide();
    });
});

//「いいね」を登録・削除
$(function () {
    const like = $('.js-click-good');

    like.on('click', function () {
        const $this = $(this);
        const likeIdeaId = $this.data('projectid');
        const likeFlag = $this.data("flag");
        const count = $('.js-like-count').html();
        const number = Number(count);
        const countUp = number + 1;
        const countDown = number - 1;


        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '/like/' + likeIdeaId,
            type: 'POST',
            data: { 'projectid': likeIdeaId, 'flag': likeFlag },
        })
            /*ajaxが成功した場合、クリックした要素に 'best'、いいねボタンに 'best'のクラスがあるかどうかを判別し、
              クラスの追加、削除をすることで色の変更を行う*/
            .done(function (data) {
                if (like.hasClass("best")) {
                    $('.js-like-count').html(countDown);
                    like.removeClass('best');
                } else if (!like.hasClass("best")) {
                    $('.js-like-count').html(countUp);
                    like.toggleClass('best');
                }

            })
    });
});


//文字カウント(案件投稿画面)
window.addEventListener('DOMContentLoaded',
    function () {
        const title = document.getElementById('js-count-title');
        const content = document.getElementById('js-count-content');

        //文字カウント(タイトル)
        if(!title){return false;}
        title.addEventListener('keyup', function () {
            if (!title) {return false;}
                const countTitle = title.value.length;

                const showCountTitle = document.querySelector('.js-count-short');
                showCountTitle.innerHTML = countTitle;

                //20文字を超えると文字の色が変化
                if (countTitle > 20) {
                    const element = document.querySelector('.c-countArea--short');
                    element.classList.add('c-countArea--changeColor');
                } else if (countTitle <= 20) {
                    const element = document.querySelector('.c-countArea--short');
                    element.classList.remove('c-countArea--changeColor');
                }
            
        });

        //文字カウント(内容)
        content.addEventListener('keyup', function () {
            if (!content) {return false;}
                const countContent = content.value.length;
                const showCountContent = document.querySelector('.js-count-long');
                showCountContent.innerHTML = countContent;

                //5000文字を超えると文字の色が変化
                if (countContent > 5000) {
                    const element = document.querySelector('.c-countArea--long');
                    element.classList.add('c-countArea--changeColor');
                } else if (countContent <= 5000) {
                    const element = document.querySelector('.c-countArea--long');
                    element.classList.remove('c-countArea--changeColor');
                }
            
        });
    });

//文字カウント(プロフィール編集画面)
window.addEventListener('DOMContentLoaded',
    function () {
        //文字数表示(ニックネーム)
        const name = document.getElementById('js-count-name');
        if (!name) {return false;}
            const countName = name.value.length;/*ニックネームの文字数取得*/
            const showCountName = document.querySelector('.js-show-count-name');
            showCountName.innerHTML = countName;/*取得した文字数表示*/

            //文字数表示(自己紹介)
            const text = document.getElementById('js-count-text');
            const countText = text.value.length;/*自己紹介の文字数取得*/
            const showCountText = document.querySelector('.js-show-count-text');
            showCountText.innerHTML = countText;/*取得した文字数表示*/

            //文字カウント(ニックネーム)
            name.addEventListener('keyup', function () {
                const name = document.getElementById('js-count-name');
                const countName = name.value.length;
                const showCountName = document.querySelector('.js-show-count-name');
                showCountName.innerHTML = countName;

                //20文字以上入力で文字の色を変化させる
                if (countName > 20) {
                    const element = document.querySelector('.c-countArea--short');
                    element.classList.add('c-countArea--changeColor');
                } else if (countName <= 20) {
                    const element = document.querySelector('.c-countArea--short');
                    element.classList.remove('c-countArea--changeColor');
                }
            });

            //文字数カウント(自己紹介)
            text.addEventListener('keyup', function () {
                const text = document.getElementById('js-count-text');
                if (!text) {return false;}
                    const countText = text.value.length;
                    const showCountText = document.querySelector('.js-show-count-text');
                    showCountText.innerHTML = countText;

                    //10000文字以上入力で文字の色を変化させる
                    if (countText > 10000) {
                        const element = document.querySelector('.c-countArea--long');
                        element.classList.add('c-countArea--changeColor');
                    } else if (countText <= 10000) {
                        const element = document.querySelector('.c-countArea--long');
                        element.classList.remove('c-countArea--changeColor');
                    }
                
            });
        
    });

//文字カウント(案件編集画面)
window.addEventListener('DOMContentLoaded',
    function () {

        //文字数表示(タイトル)
        const title = document.getElementById('js-count-title');
        if (!title) {return false;}
            const countTitle = title.value.length;
            const showCountTitle = document.querySelector('.js-count-short');
            showCountTitle.innerHTML = countTitle;
        
        //文字数表示(内容)
        const content = document.getElementById('js-count-content');
        if (content !== null) {
            const countContent = content.value.length;
            const showCountContent = document.querySelector('.js-count-long');
            showCountContent.innerHTML = countContent;
        }
    });

//文字カウント(メッセージ送信)
window.addEventListener('DOMContentLoaded',
    function () {
        const msg = document.getElementById('js-count-msg');
        if(!msg){return false;}
        msg.addEventListener('keyup', function () {
            if (msg !== null) {
                const countMsg = msg.value.length;
                const showCountMsg = document.querySelector('.js-count-msg');
                showCountMsg.innerHTML = countMsg;

                //5000文字以上入力で文字の色変化
                if (countMsg > 5000) {
                    const element = document.querySelector('.c-countArea--msg');
                    element.classList.add('c-countArea--changeColor');
                } else if (countMsg <= 5000) {
                    const element = document.querySelector('.c-countArea--msg');
                    element.classList.remove('c-countArea--changeColor');
                }
            }
        });

    });

//案件投稿画面にて、単発を選択した際に金額入力を表示させ,レベニューシェアを選択時は入力した金額を消す
window.addEventListener('DOMContentLoaded',
    function () {
        const priceBox = document.getElementById('priceBox');
        if(!priceBox){return false;}
        priceBox.onchange = function () {
            const priceBox = document.getElementById('priceBox');
            const selectValue = priceBox.value;
            const priceShow = document.querySelector('.js-price-show');
            const clear1 = document.querySelector('.js-clear1');
            const clear2 = document.querySelector('.js-clear2');
            if (selectValue == 1) {
                priceShow.style.display = "block";
            } else if (selectValue == 2) {
                priceShow.style.display = "none";
                clear1.value = '';
                clear2.value = '';
            }
        }
    });

//案件投稿画面にてpost送信後、バリデーションに引っ掛かかった場合の金額入力表示処理    
window.addEventListener('DOMContentLoaded',
    function () {
        const priceBox = document.getElementById('priceBox');
        if (priceBox !== null) {
            const selectValue = priceBox.value;
            const priceShow = document.querySelector('.js-price-show');

            if (selectValue == 1) {
                priceShow.style.display = "block";
            } else if (selectValue == 2) {
                priceShow.style.display = "none";
            }
        }
    });



