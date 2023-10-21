export default function PrimaryButton({ disabled, children, ...props }) {
    return (
        <button
            {...props}
            className={
                `text-sm text-black-900 bg-white-900 py-2.5 px-7 rounded-full ${disabled && 'opacity-25'}`
            }
            disabled={disabled}
        > 
            {children}
        </button>
    );
}
