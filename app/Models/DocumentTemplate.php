<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'thumbnail',
        'download_count',
        'view_count',
        'uploaded_by',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'download_count' => 'integer',
        'view_count' => 'integer',
        'file_size' => 'integer',
    ];

    /**
     * Get the user who uploaded this template
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Scope to get only active templates
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get featured templates
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get list of available categories
     */
    public static function getCategories(): array
    {
        return [
            'บันทึกข้อความ' => 'บันทึกข้อความ',
            'หนังสือภายใน' => 'หนังสือภายใน',
            'หนังสือภายนอก' => 'หนังสือภายนอก',
            'คำสั่ง' => 'คำสั่ง',
            'ประกาศ' => 'ประกาศ',
            'ระเบียบ' => 'ระเบียบ',
            'อื่นๆ' => 'อื่นๆ',
        ];
    }

    /**
     * Get human readable file size
     */
    public function getFormattedFileSizeAttribute(): string
    {
        $bytes = $this->file_size;

        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' Bytes';
        }
    }

    /**
     * Increment download count
     */
    public function incrementDownload(): void
    {
        $this->increment('download_count');
    }

    /**
     * Increment view count
     */
    public function incrementView(): void
    {
        $this->increment('view_count');
    }
}
