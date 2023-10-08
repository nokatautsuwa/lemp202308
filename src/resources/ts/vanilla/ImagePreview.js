// 画像プレビュー
const fileInput = document.getElementById('file-input');
const previewImg = document.getElementById('preview-img');

fileInput.addEventListener('change', (event) => {
  // 選択されたファイルを取得する
  const file = event.target.files[0];
  // FileReaderオブジェクトを作成する
  const reader = new FileReader();
  // ファイルが読み込まれた時の処理を定義する
  reader.onload = () => {
    // プレビュー画像のsrc属性を更新する
    previewImg.src = reader.result;
  };
  // ファイルを読み込む
  reader.readAsDataURL(file);
});