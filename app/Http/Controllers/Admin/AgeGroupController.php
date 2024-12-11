<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AgeGroupService;
use App\ValueObject\AgeGroup;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AgeGroupController extends Controller
{
    public function __construct(
        private readonly AgeGroupService $ageGroupService,
    ) {
    }

    public function index(): View
    {
        $ageGroups = $this->ageGroupService->getAllAgeGroups();

        return view('admin.age-group.index', [
            'ageGroups' => $ageGroups,
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'age_group' => ['required', 'string', 'max:255'],
        ]);

        $this->ageGroupService->storeAgeGroup(
            AgeGroup::fromString($request->get('age_group')),
        );

        return redirect()->route('admin.age_group.index')->with('status', __('Age group created successfully.'));
    }

    public function edit(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'age_group' => ['required', 'string', 'max:255'],
        ]);

        $this->ageGroupService->updateAgeGroup(
            AgeGroup::fromString($request->get('age_group')),
            $id,
        );

        return redirect()->route('admin.age_group.index')->with('status', __('Age group updated successfully.'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->ageGroupService->deleteAgeGroup($id);

        return redirect()->route('admin.age_group.index')->with('status', __('Age group deleted successfully.'));
    }
}
