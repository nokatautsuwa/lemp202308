import { useEffect } from 'react';
import Checkbox from '@/Components/Checkbox';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Login({ status, canResetPassword }) {

    // data, setData: useState
    // post: post() 関数でフォームデータをPOSTする(get/put/delete/patchも用意されている)
    // processing: 通信中かどうかの判定(disabled={processing}で通信中は複数回クリック出来ないようにしている)
    // error: Controller側でバリデーションエラーが出た場合にフィールドとエラーメッセージを格納する
    // <InputError message={errors.email} />
    // <InputError message={errors.password} />
    const { data, setData, post, processing, errors, reset } = useForm({
        account: '',
        password: '',
        remember: false,
    });

    // 第二引数の[]で初回レンダリング時のみ実行する
    useEffect(() => {
        return () => {
            // reset: 値をデフォルト値に戻す
            reset('password');
        };
    }, []);

    // リクエストを送信したときに実行
    const submit = (e) => {
        e.preventDefault();
        // POSTリクエストで'/login'へアクセス
        post(route('login'));
    };

    return (
        <GuestLayout>

            {/* ページタイトル */}
            <Head title="ログイン" />

            {/* 処理を行ってリダイレクトされたときにstatusキーに入った値を表示する */}
            {status && <div className="mb-4 font-medium text-sm text-green-600">{status}</div>}

            <form onSubmit={submit}>

                {/* アカウントID or メールアドレス */}
                <div>
                    <InputLabel htmlFor="account" value="アカウントIDまたはメールアドレス" />

                    <TextInput
                        id="account"
                        name="account"
                        value={data.account}
                        className="mt-1 block w-full"
                        autoComplete="account"
                        isFocused={true}
                        onChange={(e) => setData('account', e.target.value)}
                    />
                    <InputError message={errors.account} className="mt-2" />
                </div>

                {/* パスワード */}
                <div className="mt-4">
                    <InputLabel htmlFor="password" value="パスワード" />

                    <TextInput
                        id="password"
                        type="password"
                        name="password"
                        value={data.password}
                        className="mt-1 block w-full"
                        autoComplete="current-password"
                        onChange={(e) => setData('password', e.target.value)}
                    />
                    <InputError message={errors.password} className="mt-2" />
                    {canResetPassword && (
                        <Link
                            href={route('password.request')}
                            className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            パスワードを忘れた方はこちら
                        </Link>
                    )}
                </div>

                {/* ユーザー情報を保存 */}
                <div className="block mt-4">
                    <label className="flex items-center">
                        <Checkbox
                            name="remember"
                            checked={data.remember}
                            onChange={(e) => setData('remember', e.target.checked)}
                        />
                        <span className="ml-2 text-sm text-gray-600">ユーザー情報を保存する</span>
                    </label>
                </div>

                {/* 登録 */}
                <div className="flex items-center justify-end mt-4">   
                    <Link
                        href={route('register')}
                        className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        未登録の方はこちら
                    </Link>
                    <PrimaryButton className="ml-4" disabled={processing}>
                        ログイン
                    </PrimaryButton>
                </div>

            </form>
        </GuestLayout>
    );
}