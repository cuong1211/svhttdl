<?php

namespace App\View\Components\website;

use App\Models\Counter as ModelsCounter;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Counter extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $visitor = ModelsCounter::where('user_agent', request()->userAgent())
            ->where('ip', request()->ip())
            ->where('time', '>', (now()->timestamp - 360))->first();

        if (!$visitor) {
            ModelsCounter::updateOrCreate(
                [
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'date' => now()->format('Y-m-d'),
                ],
                ['time' => now()->timestamp],
            );
        }

        $timestamp = now()->timestamp;

        $counter = DB::table('counters')->select('id')->count();
        $today = DB::table('counters')->select('date')->whereDate('date', now()->format('Y-m-d'))->get();
        $month = DB::table('counters')->select('date')->whereMonth('date', now()->format('m'))->get();
        $online = DB::table('counters')
            ->select('time')
            ->whereRaw("(CAST(time AS INTEGER) + 360) >= ?", [$timestamp])
            ->get();

        return view('components.website.counter', [
            'current' => number_format($online->count()),
            'today' => number_format($today->count()),
            'month' => number_format($month->count()),
            'total' => number_format($counter),
        ]);
    }
}
