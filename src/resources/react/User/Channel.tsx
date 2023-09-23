import React, { useEffect } from 'react'
import { useParams } from 'react-router-dom';
import '../../sass/user/app.scss';

export default function Channel() {

  // useParamsで変数usernameに末尾の/以降の文字列を格納する
  const { channelName } = useParams();

  // コンポーネントがマウントされたときにページのタイトルを設定
  useEffect(() => {
    document.title = `${channelName} | RES`;
  });

  return (
    <>
      <div className='test'>
        <p>チャンネル名test: { channelName }</p>
      </div>
    </>
  )
}