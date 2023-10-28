import React from 'react';

// DangerButtonコンポーネントのプロパティ型
interface DangerButtonProps {
    disabled: boolean;
    children: string;
};

export default function DangerButton({disabled, children, ...props } : DangerButtonProps) {
    return (
        <button
            {...props}
            className={
                `inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 ${disabled && 'opacity-25'} `
            }
            disabled={disabled}
        >
            {children}
        </button>
    );
}
