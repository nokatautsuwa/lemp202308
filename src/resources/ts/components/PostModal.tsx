import React from 'react';
import { Link } from '@inertiajs/react';

// LinkButtonコンポーネントのプロパティ型
interface DrawerLinkProps {
    url: string;
    file: string
    text: string;
};

// 子コンポーネントで定義された値を当てはめる
export default function PostModal({ url, file, text } : DrawerLinkProps) {
    return (
        <Link
            href={url}
            className='flex w-full h-full hover:bg-gray-600'
        >
            <img src={`/images/${file}`} className="h-5 w-auto mr-2.5 my-auto" alt={`${text}`} />
            <p>{text}</p>
        </Link>
    );
};