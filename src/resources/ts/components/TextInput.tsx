import React from 'react';
import { forwardRef, useEffect, useRef } from 'react';

// イベントオブジェクトの型を指定/onChange イベントハンドラの型を宣言
type ChangeEvent = React.ChangeEvent<HTMLInputElement>;
type OnChangeHandler = (e: ChangeEvent) => void;
// TextInputコンポーネントのプロパティ型
interface TextInputProps {
    isFocused: boolean;
    id: string;
    type: string;
    name: string;
    value: string;
    autoComplete: string;
    onChange: OnChangeHandler;
};

export default function TextInput(
    {
        isFocused = false, // フォーカス初期設定
        ...props // その他各HTML属性
    } : TextInputProps
) {

    // useRefフックを使用して変数inputを作成
    // テキスト入力要素にフォーカスを設定するために使用
    const input = useRef<HTMLInputElement | null>(null);

    // 第二引数の[]で初回レンダリング時に実行する
    useEffect(() => {
        // isFocusedプロパティがtrueの場合
        // input.current.focus()を呼び出してテキスト入力フィールドにフォーカスを当てる
        if (isFocused) {
            input.current?.focus();
        }
    }, []);

    return (
        <input
            {...props}
            className='rounded-full px-2.5 mt-1 block text-base text-black bg-white w-full'
            {...input}
        />
    );

};
