import React from 'react'; // TypeScriptに変えた場合必要

// InputLabelコンポーネントのプロパティ型
interface InputLabelProps {
    value: string;
}

export default function InputLabel({ value } : InputLabelProps) {
    return (
        <label
            className='block font-medium text-sm text-white mb-1.5'
        >
            {value}
        </label>
    );
}
