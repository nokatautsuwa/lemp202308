import React, { useState, useEffect } from 'react';
import { createRoot } from 'react-dom/client'
import { BrowserRouter as Router, Routes, Route, Navigate, useNavigate } from "react-router-dom";
import axios from 'axios'; // APIの取得(npm install axiosで別途インストール)

function App() {
  return (
    <Router>
      <Routes>
        <Route path={`/home`} element={<Home />} />
      </Routes>
    </Router>
  );
}

function Home() {
  const navigate = useNavigate();

  const handleButtonClick = () => {
    navigate('/login');
  };

  return (
    <div>
      <h1>Home</h1>
      <button onClick={handleButtonClick}>Loginへ</button>
    </div>
  );
}

function About() {
  return <h1>About</h1>;
}

export default App;

const root = createRoot(
  document.getElementById('test') as HTMLElement
)
root.render(<App />)
