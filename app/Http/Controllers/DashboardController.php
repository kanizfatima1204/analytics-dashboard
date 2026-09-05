<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard.index');
    }

    public function profile(): View
    {
        $user = auth()->user();
        return view('dashboard.profile', compact('user'));
    }

    public function data(Request $request): JsonResponse
    {
        $days = max(7, min((int) $request->input('days', 30), 365));
        $factor = match (true) {
            $days <= 7 => 0.26,
            $days <= 30 => 1,
            $days <= 90 => 2.72,
            default => 11.9,
        };

        $revenue = round(58240 * $factor);
        $users = (int) round(18420 * $factor);
        $orders = (int) round(1328 * $factor);
        $conversion = $users > 0 ? round(($orders / $users) * 100, 2) : 0;

        $labels = $days <= 7
            ? ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
            : ($days <= 30 ? ['W1', 'W2', 'W3', 'W4'] : ($days <= 90 ? ['M1', 'M2', 'M3', 'M4', 'M5', 'M6'] : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']));

        $multiplier = count($labels);
        $revenueSeries = collect(range(1, $multiplier))->map(fn ($i) => round(($revenue / $multiplier) * (0.82 + (($i % 4) * 0.07)) ))->values();
        $orderSeries = collect(range(1, $multiplier))->map(fn ($i) => (int) round(($orders / $multiplier) * (0.86 + (($i % 3) * 0.08))))->values();
        $newUsersSeries = collect(range(1, $multiplier))->map(fn ($i) => (int) round(($users / $multiplier) * (0.84 + (($i % 4) * 0.06))))->values();

        return response()->json([
            'period' => $days,
            'kpis' => compact('revenue', 'users', 'orders', 'conversion'),
            'labels' => $labels,
            'revenueSeries' => $revenueSeries,
            'orderSeries' => $orderSeries,
            'newUsersSeries' => $newUsersSeries,
            'channels' => [48, 24, 16, 12],
            'funnel' => [
                ['label' => 'Visitors', 'value' => $users],
                ['label' => 'Product views', 'value' => (int) round($users * 0.54)],
                ['label' => 'Checkout', 'value' => (int) round($orders * 1.55)],
                ['label' => 'Purchased', 'value' => $orders],
            ],
            'transactions' => [
                ['customer'=>'Ava Morgan','reference'=>'TXN-1048','date'=>'05 Sep 2026','amount'=>1490,'status'=>'Paid'],
                ['customer'=>'Noah Carter','reference'=>'TXN-1047','date'=>'04 Sep 2026','amount'=>820,'status'=>'Paid'],
                ['customer'=>'Mia Anderson','reference'=>'TXN-1046','date'=>'04 Sep 2026','amount'=>420,'status'=>'Pending'],
                ['customer'=>'Ethan Wilson','reference'=>'TXN-1045','date'=>'03 Sep 2026','amount'=>1280,'status'=>'Paid'],
                ['customer'=>'Sofia Miller','reference'=>'TXN-1044','date'=>'03 Sep 2026','amount'=>760,'status'=>'Refunded'],
            ],
            'usersTable' => [
                ['name'=>'Ava Morgan','email'=>'ava@example.com','plan'=>'Enterprise','spend'=>12480,'orders'=>28],
                ['name'=>'Noah Carter','email'=>'noah@example.com','plan'=>'Growth','spend'=>8840,'orders'=>21],
                ['name'=>'Mia Anderson','email'=>'mia@example.com','plan'=>'Pro','spend'=>6120,'orders'=>16],
                ['name'=>'Ethan Wilson','email'=>'ethan@example.com','plan'=>'Growth','spend'=>5580,'orders'=>15],
            ],
        ]);
    }
}
