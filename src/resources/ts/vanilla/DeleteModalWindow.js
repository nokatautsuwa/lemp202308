// 編集モーダルウィンドウの開閉
// ------------------------------------
// 編集
var deleteButton= document.getElementById("delete");
// モーダル
var deleteModalWindow = document.getElementById("delete-modal");
// クローズ
var deleteCloseButton = document.getElementById("delete-close");

// id='delete-modal'のclass要素からhiddenを削除する
function deleteModalOpen() {
  deleteModalWindow.classList.remove('hidden');
}

// id='modal'のclass要素からhiddenを追加する
function deleteModalClose() {
  deleteModalWindow.classList.toggle('hidden');
}

// deleteWindow要素をクリックするとopen functionを実行する
deleteButton.addEventListener('click', deleteModalOpen);
// closeWindow要素をクリックするとclose functionを実行する
deleteCloseButton.addEventListener('click', deleteModalClose);
// ------------------------------------