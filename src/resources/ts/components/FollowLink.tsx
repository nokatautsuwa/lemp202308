import React from 'react';
import { Link } from '@inertiajs/react';

// LinkButtonコンポーネントのプロパティ型
interface FollowLinkProps {
    follow: number;
    follower: number;
};

// 子コンポーネントで定義された値を当てはめる
export default function FollowLink(props : FollowLinkProps) {
    return (
        <div className='flex text-xs font-bold'>
            <Link
                href='/login'
            >
                <p className='px-2'>フォロー {props.follow}</p>
            </Link>
            <Link
                href='/login'
            >
                <p className='px-2'>フォロワー {props.follower}</p>
            </Link>
        </div>
    );
};