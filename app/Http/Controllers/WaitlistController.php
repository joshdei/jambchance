<?php

namespace App\Http\Controllers;

use App\Models\Waitlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class WaitlistController extends Controller
{
    /**
     * Store a new waitlist entry
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:waitlists,email',
                'jamb_score_range' => 'nullable|string|max:50',
                'state_of_origin' => 'nullable|string|max:100',
                'preferred_course' => 'nullable|string|max:255',
                'other_course' => 'nullable|string|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Get device info
            $deviceInfo = Waitlist::getDeviceInfo($request->userAgent());

            // Prepare data for insertion
            $data = [
                'full_name' => $request->full_name,
                'email' => $request->email,
                'jamb_score_range' => $request->jamb_score_range,
                'state_of_origin' => $request->state_of_origin,
                'preferred_course' => $request->preferred_course,
                'other_course' => $request->other_course,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'session_id' => session()->getId(),
                'referrer' => $request->headers->get('referer'),
                'page_url' => $request->fullUrl(),
                'browser' => $deviceInfo['browser'],
                'os' => $deviceInfo['os'],
                'device_type' => $deviceInfo['device_type'],
                'is_mobile' => $deviceInfo['is_mobile'],
                'is_tablet' => $deviceInfo['is_tablet'],
                'is_desktop' => $deviceInfo['is_desktop']
            ];

            // Save to database
            $waitlist = Waitlist::create($data);

            // Log success
            Log::info('New waitlist signup', [
                'email' => $waitlist->email,
                'id' => $waitlist->id
            ]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Successfully joined the waitlist!',
                'data' => [
                    'name' => $waitlist->full_name,
                    'email' => $waitlist->email,
                    'first_name' => $waitlist->first_name
                ]
            ], 201);

        } catch (\Exception $e) {
            // Log error
            Log::error('Waitlist signup failed', [
                'error' => $e->getMessage(),
                'email' => $request->email ?? 'unknown'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred. Please try again later.'
            ], 500);
        }
    }

    /**
     * Get waitlist statistics (for admin)
     */
    public function stats()
    {
        try {
            $stats = [
                'total' => Waitlist::count(),
                'today' => Waitlist::today()->count(),
                'this_week' => Waitlist::thisWeek()->count(),
                'this_month' => Waitlist::whereMonth('created_at', now()->month)->count(),
                
                // Top courses
                'top_courses' => Waitlist::whereNotNull('preferred_course')
                    ->select('preferred_course', \DB::raw('count(*) as total'))
                    ->groupBy('preferred_course')
                    ->orderByDesc('total')
                    ->limit(5)
                    ->get(),
                
                // Top states
                'top_states' => Waitlist::whereNotNull('state_of_origin')
                    ->select('state_of_origin', \DB::raw('count(*) as total'))
                    ->groupBy('state_of_origin')
                    ->orderByDesc('total')
                    ->limit(5)
                    ->get(),
                
                // Device breakdown
                'devices' => [
                    'mobile' => Waitlist::where('is_mobile', true)->count(),
                    'desktop' => Waitlist::where('is_desktop', true)->count(),
                    'tablet' => Waitlist::where('is_tablet', true)->count()
                ],
                
                // JAMB score distribution
                'jamb_scores' => Waitlist::whereNotNull('jamb_score_range')
                    ->select('jamb_score_range', \DB::raw('count(*) as total'))
                    ->groupBy('jamb_score_range')
                    ->orderBy('jamb_score_range')
                    ->get()
            ];

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Could not fetch statistics'
            ], 500);
        }
    }

    /**
     * Check if email exists
     */
    public function checkEmail(Request $request)
    {
        $exists = Waitlist::where('email', $request->email)->exists();
        
        return response()->json([
            'exists' => $exists
        ]);
    }
}