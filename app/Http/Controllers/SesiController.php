<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class SesiController extends Controller
{
    public function index()
    {
        $sesis = Sesi::all();
        return view('cbt-user.start-cbt', compact('sesis'));
    }

    public function create()
    {
        return view('cbt-user.create');
    }

    public function store(Request $request)
    {
        $newUID = $this->generateUID();
        Sesi::create([
            'uid' => $newUID,
            'keluhan' => $request->input('keluhan'),
            'status' => $request->input('status'),
        ]);
        return redirect()->route('start-cbt.index');
    }

    public function edit($id)
    {
        $sesi = Sesi::find($id);
        return view('cbt-user.edit', compact('sesi'));
    }

    public function update(Request $request, $id)
    {
        $sesi = Sesi::find($id);
        $sesi->update($request->all());
        return redirect()->route('start-cbt.index');
    }

    public function delete($id): RedirectResponse
    {
        if ($sesi = Sesi::find($id)) {
            $sesi->delete();

            return redirect()->route('start-cbt.index')->with('success', 'User removed!');
        }

        return redirect('users')->with('error', 'User not found');
    }


// Assuming you're in a controller method
public function generateUID()
{
    $datePart = now()->format('dmY'); // Get the current date in 'dmY' format
    $lastUID = DB::table('sesis')->max('id'); // Get the highest existing UID

    if ($lastUID) {
        $incrementalPart = str_pad((int)substr($lastUID, -2) + 1, 2, '0', STR_PAD_LEFT);
    } else {
        $incrementalPart = '01'; // If there are no existing UIDs, start with '01'
    }

    $newUID = $datePart . $incrementalPart;

    return $newUID;
}

}
