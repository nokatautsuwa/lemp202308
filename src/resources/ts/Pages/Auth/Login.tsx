import React from 'react'; // TypeScriptに変えた場合必要

import { useEffect } from 'react';
import Checkbox from '@/Components/Checkbox';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import LinkButton from '@/Components/LinkButton';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';

// Loginコンポーネントのプロパティ型
interface LoginProps {
    status: string;
    canResetPassword: string;
}

export default function Login({ status, canResetPassword } : LoginProps) {

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
    const submit = (e: React.FormEvent<HTMLFormElement>) => {
        // デフォルトの遷移動作(新しいページへの移動)をキャンセル
        e.preventDefault();
        // POSTリクエストで'/login'へアクセス
        post(route('login'));
    };

    return (
        <GuestLayout>

            {/* ページタイトル */}
            <Head title="ログイン" />

            {/* 処理を行ってリダイレクトされたときにstatusキーに入った値を表示する */}
            {status && <div className="mb-4 font-medium text-sm">{status}</div>}

            <form onSubmit={submit}>

                {/* アカウントID or メールアドレス */}
                <div>
                    <InputLabel htmlFor="account" value="アカウントIDまたはメールアドレス" />
                    {/* 入力欄の値が変化した時にsetDataのaccountに現在の値を格納する */}
                    <TextInput
                        isFocused={true}
                        id="account"
                        type="text"
                        name="account"
                        value={data.account}
                        autoComplete="account"
                        onChange={(e: React.ChangeEvent<HTMLInputElement>) => setData('account', e.target.value)}
                    />
                    {/* エラーメッセージ */}
                    <InputError message={errors.account} className="mt-2" />
                </div>

                {/* パスワード */}
                <div className="mt-4">
                    <InputLabel htmlFor="password" value="パスワード" />
                    {/* 入力欄の値が変化した時にsetDataのpasswordに現在の値を格納する */}
                    <TextInput
                        id="password"
                        type="password"
                        name="password"
                        value={data.password}
                        autoComplete="current-password"
                        onChange={(e: React.ChangeEvent<HTMLInputElement>) => setData('password', e.target.value)}
                    />
                    {/* エラーメッセージ */}
                    <InputError message={errors.password} className="mt-2" />
                </div>

                {/* ユーザー情報を保存 */}
                <div className="mt-4">
                    <label className="flex items-center">
                        {/* 入力欄の値が変化した時にsetDataのrememberに現在のチェック状態を格納する */}
                        <Checkbox
                            name="remember"
                            type="checkbox"
                            checked={data.remember}
                            onChange={(e: React.ChangeEvent<HTMLInputElement>) => setData('remember', e.target.checked)}
                        />
                        <span
                            className="ml-2 text-sm text-white"
                        >
                            ユーザー情報を保存する
                        </span>
                    </label>
                </div>

                {/* 登録 */}
                <div className="flex items-center justify-center mt-8">
                    <PrimaryButton
                        disabled={processing}
                    >
                        ログイン
                    </PrimaryButton>
                </div>

            </form>

            <div className="flex items-center justify-center mt-4">
                {canResetPassword && (
                    <Link
                        href={route('password.request')}
                        className="underline text-sm text-white"
                    >
                        パスワードを忘れた方はこちら
                    </Link>
                )}
            </div>

            <div className="flex items-center justify-center mt-8">
                <LinkButton
                    url={route('register')}
                    text='新規登録'
                />
            </div>

        </GuestLayout>
    );
}
