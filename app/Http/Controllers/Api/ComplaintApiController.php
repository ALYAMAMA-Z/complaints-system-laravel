<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComplaintRequest;
use App\Services\ComplaintService;
use Illuminate\Http\Request;

class ComplaintApiController extends Controller
{
    protected $complaintService;

    public function __construct(ComplaintService $complaintService)
    {
        $this->complaintService = $complaintService;
    }

    // GET /api/complaints
    public function index()
    {
        $complaints = $this->complaintService->getAllComplaints();

        return response()->json([
            'success' => true,
            'data' => $complaints,
        ]);
    }

    // POST /api/complaints
    public function store(StoreComplaintRequest $request)
    {
        $complaint = $this->complaintService->createComplaint($request);

        return response()->json([
            'success' => true,
            'message' => 'تم إرسال الشكوى بنجاح',
            'data' => $complaint,
        ], 201);
    }

    // GET /api/complaints/{id}
    public function show($id)
    {
        $complaint = $this->complaintService->getComplaintById($id);
        if (! $complaint) {
            return response()->json([
                'success' => false,
                'message' => 'الشكوى غير موجودة',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $complaint,
        ]);
    }

    // PUT/PATCH /api/complaints/{id} (اختياري، يمكن تركه فارغاً حالياً)
    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'تحديث الشكوى ليس متاحاً بعد'], 501);
    }

    // DELETE /api/complaints/{id} (اختياري)
    public function destroy($id)
    {
        return response()->json(['message' => 'حذف الشكوى ليس متاحاً بعد'], 501);
    }
}
