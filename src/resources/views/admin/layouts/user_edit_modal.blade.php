<div id='edit-modal' class='modal hidden'>

    <div id='window' class='window'>

        <p class='modal-title'>ユーザー復旧</p>

        <ul>
            <!-- 更新: 基本操作できるのは復旧のみ -->
            <form
                method="POST"
                action="{{ route('admin.user.edit', ['account_id' => $users->account_id]) }}"
                enctype="multipart/form-data"
            >
            <!-- PATCHメソッドを指定する -->
            @method('PATCH')
            <!------------------------------------------------->
                <!--CSRFトークン-->
                @csrf

                <li>
                    <img src="{{ asset('storage/images/user/'.$users->image) }}" alt="{{ $users->account_id }}">
                </li>

                <li>
                    <label class='alert-success'>
                        <input type="checkbox" id="recover" name="recover" value=1 class='checkbox'>
                        {{ $users->name }}を復旧する
                    </label>
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
                        <button type="submit">復旧</button>
                        <a href="{{ route('admin.user.cancel', ['account_id' => $users->account_id]) }}">キャンセル</a>
                    </p>
                </li>
            <!------------------------------------------------->
            </form>
            
        </ul>

    </div>

    <div id='edit-close' class='black'></div>


</div>