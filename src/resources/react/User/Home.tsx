import React, { useEffect } from 'react'
import { createRoot } from 'react-dom/client'
import { Link, BrowserRouter, Routes, Route, useParams } from "react-router-dom"; // npm install react-router-dom で別途インストール
import useSWR from 'swr'; // npm install swr で別途インストール


// asyncで非同期処理を行いawaitで結果が返ってくるまで処理をまつ
async function fetcher(url: string) {
  const response = await fetch(url);
  const data = await response.json();
  console.log(data);
  return data;
}

function Home() {
  
  // コンポーネントがマウントされたときにページのタイトルを設定
  useEffect(() => {
    document.title = `ホーム | RES`;
  });

  return (
    <>
      <p>
        Home TL
      </p>
    </>
  )
}

export default Home;