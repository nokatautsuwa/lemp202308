import React, { useState, useEffect } from 'react';
import useSWR, { mutate } from 'swr';
import { Navigate } from "react-router-dom";
import axios from 'axios'; // APIの取得(npm install axiosで別途インストール)

function Login() {

  async function fetcher(url: string) {
    const response = await fetch(url);
    const data = await response.json();
    return data;
  }

  // 入力欄の値を取得
  const [credentials, setCredentials] = useState({ email: '', password: '' });
  const handleInputChange = (e:any) => {
    const { name, value } = e.target;
    setCredentials({ ...credentials, [name]: value });
  };

  // 認証情報を保持
  const [user, setUser] = useState(null);
  

  const LoginSubmit = async (e:any) => {
    e.preventDefault();

    // 最初にアプリケーションのCSRF保護を初期化
    // 今回はオリジンが同じなので必要ないが、別々のサーバで実装する時はCORS設定が必要
    // エンドポイントにGETリクエストするとCSRFトークンを含むXSRF-TOKENクッキー付きレスポンスが返却される
    // DevToolのNetworkにあるcsrf-cookieで確認できる
    axios.get('/sanctum/csrf-cookie').then(response => {

      if (response) {
        console.log('ok');
        console.log(credentials);
      }

      const data = {
        email: credentials.email,
        password: credentials.password,
      }
      
      axios.post("/api/login", data).then(response => {

        console.log(response.data);
        // 200: 成功
        if (response.data.status === 200) {
          console.log('[login]ログイン成功');
          setUser(response.data); // 認証情報をsetUserに保存
        } else {
          console.log('[login]ログイン失敗');
        }

      }).catch(err => {
        console.log(err.response);
      });
      
    });

  };

  const LogoutSubmit = async () => {
    try {
      // セッション情報を消去した後はRouteServiceProvider.phpにの設定に従ってリダイレクトされる
      await axios.post('/api/logout');
      setUser(null);
    } catch (error) {
        console.error('ログアウト時にエラーが発生しました', error);
    }
  };

  return (
    <div>
      {user ? (
        // 認証が通っている場合の表示
        <>
          <h1>ログインしています</h1>
          <form onSubmit={LogoutSubmit}>
            <div>
              <button type="submit">ログアウト</button>
            </div>
          </form>
        </>
      ) : (
        // 認証が通っていない場合の表示
        <>
          <h1>ログインしていません</h1>
          <form onSubmit={LoginSubmit}>
            <div>
              <label>Email:</label>
              <input
                type="email"
                name="email"
                value={credentials.email}
                onChange={handleInputChange}
              />
            </div>
            <div>
              <label>Password:</label>
              <input
                type="password"
                name="password"
                value={credentials.password}
                onChange={handleInputChange}
              />
            </div>
            <div>
              <button type="submit">ログイン</button>
            </div>
          </form>
        </>
      )}
    </div>
  );
}

export default Login;
