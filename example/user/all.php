<?php

/**
 * サンプルドキュメント生成用の叩き台です（グローバル）
 *
 * @author ryunosuke <ryunosuke.arima@gmail.com>
 */
namespace {

    /** @var string グローバルの定数です */
    const GLOBAL_CONSTANT = [1, 2, 3, 4, 5, 'x' => 'X'];

    /**
     * グローバルに定義された関数です
     *
     * これは関数の説明です。
     *
     * @see \implode()
     *
     * @param string $format 引数1です
     * @param array $args 可変引数です。
     *     これは改行も含めた少し長めの引数概要です。
     * @return string 返り値です
     */
    function global_function($format, ...$args) { }

    /**
     * グローバルに定義されたインターフェースです
     *
     * これはインターフェースの説明です。
     */
    interface Ginterface
    {
        /** @var string インターフェースの定数です */
        const INTERFACE_CONSTANT = 'interface constant';

        /**
         * インターフェースのメソッドです
         *
         * これはインターフェースメソッドの説明です。
         *
         * @param string $arg1 引数1です
         * @return mixed 返り値です
         */
        public function interfaceMethod($arg1);
    }

    /**
     * グローバルに定義されたトレイトです
     *
     * これはトレイトの説明です。
     */
    trait Gtrait
    {
        /** @var string トレイトのプロパティです */
        private $trait_property = 'trait property';

        /**
         * トレイトのメソッドです
         *
         * @param string $arg1 引数1です
         * @return mixed 返り値です
         */
        public function traitMethod($arg1) { }
    }

    /**
     * グローバルに定義されたクラスです
     *
     * これはクラスの説明です。
     */
    class Gclass
    {
        /** @var string インターフェースの定数です */
        const CLASS_CONSTANT = 'class constant';

        /** @var string クラスのプロパティです */
        protected $class_property = 'class property';

        /**
         * クラスのメソッドです
         *
         * @param string $arg1 引数1です
         * @return mixed 返り値です
         */
        public function classMethod($arg1) { }
    }
}

/**
 * サンプルドキュメント生成用の叩き台です（名前空間）
 *
 * @author ryunosuke <ryunosuke.arima@gmail.com>
 */
namespace NS {

    /** @var string 名前空間の定数です */
    const NAMESPACE_CONSTANT = 'namespace constant';

    /**
     * 名前空間に定義された関数です
     *
     * これは関数の説明です。
     *
     * @param string $format 引数1です
     * @param array $args 可変引数です
     * @return string 返り値です
     */
    function namespace_function($format, ...$args) { }

    /**
     * 名前空間に定義されたインターフェースです
     *
     * これはインターフェースの説明です。
     */
    interface Ninterface
    {
        /** @var string インターフェースの定数です */
        const INTERFACE_CONSTANT = 'interface constant';

        /**
         * インターフェースのメソッドです
         *
         * これはインターフェースメソッドの説明です。
         *
         * @param string $arg1 引数1です
         * @return mixed 返り値です
         */
        public function interfaceMethod($arg1);
    }

    /**
     * 名前空間に定義されたトレイトです
     *
     * これはトレイトの説明です。
     */
    trait Ntrait
    {
        /** @var string トレイトのプロパティです */
        private $trait_property = 'trait property';

        /**
         * トレイトのメソッドです
         *
         * @param string $arg1 引数1です
         * @return mixed 返り値です
         */
        public function traitMethod($arg1) { }
    }

    /**
     * 名前空間に定義されたクラスです
     *
     * これはクラスの説明です。
     */
    class Nclass
    {
        /** @var string インターフェースの定数です */
        const CLASS_CONSTANT = 'class constant';

        /** @var string クラスのプロパティです */
        protected $class_property = 'class property';

        /**
         * クラスのメソッドです
         *
         * @param string $arg1 引数1です
         * @return mixed 返り値です
         */
        public function classMethod($arg1) { }
    }

