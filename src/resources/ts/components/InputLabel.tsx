import React from 'react';

// InputLabelコンポーネントのプロパティ型
interface InputLabelProps {
    value: string;
}

export default function InputLabel(props : InputLabelProps) {
    return (
        <label
            className='block font-medium text-sm text-white mb-1.5'
        >
            {props.value}
        </label>
    );
};
