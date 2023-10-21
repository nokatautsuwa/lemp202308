import React from 'react'; // TypeScriptに変えた場合必要
import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';

export default function Guest({ children }) {
    return (
        <main
            className="min-h-screen flex flex-col justify-center items-center bg-black-900"
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
        </main>
    );
}
