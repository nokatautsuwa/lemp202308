// menuリストの開閉
// ------------------------------
const menuButton = document.getElementById('menu');
const menuList = document.getElementById('menu-list');



function menu() {
  // 要素のclassListに指定したクラスが含まれているか判定
  const hasClass = menuList.classList.contains('hidden');
  if (hasClass) {
    // class要素にhiddenがある場合はhiddenを削除する
  menuList.classList.remove('hidden');
  } else {
    // ない場合はhiddenを追加する
    menuList.classList.toggle('hidden');
  }
}

// id='menu'要素をクリックするとmenu functionを実行する
menuButton.addEventListener('click', menu);
// ------------------------------