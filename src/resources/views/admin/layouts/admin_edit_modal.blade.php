<div id='edit-modal' class='modal hidden'>

    <div id='window' class='window'>

        <p class='modal-title'>管理者プロフィール編集</p>

        <ul>
            <!-- 更新: 画像ファイルの処理があるためenctype="multipart/form-data"を追記 -->
            <form
                method="POST"
                action="{{ route('admin.profile.edit', ['id' => $admins->id]) }}"
                enctype="multipart/form-data"
            >
            <!-- PATCHメソッドを指定する -->
            @method('PATCH')
            <!------------------------------------------------->
                <!--CSRFトークン-->
                @csrf

                <li>
                    @if ($admins->deleted_at !== null)
                        <img src="{{ asset('storage/images/admin/'.$admins->image) }}" alt="{{ $admins->id }}">
                    @else
                        <label name='images' >
                            <input id="file-input" name='images' type="file" accept='.jpg,.jpeg,.png,.webp,.svg'>
                            <img id="preview-img" name='images' src="{{ asset('storage/images/admin/'.$admins->image) }}" alt="{{ $admins->id }}">
                        </label>
                    @endif
                </li>

                @if (Auth::guard('admin')->user()->system_permission === 1)
                <!-- 自分がシステム管理者 -->
                    @if($admins->deleted_at !== null)
                    <!-- 論理削除されている -->
                        <li>
                            <p class='help-block'>* 編集するには復旧作業が必要です</p>
                            <label class='alert-success'>
                                <input type="checkbox" id="recover" name="recover" value=1 class='checkbox'>
                                {{ $admins->name }}
                                @if ($admins->admin_permission === 1)
                                <!-- 管理者編集権限有(上長)を判別できるようにする -->
                                    ⚫︎
                                @endif
                                を復旧する
                            </label>
                        </li>
                    @endif
                @endif

                <li>
                    <!--名前-->
                    <label>
                        名前
                        @if ($admins->deleted_at !== null)
                            <input type="text" name="name" value="{{ $admins->name }}" readonly class='disable'>
                        @else
                            <input type="text" name="name" value='{{ $admins->name }}'>
                            <!--エラーハンドリング-->
                            @if ($errors->has('name'))
                                <p class="help-block">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                        @endif
                    </label>
                </li>
                
                <li>
                    <!--メールアドレス-->
                    <label>
                        メールアドレス
                        @if ($admins->deleted_at !== null)
                            <input type="text" name="email" value='********' readonly class='disable'>
                        @else
                            <p>* 空欄の場合は現在のメールアドレスになります</p>
                            <input type="text" name="email">
                            <!--エラーハンドリング-->
                            @if ($errors->has('email'))
                                <p class="help-block">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                        @endif
                    </label>
                </li>

                <li>
                    <!-- 所属会社: システム管理者でない場合は自分の所属会社で固定 -->
                    <label>
                        所属会社
                        <p>* システム管理者のみ編集可能</p>
                        @if (Auth::guard('admin')->user()->system_permission === 1 && $admins->deleted_at === null)
                        <!-- 自分がシステム管理者で対象の管理者が論理削除されていない場合のみ編集できるようにする -->
                            <select name="place">
                                <!--Model->Controllerで取得した配列を出力-->
                                @foreach($place_list as $option_place)
                                    <!-- デフォルトで今ログインしているアカウントと同じ配属先にする -->
                                    @if($option_place === $admins->place)
                                        <option value='{{ $option_place }}' selected>{{ $option_place }}</option>
                                    @else
                                        <option value='{{ $option_place }}'>{{ $option_place }}</option>
                                    @endif
                                @endforeach
                            </select>
                        @else
                            <input type="text" name="place" value="{{ $admins->place }}" readonly class='disable'>
                        @endif
                    </label>
                    <!--エラーハンドリング-->
                    @if ($errors->has('place'))
                        <p class="help-block">
                            {{ $errors->first('place') }}
                        </p>
                    @endif
                </li>

                <li>
                    <!-- エリア(地方): システム管理者でない場合は自分のエリアで固定 -->
                    <label>
                        エリア
                        <p>* システム管理者のみ編集可能</p>
                        @if (Auth::guard('admin')->user()->system_permission === 1 && $admins->deleted_at === null)
                        <!-- 自分がシステム管理者で対象の管理者が論理削除されていない場合のみ編集できるようにする -->
                            <select name="area">
                                <!--Model->Controllerで取得した配列を出力-->
                                @foreach($area_list as $option_area)
                                    <!-- デフォルトで今ログインしているアカウントと同じエリアにする -->
                                    @if($option_area === $admins->area)
                                        <option value='{{ $option_area }}' selected>{{ $option_area }}</option>
                                    @else
                                        <option value='{{ $option_area }}'>{{ $option_area }}</option>
                                    @endif
                                @endforeach
                            </select>
                        @else
                            <input type="text" name="area" value="{{ $admins->area }}" readonly class='disable'>
                        @endif
                    </label>
                    <!--エラーハンドリング-->
                    @if ($errors->has('area'))
                        <p class="help-block">
                            {{ $errors->first('area') }}
                        </p>
                    @endif
                </li>

                @if($admins->system_permission !== 1)
                <!-- 編集権限: システム管理者でない管理者のみ表示 -->

                    <li>
                        <!-- ユーザー編集権限: システム管理者でない場合は現在の権限で固定 -->
                        <label>
                            @if (Auth::guard('admin')->user()->system_permission === 1 && $admins->deleted_at === null)
                            <!-- 自分がシステム管理者で対象の管理者が論理削除されていない場合のみ編集できるようにする -->
                                @if ($admins->user_permission === 1)
                                    <input type="checkbox" id="user-permission" name="user-permission" value=1 class='checkbox' checked>
                                @else
                                    <input type="checkbox" id="user-permission" name="user-permission" value=1 class='checkbox'>
                                @endif
                            @else
                                @if ($admins->user_permission === 1)
                                    <input type="checkbox" id="user-permission" name="user-permission" value=1 class='checkbox' checked disabled>
                                @else
                                    <input type="checkbox" id="user-permission" name="user-permission" value=1 class='checkbox' disabled>
                                @endif
                            @endif
                            ユーザー編集権限
                        </label>
                    </li>

                    <li>
                        <!-- 管理者編集権限: システム管理者でない場合は現在の権限で固定 -->
                        <label>
                            @if (Auth::guard('admin')->user()->system_permission === 1 && $admins->deleted_at === null)
                            <!-- 自分がシステム管理者で対象の管理者が論理削除されていない場合のみ編集できるようにする -->
                                @if ($admins->admin_permission === 1)
                                    <input type="checkbox" id="admin-permission" name="admin-permission" value=1 class='checkbox' checked>
                                @else
                                    <input type="checkbox" id="admin-permission" name="admin-permission" value=1 class='checkbox'>
                                @endif
                            @else
                                @if ($admins->admin_permission === 1)
                                    <input type="checkbox" id="admin-permission" name="admin-permission" value=1 class='checkbox' checked disabled>
                                @else
                                    <input type="checkbox" id="admin-permission" name="admin-permission" value=1 class='checkbox' disabled>
                                @endif
                            @endif
                            管理者編集権限
                        </label>
                    </li>

                @endif

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
                        <button type="submit">
                            @if($admins->deleted_at !== null)
                            <!-- 論理削除されている -->
                                復旧
                            @else
                                更新
                            @endif
                        </button>
                        <a href="{{ route('admin.profile.cancel', ['id' => $admins->id]) }}">キャンセル</a>
                    </p>
                </li>
                
            <!------------------------------------------------->
            </form>
            
        </ul>

    </div>

    <div id='edit-close' class='black'></div>


</div>