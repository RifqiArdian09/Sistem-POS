<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use App\Exports\SalesReportExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReportController extends Controller
{
    public function index()
    {
        // Default tampilkan laporan bulan ini
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        
        $orders = Order::with(['items.product', 'user'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'completed')
            ->get();

        $totalSales = $orders->sum('total_amount');
        $totalOrders = $orders->count();

        return view('reports.index', compact('orders', 'totalSales', 'totalOrders', 'startDate', 'endDate'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'report_type' => 'required|in:daily,weekly,monthly,yearly',
        ]);

        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();

        $query = Order::with(['items.product', 'user'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'completed');

        // Grouping berdasarkan periode
        switch ($request->report_type) {
            case 'daily':
                $orders = $query->orderBy('created_at')->get()
                    ->groupBy(function($date) {
                        return Carbon::parse($date->created_at)->format('Y-m-d');
                    });
                break;
            case 'weekly':
                $orders = $query->orderBy('created_at')->get()
                    ->groupBy(function($date) {
                        return Carbon::parse($date->created_at)->format('Y-W');
                    });
                break;
            case 'monthly':
                $orders = $query->orderBy('created_at')->get()
                    ->groupBy(function($date) {
                        return Carbon::parse($date->created_at)->format('Y-m');
                    });
                break;
            case 'yearly':
                $orders = $query->orderBy('created_at')->get()
                    ->groupBy(function($date) {
                        return Carbon::parse($date->created_at)->format('Y');
                    });
                break;
            default:
                $orders = $query->get();
        }

        $totalSales = $query->sum('total_amount');
        $totalOrders = $query->count();

        return view('reports.result', [
            'orders' => $orders,
            'totalSales' => $totalSales,
            'totalOrders' => $totalOrders,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'reportType' => $request->report_type
        ]);
    }

    public function exportExcel(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'report_type' => 'required|in:detail,summary',
        ]);

        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();

        $fileName = 'sales-report-' . $startDate->format('Ymd') . '-to-' . $endDate->format('Ymd') . '.xlsx';

        if ($request->report_type === 'detail') {
            return Excel::download(new OrdersExport($startDate, $endDate), $fileName);
        } else {
            return Excel::download(new SalesReportExport($startDate, $endDate), $fileName);
        }
    }

    public function exportPdf(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'report_type' => 'required|in:detail,summary',
        ]);

        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();

        if ($request->report_type === 'detail') {
            $orders = Order::with(['items.product', 'user'])
                ->whereBetween('created_at', [$startDate, $endDate])
                ->where('status', 'completed')
                ->get();

            $pdf = PDF::loadView('reports.pdf.detail', [
                'orders' => $orders,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'totalSales' => $orders->sum('total_amount'),
                'totalOrders' => $orders->count()
            ]);
        } else {
            $orders = Order::whereBetween('created_at', [$startDate, $endDate])
                ->where('status', 'completed')
                ->get()
                ->groupBy(function($date) {
                    return Carbon::parse($date->created_at)->format('Y-m-d');
                });

            $pdf = PDF::loadView('reports.pdf.summary', [
                'orders' => $orders,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'totalSales' => $orders->flatten()->sum('total_amount'),
                'totalOrders' => $orders->flatten()->count()
            ]);
        }

        $fileName = 'sales-report-' . $startDate->format('Ymd') . '-to-' . $endDate->format('Ymd') . '.pdf';

        return $pdf->download($fileName);
    }
}