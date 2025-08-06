<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConversationUser extends Model
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_LEFT = 'left';
    public const STATUS_REMOVED = 'removed';

    public const ROLE_MEMBER = 'member';
    public const ROLE_ADMIN = 'admin';

    protected $table = 'conversation_user';

    protected $fillable = [
        'conversation_id',
        'user_id',
        'status',
        'role',
        'joined_at',
        'last_read_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }
}
