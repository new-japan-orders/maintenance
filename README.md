# 前置き
Laravel標準のメンテナンスモードはメンテナンスかどうかをファイル（downファイル）の有無で確認している。このファイルはローカルストレージに保存されるので、ロードバランサなどを使って負荷分散している場合だと、稼働しているすべてのサーバーで` php artisan down `することになって面倒です(たぶん)。

この問題を解決するために、DBにメンテナンスの情報を保存することで、稼働しているサーバーをまとめてメンテナンスモードへ移行できるようにしてみました。

ついでに予約メンテナンス的な機能も入れました。
メンテナンスの終了は手動のみです。

# 使い方
## インストール方法

```
composer require new-japan-orders/maintenance
php artisan migrate
```

## app/Http/Kernel.php

```php

    protected $middleware = [ 
        /// コメントアウト
        /// \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,

        /// 追加
        \NewJapanOrders\Maintenance\CheckForMaintenanceMode::class,

        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];  
```

管理機能だけはメンテナンスの対象外にしたいといった場合は、
ミドルウェアグループを利用するといいと思います。

## アクセス

`{domain}/maintenances/` にアクセスしてメンテナンス情報一覧画面を表示してください。

## publish

```
php artisan vendor:publish --provider 'NewJapanOrders\Maintenance\ServiceProvider'
```

resouces/views/maintenancesに

* index.blade.php
* edit.blade.php
* create.blade.php

をコピーします。

## viewファイルの場所を変更したい場合

NewJapanOrders\Maitenance\Controllers\MaitenanceControllerクラスを継承したクラスを作成し、以下のようにプロパティをオーバーライドしてください。

```php
use NewJapanOrders\Maintenance\Controllers\MaintenanceController as Controller;
use Illuminate\Http\Request;

class MaintenanceController extends Controller {
    protected $index_view = 'maintenances.index';
    protected $create_view = 'maintenances.create';
    protected $edit_view = 'maintenances.edit';
}
```

