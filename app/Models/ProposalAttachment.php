<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProposalAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposal_id',
        'filename',
        'original_filename',
        'mime_type',
        'file_size',
    ];

    /**
     * Get the proposal that owns the attachment.
     */
    public function proposal(): BelongsTo
    {
        return $this->belongsTo(Proposal::class);
    }
}
