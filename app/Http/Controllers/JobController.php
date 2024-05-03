<?php

namespace App\Http\Controllers;

use App\Mail\JobNotificationEmail;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobType;
use App\Models\SavedJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('status', 1)->get();
        $jobTypes = JobType::where('status', 1)->get();
        $jobs = Job::where('status', 1);

        //Search using Keyword
        if (!empty($request->keyword)) {
            $jobs = $jobs->where(function ($query) use ($request) {
                $query->orWhere('title', 'like', '%' . $request->keyword . '%');
                $query->orWhere('keywords', 'like', '%' . $request->keyword . '%');
            });
        }
        //Search using Location
        if (!empty($request->location)) {
            $jobs = $jobs->where('location', $request->location);
        }
        //Search using Category
        if (!empty($request->category)) {
            $jobs = $jobs->where('category_id', $request->category);
        }
        //Search using JobType
        $jobTypeArray = [];
        if (!empty($request->jobType)) {
            $jobTypeArray = explode(',', $request->jobType);
            $jobs = $jobs->whereIn('job_type_id', $jobTypeArray);
        }
        //Search using Experience
        if (!empty($request->experience)) {
            $jobs = $jobs->where('experience', $request->experience);
        }

        $jobs = $jobs->with(['jobType', 'category']);

        if ($request->sort == "0") {
            $jobs = $jobs->orderBy('created_at', 'ASC');
        } else {
            $jobs = $jobs->orderBy('created_at', 'DESC');
        }

        $jobs = $jobs->paginate(9);
        return view('front.jobs', [
            'categories' => $categories,
            'jobTypes' => $jobTypes,
            'jobs' => $jobs,
            'jobTypeArray' => $jobTypeArray
        ]);
    }

    public function detail($id)
    {
        $job = Job::where(['id' => $id, 'status' => 1])->with(['jobType', 'category'])->first();

        if ($job == null) {
            abort(404);
        }

        $count = SavedJob::where([
            'user_id' => Auth::user()->id,
            'job_id' => $id,
        ])->count();

        return view('front.jobDetail', [
            'job' => $job,
            'count' => $count
        ]);
    }

    public function applyJob(Request $request)
    {
        $id = $request->id;
        $job = Job::where(['id' => $id])->first();

        // Job does not found db
        if ($job == null) {
            session()->flash('error', 'Job does not exist');
            return response()->json([
                'status' => false,
                'message' => 'Job does not exist',
            ]);
        };

        //You can not apply on this job twice
        $jobApplicationCount = JobApplication::where(
            [
                'user_id' => Auth::user()->id,
                'job_id' => $id
            ]
        )->count();
        if ($jobApplicationCount > 0) {
            session()->flash('error', 'You already applied on this job');
            return response()->json([
                'status' => false,
                'message' => 'You already applied on this job',
            ]);
        }

        //you can not apply on your own job
        $employer_id = $job->user_id;
        if ($employer_id == Auth::user()->id) {
            session()->flash('error', 'You can not apply on your own job');
            return response()->json([
                'status' => false,
                'message' => 'You can not apply on your own job'
            ]);
        };

        $application = new JobApplication();
        $application->job_id = $id;
        $application->user_id = Auth::user()->id;
        $application->employer_id = $employer_id;
        $application->applied_date = now();
        $application->save();

        //Send Notification Email to Employee
        $employee = User::where('id', $employer_id)->first();

        $mailData = [
            'employee' => $employee,
            'user' => Auth::user(),
            'job' => $job
        ];
        Mail::to($employee->email)->send(new JobNotificationEmail($mailData));

        session()->flash('success', 'You have successfully applied');
        return response()->json([
            'status' => false,
            'message' => 'You have successfully applied'
        ]);
    }

    public function saveJob(Request $request)
    {
        $id = $request->id;
        $job = Job::find($id);

        if ($job == null) {
            session()->flash('error', 'Job not found');

            return response()->json([
                'status' => false,
            ]);
        }

        //Check if user already saved in job
        $count = SavedJob::where([
            'user_id' => Auth::user()->id,
            'job_id' => $id,
        ])->count();

        if ($count > 0) {
            session()->flash('error', 'You already applied on this job');

            return response()->json([
                'status' => false,
            ]);
        }

        $saveJob = new SavedJob();
        $saveJob->job_id = $id;
        $saveJob->user_id = Auth::user()->id;
        $saveJob->save();

        session()->flash('success', 'You have successfully saved on this job');

        return response()->json([
            'status' => true,
        ]);
    }
}
