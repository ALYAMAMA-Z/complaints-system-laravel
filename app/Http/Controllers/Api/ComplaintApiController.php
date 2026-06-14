<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComplaintRequest;
use App\Models\Complaint;
use App\Services\ComplaintService;
use Illuminate\Http\Request;

class ComplaintApiController extends Controller
{
    protected $complaintService;

    public function __construct(ComplaintService $complaintService)
    {
        $this->complaintService = $complaintService;
        // $this->middleware('auth:sanctum');
    }

    // GET /api/complaints
    public function index()
    {
        \Log::info('===== DEBUG TOKEN =====');
        \Log::info('User ID: '.auth()->id());
        \Log::info('User check: '.(auth()->check() ? 'logged in' : 'not logged in'));
        \Log::info('Token: '.request()->bearerToken());

        $complaints = $this->complaintService->getAllComplaints();

        return response()->json([
            'success' => true,
            'data' => $complaints,
        ]);
    }

    // POST /api/complaints

    public function store(StoreComplaintRequest $request)
    {
        try {
            \Log::info('=== START POST ===');
            \Log::info('User: '.auth()->id());

            $validatedData = $request->validated();
            $validatedData['user_id'] = auth()->id();

            $complaint = Complaint::create($validatedData);

            return response()->json([
                'success' => true,
                'data' => $complaint,
            ], 201);

        } catch (\Exception $e) {
            \Log::error('Error: '.$e->getMessage());
            \Log::error('Line: '.$e->getLine());
            \Log::error('File: '.$e->getFile());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }

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
