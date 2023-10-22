import React from 'react'; // TypeScriptに変えた場合必要

export default function Checkbox({ ...props }) {
    return (
        <input
            {...props} // checkboxの各属性
            className='rounded border-gray-300 text-gray-600'
        />
    );
}
