<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComplaintRequest;
use App\Services\ComplaintService;

class ComplaintController extends Controller
{
    protected $complaintService;

    public function __construct(ComplaintService $complaintService)
    {
        $this->complaintService = $complaintService;
    }

    public function index()
    {
        $complaints = $this->complaintService->getAllComplaints();

        return view('complaints.index', compact('complaints'));
    }

    public function create()
    {
        return view('complaints.create');
    }

    public function store(StoreComplaintRequest $request)
    {
        $complaint = $this->complaintService->createComplaint($request);

        return redirect()->route('complaints.index')
            ->with('success', 'تم إرسال الشكوى بنجاح');
    }
}
