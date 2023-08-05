<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Document;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::all();
        return view('loans.index', compact('loans'));
    }

    public function indexFile()
    {
        $documents = Document::all();
        return view('loans.edit', compact('documents'));
    }

    public function create()
    {
        return view('loans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:2000|max:100000',
        ]);

        $loanType = $request->input('type');
        $amount = $request->input('amount');
        $duration = $request->input('duration');

        if ($loanType == 1) { // Home Loan
            $interest = 0.005;
            $installment = ($amount * $interest * pow(1 + $interest, $duration)) / (pow(1 + $interest, $duration) - 1);
        } else { // Personal Loan
            $durationYear = $duration / 12;
            $installment = ($amount * 0.08 * $durationYear + $amount) / $duration;
        }

        $loan = Loan::create([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'amount' => $amount * 100,
            'duration' => $duration,
            'installment' => $installment * 100, // Convert to cents
        ]);

        return redirect()->route('loans.index')->with('success', 'Loan application added successfully!');
    }

    public function show(Loan $loan)
    {
        $documents = $loan->documents;
        return view('loans.show', compact('loan', 'documents'));
    }

    public function edit(Loan $loan)
    {
        $documents = $loan->documents;
        return view('loans.edit', compact('loan', 'documents'));
    }

    public function update(Request $request, Loan $loan)
    {
        $request->validate([
            'amount' => 'required|numeric|min:2000|max:100000',
        ]);

        $loanType = $request->input('type');
        $amount = $request->input('amount') * 100;
        $duration = $request->input('duration');

        if ($request->hasFile('uploadFile')) {
            $file = $request->file('uploadFile');
            // dd($file->getSize());
            $maxSizeInBytes = 20 * 1024 * 1024; // 20 MB
            if ($file->getSize() > $maxSizeInBytes) {
                return redirect()->back()->withInput()->withErrors(['uploadFile' => 'The file size exceeds the maximum limit of 20 MB.']);
            }
            $extension = strtoupper($file->getClientOriginalExtension());
            $filename = $file->getClientOriginalName();
            $content = $file->storeAs('assets', $filename);

            if (isset($filename) && isset($extension) && isset($content)) {
                $file->move('assets', $filename);
                Document::create([
                    'loan_id' => $loan->loan_id,
                    'file_name' => $filename,
                    'extension' => $extension,
                    'content' => $content,
                ]);
            }
        }

        if ($loanType == 1) { // Home Loan
            $interest = 0.005;
            $installment = ($amount * $interest * pow(1 + $interest, $duration)) / (pow(1 + $interest, $duration) - 1);
        } else { // Personal Loan
            $durationYear = $duration / 12;
            $installment = ($amount * 0.08 * $durationYear + $amount) / $duration;
        }

        $loan->update([
            'name' => $request->input('name'),
            'type' => $loanType,
            'amount' => $amount,
            'duration' => $duration,
            'installment' => $installment,
        ]);

        return redirect()->route('loans.index')->with('success', 'Loan application updated successfully!');
    }

    public function download($file)
    {
        if (!empty($file) && file_exists(public_path('assets/' . $file))) {
            return response()->download(public_path('assets/' . $file));
        } else {
            throw new FileNotFoundException($file);
        }
    }

    public function destroy(Loan $loan)
    {
        $loan->delete();
        return redirect('/loans')->with('success', 'Loan application deleted successfully.');
    }
}
