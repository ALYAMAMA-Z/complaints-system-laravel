<?php

namespace App\Services;

use App\Http\Requests\StoreComplaintRequest;
use App\Models\Complaint;

class ComplaintService
{
    protected $hfService;

    public function __construct(HuggingFaceService $hfService)
    {
        $this->hfService = $hfService;
    }

    public function getAllComplaints()
    {
        if (auth()->user() && auth()->user()->role === 'employee') {
            return Complaint::latest()->get();  // الموظف يرى كل الشكاوى
        }

        return Complaint::where('user_id', auth()->id())->latest()->get();  // المواطن يرى شكاويه فقط
    }

    public function getComplaintById($id)
    {
        return Complaint::find($id);
    }

    public function getAllComplaintsForEmployee()
    {
        return Complaint::latest()->get();
    }

    public function createComplaint(StoreComplaintRequest $request): Complaint
    {
        $validatedData = $request->validated();

        // ربط الشكوى بالمستخدم المسجل (إذا كان موجوداً)
        if (auth()->check()) {
            $validatedData['user_id'] = auth()->id();
        } else {
            // إذا لم يكن مستخدم مسجل، نستخدم user_id افتراضي أو نتركه NULL
            $validatedData['user_id'] = null;
        }
        \Log::info('User check: '.(auth()->check() ? 'logged in' : 'not logged in'));
        \Log::info('User ID: '.auth()->id());

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('complaints', 'public');
            $validatedData['image'] = $imagePath;
        }

        $complaint = Complaint::create($validatedData);

        // التصنيف الذكي
        $predictedCategory = $this->hfService->classifyText($complaint->description);
        $complaint->category = $predictedCategory;
        $complaint->save();

        return $complaint;
    }

    public function createComplaintWithData(array $data, $request = null): Complaint
    {
        if ($request && $request->hasFile('image')) {
            $imagePath = $request->file('image')->store('complaints', 'public');
            $data['image'] = $imagePath;
        }

        $complaint = Complaint::create($data);

        // التصنيف الذكي
        $predictedCategory = $this->hfService->classifyText($complaint->description);
        $complaint->category = $predictedCategory;
        $complaint->save();

        return $complaint;
    }
}