    // @formatter:off
    /**
     * マジック/プロパティメソッドのサンプル用クラスです
     *
     * @property string $magicProperty1 これはただのマジックプロパティです
     * @property string $magicProperty2 {
     *     これはインライン phpdoc を使用したマジックプロパティです
     *
     *     このように詳細な doccomment が記述できますが、 var タグで事足りることが多いためほとんど用途はありません。
     *     ただ、下記のようにタグを貼る際は有用です。
     *
     *     @deprecated このプロパティは非推奨です
     *     @see https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md#54-inline-phpdoc URL も貼れます
     * }
     * @method string magicMethod1($arg) これはただのマジックメソッドです
     * @method string magicMethod2(int|string &$arg1=123, \Exception|\Throwable $e = null) これはマジックメソッドです。タイプヒントにパイプが使えます
     * @method string magicMethod3($arg) {
     *     これはインライン phpdoc を使用したマジックメソッドです
     *
     *     関数・メソッドと同じ形式でマジックメソッドに @param や @return を書くことが出来ます。
     *     同様に @see や @throws も書けます。
     *
     *     ただし、インデントが必要です。インデントがないと親の @ 指定と区別がつかないからです。
     *     phpstorm などの IDE では doccomment 内のフォーマットもサポートしているので注意が必要です。
     *     （実際、このコメントの上下に @formatter:off/on を入れています。でないとインデントが消されてしまうからです）
     *
     *     この機能は破棄された psr-5 を仮実装したものです。psr-5 の状況によっては形式などが変わるかもしれません。
     *
     *     @see $this::actualMethod see を使うと参照が貼れます
     *     @see https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md#54-inline-phpdoc URL も貼れます
     *
     *     @param array $arg 引数です
     *     @return string 返り値です
     *     @throws \RuntimeException
     * }
     * @**
     *  * これは拡張構文を使用したマジックメソッドです
     *  *
     *  * 関数・メソッドと同じ形式でマジックメソッドに @param や @return を書くことが出来ます。
     *  * 同様に @see や @throws も書けます。
     *
     *  * 普通のメソッドと似たような感じで method タグの上部に記述できるので自然な形になります。
     *  * インラインのようなインデントの辛みもありません。
     *  * ただし、完全に独自構文です。psr-5 と互換性は全くありませんし、見た目が受け入れられない人もいると思います。
     *
     *  * @see $this::actualMethod see を使うと参照が貼れます
     *  * @see https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md#54-inline-phpdoc URL も貼れます
     *
     *  * @param array $arg 引数です
     *  * @return string 返り値です
     *  * @throws \RuntimeException
     *  *@
     * @method void magicMethod4($arg)
     * @method string magicMethod5($arg1) {
     *     これはインライン phpdoc を使用したマジックメソッドです
     *
     *     <@see Mclass::actualMethod()>を使用してインラインかつ link 的な挙動を示すことができます。
     *     <@uses Mclass::actualMethod()>を使用してインラインかつ inheritdoc 的な挙動を示すことができます。
     *
     *     このメソッドは &#64;see しているにもかかわらず see 参照が出ていません。&lt;inline see&gt; では link に読み換えられるからです。
     *     このメソッドは &#64;inheritdoc していないにも関わらず引数が継承されています。&lt;inline uses&gt; では自動で inheritdoc が付与されるからです。
     *
     *     これは phpstorm などの IDE ジャンプで特に有用です。
     *     例えば &#123;&#64;see&#125; としても phpstorm が反応しません（インライン未対応？）。 link は標準ではないためそもそも反応しません。
     *     &#64;uses に関しては個人的な用途です（link + inheritdoc を同時にしたいことが多々ある）。
     * }
     */
    // @formatter:on
    class Mclass
    {
        /**
         * これは実際に定義されているメソッドです
         *
         * @param string $arg1 引数です
         * @return mixed 返り値です
         */
        public function actualMethod($arg1) { }

        /**
         * ignoreinherit のメソッドです
         *
         * ignoreinherit しているので、自身のメソッドとしてはドキュメント化されますが、 継承先である Rclass では出現しません。
         *
         * @ignoreinherit
         * @param string $arg1 引数1です
         * @return mixed 返り値です
         */
        public function ignoreinheritMethod($arg1) { }

        /**
         * used-by でマジックメソッドを指定したメソッド
         *
         * used-by するとドキュメント内の位置が変わります。
         *
         * @used-by magicMethod4()
         *
         * @param string $arg1 引数1です
         * @return mixed 返り値です
         */
        public function usedByMethod($arg1) { }
    }

