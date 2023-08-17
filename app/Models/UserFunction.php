<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFunction extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'function_id',
    ];

    public function function(): BelongsTo
    {
        return $this->belongsTo(FunctionModel::class);
    }

    /**
     * 指定した機能が有効かどうかを返す
     *
     * @param $user
     * @param $id
     * @return mixed
     */
    public static function isEnableFunction($user, $id)
    {
        return UserFunction::where('user_id', $user)
            ->where('function_id', $id)
            ->exists();
    }

    /**
     * ユーザーが一つでも機能を有効にしているかを返す
     *
     * @param $user
     * @return mixed
     */
    public static function isNotSet($user)
    {
        return UserFunction::where('user_id', $user)
            ->exists();
    }

}
