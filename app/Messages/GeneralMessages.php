<?php
namespace App\Messages;

class GeneralMessages
{
    // 利用者登録
    const CREATEUSER_SUCCESS = "利用者登録が完了しました。今後は登録した情報でログインしてください";

    // 利用者認証
    const LOGIN_FAILED = "ログイン情報をご確認ください";
    const LOGIN_SUCCESSED = "ログインしました";

    // ホーム
    const HOME_NAME_NOT_SET = "表示名が設定されていないようです。「設定」から表示名を設定しましょう！";

    // ログアウト
    const LOGOUT_SUCCESSED = "ログアウトしました";

    const CONFIG_PASSWORD_CHANGED = "パスワードは正常に変更されました";
    const CONFIG_PASSWORD_NOT_CHANGED = "パスワードは変更されませんでした";
    const CONFIG_PASSWORD_IS_SAME = "変更前と同じパスワードです";
    const CONFIG_NAME_IS_SAME = "変更前と同じ名前です";
    const CONFIG_NAME_CHANGED = "利用者名は正常に変更されました";

    // user_functions
    const USERFUNCTIONS_ADDED = "機能を追加しました";

    // memo_lines
    const MEMO_ADDED = "メモを追加しました";
    const MEMO_SAVED = "メモを保存しました";
    const MEMO_DELETED = "メモを削除しました";

    // EMAIL
    const EMAIL_SUBJECT_USER_CREATED = "【MyNOTE】利用者登録が完了しました";

    const DB_ERROR = "データベース更新中にエラーが発生しました。恐れ入りますが再度ご操作ください";

    // 使用設定がないアプリを起動しようとした
    const USER_NOT_AUTHORIZETION = "この機能はまだ有効になっていません";
}
