// ページを離れるときに確認メッセージを表示させる
window.addEventListener("beforeunload", function (e) {
  // ダイアログメッセージを設定
  let confirmationMessage = "このページを離れてもよろしいですか？";
  // このメッセージをダイアログに表示するかどうかを確認
  (e || window.event).returnValue = confirmationMessage;
  return confirmationMessage;
});