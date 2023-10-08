// 編集モーダルウィンドウの開閉
// ------------------------------------
// 編集
var editButton= document.getElementById("edit");
// モーダル
var editModalWindow = document.getElementById("edit-modal");
// クローズ
var editCloseButton = document.getElementById("edit-close");

// id='edit-modal'のclass要素からhiddenを削除する
function editModalOpen() {
  editModalWindow.classList.remove('hidden');
}

// id='modal'のclass要素からhiddenを追加する
function editModalClose() {
  editModalWindow.classList.toggle('hidden');
}

// editWindow要素をクリックするとopen functionを実行する
editButton.addEventListener('click', editModalOpen);
// closeWindow要素をクリックするとclose functionを実行する
editCloseButton.addEventListener('click', editModalClose);
// ------------------------------------