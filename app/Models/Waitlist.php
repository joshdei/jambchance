<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Waitlist extends Model
{
    // Specify the table name (optional if it matches plural form)
    protected $table = 'waitlists';

    // Define which fields can be mass-assigned
    protected $fillable = [
        'full_name',
        'email',
        'jamb_score_range',
        'state_of_origin',
        'preferred_course',
        'other_course',
        'ip_address',
        'user_agent',
        'session_id',
        'referrer',
        'page_url',
        'device_type',
        'browser',
        'os',
        'is_mobile',
        'is_tablet',
        'is_desktop'
    ];

    // Cast boolean fields
    protected $casts = [
        'is_mobile' => 'boolean',
        'is_tablet' => 'boolean',
        'is_desktop' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get device information from user agent
     */
    public static function getDeviceInfo($userAgent)
    {
        $info = [
            'browser' => 'Unknown',
            'os' => 'Unknown',
            'device_type' => 'Desktop',
            'is_mobile' => false,
            'is_tablet' => false,
            'is_desktop' => true
        ];

        if (!$userAgent) {
            return $info;
        }

        $userAgent = strtolower($userAgent);

        // Detect mobile
        if (preg_match('/(android|iphone|ipod|blackberry|windows phone|mobile)/i', $userAgent)) {
            $info['is_mobile'] = true;
            $info['is_desktop'] = false;
            $info['device_type'] = 'Mobile';
        }
        
        // Detect tablet
        if (preg_match('/(ipad|tablet|kindle)/i', $userAgent)) {
            $info['is_tablet'] = true;
            $info['is_mobile'] = false;
            $info['is_desktop'] = false;
            $info['device_type'] = 'Tablet';
        }

        // Detect browser
        if (strpos($userAgent, 'edg') !== false || strpos($userAgent, 'edge') !== false) {
            $info['browser'] = 'Edge';
        } elseif (strpos($userAgent, 'opr') !== false || strpos($userAgent, 'opera') !== false) {
            $info['browser'] = 'Opera';
        } elseif (strpos($userAgent, 'chrome') !== false) {
            $info['browser'] = 'Chrome';
        } elseif (strpos($userAgent, 'firefox') !== false) {
            $info['browser'] = 'Firefox';
        } elseif (strpos($userAgent, 'safari') !== false) {
            $info['browser'] = 'Safari';
        }

        // Detect OS
        if (strpos($userAgent, 'windows') !== false) {
            $info['os'] = 'Windows';
        } elseif (strpos($userAgent, 'mac') !== false) {
            $info['os'] = 'macOS';
        } elseif (strpos($userAgent, 'linux') !== false) {
            $info['os'] = 'Linux';
        } elseif (strpos($userAgent, 'android') !== false) {
            $info['os'] = 'Android';
        } elseif (strpos($userAgent, 'ios') !== false || strpos($userAgent, 'iphone') !== false || strpos($userAgent, 'ipad') !== false) {
            $info['os'] = 'iOS';
        }

        return $info;
    }

    /**
     * Scope for filtering by state
     */
    public function scopeFromState($query, $state)
    {
        return $query->where('state_of_origin', $state);
    }

    /**
     * Scope for filtering by course
     */
    public function scopeStudying($query, $course)
    {
        return $query->where('preferred_course', $course);
    }

    /**
     * Scope for today's signups
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    /**
     * Scope for this week's signups
     */
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    /**
     * Get the user's first name
     */
    public function getFirstNameAttribute()
    {
        return explode(' ', $this->full_name)[0];
    }
}