import React, { useRef, useEffect, useState, SetStateAction } from 'react';
import { Link } from '@inertiajs/react';

import Account from '@/Components/Account';

// 受け取ったpostDataの各データの型定義
interface postData {
    id: number;
    name: string;
    account_id: string;
    repost: boolean;
    favorite: boolean;
    list: boolean;
    follow: boolean;
    mute: boolean;
    block: boolean;
};
// 受け取ったpostData配列の型定義
interface PostProps {
  postData: postData[];
};



// 親コンポーネントからpostDataを受け取る
export default function Post({ postData }: PostProps) {


    // リアクションエリア

    // リアクションの各要素を配列で取得
    const reactionData = [
        { id: 1, path: 'close.svg', set: 'response' },
        { id: 2, path: 'close.svg', set: 'repost' },
        { id: 3, path: 'close.svg', set: 'favorite' },
        { id: 4, path: 'close.svg', set: 'list' },
        { id: 5, path: 'close.svg', set: 'others' },
    ];

    // 各ステート
    // ----------------------------------------------------------------
    // リアクションアイコンボタンのデフォルトデザイン
    const reactionIconTrue = 'bg-gray-200';
    const reactionIconFalse = '';
    const initialReactionIcon = {
        repost: reactionIconFalse,
        favorite: reactionIconFalse,
        list: reactionIconFalse,
    };
    const [reactionList, setReactionList] = useState(postData.map(() => ({ ...initialReactionIcon })));

    // その他アクションメニュー
    const [isOtherListOpen, setIsOtherListOpen] = useState(postData.map(() => false));
    const [otherList, setOtherList] = useState(postData.map(() => 'hidden'));
    // ----------------------------------------------------------------


    // クリック時にfuncNameに格納した値に応じた処理を実行する
    const reactionHandleClick = (data : postData, reSet: string) => {

        // 配列インデックスの開始番号が0のため
        const indexNo = data.id - 1

        // reactionListを配列で取得
        const newReactionList = reactionList.map((newReactionList) => {
            return newReactionList;
        });
        // 条件に応じてreactionHandleClickの処理を変える
        // -------------------------------------------------
        if (reSet === 'response') {

            alert(`レスポンスします`);

        } else if (reSet === 'repost') {

            data.repost = !data.repost
            if (data.repost === true) {
                newReactionList[indexNo].repost = reactionIconTrue;
            } else {
                newReactionList[indexNo].repost = reactionIconFalse;
            }
            // 配列をセットする
            setReactionList(newReactionList);

        } else if(reSet === 'favorite') {

            data.favorite = !data.favorite
            if (data.favorite === true) {
                newReactionList[indexNo].favorite = reactionIconTrue;
            } else {
                newReactionList[indexNo].favorite = reactionIconFalse;
            }
            setReactionList(newReactionList);

        } else if(reSet === 'list') {

            data.list = !data.list
            if (data.list === true) {
                newReactionList[indexNo].list = reactionIconTrue;
            } else {
                newReactionList[indexNo].list = reactionIconFalse;
            }
            setReactionList(newReactionList);

        } else if (reSet === 'others') {

            // 該当リスト以外の要素を全てデフォルトにする
            const resetIsOtherListOpen = isOtherListOpen.map((resetIsOtherListOpen, index) => {
                if (index !== indexNo) {
                    return false;
                }
                return resetIsOtherListOpen;
            });
            const resetOtherList = otherList.map((resetOtherList, index) => {
                if (index !== indexNo) {
                    return 'hidden';
                }
                return resetOtherList;
            });

            // otherList/isOtherListOpenを配列で取得
            const newIsOtherListOpen = [...resetIsOtherListOpen];
            const newOtherList = [...resetOtherList];

            // 配列の該当するステータスを反転させる
            newIsOtherListOpen[indexNo] = !newIsOtherListOpen[indexNo];

            // 対象のリストのステータスがtrueの場合は表示させる
            // 非表示にする
            if (newIsOtherListOpen[indexNo] === true) {
                newOtherList[indexNo] = '';
            } else {
                newOtherList[indexNo] = 'hidden';
            }
            setIsOtherListOpen(newIsOtherListOpen);
            setOtherList(newOtherList);

        } else {
            alert(`Error: メソッドが見つかりません`);
        }
        // -------------------------------------------------

    };



    // その他処理エリア
    
    // その他処理の各要素を配列で取得
    const othersFuncData = [
        { id: 1, set: 'follow', text: 'フォロー' },
        { id: 2, set: 'mute', text: 'ミュート' },
        { id: 3, set: 'block', text: 'ブロック' },
        { id: 4, set: 'report', text: '報告' },
    ];
    
    // 各ステート
    // ----------------------------------------------------------------
    // その他処理ボタンのデザイン
    const reactionOthersTrue = 'bg-gray-600 text-white';
    const reactionOthersFalse = 'bg-white text-black';
    const initialReactionOthers = {
        follow: reactionOthersFalse,
        mute: reactionOthersFalse,
        block: reactionOthersFalse,
    };
    const [reactionOthersList, setReactionOthersList] = useState(postData.map(() => ({ ...initialReactionOthers })));

    // メッセージの内容/表示位置
    const [message, setMessage] = useState({
        user: '',
        position: '-top-10',
        text: '',
    });
    // タイマー
    const timerId = useRef<ReturnType<typeof setTimeout> | null>();
    // ----------------------------------------------------------------


    // reactionOthersListを配列で取得
    const newReactionOthersList = reactionOthersList.map((newReactionOthersList) => {
        return newReactionOthersList;
    });

    // クリック時にfuncNameに格納した値に応じた処理を実行する
    const othersHandleClick = (data: postData, otrSet: string) => {

        // 配列インデックスの開始番号が0のため
        const indexNo = data.id - 1
        
        // 条件に応じてreactionHandleClickの処理を変える
        // -----------------------------------------------------
        if (otrSet === 'follow') {

            data.follow = !data.follow
            if (data.follow === true) {
                newReactionOthersList[indexNo].follow = reactionOthersTrue;
            } else {
                newReactionOthersList[indexNo].follow = reactionOthersFalse;
            }
            // 配列をセットする
            setReactionOthersList(newReactionOthersList);
            

        } else if (otrSet === 'report') {

                alert(`${data.name}さんを報告します`);

        } else if (otrSet === 'mute' || otrSet === 'block') {
        // フォローはメッセージを出す必要がない/通報は別ページへ移動させるため
        // 上部からスライドインするメッセージは残りのミュートとブロックに対してのみ適用させる

            // メッセージステートに引数で受け取った値と表示させる用のTailwindCSSを入れる
            setMessage((setMessage) => ({
                ...setMessage, // 既存のメッセージ情報をコピー
                user: data.name,
                position: 'top-3 duration-150',
            }));

            if (otrSet === 'mute') {

                data.mute = !data.mute
                if (data.mute === true) {
                    newReactionOthersList[indexNo].mute = reactionOthersTrue;
                    setMessage((setMessage) => ({
                        ...setMessage,
                        text: `をミュートしました`,
                    }));
                } else {
                    newReactionOthersList[indexNo].mute = reactionOthersFalse;
                    setMessage((setMessage) => ({
                        ...setMessage,
                        text: `のミュートを解除しました`,
                    }));
                }

            } else if (otrSet === 'block') {

                data.block = !data.block
                if (data.block === true) {
                    newReactionOthersList[indexNo].block = reactionOthersTrue;
                    setMessage((setMessage) => ({
                        ...setMessage,
                        text: `をブロックしました`,
                    }));
                } else {
                    newReactionOthersList[indexNo].block = reactionOthersFalse;
                    setMessage((setMessage) => ({
                        ...setMessage,
                        text: `のブロックを解除しました`,
                    }));
                }

            } else {
                alert(`Error: メソッドが見つかりません`);
            }

            // 3秒後にpositionを元の場所に戻す(最初にタイマーをクリア)
            if (timerId.current) {
                clearTimeout(timerId.current);
            }
            timerId.current = setTimeout(() => {
                setMessage((setMessage) => ({
                    ...setMessage,
                    position: '-top-10 duration-150',
                }));
            }, 3000);

        } else {
            alert(`Error: メソッドが見つかりません`);
        };
        // -----------------------------------------------------

    };
    


    return (

        <>
            {postData.map((data) => (
                
                <div
                    className='w-11/12 sm:w-3/4 mx-auto lg:mt-2 border-b border-gray-600'
                    key={data.id}
                >

                    {/* ポストブロック */}
                    <div className='flex mx-auto my-2 text-sm bg-gray-900 px-2 py-4 rounded-xl'>

                        <Link
                            href='/login'
                        >
                            {/* アイコン */}
                            <img src={'/images/close.svg'}
                                className="w-8 h-8 mx-2 rounded-full object-cover bg-red-300"
                                alt="post"
                            />
                        </Link>

                        <div className='relative w-post'>

                            <Link
                                href='/login'
                            >
                                {/* アカウント情報 */}
                                <Account
                                    name={data.name}
                                    account={data.account_id}
                                    class='w-7/12'
                                />
                                {/* ポスト内容 */}
                                <p className='pt-1 break-words whitespace-pre-wrap'>
                                    テストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテスト
                                    testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest
                                </p>
                            </Link>

                            {/* リアクションエリア */}
                            <ul
                                className="flex justify-between mt-4 w-full max-w-sm"
                            >
                                {reactionData.map((re) => {
                                    return (
                                        <li
                                            key={re.id}
                                            className={`flex cursor-pointer ${
                                                    re.set === 'repost' ? (
                                                        reactionList[data.id - 1].repost
                                                    ) : re.set === 'favorite' ? (
                                                        reactionList[data.id - 1].favorite
                                                    ) : re.set === 'list' ? (
                                                        reactionList[data.id - 1].list
                                                    ) : ''
                                                }`}
                                            onClick={() => reactionHandleClick(data, re.set)}
                                        >
                                            <img src={`/images/${re.path}`}
                                                className={`h-3 w-auto my-auto`}
                                                alt={re.set}
                                            />
                                            {
                                                re.set === 'response' ? (
                                                <p className='ml-2'>12</p>
                                                ) : re.set === 'repost' ? (
                                                <p className='ml-2'>5644</p>
                                                ) : re.set === 'favorite' ? (
                                                <p className='ml-2'>13234</p>
                                                ) : ''
                                            }
                                        </li>
                                    );
                                })}
                            </ul>

                            {/* Othersエリア */}
                            <ul
                                className={`flex flex-wrap mt-4 w-full text-size90 ${otherList[data.id - 1]}`}
                            >
                                {othersFuncData.map((func) => {

                                    return (
                                        <li
                                            key={func.id}
                                            className="m-1"
                                        >
                                            <p
                                                onClick={() => othersHandleClick(data, func.set)}
                                                className={`cursor-pointer px-4 py-2 rounded-full ${
                                                    func.set === 'follow' ? (
                                                        reactionOthersList[data.id - 1].follow
                                                    ) : func.set === 'mute' ? (
                                                        reactionOthersList[data.id - 1].mute
                                                    ) : func.set === 'block' ? (
                                                        reactionOthersList[data.id - 1].block
                                                    ) : 'text-black bg-white'
                                                }`}
                                            >
                                                {data.name.length > 8 ?
                                                    data.name.slice(0, 8) + '...'
                                                    : data.name
                                                }
                                                さん
                                                {
                                                    func.set === 'follow' ? (
                                                        data.follow === true ? (
                                                            `のフォローを解除`
                                                        ) : `をフォロー`
                                                    ) : func.set === 'mute' ? (
                                                        data.mute === true ? (
                                                            `のミュートを解除`
                                                        ) : `をミュート`
                                                    ) : func.set === 'block' ? (
                                                        data.block === true ? (
                                                            `のブロックを解除`
                                                        ) : `をブロック`
                                                    ) : 'を報告'
                                                }
                                            </p>
                                        </li>
                                    )
                                })}
                            </ul>

                            {/* タイムスタンプ */}
                            <p className='absolute -top-0 -right-0 text-size90 text-gray-400'>
                                2023/10/24 23:54:59
                            </p>

                        </div>

                    </div>

                </div>
            ))}

            {/* 上部からスライドインするメッセージ */}
            <div
                className={`z-50 fixed ${message.position} left-0 w-full text-white`}
            >
                <p
                    className={`grid place-items-center w-5/6 max-w-xs text-xs font-bold px-4 py-2 mx-auto bg-translucent rounded-full`}
                >
                    {(message.user.length > 8) ?
                        message.user.slice(0, 8) + '...'
                        : message.user
                    }
                    さん{message.text}
                </p>
            </div>
        </>
    );
};