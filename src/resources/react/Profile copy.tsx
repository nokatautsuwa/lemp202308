// Read/Follow

import React, { useEffect, useState } from 'react'
import { createRoot } from 'react-dom/client'
import { BrowserRouter as Router, useLocation } from "react-router-dom"; // npm install react-router-dom で別途インストール
import useSWR from 'swr'; // npm install swr で別途インストール
import { format } from 'date-fns'; // 日付操作(npm install date-fnsで別途インストール)

//SWRを使わない場合
import axios from 'axios'; // DBの取得(npm install axiosで別途インストール)

// SWRを使わない場合
interface User {
  id: number;
  name: string;
  account_id: string;
  email: string;
  bio: string;
  image: string;
  owner_authority: number;
  created_at: Date;
  updated_at: Date;
}

// asyncで非同期処理を行いawaitで結果が返ってくるまで処理をまつ
async function fetcher(url: string) {
  const response = await fetch(url);
  const data = await response.json();
  return data;
}

function App() {

  // locationオブジェクト取得
  const location = useLocation();
  const currentPath = location.pathname;
  // エンドポイントから最後の/以降の文字列のみ取得(account_id)
  const endpoint = currentPath.substring(currentPath.lastIndexOf('/') + 1);

  // useLocationで取得したURLエンドポイントでusers APIを取得
  // URLのエンドポイントにusersテーブルのaccount_id値を入れている
  const { data: dataUser, error: errorUser } = useSWR(`/api/users/${endpoint}`, fetcher);
  // console.log(data);

  // サーバーエラー(500)
  if (errorUser) {
    return <div className='guide'>Error</div>;
  }

  // 取得中
  if (!dataUser) {
    return <div className='guide'>Loading...</div>;
  }

  // データの表示や処理
  return (
    <>
      {/* アカウント情報 */}
      <ul>
        <li>
          <img src={`/storage/images/user/${dataUser.image}`} alt={dataUser.name} />
        </li>
        <li>
          <p className="user-name">{dataUser.name}</p>
          <p className="user-account-id">@{dataUser.account_id}</p>
        </li>
        <li>
          <button>フォロー</button>
        </li>
      </ul>

      {/* 自己紹介文 */}
      <div className="bio">
        <p>{dataUser.bio}</p>
      </div>

      {/* Date */}
      <div className="date">
        <p>
          <span>登録日</span>
          <span>{format(new Date(dataUser.created_at), 'yyyy/MM/dd')}</span>
        </p>
        <p>
          <span>誕生日</span>
          <span>
            {/* 三項演算子でtrue判定を行いfalse(null)の場合に'-'を表示させる */}
            {dataUser.birth ? format(new Date(dataUser.birth), 'yyyy/MM/dd') : '-'}
          </span>
        </p>
      </div>

      {/* フォロー/フォロワー */}
      <div className="follow">
        <p>
          <span>{dataUser.follow_count}</span>
          フォロー
        </p>
        <p>
          <span>{dataUser.follower_count}</span>
          フォロワー
        </p>
      </div>
    </>
  );
}

// useLocationを使用するためにメイン処理をAppにして<Router>コンポーネント内に読み込んでいる
export default function Profile() {
  return (
    <>
      <Router>
        <App />
      </Router>
    </>
  );
};

const root = createRoot(
  document.getElementById('profile') as HTMLElement
)
root.render(<Profile />)