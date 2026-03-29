<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GoogleCalendarService;
use Illuminate\Http\Request;

class GoogleCalendarController extends Controller
{
    public function __construct(protected GoogleCalendarService $calendarService)
    {
    }

    public function connect()
    {
        $authUrl = $this->calendarService->getAuthUrl();
        return redirect($authUrl);
    }

    public function callback(Request $request)
    {
        if ($request->has('error')) {
            return redirect()->route('admin.settings.index')
                ->with('error', 'Google Calendar bağlantısı iptal edildi.');
        }

        try {
            $this->calendarService->handleCallback($request->code, auth()->user());
            
            return redirect()->route('admin.settings.index')
                ->with('success', 'Google Calendar başarıyla bağlandı!');
        } catch (\Exception $e) {
            return redirect()->route('admin.settings.index')
                ->with('error', 'Google Calendar bağlantısı başarısız: ' . $e->getMessage());
        }
    }

    public function disconnect()
    {
        $this->calendarService->disconnect(auth()->user());
        
        return redirect()->route('admin.settings.index')
            ->with('success', 'Google Calendar bağlantısı kaldırıldı.');
    }

    public function status()
    {
        return response()->json([
            'connected' => $this->calendarService->isConnected(auth()->user())
        ]);
    }
}
