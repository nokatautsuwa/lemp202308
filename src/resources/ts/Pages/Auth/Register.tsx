import React from 'react';
import { useEffect } from 'react';
import { Head, Link, useForm } from '@inertiajs/react';

import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';

// Login.tsxと同じ構成のため省略
export default function Register() {

    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        account_id: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    useEffect(() => {
        return () => {
            reset('password', 'password_confirmation');
        };
    }, []);

    const submit = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        post(route('register'));
    };

    return (
        <GuestLayout>

            {/* ページタイトル */}
            <Head title="新規登録" />

            <form onSubmit={submit}>

                {/* アカウント名 */}
                <div>
                    <InputLabel htmlFor="name" value="アカウント名" />
                    <TextInput
                        id="name"
                        type="text"
                        name="name"
                        value={data.name}
                        autoComplete="name"
                        isFocused={true}
                        onChange={(e: React.ChangeEvent<HTMLInputElement>) => setData('name', e.target.value)}
                    />
                    <InputError message={errors.name} className="mt-2" />
                </div>

                {/* アカウントID */}
                <div className="mt-4">
                    <InputLabel htmlFor="account_id" value="アカウントID (半角英数字及び記号は-, _のみ)" />
                    <TextInput
                        id="account_id"
                        type="text"
                        name="account_id"
                        value={data.account_id}
                        autoComplete="account_id"
                        onChange={(e: React.ChangeEvent<HTMLInputElement>) => setData('account_id', e.target.value)}
                    />
                    <InputError message={errors.account_id} className="mt-2" />
                </div>

                {/* メールアドレス */}
                <div className="mt-4">
                    <InputLabel htmlFor="email" value="メールアドレス" />
                    <TextInput
                        id="email"
                        type="email"
                        name="email"
                        value={data.email}
                        autoComplete="email"
                        onChange={(e: React.ChangeEvent<HTMLInputElement>) => setData('email', e.target.value)}
                    />
                    <InputError message={errors.email} className="mt-2" />
                </div>

                {/* パスワード */}
                <div className="mt-4">
                    <InputLabel htmlFor="password" value="パスワード  (半角英数字含む8文字以上)" />
                    <TextInput
                        id="password"
                        type="password"
                        name="password"
                        value={data.password}
                        autoComplete="new-password"
                        onChange={(e: React.ChangeEvent<HTMLInputElement>) => setData('password', e.target.value)}
                    />
                    <InputError message={errors.password} className="mt-2" />
                </div>

                {/* パスワード確認 */}
                <div className="mt-4">
                    <InputLabel htmlFor="password_confirmation" value="パスワード確認" />
                    <TextInput
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        value={data.password_confirmation}
                        autoComplete="new-password"
                        onChange={(e: React.ChangeEvent<HTMLInputElement>) => setData('password_confirmation', e.target.value)}
                    />
                    <InputError message={errors.password_confirmation} className="mt-2" />
                </div>

                {/* 登録 */}
                <div className="flex items-center justify-center mt-8">
                    <PrimaryButton
                        disabled={processing}
                        text='登録'
                    />
                </div>

            </form>

            <div className="flex items-center justify-center mt-4">
                <Link
                    href={route('login')}
                    className="underline text-sm text-white"
                >
                    登録済みの方はこちら
                </Link>
            </div>

        </GuestLayout>
    );
};
