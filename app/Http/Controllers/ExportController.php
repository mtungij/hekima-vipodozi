<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Facades\Pdf;
use Illuminate\Http\Request;


class ExportController extends Controller
{
    public function invoices()
    {
        $from_date = request()->from_date ?? null;
        $to_date = request()->to_date ?? null;
        $branch_id = request()->branch_id ?? null;

        $invoices = Order::query()
                        ->when($branch_id, function (Builder $query, $branch_id) {
                            $query->where('branch_id', $branch_id);
                        })
                        ->when($from_date && !$to_date, function (Builder $query) use($from_date) {
                            $query->whereDate('created_at', '>=', $from_date);
                        })
                        ->when($to_date && !$from_date, function (Builder $query) use($to_date) {
                            $query->whereDate('created_at', '<=', $to_date);
                        })
                        ->when($from_date && $to_date, function (Builder $query) use($to_date, $from_date) {
                            $query->whereDate('created_at', '<=', $to_date)
                                  ->whereDate('created_at', '>=', $from_date);
                        })
                        ->withSum('orderItems', 'total')
                        ->with(['customer', 'branch', 'paymentMethod', 'user', 'vendor'])
                        ->get();
        return Pdf::withBrowsershot(function (Browsershot $browsershot) {
                    $browsershot->setChromePath('/usr/bin/chromium-browser');
                })
                ->view('pdfs.invoices', ['invoices' => $invoices])
                ->name("invoices.pdf")
                ->download();
    }

    public function invoice(Order $invoice)
    {
        $invoice_ = Order::where('id', $invoice->id)->with(['orderItems.product', 'customer'])->first();
        return view('pdfs.invoice', ['invoice' => $invoice_]);
    }
}
