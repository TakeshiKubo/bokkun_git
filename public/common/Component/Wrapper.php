<?php
/**
 * @method mixed Wrap_[method_Jname]()

 * @abstract Wrapper関数を定義する。
 * (数が増えた場合は、ソースファイル単位で管理しなおす予定)
 *
 * @param  mixed 元の関数と基本的には同じにする
 * @return mixed 用途に応じて変更するが、特に用途に変更がない場合は元の関数通り
 *
 * @author ぼっくん <private.mail@bokkun.jp>
 *
 */
/**
 * @method wrap_arrayc_combine
 *
 * @abstract array_combineのWrapper関数。
 * @param array $keys
 * @param array $values
 * @param integer $fill
 * @return array
 */
function wrap_array_combine(array $keys = [], array $values = [], $fill = 0)
{
    if (count($keys) > count($values)) {
        foreach ($keys as $_key => $_val) {
            print_r("$_key: $_val");
        }
    } else if (count($keys) < count($values)) {
    }
    var_dump(count($values));
}
