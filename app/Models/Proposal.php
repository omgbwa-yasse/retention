<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'title',
        'description',
        'status',
        'user_id',
    ];

    /**
     * Get the user that owns the proposal.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the attachments for the proposal.
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(ProposalAttachment::class);
    }
}
