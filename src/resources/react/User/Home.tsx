import React, { useEffect } from 'react'
import { createRoot } from 'react-dom/client'
import { Link, BrowserRouter, Routes, Route, useParams } from "react-router-dom"; // npm install react-router-dom で別途インストール

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