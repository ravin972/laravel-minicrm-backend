<?php

namespace App\Models;

use App\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'client_id',
        'deadline_at',
        'status',
    ];
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory, SoftDeletes;
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    protected function casts(): array
    {
        return [
            'status' => ProjectStatus::class,
            'deadline_at' => 'datetime',
        ];
    }
}
