import React from 'react';
import { Link } from '@inertiajs/react';

import ApplicationLogo from '@/Components/ApplicationLogo';

// Loginコンポーネントのプロパティ型
interface GuestLayoutProps {
    children: string;
};

export default function Guest({ children } : GuestLayoutProps) {
    return (
        <div
            className="min-h-screen flex flex-col justify-center items-center bg-black"
		>
			{/* ロゴ */}
            <div>
                <Link href="/">
					<ApplicationLogo
						className="w-20 h-20 fill-current text-gray-300"
					/>
                </Link>
            </div>

			<div
				className="w-10/12 sm:max-w-xs mt-2.5 overflow-hidden"
			>
				{/* 子コンポーネントで<GuestLayout>でラップされている要素を取得する */}
                {children}
            </div>
        </div>
    );
};
