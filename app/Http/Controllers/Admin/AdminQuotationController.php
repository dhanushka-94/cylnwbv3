<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AdminQuotationController extends Controller
{
    /**
     * Display a listing of quotations
     */
    public function index(Request $request)
    {
        $query = Quotation::with(['user', 'createdByAdmin', 'viewedByAdmin']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search by quotation number, customer name, email, or phone
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('quotation_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        // Filter by expired status
        if ($request->filled('expired')) {
            if ($request->expired === 'yes') {
                $query->expired();
            } else {
                $query->active();
            }
        }

        // Sort by latest first
        $quotations = $query->latest()->paginate(20);

        // Get statistics
        $stats = [
            'total' => Quotation::count(),
            'pending' => Quotation::where('status', 'pending')->count(),
            'sent' => Quotation::where('status', 'sent')->count(),
            'accepted' => Quotation::where('status', 'accepted')->count(),
            'rejected' => Quotation::where('status', 'rejected')->count(),
            'expired' => Quotation::expired()->count(),
            'today' => Quotation::whereDate('created_at', Carbon::today())->count(),
            'this_week' => Quotation::whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])->count(),
            'this_month' => Quotation::whereBetween('created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])->count(),
        ];

        return view('admin.quotations.index', compact('quotations', 'stats'));
    }

    /**
     * Display the specified quotation
     */
    public function show(Quotation $quotation)
    {
        // Mark as viewed by admin
        $quotation->markAsViewedByAdmin(Auth::id());

        // Load relationships
        $quotation->load(['user', 'createdByAdmin', 'viewedByAdmin']);

        return view('admin.quotations.show', compact('quotation'));
    }

    /**
     * Update quotation status
     */
    public function updateStatus(Request $request, Quotation $quotation)
    {
        $request->validate([
            'status' => 'required|in:pending,sent,accepted,rejected,expired',
        ]);

        $oldStatus = $quotation->status;
        $quotation->update([
            'status' => $request->status,
            'responded_at' => in_array($request->status, ['accepted', 'rejected']) ? now() : null,
            'sent_at' => $request->status === 'sent' ? now() : $quotation->sent_at,
        ]);

        return response()->json([
            'success' => true,
            'message' => "Quotation status updated from {$oldStatus} to {$request->status}",
            'status' => $quotation->formatted_status,
            'status_color' => $quotation->status_color,
        ]);
    }

    /**
     * Add admin notes to quotation
     */
    public function addNotes(Request $request, Quotation $quotation)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:1000',
        ]);

        $quotation->update([
            'admin_notes' => $request->admin_notes,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Admin notes added successfully',
            'notes' => $quotation->admin_notes,
        ]);
    }

    /**
     * Download quotation PDF
     */
    public function downloadPdf(Quotation $quotation)
    {
        // Prepare quotation data for PDF
        $quotationData = [
            'quotation_number' => $quotation->quotation_number,
            'date' => $quotation->created_at->format('F d, Y'),
            'valid_until' => $quotation->valid_until->format('F d, Y'),
            'customer' => [
                'name' => $quotation->customer_name,
                'email' => $quotation->customer_email ?? 'Not provided',
                'phone' => $quotation->customer_phone,
                'address' => $quotation->customer_address ?? 'Not provided',
                'city' => $quotation->customer_city ?? 'Not provided',
                'state' => $quotation->customer_state ?? '',
                'postal_code' => $quotation->customer_postal_code ?? '',
                'country' => $quotation->customer_country ?? 'Sri Lanka',
            ],
            'items' => $quotation->items_data,
            'subtotal' => $quotation->subtotal,
            'original_subtotal' => $quotation->original_subtotal,
            'total_discount' => $quotation->total_discount,
            'shipping_cost' => $quotation->shipping_cost,
            'tax_amount' => $quotation->tax_amount,
            'total' => $quotation->total_amount,
            'notes' => $quotation->notes ?? ''
        ];

        // Generate PDF
        $pdf = Pdf::loadView('quotations.pdf', $quotationData);
        $pdf->setPaper('A4', 'portrait');
        
        // Set PDF options for better rendering
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => true,
            'defaultFont' => 'DejaVu Sans',
        ]);

        // Return PDF download
        return $pdf->download('CeylonIT-Quotation-' . $quotation->quotation_number . '.pdf');
    }

    /**
     * Delete quotation
     */
    public function destroy(Quotation $quotation)
    {
        $quotationNumber = $quotation->quotation_number;
        $quotation->delete();

        return response()->json([
            'success' => true,
            'message' => "Quotation {$quotationNumber} deleted successfully",
        ]);
    }

    /**
     * Bulk actions for quotations
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,update_status',
            'quotation_ids' => 'required|array',
            'quotation_ids.*' => 'exists:quotations,id',
            'status' => 'required_if:action,update_status|in:pending,sent,accepted,rejected,expired',
        ]);

        $quotations = Quotation::whereIn('id', $request->quotation_ids);
        $count = $quotations->count();

        if ($request->action === 'delete') {
            $quotations->delete();
            $message = "{$count} quotation(s) deleted successfully";
        } else {
            $quotations->update([
                'status' => $request->status,
                'responded_at' => in_array($request->status, ['accepted', 'rejected']) ? now() : null,
                'sent_at' => $request->status === 'sent' ? now() : null,
            ]);
            $message = "{$count} quotation(s) status updated to {$request->status}";
        }

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    /**
     * Get quotation statistics for dashboard
     */
    public function statistics()
    {
        $stats = [
            'total_quotations' => Quotation::count(),
            'pending_quotations' => Quotation::where('status', 'pending')->count(),
            'accepted_quotations' => Quotation::where('status', 'accepted')->count(),
            'expired_quotations' => Quotation::expired()->count(),
            'today_quotations' => Quotation::whereDate('created_at', Carbon::today())->count(),
            'weekly_quotations' => Quotation::whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])->count(),
            'monthly_quotations' => Quotation::whereBetween('created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])->count(),
            'total_value' => Quotation::sum('total_amount'),
            'monthly_value' => Quotation::whereBetween('created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])->sum('total_amount'),
        ];

        return response()->json($stats);
    }
}