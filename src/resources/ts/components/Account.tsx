import React from 'react';

// LinkButtonコンポーネントのプロパティ型
interface DrawerLinkProps {
    name: string;
    account: string;
    class: string;
};

// 子コンポーネントで定義された値を当てはめる
export default function AccountLink(props: DrawerLinkProps) {
    return (
        <div className={`inline-block font-bold ${props.class}`
} >
            <p className='truncate'>
                {props.name}
            </p>
            <p className='text-size90 text-gray-400 truncate'>
                @{props.account}
            </p>
        </div>
    );
};