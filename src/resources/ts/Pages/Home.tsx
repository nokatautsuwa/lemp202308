import React from 'react';
import { Head, Link, useForm } from '@inertiajs/react';

import PageLayout from '@/Layouts/PageLayout';
import TimeLine from '@/Components/TimeLine';

// TLに表示するテーブルを取得してPostコンポーネントに渡す

// テスト用データ(DBの値に移行するまでの仮置き)
// ------------------------------------
const userData = [
    { id: 1, name: 'テスト1えええええええええええええ', account_id: 'testuser1', repost: false, favorite: false, list: false, follow: false, mute: false, block: false },
    { id: 2, name: 'テスト2', account_id: 'testuser2', repost: false, favorite: false, list: false, follow: false, mute: false, block: false },
    { id: 3, name: 'テスト3えええええええええええええ', account_id: 'testuser3', repost: false, favorite: false, list: false, follow: false, mute: false, block: false },
    { id: 4, name: 'テスト4', account_id: 'testuser4', repost: false, favorite: false, list: false, follow: false, mute: false, block: false },
    { id: 5, name: 'テスト5', account_id: 'testuser5', repost: false, favorite: false, list: false, follow: false, mute: false, block: false },
];
// ------------------------------------

export default function Home() {
    
    return (
        <PageLayout>

            {/* ページタイトル */}
            <Head title="ホーム" />

            {/* TLポスト: ポストエリアをコンポーネント化 */}
            <TimeLine postData={userData} />
            
        </PageLayout>
    );

};