import React from 'react'; // TypeScriptに変えた場合必要

// PrimaryButtonコンポーネントのプロパティ型
interface PrimaryButtonProps {
    disabled: boolean;
    children: string;
}

export default function PrimaryButton({ disabled, children, ...props } : PrimaryButtonProps) {
    return (
        <button
            {...props}
            className={
                `text-sm text-black bg-white py-2.5 px-7 rounded-full ${disabled && 'opacity-25'}`
            }
            disabled={disabled}
        > 
            {children}
        </button>
    );
}
