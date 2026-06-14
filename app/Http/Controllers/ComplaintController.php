<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComplaintRequest;
use App\Services\ComplaintService;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    protected $complaintService;

    public function __construct(ComplaintService $complaintService)
    {
        $this->complaintService = $complaintService;
    }

    public function index()
    {
        $complaints = $this->complaintService->getAllComplaintsForEmployee();

        return view('complaints.index', compact('complaints'));
    }

    public function create()
    {
        return view('complaints.create');
    }

    public function store(StoreComplaintRequest $request)
    {
        \Log::info('POST request received');
        \Log::info('Authorization header: '.$request->header('Authorization'));
        $complaint = $this->complaintService->createComplaint($request);

        return redirect()->route('complaints.index')
            ->with('success', 'تم إرسال الشكوى بنجاح');
    }

    public function updateStatus(Request $request, $id)
    {
        $complaint = $this->complaintService->getComplaintById($id);

        if (! $complaint) {
            return redirect()->route('complaints.index')->with('error', 'الشكوى غير موجودة');
        }

        $complaint->status = $request->status;
        $complaint->save();

        return redirect()->route('complaints.index')->with('success', 'تم تحديث حالة الشكوى بنجاح');
    }
}
