import React, { useState } from 'react';
import { Head, Link, useForm } from '@inertiajs/react';

import Account from '@/Components/Account';
import DrawerLink from '@/Components/DrawerLink';
import FollowLink from '@/Components/FollowLink';
import NavLink from '@/Components/NavLink';

// Pageコンポーネントのプロパティ型
interface PageLayoutProps {
    children: string;
};

// NavLinkの各要素を配列で取得
const navLinks = [
    { id: 1, url: route('home'), file: 'plus.svg', text: 'ホーム' },
    { id: 2, url: route('home'), file: 'plus.svg', text: 'ホーム' },
    { id: 3, url: route('home'), file: 'plus.svg', text: 'ホーム' },
    { id: 4, url: route('home'), file: 'plus.svg', text: 'ホーム' },
];

// DrawerLinkの各要素を配列で取得
const drawerLinks = [
    { id: 1, url: route('home'), file: 'plus.svg', text: 'ホーム' },
    { id: 2, url: route('home'), file: 'plus.svg', text: '通知' },
    { id: 3, url: route('home'), file: 'plus.svg', text: 'ドライブ' },
    { id: 4, url: route('home'), file: 'plus.svg', text: 'リスト' },
    { id: 5, url: route('home'), file: 'plus.svg', text: '検索' },
    { id: 6, url: route('home'), file: 'plus.svg', text: '設定' },
];

export default function Page({ children }: PageLayoutProps) {
    
    // Drawerステート監視
    // -----------------------------------------
    // boolean
    const [isDrawerOpen, setIsDrawerOpen] = useState(false);
    // TailwindCSS
    const [drawerPosition, setDrawerPosition] = useState({
        position: '-left-72',
        bg: 'hidden'
    });
    // -----------------------------------------
    
    // Postステート監視
    // -----------------------------------------

    // -----------------------------------------

    // onClick={drower}要素押下でスライドイン/スライドアウト
    function drower() {
        // isDrawerOpenを現在と反転させてbooleanの状態に応じてTailwindCSSを反映させる
        setIsDrawerOpen(!isDrawerOpen);
        if (!isDrawerOpen === true) {
            // true(開いている時)
            setDrawerPosition({
                position: 'left-0 duration-150',
                bg: ''
            });
        } else {
            // false(閉じている時)
            setDrawerPosition({
                position: '-left-72 duration-150',
                bg: 'hidden'
            });
        };
    };

    return (
        <div
            className="min-h-screen text-white bg-black"
        >
            
            {/* ヘッダー: lg以上は非表示 */}
            <header
                className='z-10 fixed grid place-items-center bg-gray-800 w-full h-8 lg:hidden'
            >
                <img src={'/storage/images/user/icon_default.svg'} className="h-5 w-auto mx-auto" alt="home" />
            </header>

            {/* アイコン: lg以上は非表示 */}
            <div
                className='z-10 fixed grid place-items-center h-8 left-2.5 lg:hidden'
                onClick={drower}
            >
                <img src={'/storage/images/user/icon_default.svg'} className="h-5 w-auto mx-auto" alt="home" />
            </div>

            
            {/* ページ下のグローバルナビ: lg以上は非表示 */}
            {/* translucent: tailwind.config.jsのカスタムカラー */}
            <nav
                className='z-10 fixed bottom-0 w-full bg-translucent lg:hidden'
            >
                <ul className='flex'>
                    {/* 各NavLink */}
                    {navLinks.map((nav) => (
                        <NavLink
                            key={nav.id}
                            url={nav.url}
                            file={nav.file}
                            text={nav.text}
                        />
                    ))}

                    {/* ポストボタン */}
                    <li
                        className='w-1/5 h-14 pt-2'
                        onClick={drower}
                    >
                        <img src={'/images/close.svg'} className="h-5 w-auto mx-auto" alt="post" />
                    </li>
                </ul>
            </nav>

            
            <main>

                {/* ドロワー: lg以上の場合は常時表示 */}
                <aside
                    className={`z-30 fixed block bg-gray-800 w-72 h-full overflow-y-auto text-sm ${drawerPosition.position} lg:left-0`}
                >
                    {/* スマートフォン表示のみページ下に出してるメニュー項目を表示しない */}
                
                    <ul>
                        {/* サイト案内ページ */}
                        <Link
                            href='/login'
                        >
                            <li
                                className='sticky top-0 h-16 grid place-items-center bg-gray-500'
                            >
                                    <img src={'/storage/images/user/icon_default.svg'} className="h-8 w-auto" alt="home" />
                            </li>
                        </Link>

                        {/* アカウント情報 */}
                        <li className='mt-8'>
                            {/* size90: tailwind.config.jsでカスタム */}
                            <Link
                                href='/login'
                            >
                                <div className='flex px-8'>
                                    <img src={'/storage/images/user/icon_default.svg'} className="h-8 w-auto my-auto mr-2.5 rounded-full" alt="home" />
                                    <Account
                                        name='テストユーザーaaaaaaaaaaaaaaaaaaaaaaaaaaaa'
                                        account='account_id'
                                        class='w-10/12'
                                    />
                                </div>
                            </Link>
                        </li>

                        {/* フォロー/フォロワー情報 */}
                        <li className='px-6 my-6'>
                            <FollowLink
                                follow= {5}
                                follower= {174}
                            />
                        </li>

                        {/* 各DrawerLink */}
                        {drawerLinks.map((drawer) => (
                            <li
                                key={drawer.id}
                                className=''
                            >
                                <DrawerLink
                                    url={drawer.url}
                                    file={drawer.file}
                                    text={drawer.text}
                                />
                            </li>
                        ))}

                        {/* ポストボタン */}
                        <li
                            className='cursor-pointer w-3/4 rounded-full text-center py-3 my-6 mx-auto text-black font-bold bg-white hover:opacity-80'
                            onClick={drower}
                        >
                            ポスト
                        </li>
                    </ul>
                </aside>
                <div
                    className={`z-20 fixed block bg-black opacity-50 w-full h-full ${drawerPosition.bg}`}
                    onClick={drower}
                ></div>

                {/* コンテンツエリア */}
                {/* lg以上でcontent_lg(ドロワーメニューが表示されるため/tailwind.config.jsでカスタム) */}
                <div
                    className='z-0 flex flex-col min-h-screen w-full lg:w-content_lg lg:ml-72'
                >
                    {/* 子コンポーネントでラップされている要素を取得する */}
                    <div className='mt-8 mb-14 lg:mt-2'>
                        {children}
                    </div>
                </div>

            </main>

        </div>
    );
}
