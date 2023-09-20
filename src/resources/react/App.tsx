import React from 'react'
import { createRoot } from 'react-dom/client'
import { Link, BrowserRouter, Routes, Route } from "react-router-dom"; // npm install react-router-dom で別途インストール

// 各URLに対応するコンポーネントを入れる
import Test from './Test';
import Home from './Home';
import About from './About';

// App.tsxで全てのComponentを制御してRoutesで各SPAのURLルートを設定する
// ex.)
// '/'の時はHomeコンポーネントを呼び出す
// '/about'の時はAboutコンポーネントを呼び出す

function App() {
  // api経由でログイン中ユーザー情報を取得
  // その中からaccount_idを取得
  // deleteにそれを入れ込む
  return (
    <BrowserRouter>
      <h2>React</h2>

      <p><Link to={`/`}>testアクセステスト</Link></p>
      <p><Link to={`/home`}>homeアクセステスト</Link></p>
      <p><Link to={`/about`}>aboutアクセステスト</Link></p>

      {/* Route制御: 各URLにアクセスしたときに対応したコンポーネントを表示させる */}
      <Routes>
        <Route path={`/`} element={<Test />} />
        <Route path={`/home`} element={<Home />} />
        <Route path={`/about`} element={<About />} />
      </Routes>

    </BrowserRouter >
  )
}

export default App;

const root = createRoot(
  document.getElementById('app') as HTMLElement
)
root.render(<App />)