    /**
     * これは継承関係を説明するためのクラスです
     *
     * 基本的に継承されたメソッドは全て自身のものとしてドキュメント化されます。
     *
     * inheritdoc タグを使うと親のドキュメントを継承することが出来ます。
     * 継承関係がなくても inheritdoc FQSEN 形式を使用すると参照先を強制的に指定して継承することが出来ます。
     */
    class Rclass extends Mclass implements Ninterface
    {
        use Ntrait;

        /** @var string クラスのプロパティです */
        protected $class_property = 'Rclass property';

        // doccomment 自体がない場合は @inheritdoc されているとみなされます
        public function interfaceMethod($arg1) { }

        /**
         * これはオーバーライドしたメソッドです
         *
         * 概要・説明はこのように自身のものが記載され、引数・返り値は継承元のものがドキュメント化されます。
         * 説明を記述しなかった場合は親の説明を完全に継承します。
         *
         * @inheritdoc
         */
        public function actualMethod($arg1) { }

        /**
         * これはドキュメントの継承元を指定したメソッドです
         *
         * inheritdoc で参照先を指定しているので、
         *
         * - 引数・返り値は参照先のもの
         * - php の言語構造の継承とは無関係
         *
         * という動作になります。
         * 結果としていま記述されているこのコメントは残り、 @param 指定などがないにも関わらず引数・返り値はドキュメント化されているはずです。
         *
         * @inheritdoc Mclass::actualMethod
         */
        public function inheritMethod($arg1) { }

        /**
         * これは一部のみ継承するメソッドです
         *
         * $arg0, $arg2 は親に無い引数ですが、自身に記述されているので、マージされて使用されます。
         * param type $arg1 hogehoge とすることで親の引数の一部のみを書き換えることも出来ます。
         * return はこのメソッド自身に記述されているので上書きされて使用されます。
         *
         * @inheritdoc Mclass::actualMethod
         * @param int $arg0 param 追加。親に $arg0 は無いが、ここに記述することで追加される
         * @param int $arg2 param 追加。親に $arg2 は無いが、ここに記述することで追加される
         * @return string return 上書き。親は mixed だが string と表記される
         */
        public function inheritMethod1($arg0, $arg1, $arg2) { }

        /**
         * これは inheritdoc しているメソッドへの inheritdoc です
         *
         * 参照は再帰的に行われるので最終的に inheritdoc ではない実際に記述が為されているメソッドがドキュメント化されます。
         *
         * 以下に継承元ドキュメントが表示されます。
         * <blockquote>{@inheritdoc Rclass::inheritMethod}</blockquote>
         * 継承元ドキュメントはここまでです。
         */
        public function inheritMethod2($arg1) { }

        /**
         * これは {inheritdoc FQSEN 文言指定} かつ文言指定メソッドです
         *
         * {inheritdoc FQSEN 文言指定} とすると元ドキュメントではなく文言指定で文字列を埋め込めます。
         *
         * {@inheritdoc inheritMethod() 継承しつつ文言指定ができます}
         */
        public function inheritMethod3($arg1) { }
    }

    /**
     * 色々なタグを試すための名前空間関数です
     *
     * 色々なタグを使っています。
     *
     * @see Rclass これは see タグの説明です
     * @deprecated 1.2.3 これは deprecated タグの説明です
     * @license MIT これは license タグの説明です
     * @author ryunosuke <ryunosuke.arima@gmail.com>
     */
    function package_function() { }

