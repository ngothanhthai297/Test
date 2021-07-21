<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionUser extends Model
{
    protected $fillable=['token','refresh_token','token_expried','refresh_token_expried','user_id'];
    protected $primaryKey = 'id';
    protected $table = 'table_session_user';
}
