<?php
return [
    'mode'       => 'flat',
    'extension'  => 'html',
    // ドキュメントのタイトル
    'title'      => 'Example PHP Document',
    // メニューフレームのサイズ
    'menusize'   => 30,
    // ソースリンク（キーの正規表現が値の文字列に置換されて URL 化される）
    'source-map' => [
        // これらはテストとか確認で使っているもの（消しても問題ない）
        '.*/timetoogo/pinq/'                                 => 'https://github.com/TimeToogo/Pinq/blob/3.4.1/',
        '.*/symfony/(.+?)/'                                  => 'https://github.com/symfony/$1/blob/v3.4.11/',
        '.*/laravel/framework/'                              => 'https://github.com/laravel/framework/blob/v8.83.23/',
        '.*/zendframework/zendframework/library/Zend/(.+?)/' => 'https://github.com/zendframework/zend-$1/blob/release-2.0.8/src/',
        // これが example のマップ
        '.*/'                                                => 'https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/',
        // このようにコールバックも使用できる（github は行指定が#L10-L20 だが、それ以外のホスティングサービスを使う場合に有用）
        function ($location) {
            return "https://hosting-service/{$location['path']}#L{$location['start']}-L{$location['end']}";
        },
    ],
];
