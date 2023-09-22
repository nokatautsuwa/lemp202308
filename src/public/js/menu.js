// menuリストの開閉
// ------------------------------
const menuButton = document.getElementById('menu');
const menuList = document.getElementById('menu-list');

// classList: id: menu-listの要素にactiveクラスを追加する(既にある場合は削除する)
function menu() {
  menuList.classList.toggle('active');
}

// clickするとmenu functionを実行する
menuButton.addEventListener('click', menu);

// 要素クリックしたときmenu要素がactive状態の場合に実行する
document.addEventListener('click', e => {
  if (!e.target.closest('#menu')) {
    // classList: activeクラスを削除する
    menuList.classList.remove('active');
  }
});
// ------------------------------