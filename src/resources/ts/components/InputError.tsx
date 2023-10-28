import React from 'react';

// InputErrorコンポーネントのプロパティ型
interface InputErrorProps {
    message: string;
};

export default function InputError(props : InputErrorProps) {

    // 三項演算子: messageの中身が存在する場合
    return props.message ? (
        <p className={'text-sm text-red-600 mt-1'}>
            {props.message}
        </p>
    ) :
        null;

};
