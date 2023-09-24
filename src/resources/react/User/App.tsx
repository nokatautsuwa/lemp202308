
import React, { useEffect } from 'react'
import { createRoot } from 'react-dom/client'
import { Link, BrowserRouter as Router, Routes, Route, useParams } from "react-router-dom"; // npm install react-router-dom で別途インストール
import axios from 'axios'; // APIの取得(npm install axiosで別途インストール)
import useSWR from 'swr'; // npm install swr で別途インストール
import { format } from 'date-fns'; // 日付操作(npm install date-fnsで別途インストール)

// 各URLに対応するコンポーネントを入れる
import Home from '../User/Home';
import Channel from '../User/Channel';

export default function App() {

  async function fetcher(url: string) {
    const response = await fetch(url);
    const data = await response.json();
    return data;
  }
  
  return (
    <>
      <Router>

        <main>
          {/* Route制御: 各URLにアクセスしたときに対応したコンポーネントを表示させる */}
          <Routes>
            {/* ホーム(Publicチャンネル) */}
            <Route path={`/home`} element={<Home />} />
            {/* ホーム(Publicチャンネル) */}
            <Route path={`/home`} element={<Home />} />
            {/* :channelName : 子コンポーネントChannel.tsxに引数を渡す */}
            <Route path={`/channel/:channelName`} element={<Channel />} />
          </Routes>
          
        </main>

        <aside>

          {/* アカウント情報 */}
          <div className='account'>
            <img src={`/storage/images/user/icon_default.svg`} alt='user_default' />
            <div>
              <p>ゲスト</p>
              <p><a href="/login">Login</a></p>
            </div>
          </div>

          {/* グローバルナビ */}
          <nav className='global'>
            <ul>
              <li>
                <Link
                  to={{
                    pathname: `/channel/about`,
                    search: "?created_by=userid",
                  }}
                >
                  <div>
                    <img src={`/storage/images/user/icon_default.svg`} alt='about' />
                    <p>通知</p>
                  </div>
                </Link>
              </li>
              <li>
                <Link
                  to={{
                    pathname: `/channel/test`,
                    search: "?created_by=userid",
                  }}
                >
                  <div>
                    <img src={`/storage/images/user/icon_default.svg`} alt='test' />
                    <p>ドライブ</p>
                  </div>  
                </Link>
              </li>
              <li>
                <Link
                  to={{
                    pathname: `/channel/test`,
                    search: "?created_by=userid",
                  }}
                >
                  <div>
                    <img src={`/storage/images/user/icon_default.svg`} alt='test' />
                    <p>設定</p>
                  </div>
                </Link>
              </li>
              <li>
                <Link
                  to={{
                    pathname: `/channel/test`,
                    search: "?created_by=userid",
                  }}
                >
                  <div>
                    <img src={`/storage/images/user/icon_default.svg`} alt='test' />
                    <p>ログアウト</p>
                  </div>
                </Link>
              </li>
            </ul>
          </nav>

          {/* チャンネルリスト */}
          {/* channelsテーブルのAPIを取得して'/channel/:channelname(64ランダム文字列にする)?created_by={users->id}'にする */}
          <nav className='channel'>
            <p className='title'>チャンネルリスト</p>
            <ul>
              <li>
                <Link to={`/home`}>
                  <div>
                    <img src={`/storage/images/user/icon_default.svg`} alt='public' />
                    <p>Public</p>
                  </div>
                </Link>
              </li>
            </ul>
            <ul>
              <li>
                <Link
                  to={{
                    pathname: `/channel/about`,
                    search: "?created_by=userid",
                  }}
                >
                  <div>
                    <img src={`/storage/images/user/icon_default.svg`} alt='about' />
                    <p>About</p>
                  </div>
                </Link>
              </li>
              <li>
                <Link
                  to={{
                    pathname: `/channel/test`,
                    search: "?created_by=userid",
                  }}
                >
                  <div>
                    <img src={`/storage/images/user/icon_default.svg`} alt='test' />
                    <p>Test</p>
                  </div>
                </Link>
              </li>
            </ul>
          </nav>

        </aside>

      </Router>
    </>
  );
};

const root = createRoot(
  document.getElementById('app') as HTMLElement
)
root.render(<App />)