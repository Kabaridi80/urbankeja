<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 1. See all agents
    public function index() {
        // We only want to see people who are NOT admins (the agents)
        $agents = User::where('is_admin', false)->latest()->get();
        return view('admin.agents', compact('agents'));
    }

    // 2. Verify an agent (gives them the badge)
    public function verify($id) {
        $agent = User::findOrFail($id);
        $agent->update(['is_verified' => true]);
        return back()->with('success', 'Agent is now verified!');
    }

    // 3. Delete an agent
    public function destroy($id) {
        $agent = User::findOrFail($id);
        $agent->delete();
        return back()->with('success', 'Agent removed from UrbanKeja.');
    }
}