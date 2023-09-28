// 各権限設定のチェックボックス
// ------------------------------------
// user権限/admin権限/system権限のチェックボックスidを取得
var userCheckbox = document.getElementById("user-permission");
var adminCheckbox = document.getElementById("admin-permission");
var systemCheckbox = document.getElementById("system-permission");
// descriptionタグを取得
var description = document.getElementById("description");
// ------------------------------------



// チェックボックスの状態を監視
// ------------------------------------
systemCheckbox.addEventListener("change", function () {
  
  
  if (systemCheckbox.checked) {

    // チェックボックスがチェックされている場合

    // userCheckbox/adminCheckboxをチェックを外して無効にする
    userCheckbox.checked = false;
    userCheckbox.disabled = true;
    adminCheckbox.checked = false;
    adminCheckbox.disabled = true;
    // discriptionの非表示を解除する
    description.classList.remove('hidden');

  } else {

    // チェックボックスがチェックされていない場合
    
    // userCheckbox/adminCheckboxを有効にする
    userCheckbox.disabled = false;
    adminCheckbox.disabled = false;
    // discriptionの非表示を有効にする
    description.classList.toggle('hidden');
    
  }

});
// ------------------------------------