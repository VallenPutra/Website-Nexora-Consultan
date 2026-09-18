<?php

namespace App\Models;

use Database\Factories\ConsultationRequestFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConsultationRequest extends Model
{
    /** @use HasFactory<ConsultationRequestFactory> */
    use HasFactory;

    protected $fillable = ['chat_token', 'name', 'email', 'company', 'phone', 'service', 'budget', 'message', 'status', 'admin_notes'];

    public function chatMessages(): HasMany
    {
        return $this->hasMany(ConsultationMessage::class);
    }
}
