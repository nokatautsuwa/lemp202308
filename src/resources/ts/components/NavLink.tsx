import React from 'react';
import { Link } from '@inertiajs/react';

// LinkButtonコンポーネントのプロパティ型
interface NavLinkProps {
    url: string;
    file: string
    text: string;
};

// 子コンポーネントで定義された値を当てはめる
export default function NavLink(props : NavLinkProps) {
    return (
        <Link
            href={props.url}
            className='w-1/5 h-14 pt-2'
        >
            <li>
                <img src={`/images/${props.file}`} className="h-5 w-auto mx-auto" alt={`${props.text}`} />
            </li>
        </Link>
    );
};