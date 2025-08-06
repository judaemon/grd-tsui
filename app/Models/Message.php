<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    public const TYPE_TEXT   = 'text';
    public const TYPE_IMAGE  = 'image';
    public const TYPE_FILE   = 'file';
    public const TYPE_SYSTEM = 'system';
    public const TYPE_INFO   = 'info';

    protected $fillable = [
        'conversation_id',
        'user_id',
        'body',
        'type',
        'reply_to_id',
        'edited_at',
        'status',
    ];

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function replyTo(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'reply_to_id');
    }
}
