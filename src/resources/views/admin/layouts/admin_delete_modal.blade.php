<div id='delete-modal' class='modal hidden'>

    <div id='window' class='window'>

        <p class='modal-title'>管理者削除</p>

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
                    <p class="alert-success">
                        {{ $admins->name }}
                        @if ($admins->admin_permission === 1)
                        <!-- 管理者編集権限有(上長)を判別できるようにする -->
                            ⚫︎
                        @endif
                        を削除します。
                    </p>
                    <p class="help-block">
                        * 論理削除を実行すると削除扱いになりますが、DBには残ります。
                    </p>
                    @if (Auth::guard('admin')->user()->system_permission === 1)
                        <p class="help-block">
                            * レコード削除を実行するとアカウントの復旧ができなくなります。
                        </p>
                    @endif
                </li>
                
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
                        @if ($admins->deleted_at === null)
                        <!-- 論理削除 -->
                        <!------------------------------------------------->
                            <button
                                type="submit"
                                class='submit-delete'
                                formaction="{{ route('admin.profile.softdelete', ['id' => $admins->id]) }}"
                            >
                                論理削除
                            </button>
                        <!------------------------------------------------->
                        @endif

                        @if (Auth::guard('admin')->user()->system_permission === 1)
                        <!-- レコード削除 -->
                        <!------------------------------------------------->
                            <button
                                type="submit"
                                enctype="multipart/form-data"
                                class='submit-delete'
                                formaction="{{ route('admin.profile.destroy', ['id' => $admins->id]) }}"
                            >
                                レコード削除
                            </button>
                        <!------------------------------------------------->
                        @endif
                        <a href="{{ route('admin.profile.cancel', ['id' => $admins->id]) }}">キャンセル</a>
                    </p>
                </li>
            <!------------------------------------------------->
            </form>
        </ul>

    </div>

    <div id='delete-close' class='black'></div>


</div>