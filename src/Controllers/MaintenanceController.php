<?php

namespace NewJapanOrders\Maintenance\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use NewJapanOrders\Maintenance\Models\Maintenance;
use NewJapanOrders\Maintenance\DatetimeInput;

class MaintenanceController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $maintenances = Maintenance::paginate();
        return view('maintenance::index', compact('maintenances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('maintenance::create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $inputs['start_at'] = DatetimeInput::combine($inputs['start_at']);
        $inputs['finish_at'] = DatetimeInput::combine($inputs['finish_at']);
        if (!empty($inputs['auto_finish'])) {
            $inputs['finished_at'] = $inputs['finish_at']; 
        }
        Maintenance::create($inputs);

        return redirect()->route('maintenances.index')->with('message', 'Item created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $start_at = DatetimeInput::separate($maintenance['start_at']);
        $finish_at = DatetimeInput::separate($maintenance['finish_at']);

        return view('maintenance::edit', compact('maintenance', 'start_at', 'finish_at'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $inputs = $request->all();

        $maintenance = Maintenance::findOrFail($id);     
        $inputs['start_at'] = DatetimeInput::combine($inputs['start_at']);
        $inputs['finish_at'] = DatetimeInput::combine($inputs['finish_at']);
        if (empty($inputs['auto_finish'])) {
            $inputs['finished_at'] = null;
        } else {
            $inputs['finished_at'] = $inputs['finish_at']; 
        }
        $maintenance->update($inputs);

        return redirect()->route('maintenances.index')->with('message', 'Item updated successfully.');
    }
}
