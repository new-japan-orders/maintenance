<?php

namespace NewJapanOrders\Maintenance\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use NewJapanOrders\Maintenance\Models\Maintenance;
use NewJapanOrders\Maintenance\DatetimeInput;
use View;

class MaintenanceController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $index_view = 'maintenances.index';
    protected $create_view = 'maintenances.create';
    protected $edit_view = 'maintenances.edit';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $maintenances = Maintenance::paginate();
        if (!View::exists($this->index_view)) {
            $this->index_view = 'maintenance::index';
        }
        return view($this->index_view, compact('maintenances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (!View::exists($this->create_view)) {
            $this->create_view = 'maintenance::create';
        }
        return view($this->create_view);
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

        if (!View::exists($this->edit_view)) {
            $this->edit_view = 'maintenance::edit';
        }
        return view($this->edit_view, compact('maintenance', 'start_at', 'finish_at'));
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
        $maintenance->update($inputs);

        return redirect()->route('maintenances.index')->with('message', 'Item updated successfully.');
    }

    public function finish($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->update(['finished_at' => date('Y-m-d H:i:s')]);
        return redirect()->route('maintenances.index')->with('message', 'Item updated     successfully.');
    }
}