    /**
     * 色々なタグを試すためのクラスです
     *
     * 色々なタグを使っています。
     * 以下は markdown の確認用です。
     *
     * # 見出し1
     *
     * ## 見出し2
     *
     * ### 見出し3
     *
     * #### 見出し4
     *
     * ##### 見出し5
     *
     * ###### 見出し6
     *
     * テキスト
     *
     * ~~打ち消し~~
     * **強調**
     * \*\*エスケープ\*\*
     *
     * > 引用
     * >> 引用
     *
     * ###### 箇条書き
     *
     * - list 1
     *     - list 1-1
     *     - list 1-2
     * - list 2
     * - list 3
     *
     * 1. list 1
     *     1. list 1-1
     *     2. list 1-2
     * 2. list 2
     * 3. list 3
     *
     * ###### コード
     *
     * インライン `$hoge = 123;` コード
     *
     * ```php
     * // コードブロック
     * $hoge = 123;
     * echo $hoge;
     * ```
     *
     * ###### テーブル
     *
     * | No | col1(left) | col2(center)
     * | --:|:--         |:--:
     * |  1 | row1col1   | row1col2
     * |  2 | row2col1   | row2col2
     *
     * @no-virtual-method
     * @see Rclass これは see タグの説明です（内部リンク）
     * @see https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md これは see タグの説明です（外部リンク）
     * @deprecated 3.4.5 これは deprecated タグの説明です
     * @license MIT これは license タグの説明です
     * @author ryunosuke <ryunosuke.arima@gmail.com>
     */
    final class Tclass extends Rclass
    {
        /**
         * これはプロパティ用のタグの例示用メソッドです
         *
         * とは言えプロパティ専用のタグはほとんど無いため、 var のためだけに存在しています。
         *
         * @var array
         */
        protected $tagProperty;

        /**
         * デフォルトあり型付きプロパティです
         *
         * @var string
         */
        protected string $defaultTypeProperty = 'default';

        /**
         * デフォルトなし型付きプロパティです
         *
         * @var string
         */
        protected string $nodefaultTypeProperty;

        /**
         * このプロパティは @ignore によりドキュメント化されません
         *
         * @ignore
         */
        public $ignoreProperty;

        /**
         * これはメソッド用の{@link https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md#7-tags タグ}の例示用メソッドです
         *
         * 右側に属性ラベルが表示されたり、メソッドに打ち消し線が引かれていたりするはずです。
         * また、 link/source タグを使うと
         *
         * - {@link https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md こんな感じに外部リンク}が貼れたり
         * - {@link Rclass::actualMethod() こんな感じに要素リンク}が貼れたり
         * - {@source Rclass::actualMethod() こんな感じにソースへリンク}が貼れたり
         *
         * します。ただしこれは生成側との協力が必要です。
         *
         * あとこれはタグではないですが、コメント中にコードブロックを埋め込むことが出来ます。
         *
         * Example:
         * ```php
         * // これは doccomment 内のコードブロックです
         * $sample1 = 123;
         * // ハイライト表示されます
         * $sample2 = [1, 2, 3];
         * $sample3 = [
         *     'a' => 'A',
         *     'b' => 'B',
         *     'c' => 'C',
         * ];
         * ```
         *
         * ただこれは生成側の処理です。掻き集める側はそもそも markdown を認識しません（結果としてコードブロックも得られない）。
         * 基本的に Description はただのテキストです。
         *
         * @api
         * @see Rclass::actualMethod これは see タグの説明です
         * @since 1.2.3 これは version タグの説明です
         * @deprecated 2.3.4 これは deprecated タグの説明です
         * @version 3.4.5 これは version タグの説明です
         * @internal これは internal タグの説明です
         * @param string $arg1 これは param タグの説明です。{@link Tclass インラインタグが使えます}
         * @return string これは return タグの説明です。{@link Tclass インラインタグが使えます}
         * @return false これは2つ目の return タグの説明です。{@link Tclass インラインタグが使えます}
         * @throws \RuntimeException これは throws タグの説明です
         * @author ryunosuke <ryunosuke.arima@gmail.com>
         */
        final public function tagMethod($arg1) { }

        public function typeMethod(?self $arg1, ?string $arg2): ?self {}

        /**
         * このメソッドは @ignore によりドキュメント化されません
         *
         * @ignore
         */
        public function ignoreMethod() { }

        // doccomment が無いかつ親を持つメソッドは自動で @inheritdoc されたとみなされます
        public function inheritMethod($arg1) { }
    }
}

/**
 * サンプルドキュメント生成用の叩き台です（ネスト）
 *
 * @author ryunosuke <ryunosuke.arima@gmail.com>
 */
namespace NS\NSS {

    /**
     * これはネストされた名前空間用です。実質的な意味はありません
     */
    function fff() { }

    /**
     * これはネストされた名前空間用です。実質的な意味はありません
     */
    class C
    {
        function m() { }
    }
}
