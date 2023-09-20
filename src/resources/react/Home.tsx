import React from 'react'
import { createRoot } from 'react-dom/client'
import { Link, BrowserRouter, Routes, Route } from "react-router-dom"; // npm install react-router-dom で別途インストール

function Home() {
  return (
    <>
      <p>
        Homeテスト
      </p>
    </>
  )
}

export default Home;

const root = createRoot(
  document.getElementById('home') as HTMLElement
)
root.render(<Home />)