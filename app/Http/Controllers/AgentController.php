<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Database\QueryException;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Agent::with('user')->latest();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('parent_id', function ($row) {
                    if ($row->parent_id != null)
                        return $row->parent_id;
                    else
                        return 'N / A';
                })
                ->addColumn('action', function ($row) {
                    return view('agents.action', ['row' => $row]);
                })
                ->rawColumns(['action', 'parent_id'])
                ->make(true);
        }
        $agents = Agent::whereNull('parent_id')->with('user')->get();
        // dd($agents->toArray());
        $users = User::whereDoesntHaveRole()->get();
        return view('agents.agents', ['users' => $users, 'agents' => $agents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|max:255',
        ]);

        Agent::create($request->all());
        $user = User::find($request->user_id);
        $user->attachRole('agent');

        return redirect()->route('agents.index')
            ->with('success', 'Agent created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent $agent)
    {
        $agents = Agent::whereNull('parent_id')->with('user')->get();
        // dd($agents->toArray());
        $users = User::whereDoesntHaveRole()->get();
        return view('agents.agents', ['agent' => $agent, 'agents' => $agents, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agent $agent)
    {
        $request->validate([
            'user_id' => 'required|integer|max:255',
        ]);

        $agent->update($request->all());

        return redirect()->route('agents.index')
            ->with('success', 'Agent updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $agent)
    {
        try {
            return $agent->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
