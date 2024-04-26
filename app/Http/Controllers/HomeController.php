<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->orderBy('name', 'ASC')->take(8)->get();
        $featureJobs = Job::where('status', 1)->orderBy('created_at', 'DESC')->with('jobType')->where('isFeature', 1)->take(6)->get();
        $latestJobs = Job::where('status', 1)->with('jobType')->orderBy('created_at', 'DESC')->take(6)->get();
        return view('front.home', [
            'categories' => $categories,
            'featureJobs' => $featureJobs,
            'latestJobs' => $latestJobs,
        ]);
    }
}
