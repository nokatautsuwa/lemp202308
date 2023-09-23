
import React from 'react'
import { createRoot } from 'react-dom/client'
import { Link, BrowserRouter as Router, Routes, Route } from "react-router-dom"; // npm install react-router-dom で別途インストール
import useSWR from 'swr'; // npm install swr で別途インストール
import { format } from 'date-fns'; // 日付操作(npm install date-fnsで別途インストール)

// App.tsxで全てのComponentを制御してRoutesで各SPAのURLルートを設定する
// ex.)
// '/'の時はHomeコンポーネントを呼び出す
// '/about'の時はAboutコンポーネントを呼び出す

// 各URLに対応するコンポーネントを入れる
import Home from './User/Home';
import About from './User/Channel/About';


export default function App() {
  return (
    <>
      <Router>

        <h1>React-User</h1>

        <p><Link to={`/home`}>Home</Link></p>
        <p><Link to={`/channel/about`}>About</Link></p>

        {/* Route制御: 各URLにアクセスしたときに対応したコンポーネントを表示させる */}
        <Routes>
          <Route path={`/home`} element={<Home />} />
          <Route path={`/channel/about`} element={<About />} />
        </Routes>

      </Router>
    </>
  );
};

const root = createRoot(
  document.getElementById('app') as HTMLElement
)
root.render(<App />)