<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Mustahik extends Model
{
    //
    use HasFactory;

    protected $table = 'zakat_mustahik';

      /**
     * Statuses.
     */
    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';

    /**
     * List of statuses.
     *
     * @var array
     */
    public static $statuses = [self::STATUS_ACTIVE, self::STATUS_INACTIVE];

    protected $guarded = [];

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->author_id && Auth::user()) {
            $this->author_id = Auth::user()->id;
        }

        parent::save();
    }

    public function zakat_mustahik_kategori(): HasMany
    {
        return $this->hasMany(MustahikKategori::class, 'zakat_mustahik_kategori_id', 'id');
    }
    
    public function mustahik_kategori(): BelongsTo
    {
        return $this->belongsTo(MustahikKategori::class, 'id', 'id');
    }
}
