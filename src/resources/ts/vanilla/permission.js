// 各権限設定のチェックボックス
// ------------------------------------
// 配属先/エリア/user権限/admin権限/system権限のチェックボックスidを取得
var placePulldown = document.getElementById("place");
var areaPulldown = document.getElementById("area");
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

    // userCheckbox/adminCheckboxを無効にする
    userCheckbox.disabled = true;
    adminCheckbox.disabled = true;

    // プルダウンリストplacePulldown/areaPulldownを非表示にする
    placePulldown.classList.toggle('hidden');
    areaPulldown.classList.toggle('hidden');
    // discriptionの非表示を解除する
    description.classList.remove('hidden');

  } else {

    // チェックボックスがチェックされていない場合
    
    // userCheckbox/adminCheckboxを有効にする
    userCheckbox.disabled = false;
    adminCheckbox.disabled = false;

    // プルダウンリストplacePulldown/areaPulldown及びuserCheckbox/adminCheckboxを表示する
    placePulldown.classList.remove('hidden');
    areaPulldown.classList.remove('hidden');

    // discriptionの非表示を有効にする
    description.classList.toggle('hidden');
    
  }

});
// ------------------------------------