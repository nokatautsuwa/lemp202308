import React from 'react';
import { Link } from '@inertiajs/react';

// LinkButtonコンポーネントのプロパティ型
interface DrawerLinkProps {
    url: string;
    file: string
    text: string;
};

// 子コンポーネントで定義された値を当てはめる
export default function DrawerLink( props : DrawerLinkProps ) {
    return (
        <Link
            href={props.url}
            className='flex w-full h-full hover:bg-gray-600 py-4 px-10'
        >
            <img src={`/images/${props.file}`} className="h-5 w-auto mr-2.5 my-auto" alt={`${props.text}`} />
            <p>{props.text}</p>
        </Link>
    );
};