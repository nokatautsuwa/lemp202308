// value=の値を取得する
export default function InputLabel({ value }) {
    return (
        <label
            className='block font-medium text-sm text-white-900 mb-1.5'
        >
            {value}
        </label>
    );
}
