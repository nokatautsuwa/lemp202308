import React from 'react'; // TypeScriptに変えた場合必要
import { Link } from '@inertiajs/react';

// LinkButtonコンポーネントのプロパティ型
interface LinkButtonProps {
    url: string;
    text: string;
}

// 子コンポーネントで定義されたurlとtextを当てはめる
export default function LinkButton({ url, text } : LinkButtonProps) {
    return (
        <Link
            href={url}
            className="text-sm text-black-900 bg-white-900 py-2.5 px-7 rounded-full"
        >
            {text}
        </Link>
    );
};