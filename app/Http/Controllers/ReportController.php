<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Test;
use App\Models\report;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Facades\pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories= Category::all();
        $sub_categories= SubCategory::all();
        $tests= Test::all();
        $reports= Report::all();
        return view('report.index', compact('categories', 'sub_categories', 'tests','reports'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= Category::all();
        $sub_categories= SubCategory::all();
        $tests= Test::all();
        return view('report.add', compact('categories', 'sub_categories', 'tests'));
        return view('report.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $report=new Report();
        $report->Patient_name=$request->name;
        $report->Patient_age=$request->age;
        $report->refer_by_doctor=$request->refer_by_doctor;
        $report->category_id=$request->category;
        $report->sub_category_id=$request->sub_category;
        $report->test_id=$request->test_id;
        $report->Patient_result=$request->test_report;
        $report->save();
        return redirect('/test');

    }

    /**
     * Display the specified resource.
     */
    public function show(report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(report $report)
    {
        //
    }

    function view($id) {
        $report=report::find($id);
        $template= view('report.view_report',['report'=>$report])->render();

        Browsershot::html($template)->save(storage_path('/app/public/report'.$report->id.'.pdf'));

    }
}
