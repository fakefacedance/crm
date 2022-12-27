<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDealRequest;
use App\Models\Client;
use App\Models\Deal;
use App\Models\Funnel;
use App\Models\Employee;

class DealController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Deal::class);

        return view('deals.create', [
            'clients' => Client::all(),
            'employees' => Employee::all(),
            'funnels' => Funnel::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDealRequest $request)
    {
        Deal::create([
            'title' => $request->title,
            'client_id' => $request->client,
            'employee_id' => $request->employee,
            'funnel_id' => $request->funnel,
            'stage' => 0,
            'amount' => $request->amount,
            'created_at' => now()
        ]);

        return redirect()->route('deals.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Deal::find($id));

        Deal::find($id)->delete();

        return redirect()->route('deals.index');
    }
}
