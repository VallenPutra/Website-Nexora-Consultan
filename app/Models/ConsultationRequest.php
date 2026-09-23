<?php

namespace App\Models;

use Database\Factories\ConsultationRequestFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ConsultationRequest extends Model
{
    /** @use HasFactory<ConsultationRequestFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'chat_token', 'name', 'email', 'company', 'phone', 'service', 'budget', 'message', 'status', 'handled_by', 'admin_notes'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function chatMessages(): HasMany
    {
        return $this->hasMany(ConsultationMessage::class);
    }

    public function latestChatMessage(): HasOne
    {
        return $this->hasOne(ConsultationMessage::class)->latestOfMany();
    }
}
