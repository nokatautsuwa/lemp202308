import React from 'react';

// PrimaryButtonコンポーネントのプロパティ型
interface PrimaryButtonProps {
    disabled: boolean;
    text: string;
};

export default function PrimaryButton(props : PrimaryButtonProps) {
    return (
        <button
            className={
                `text-sm text-black bg-white py-2.5 px-7 rounded-full ${props.disabled && 'opacity-25'}`
            }
            disabled={props.disabled}
        > 
            {props.text}
        </button>
    );
};
