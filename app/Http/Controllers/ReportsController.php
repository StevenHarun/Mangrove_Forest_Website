<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Reports; // Menggunakan nama model yang benar
use Illuminate\View\View;

class ReportsController extends Controller
{
    public function create(): View
    {
        return view('report.report');
    }

    public function viewReport()
    {
        $reports = Reports::all();

        return view('report.viewreport', compact('reports'));
    }

    public function store(Request $request){
        $request->validate([ 
            'report_title' => 'required|string|max:255', 
            'category' => 'required|string|max:255', 
            'location' => 'required|string|max:255', 
            'date' => 'required|date', 
            'description' => 'required|string', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);
    
        // Get the uploaded image
        $image = $request->file('image');
    
        // Check if an image was uploaded
        if ($image) {
            // Get the image contents as a binary string
            $imageBinary = file_get_contents($image->getPathname());
    
            // Store the image in the database as a BLOB
            Reports::create([
                'report_title' => $request->report_title,
                'category' => $request->category,
                'location' => $request->location,
                'date' => $request->date,
                'description' => $request->description,
                'image' => $imageBinary, // Store the image as a BLOB
            ]);
        } else {
            Reports::create([
                'report_title' => $request->report_title,
                'category' => $request->category,
                'location' => $request->location,
                'date' => $request->date,
                'description' => $request->description,
            ]);
        }

        Session::flash('success', 'Laporan berhasil ditambahkan.');
    
        return view('report.report');
    }

    public function retrieveImage($reportId)
    {
        $report = Reports::findOrFail($reportId);

        // Check if the report has an image
        if (!$report->image) {
            abort(404);
        }

        // Return the image as a response
        return response($report->image)
            ->header('Content-Type', 'image/jpeg'); // Adjust content type if necessary
    }

    // Tambahkan method filter untuk mengatur filter
    public function filter($category)
    {
        // Lakukan query berdasarkan kategori yang dipilih
        $reports = Reports::where('category', $category)->get();

        // Kirim data ke view
        return view('report.viewreport', compact('reports'));
    }

    public function destroy($id)
    {
    $report = Reports::findOrFail($id);
    $reportTitle = $report->report_title;
    $report->delete();
    return back()->with('success', 'Laporan "' . $reportTitle . '" berhasil dihapus.');
    }
}
