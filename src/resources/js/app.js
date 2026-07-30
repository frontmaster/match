import "./bootstrap";

import Alpine from "alpinejs";
import { createApp } from "vue";
import RegisteredProjectList from "./Components/RegisteredProjectList.vue";
import AllProjectList from "./Components/AllProjectList.vue";
import ApplyProjectList from "./Components/ApplyProjectList.vue";

const appElement = document.getElementById("app");

if (appElement) {
    const page = appElement.dataset.page;

    if (page === "mypage-projects") {
        createApp(RegisteredProjectList).mount("#app");
    }

    if (page === "projects") {
        createApp(AllProjectList).mount("#app");
    }

    if (page === "apply-projects") {
        createApp(ApplyProjectList).mount("#app");
    }
}

window.Alpine = Alpine;

Alpine.start();

// 案件種別で単発を選んだ時だけ価格を表示
document.addEventListener("DOMContentLoaded", function () {
    function togglePriceField() {
        const priceField = document.getElementById("priceField");
        const singleRadio = document.getElementById("single");

        if (singleRadio && priceField) {
            if (singleRadio.checked) {
                priceField.style.display = "flex";
            } else priceField.style.display = "none";
        }
    }

    // ラジオボタンの変更を監視
    document.querySelectorAll('input[name="project_type"]').forEach((radio) => {
        radio.addEventListener("change", togglePriceField);
    });

    // ページ読み込み時に適用
    togglePriceField();
});

//モーダル表示
$(function () {
    $(".js-show-modal").on("click", function () {
        $(".js-show-modal-cover").css("display", "flex");
    });

    $(".js-hide-modal").on("click", function () {
        $(".js-show-modal-cover").hide();
    });
});

//モーダルから送信
document.addEventListener("DOMContentLoaded", function () {
    const submitBtn = document.querySelector(".js-submit-main-form");
    const form = document.querySelector(".c-modal__form");

    if (submitBtn && form) {
        submitBtn.addEventListener("click", function () {
            form.submit();
        });
    }
});

//サクセスメッセージ表示
document.addEventListener("DOMContentLoaded", function () {
    const successMessage = document.querySelector(".c-success");

    if (successMessage) {
        // 100ms後にスライドダウンして表示
        setTimeout(() => {
            successMessage.classList.add("show");
        }, 100);

        // 10秒後にフェードアウト
        setTimeout(() => {
            successMessage.style.opacity = "0";
            setTimeout(() => {
                successMessage.style.display = "none";
            }, 500); // フェードアウトアニメーション時間と一致させる
        }, 10000);
    }
});
