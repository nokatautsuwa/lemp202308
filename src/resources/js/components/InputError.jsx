// 親コンポーネントから変数messageを受け取っている
export default function InputError({ message }) {

    // 三項演算子: messageの中身が存在する場合
    return message ? (
        <p className={'text-sm text-red-600'}>
            {message}
        </p>
    ) :
        null;

}
