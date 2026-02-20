<?php

namespace App\Http\Controllers;

use App\Models\Waitlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class WaitlistController extends Controller
{
    /**
     * Show the waitlist form (landing page)
     */
    public function index()
    {
        return view('landing');
    }

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
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
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

            // Redirect to success page with data
            return redirect()->route('waitlist.success', [
                'name' => $waitlist->full_name,
                'email' => $waitlist->email
            ]);

        } catch (\Exception $e) {
            // Log error
            Log::error('Waitlist signup failed', [
                'error' => $e->getMessage(),
                'email' => $request->email ?? 'unknown'
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred. Please try again later.')
                ->withInput();
        }
    }

    /**
     * Show success page after waitlist signup
     */
    public function success(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');

        // If no data in URL, check session as fallback
        if (!$name || !$email) {
            $name = session('waitlist_data.name');
            $email = session('waitlist_data.email');
        }

        // If still no data, redirect to home
        if (!$name || !$email) {
            return redirect()->route('home');
        }

        return view('success', compact('name', 'email'));
    }

    /**
     * Check if email exists (for AJAX validation)
     */
    public function checkEmail(Request $request)
    {
        $exists = Waitlist::where('email', $request->email)->exists();
        
        if ($request->ajax()) {
            return response()->json(['exists' => $exists]);
        }
        
        return redirect()->back()->with('email_exists', $exists);
    }
}