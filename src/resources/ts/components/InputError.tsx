// 変数message
export default function InputError({ message }) {

    // 三項演算子: messageの中身が存在する場合
    return message ? (
        <p className={'text-sm text-red-600 mt-1'}>
            {message}
        </p>
    ) :
        null;

}
