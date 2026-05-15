<?php

namespace App\Services;

use App\Models\Complaint;
use App\Http\Requests\StoreComplaintRequest;

class ComplaintService
{
    protected $hfService;

    public function __construct(HuggingFaceService $hfService)
    {
        $this->hfService = $hfService;
    }

    public function getAllComplaints()
    {
        return Complaint::latest()->get();
    }

    public function getComplaintById($id)
    {
        return Complaint::find($id);
    }

    public function createComplaint(StoreComplaintRequest $request): Complaint
    {
        $validatedData = $request->validated();
        
        // إنشاء الشكوى أولاً
        $complaint = Complaint::create($validatedData);
        
        // تصنيف الشكوى باستخدام الذكاء الاصطناعي
        $predictedCategory = $this->hfService->classifyText($complaint->description);
        
        // تحديث التصنيف في قاعدة البيانات
        $complaint->category = $predictedCategory;
        $complaint->save();
        
        return $complaint;
    }
}