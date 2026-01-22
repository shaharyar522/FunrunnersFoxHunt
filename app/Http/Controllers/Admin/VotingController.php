<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voting;
use App\Models\VotingContestant;
use Carbon\Carbon;


class VotingController extends Controller
{
    public function index()
    {
        $votings = Voting::orderBy('creationdate', 'desc')->get();
        return view('admin.voting.list', compact('votings'));
    }

  
public function changeStatus($id)
{
    $voting = Voting::findOrFail($id);
 // now es main  agr voting ka scene hain. agr 
    // voting status = 0 hnga tu pending , 1 open or close 0

    // jb pending par click kary guy tu wo open ho jay ga , or agr open par click kary guy tu wo close ho jay ga
    if ($voting->status == 0) {
        $voting->status = 1; // Pending → Open
    } elseif ($voting->status == 1) {
        $voting->status = 2; // Open → Closed
    } else {
        $voting->status = 0; // Closed → Pending
    }

    $voting->save();

    return back()->with('success', 'Voting status updated');
}


 // Show Add Voting Form
    public function create()
    {
        return view('admin.voting.create');
    }


     // Store Voting
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'votingdate' => 'required|date',
        ]);

        Voting::create([

            'title' => $request->title,
            'creationdate' => Carbon::now()->toDateString(),
            'votingdate' => $request->votingdate,
            'status' => $request->status ?? 0, // Pending => 0 , open => 1, close => 0

        ]);

        return redirect()->route('admin.voting.list')
           ->with('success', 'Voting round added successfully!');
    }

// ============ detials show model =========================================
    public function detail($id)
{
    // Get voting with contestants
    $voting = Voting::with(['votingContestants.contestant'])->findOrFail($id);

    // Return HTML for AJAX modal
    if(request()->ajax()){
        return view('admin.voting.detail', compact('voting'))->render();
    }

    // fallback
    return view('admin.voting.detail', compact('voting'));
}

// Toggle contestant status
public function toggleContestantStatus($id)
{
    $vc = VotingContestant::findOrFail($id);
    $vc->status = $vc->status == 1 ? 0 : 1; // toggle
    $vc->save();

    return response()->json([
        'success' => true,
        'status' => $vc->status
    ]);
}

}
