<div id='delete-modal' class='modal hidden'>

    <div id='window' class='window'>

        <p class='modal-title'>ユーザー削除</p>

        <ul>
            <!-- 更新: 画像ファイルの処理があるためenctype="multipart/form-data"を追記 -->
            <form
                method="POST"
                onsubmit="return confirm('実行します。よろしいですか？')"
            >
            <!-- DELETEメソッドを指定する -->
            @method('DELETE')
            <!------------------------------------------------->
                <!--CSRFトークン-->
                @csrf
                
                <li>
                    <!--パスワード認証-->
                    <label>
                        ログインユーザーのパスワード
                        <input type="password" name="password">
                    </label>
                    <!--エラーハンドリング-->
                    @if ($errors->has('password'))
                        <p class="help-block">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </li>
                
                <li>
                    <p class='submit'>
                        @if ($users->deleted_at === null)
                        <!-- 論理削除 -->
                        <!------------------------------------------------->
                            <button
                                type="submit"
                                class='submit-delete'
                                formaction="{{ route('admin.user.softdelete', ['account_id' => $users->account_id]) }}"
                            >
                                論理削除
                            </button>
                        <!------------------------------------------------->
                        @endif

                        @if (Auth::guard('admin')->user()->admin_permission === 1)
                        <!-- レコード削除 -->
                        <!------------------------------------------------->
                            <button
                                type="submit"
                                enctype="multipart/form-data"
                                class='submit-delete'
                                formaction="{{ route('admin.user.destroy', ['account_id' => $users->account_id]) }}"
                            >
                                レコード削除
                            </button>
                        <!------------------------------------------------->
                        @endif
                        <a href="{{ route('admin.user.cancel', ['account_id' => $users->account_id]) }}">キャンセル</a>
                    </p>
                </li>
            <!------------------------------------------------->
            </form>
        </ul>

    </div>

    <div id='delete-close' class='black'></div>


</div>