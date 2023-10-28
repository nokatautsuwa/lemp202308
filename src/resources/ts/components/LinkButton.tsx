import React from 'react';
import { Link } from '@inertiajs/react';

// LinkButtonコンポーネントのプロパティ型
interface LinkButtonProps {
    url: string;
    text: string;
};

// 子コンポーネントで定義されたurlとtextを当てはめる
export default function LinkButton(props : LinkButtonProps) {
    return (
        <Link
            href={props.url}
            className="text-sm text-black bg-white py-2.5 px-7 rounded-full"
        >
            {props.text}
        </Link>
    );
};